

<?php //include('config/constants.php');?>
<?php //include('admin/partials/login_check.php');?>
<?php include('partial-front/menu.php'); ?>
    <!-- Navbar Section Ends Here -->



     <!-- CAtegories Section Starts Here -->
     <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Drinks</h2>

                     
<?php
$sql="SELECT * FROM tbl_category WHERE active='yes' ";
$res =mysqli_query($conn ,$sql);
 $count = mysqli_num_rows($res);
     if($count>0)
 {
     while($row=mysqli_fetch_assoc($res))
        {
         $id = $row['id'];
         $title = $row['title'];
         $image_name = $row['image_name'];
              ?>
               <a href="category-drinks.php">
         
              <div class="box-3 float-container">
               <?php
if($image_name==""){
    echo "<div class='error'>Image Not Availble</div>";
}else{
    ?>
   
       <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>" class="img-responsive img-curve"><br>
    <?php
}
               ?><br><br><br><br>
           

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>
            <?php
                }
    
            } else{
                echo "<div class='error'>category not added</div>";
            }
?>


          

         

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


  

    <!-- footer Section Starts Here -->
    <?php include('partial-front/footer.php'); ?>