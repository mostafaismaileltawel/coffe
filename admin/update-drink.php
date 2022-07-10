<?php include('partials/menu.php')?>

<?php

         if(isset($_GET['id']))
         {
     
         
              $id = $_GET['id'];
           //mysql query
              $sql2 = "SELECT * FROM tbl_drink WHERE id=$id";
              $res2 = mysqli_query($conn,$sql2);
            
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_category = $row2['category_id'];
                $current_image = $row2['image_name'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            


          }

    
         else
         {
            //REDIRECT TO MANAGE Drink

            header('location:'.SITEURL.'admin/manage-drink.php');

         }
         
         ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Drink</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
       <table class="tbl-30">
              <tr>
                <td> Title: </td>
                <td>
                <input type="text" name="title"  value="<?php echo $title; ?>">

                </td>
        </tr>
           <tr>
             <td> Description: </td>
             <td>
           <textarea name="description" cols="30" rows="5" ><?php echo $description; ?></textarea>

             </td>
           </tr>
           <tr>
             <td>Price:</td>
             <td>
                 <input type="number" name="price" value="<?php echo $price; ?>">
             </td>
           </tr>
              <tr>
                <td>Current Image:</td>
                <td>
                <?php
                if($current_image == ""){
                  //show errormessage
                  echo "<div class'error'>image not added</div>";

                  
                }
                else
                {
                  ?>
                  <img src="<?php echo SITEURL; ?>images/drinks/<?php echo $current_image; ?>" width="100px">
                  <?php
                }
                ?>
                </td>
              </tr>
              <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
              </tr>

              <tr>
             <td>Category:</td>
             <td>
                <select name="category">

               <?php 
               $sql="SELECT * FROM tbl_category WHERE active ='yes' ";
               $res =mysqli_query($conn ,$sql);
               $count = mysqli_num_rows($res);

               if($count>0)
               {   
                //category available
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    ?>
                     <option <?php if($current_category==$id){echo "selected";} ?> value="<?php echo $id; ?>"><?php echo $title ?></option>

                    
                     <?php 
                }
                }
               else
               {
                 
               ?>
               <option value="0">no category found</option>
               <?php
               }


               ?>
               



                </select>
             </td>
           </tr>






               <tr>
                 <td>Featured:</td>
              <td>
                <input <?php if($featured=="yes"){echo"checked";} ?> type="radio" name="featured" value="yes">Yes
                <input <?php if($featured=="no"){echo"checked";} ?> type="radio" name="featured" value="no"> No

              </td>
               </tr>




               <tr>
                 <td>Active:</td>
              <td>
                <input <?php if($active=="yes"){echo"checked";} ?> type="radio" name="active" value="yes">Yes
                <input <?php if($active=="no"){echo"checked";} ?> type="radio" name="active" value="no"> No

          
               </tr>
               <tr>
                <td colspan="2">
                    <input type="hidden" name=" current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name=" id" value="<?php echo $id; ?>">

                    <input type="submit" name="submit" value="Update Drink" class="btn btn-secondary">
                </td>
               </tr>

        </table>
        </form>
          <!-- //save update data -->
          <?php
        //get all value from form
       
        if(isset($_POST['submit'])){

          $id = $_POST['id'];
          $title = $_POST['title'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];
          $current_image = $_POST['current_image'];
          $featured = $_POST['featured'];
          $active = $_POST['active'];

          //update image if is selected 
          if($_FILES['image']['name']){
            //get all image details

            $image_name = $_FILES['image']['nmae'];
            if($image_name != "")
            {
                //upload new image 

                $ext = end(explode('.',$image_name));
            $image_name = "drink_name_".rand(000,999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/drinks/".$image_name;
              //upload image
            $upload = move_uploaded_file($source_path,$destination_path);

            //check image is upload or no if not upload stop proccess and show error message 
            if($upload==false){
                $_SESSION['upload'] = "<div class='error'> failed to upload image</div>";
                header('location:'.SITEURL.'admin/manage-drink.php');
                die();

            }
            if($current_image != ""){
                $remove_path = "../images/drinks/".$current_image;
                $remove = unlink($remove_path);
                if($remove==false){
                    $_SESSION['failed_remove'] = "<dive class'error'>failed to remove current image</dive>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-drink.php');
                    die();
                }

            }
           

            }
            else{

                $image_name = $current_image; 
            }
          }
          else{

            $image_name = $current_image;
          }

          //updating  database 
          $sql3 = "UPDATE tbl_drink  SET 
          title = '$title',
          description = '$description',
          price = '$price',
          image_name = '$image_name',
          category_id = '$category',
          featured = '$featured',
          active = '$active'
          WHERE id=$id";
          $res3 = mysqli_query($conn,$sql3);

          if($res3==true){
       
            $_SESSION['update'] = "<div class='success'>Drink update successfuly</div>";
            header('location:'.SITEURL.'admin/manage-drink.php');
          }
          else {
            $_SESSION['update'] = "<div class='error'>Drink update failed</div>";
            header('location:'.SITEURL.'admin/manage-drink.php');
          }

         }




?>


       
       
</div>
</div>

<?php include('partials/footer.php')?>
