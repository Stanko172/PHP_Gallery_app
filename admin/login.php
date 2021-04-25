<?php require_once("includes/init.php"); ?>
<?php

if($session->is_signed_in()){
    header("Location:index.php");
}


if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_found = User::verify_user($username, $password);

    
    if(empty($user_found)){
        $msg = "Netočni korisnički podaci!";
    }else{
        $session->login($user_found);
        header("Location:index.php");
    }
    
}else{
    $msg = "";
    $username = "";
    $password = "";
}


?>

<h4 class="bg-danger"><?php echo $msg; ?></h4>

<div class="col-md-4 col-md-offset-3">

<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>

</div>


</div>