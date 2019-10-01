<?php
session_start();
if(isset($_POST['login'])&&isset($_POST['password'])){
    $login=$_POST['login'];
    $password=$_POST['password'];
    $xml= simplexml_load_file('db.xml');
    $i=0;
    foreach($xml->user as $user){
        if($user->login==$login){
            $i++;
        }
    }
    if($i>0){
        $j=0;
        foreach($xml->user as $user){
            if(password_verify($password,$user->password_hash)){
                $j++;
            }
        }
        if($j>0){
            $_SESSION['login']=$login;
            echo "Hello ".$_SESSION['login'];
        }
        else{
            echo "Не правильный пароль";
        }
    }
    else{
        echo "Пользователя с таким логином не существует.";
    }
}


?>