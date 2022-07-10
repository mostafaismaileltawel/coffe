<?php 
include('../config/constants.php');
//check is the id and image value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
$id = $_GET['id'];
$image_name = $_GET['image_name'];

if($image_name !="")
{
    $path = "../images/".$image_name;
    //remove image
    $remove = unlink($path);
    //if failed to remove image show message error
    if($remove==false){
        $_SESSION['upload'] = "<div class ='error'>failed to remove image file</div>";
        //redirect
        header('location:'.SITEURL.'admin/manage-drink.php');
        die();

    }
}
//delete from database
$sql = "DELETE FROM tbl_drink WHERE id=$id";

$res = mysqli_query($conn,$sql);

// check if delete
if($res==true){
    //drink deleted
    $_SESSION['delete'] = "<div class='success'>Drink delete from database successfuly</div>";
    header('location:'.SITEURL.'admin/manage-drink.php');

}else{

//failed to delete drink
    $_SESSION['delete'] = "<div class='error'>failed to  delete drink</div>";
    header('location:'.SITEURL.'admin/manage-drink.php');

}




}
// else
// {
// //redirect to manage category page
// $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access. </div>";
// header('location:'.SITEURL.'admin/manage-drink.php');

// }


















?>
