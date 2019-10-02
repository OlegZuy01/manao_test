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
    $response = array(
        'success' => false,
        'error' => 'passwords_do_not_match'
    );
echo json_encode($response);
}
else{
    $xml= simplexml_load_file('db.xml');
    $i=0;
    foreach($xml->user as $user){
        if($user->email==$email){
            $i++;
            $response = array(
                'success' => false,
                'error' => 'email_busy'
            );
            echo json_encode($response);
        }
        if($user->login==$login){
            $response = array(
                'success' => false,
                'error' => 'login_busy'
            );
            echo json_encode($response);
            $i++;
        }
    }
    if($i==0){
        $response = array(
            'success' => true,
            'error' => 'no access'
        );
        echo json_encode($response);
        $password_hash = password_hash($password,PASSWORD_DEFAULT);
        $new_user=$xml->addChild('user');
        $new_user->addChild('login',$login);
        $new_user->addChild('password_hash',$password_hash);
        $new_user->addChild('email',$email);
        $new_user->addChild('name',$name);
        $xml->asXml('db.xml');

    }
}


?>