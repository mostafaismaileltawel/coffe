

<?php //include('config/constants.php');?>
<?php// include('admin/partials/register_check.php');?>
<?php include('partial-front/menu.php'); ?>
    <!-- Navbar Section Ends Here -->

    <section class="food-search text-center">
        <div class="container">
         <?php 
        
             $search = $_POST['search'];
         ?>

            
            <h2>drinks on Your Search <a href="#" class="text-white">"<?php echo $search ; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">drinks your searched</h2>
            <?php
            

                $sql = "SELECT * FROM tbl_drink WHERE title LIKE '$search' OR  description LIKE '$search'";
                
                $res =mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($res);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while( $row=mysqli_fetch_assoc($res)){
                    
                    $title = $row['title'];
                    $description = $row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name']

    
                        ?>
                       <div class="food-menu-box">
   <div class="food-menu-img">
                     <?php
                     if($image_name==""){
                        echo"<div class='error'>Image not Avilable</div>";
                     }
                     else{
                       ?>
      <img src="<?php echo SITEURL;?>images/<?php echo $image_name; ?>"  class="img-responsive img-curve"> 

                        <?php
                     }

              ?>
          </div>

                <div class="food-menu-desc">
                     <h4><?php echo $title; ?></h4>
                   <p class="food-price">$<?php echo $price; ?></p>
                   <p class="food-detail">
                    <?php echo $description; ?>
                   </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                 </div>
             </div>
                        <?php
                    }
                }
                else{
                    echo "<div class='error'>drink not found.</div>";
                }
            ?>

           

            <div class="clearfix"></div>

            

        </div>

    </section>>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
  
    <!-- footer Section Starts Here -->
    <?php include('partial-front/footer.php'); ?>