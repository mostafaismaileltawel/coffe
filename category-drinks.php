

<?php //include('config/constants.php');?>
<?php //include('admin/partials/register_check.php');?>
<?php include('partial-front/menu.php'); ?>

<?php 
if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    // echo "eeeeeeeeeeeeeeee";
    $sql =  "SELECT *  FROM tbl_drink WHERE id= $category_id";

    $res= mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
   
    if($count=1){
        
        $row=mysqli_fetch_assoc($res);
     
             $title2 =$row ['title'];
        }
        
    

    else{
       $title2="not found";


    }
 
}
else{
        header('location:'.SITEURL);
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>drink on <?php echo  $title2; ?></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">drink Menu</h2>
            <?php 
            $sql2 = "SELECT * FROM tbl_drink WHERE id= $category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if($count2=1){
               
                $row2=mysqli_fetch_assoc($res2);
                // while($row2=mysqli_fetch_assoc($res2)){
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    $price = $row2['price']
                    ?>
                    <a href="<?php echo SITEURL;?>category-drinks.php?category_id=<?php echo $id;?>"></a>

                    <div class="box-3 float-container">

                <?php 
                if($image_name=="")
                {
                    echo "<div class='error'>Image Not Availble</div>";

                }
                else{
                  ?>
              <img src="<?php echo SITEURL; ?>images/<?php echo $image_name;?>"  class="img-responsive img-curve">

                  <?php  
                }
                ?>
                </div>
                  
                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price">$<?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?>
                </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?drink_id=<?php echo $id;?>&image_name=<?php echo $image_name ;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                    <?php
                }
            // }
            else{
                echo "<div class='error'>drink Not Availble</div>";

            }
            ?>

           


            <div class="clearfix"></div>

            

        </div>

    </section>

    <!-- social Section Starts Here -->
  

    <?php include('partial-front/footer.php'); ?>