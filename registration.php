<?php
session_start();
if(isset($_POST['login'])&&isset($_POST['password'])&&isset($_POST['confirm_password'])&&isset($_POST['email'])&&isset($_POST['name'])){
    $login=$_POST['login'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    $email=$_POST['email'];
    $name=$_POST['name'];
    if($password!=$confirm_password){
        echo "Пароли не совпадают .";
    }
    else{
        $xml= simplexml_load_file('db.xml');
        $i=0;
        foreach($xml->user as $user){
            if($user->email==$email){
                $i++;
                echo "Пользователь с таким email-ом уже зарегистрирован( ";
            }
            if($user->login==$login){
                echo "Пользователь с таким login-ом уже зарегистрирован( ";
                $i++;
            }
        }
        if($i==0){
            $password_hash = password_hash($password,PASSWORD_DEFAULT);
            $new_user=$xml->addChild('user');
            $new_user->addChild('login','$login');
            $new_user->addChild('password_hash','$$password_hash');
            $new_user->addChild('email','$email');
            $new_user->addChild('name','$name');
            echo "привет ".$name;
        }

    }
}
else{
    echo "Вы ввели не все данные !";
}
?>