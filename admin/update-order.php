<?php include('partials/menu.php'); 

?>

<div class="main-content">
    <div class="wrapper">
        <h1> Update Order</h1>
        <br><br>

        <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            if ($count>0){
                while($row=mysqli_fetch_assoc($res)){
                $drink = $row['drink'];
                $price = $row['price'];
                $qty = $row ['quantity'];
                $status = $row['status'];
                $customer_name= $row['customer_name'];
                $customer_contact= $row['customer_contact'];
                $customer_email= $row['customer_email'];
                $customer_address= $row['customer_adress'];
            }
        }
            else{
                header('location:'.SITEURL.'admin/manage-order.php');

            }
        }
        else{
            header('location:'.SITEURL.'admin/manage-order.php');
        }
     ?>


        <form action="" method="post">
         <table class="tbl-30">
            <tr>
                <td>drink Name</td>
                <td><b> <?php echo $drink; ?> </b></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><b> $ <?php echo $price; ?> </b></td>
            </tr>
            <tr>
                <td>Qty</td>
                <td>
                    <input type="number" name="qty" value=" <?php echo $qty; ?>">
                </td>
            </tr>

            <tr>
                <td>Status </td>
                <td>
                    <select name="status" >
                     <option <?php if ($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                     <option  <?php if ($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                     <option <?php if ($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                     <option <?php if ($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>



                    </select>
                </td>
            </tr>
            <tr>
                <td>customer Name:</td>
                <td>
                    <input type="text" name ="customer_name" value="<?php echo $customer_name; ?>">
                </td>

            </tr> <tr>
                <td>customer Contact:</td>
                <td>
                    <input type="text" name ="customer_contact" value="<?php echo $customer_contact; ?>">
                </td>

            </tr> <tr>
                <td>customer Email:</td>
                <td>
                    <input type="text" name ="customer_email" value="<?php echo $customer_email; ?>">
                </td>

            </tr> <tr>
                <td>customer Address:</td>
                <td>
                <textarea name="customer_address"  cols="30" rows="5">"<?php echo $customer_address; ?></textarea>
             </td>

            </tr>

            <tr>
                <td clospan="2">
                    <input type="hidden" name="id" value="<?php echo $id ; ?>">
                    <input type="hidden" name="price" value="<?php echo $price ; ?>">

                    <input type="submit" name="submit" value="Update order" class="btn-secondary">

                </td>
            </tr>

         </table>

        </form>

    </div>
</div>
<?php
if(isset($_POST['submit'])){
  $id = $_POST['id'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];
  $total = $price * $qyt;
  $status = $_POST['status'];

  $customer_name = $_POST['customer_name'];
  $customer_contact = $_POST['customer_contact'];
  $customer_email = $_POST['customer_email'];
  $customer_address = $_POST['customer_address'];

  $sql2 = "UPDATE tbl_order SET
  quantity = $qty,
  total = $total,
  status = '$status',
    customer_name = '$customer_name', 
    customer_contact = '$customer_contact ' 
    customer_email = '$customer_email' , 
    customer_adress = '$customer_address' 
    WHERE id = $id
  ";

  $res2 = mysqli_query($conn,$sql2);
  $count2 = mysqli_num_rows($res2);

  if ( $count2=true){
    $_SESSION ['update'] = "<div class='success'>order updated successfully.</div>";
    header('location :'.SITEURL.'admin/manage-order.php');
  }else{
    $_SESSION ['update'] = "<div class='erorr'>failed to updated order.</div>";
    header('location :'.SITEURL.'admin/manage-order.php');
  }



}
?>
<?php include('partials/footer.php'); ?>
