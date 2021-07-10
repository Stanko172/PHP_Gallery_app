<?php include("includes/init.php");?>

<?php

if(!$session->is_signed_in()){
    header("Location:login.php");
}

?>

<?php

if(empty($_GET['id'])){
    redirect('users.php');
}

$user = User::get_by_id($_GET['id']);

if($user){
    $user->delete_user();
    redirect('users.php');
}else{
    redirect('users.php');
}


?>