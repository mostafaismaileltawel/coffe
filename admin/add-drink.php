<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="warpper">
    <h1>Add Drink</h1>
    <br/> <br/> <br/>
    <?php
      
         if(isset($_SESSION['upload']))
         {
            echo  $_SESSION['upload'] ;
            unset( $_SESSION['upload']);
 
          }
         ?>
           <br><br>
    <form action="" method="POST" enctype="multipart/form-data">
     
     <table class="tbl-30">
           <tr>
             <td> Title: </td>
             <td>
             <input type="text" name="title" placeholder="title of drink">

             </td>
           </tr>
           <tr>
             <td> Description: </td>
             <td>
           <textarea name="description" cols="30" rows="5" placeholder="description of the drink"></textarea>

             </td>
           </tr>
           <tr>
             <td>Price:</td>
             <td>
                 <input type="number" name="price">
             </td>
           </tr>
           <tr>
             <td>Select Image:</td>
             <td>
                 <input type="file" name="image">
             </td>
           </tr>


           <tr>
             <td>Category:</td>
             <td>
                <select name="category">

               <?php 
               $sql=" SELECT * FROM tbl_category WHERE active ='yes' ";
               $res =mysqli_query($conn ,$sql);
               $count = mysqli_num_rows($res);

               if($count>0)
               {
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    ?>
                     <option value="<?php echo $id ?>"><?php echo $title ?></option>

                    
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
             <input type="radio" name="featured" value="yes">Yes
             <input type="radio" name="featured" value="no"> No

           </td>
            </tr>
            <tr>
              <td>Active:</td>
           <td>
             <input type="radio" name="active" value="yes">Yes
             <input type="radio" name="active" value="no"> No

           </td>
            </tr>
            <tr>
             <td colspan="2">
                 <input type="submit" name="submit" value="Add Drink" class="btn btn-secondary">
             </td>
            </tr>




     </table>
       
       


     </form>

  <!-- add Drink from end -->
  <?php 
        //check the button is clicked or no
        if(isset($_POST['submit'])){

          //get value from the form
         $title = $_POST['title'];
         $description = $_POST['description'];
         $price = $_POST['price'];
         $category = $_POST['category'];
         //check if radio burron check or no
         if(isset($_POST['featured'])){
             //get value from form
            $featured = $_POST['featured'];

         }
         else{
            //get defualt value
            $featured = "No";
         }
        
         //check if radio burron check or no
         if(isset($_POST['active'])){
             //get value from form
            $active = $_POST['active'];

         }
         else{
            //get defualt value
            $active = "No";
         }

         //check image selected or no 
        if(isset($_FILES['image']['name'])){
            //upload image
            $image_name = $_FILES['image']['name'];
            if($image_name!=""){

            //auto rename and get extention for image
            $ext = end(explode('.', $image_name));
            $image_name = "drink_name_".rand(000,999).'.'.$ext;

            $src = $_FILES['image']['tmp_name'];

            $des = "../images/".$image_name;
              //upload image
            $upload = move_uploaded_file($src , $des);

            //check image is upload or no if not upload stop proccess and show error message 
            if($upload==false){
                $_SESSION['upload'] = "<div class='error'> failed to upload image</div>";
                header('location:'.SITEURL.'admin/add-drink.php');
                die();

            }
          }

        }
        else{
            $image_name = "";
        }
         //create sql query to insert drinks to database
         $sql2 = "INSERT INTO tbl_drink SET 
         title = '$title',
         description = '$description',
         price = '$price',
         image_name='$image_name',
         category_id = '$category',
         featured = '$featured',
         active = '$active'
         ";
         
         //excute the query 
         $res2 = mysqli_query($conn,$sql2);
        //  $count2 = mysqli_num_rows($res2);

             
         //check is the query excuted or no and data added or no
         if($res2=true){
            $_SESSION['add'] = "<div class='success'> Drink Add Successful</div>";
            header('location:'.SITEURL.'admin/manage-drink.php');

         }
         else{
            $_SESSION['add'] = "<div class='error'> category add faild</div>";
            header('location:'.SITEURL.'admin/add-category.php');

         }




        }
        
        
        
        
        
        
        
        
        
        ?>









    </div>
</div>



<?php include('partials/footer.php'); ?>