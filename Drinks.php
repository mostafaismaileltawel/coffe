
<?php //include('config/constants.php');?>
<?php //include('admin/partials/register_check.php');?>

<?php include('partial-front/menu.php'); ?>
    <!-- Navbar Section Ends Here -->

    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>drinks-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



  
    <!-- Drinks MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Drinks Menu</h2>


        
            <?php
$sql2="SELECT * FROM tbl_drink WHERE active='yes' ";
$res2 =mysqli_query($conn ,$sql2);
 $count2 = mysqli_num_rows($res2);
     if($count2>0)
 {
     while($row=mysqli_fetch_assoc($res2)){
        
         $id = $row['id'];
         $title = $row['title'];
         $price = $row['price'];
         $description = $row['description'];
         $image_name = $row['image_name'];
?>


<div class="food-menu-box">
                <div class="food-menu-img">
                <?php
if($image_name==""){
    echo "<div class='error'>Image Not Availble</div>";
}else{
    ?>
   
       <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>"  class="img-responsive img-curve">
    <?php
}
               ?>
           
                  
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title ?></h4>
                    <p class="food-price"><?php echo $price ?></p>
                    <p class="food-detail">
                    <?php echo $description ?>                 </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?drink_id=<?php echo $id;?>&image_name=<?php echo $image_name ;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>



<?php
     }
        }

    else{
        echo "<div class='error'>Drinks not added</div>";
    }
?>

             

          

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
   

    <?php include('partial-front/footer.php'); ?>