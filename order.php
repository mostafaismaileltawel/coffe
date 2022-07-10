
<?php// include('config/constants.php');?>
<?php // include('admin/partials/login-check.php');?>
<?php  include('partial-front/menu.php'); ?>
    <!-- Navbar Section Ends Here -->

    <?php 
if(isset($_GET['drink_id'])){
    
    $drink_id = $_GET['drink_id'];
    $sql="SELECT * FROM tbl_drink WHERE id = '$drink_id' ";

    $res = mysqli_query($conn,$sql);
   

    $count = mysqli_num_rows($res);
    if ($count>0){
        while( $row = mysqli_fetch_assoc($res)){
       $title2 = $row['title'];
       $price2 = $row['price'];
       $image_name2 = $row['image_name'];
    }
}
else{

        header('location'.SITEURL);

    }
}
else{
    header('location'.SITEURL);
 }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected drink</legend>

                    <div class="food-menu-img">
                        <?php

                               if($image_name2="")
                               {
                                   echo "<div class='error'>Image Not Availble</div>";

                                     }
                                 else{
                                  
                                   ?>
                          <img src="<?php echo SITEURL;?>images/<?php echo $image_name2;?>"  class="img-responsive img-curve">

                                     <?php  
                                      }
                                       ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title2;?></h3>
                        <input type="hidden" name="drink" value="<?php echo $title2;?>">

                        <p class="food-price">$<?php echo $price2;?></p>
                        <input type="hidden" name="price" value="<?php echo $price2;?>">


                        <div class="order-label">Quantity</div>
                        <input type="number" name="Quantity" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
               
                    <legend>Delivery Details</legend><br>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="text" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <input type="text" name="address"  placeholder="" class="input-responsive" required>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                

            </form>
            <?php
            if (isset($_POST['submit'])){

                 $title2 = $_POST['drink'];
                $price2 = $_POST['price'];
                $qty = $_POST['Quantity'];

                $total = $price2 * $qty;
                $order_date = date("Y-m-d h:i:sa");
                $status = "ordered";
                 $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];

                $customer_email = $_POST['email'];

                $customer_address = $_POST['address'];
                // //////////////////////////////////////////////
                // $sql2="SELECT * FROM tbl_drink  ";

                // $res2 = mysqli_query($conn,$sql2);
                // $row2 = mysqli_fetch_assoc($res2);
            
                // $count2 = mysqli_num_rows($res2);
                // if ($count2=1){
                //    $title = $row2['title'];
                //    $price = $row2['price'];
                //    $image_name = $row2['image_name'];
                // }else{
            
                //     header('location'.SITEURL);
            
                // }
                // 

             
                // /////////////////////////////////////////////////////////////
                // $sql3 = "INSERT INTO tbl_order SET
                // drink = '$title2',
                // price ='$price2',
                // quantity='$qty',
                // total='$total',
                // customer_name ='$customer_name',
                // customer_contact ='$customer_contact'
                // customer_email='$customer_email'
                // customer_adress ='$customer_address'
                // order_date = '$order_date',
                // status = '$status'
                // " ;
                // $res3 = mysqli_query($conn,$sql3);
                $sql2 = "INSERT INTO tbl_order SET
                 order_date = '$order_date',
                 status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                 customer_email = '$customer_email'
                 customer_adress = '$customer_address',
                 total='$total',
                 quantity=' $qty',
                 drink='$title2',
                 price='$price2'
                 ";
               include_once('config/constants.php');
               $res2 = mysqli_query($conn,$sql2);
               var_dump($res2);

                if( $res2){
                   
                    $_SESSION['order']="<div class='success text-center'>drink ordered successfully.</div>";
                    header('location:'.SITEURL);
                }
                else{
                 
                    $_SESSION['order']="<div class='error text-center'>failed to ordered drink.</div>";
                    header('location:'.SITEURL);
                }
            }
            
        ?>
        </div>
    </section>
   

    <!-- footer Section Starts Here -->
    <?php include('partial-front/footer.php'); ?>