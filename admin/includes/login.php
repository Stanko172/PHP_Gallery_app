<?php

if($session->is_signed_in()){
    redirect("index.php");
}


if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Metoda za provjeru postoji li korisnik u bazi podataka

    if(!$user_found){
        $msg = "Netočni korisnički podaci!";
    }else{
        $session->login($user_found);
        redirect("index.php");
    }
}


?>