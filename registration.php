<?php
if(isset($_POST['login'])) {
    $login = $_POST['login'];
}
if(isset($_POST['password'])) {
    $password = $_POST['password'];
}
if(isset($_POST['confirm_password'])) {
    $confirm_password = $_POST['confirm_password'];
}
if(isset($_POST['email'])) {
    $email = $_POST['email'];
}
if(isset($_POST['name'])) {
    $name = $_POST['name'];
}
if($password!=$confirm_password){
    echo "passwords_do_not_match";
}
else{
    $xml= simplexml_load_file('db.xml');
    $i=0;
    foreach($xml->user as $user){
        if($user->email==$email){
            $i++;
            echo "email_busy";
        }
        if($user->login==$login){
            echo "login_busy";
            $i++;
        }
    }
    if($i==0){
        $password_hash = password_hash($password,PASSWORD_DEFAULT);
        $new_user=$xml->addChild('user');
        $new_user->addChild('login',$login);
        $new_user->addChild('password_hash',$password_hash);
        $new_user->addChild('email',$email);
        $new_user->addChild('name',$name);
        $xml->asXml('db.xml');
        echo 0;
    }
}


?>