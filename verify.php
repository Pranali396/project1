<?
include "db.php";

session_start();

$id = $_POST['id'];

$user_id = $_SESSION['id'];

$query = "select  * from `user` where `id` ='".$id."'";

$result = mysqli_query($link, $query);

$row = mysqli_fetch_assoc($result);

$verify = $row['verify'] + 1;

if($verify == 3)
{
    $query1 = "update `user` set `verify`='".$verify."', `wallet`= 10 where `id` ='".$id."'";   
}
else
{
    $query1 = "update `user` set `verify`='".$verify."' where `id` ='".$id."'";
}


mysqli_query($link, $query1);

$query2 = "insert into `verify` (`user_id`,`verified_user_id`) values ('".$user_id."','".$id."')";

mysqli_query($link, $query2);

echo "success";


?>

