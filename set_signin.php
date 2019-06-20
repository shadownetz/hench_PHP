<?php
require_once("init/init_all.php");
if(isset($_POST['signin'])){
    global $db_init;

    $email  = $db_init->escape($_POST ['email']);
    $pass = md5($db_init->escape($_POST ['pass']));

    $result_set = User::login_user($email, $pass);
    if($db_init->num_rows($result_set)==1){
        while($row=$db_init->fetch_array($result_set)){
            if($row['status']=='1'){
                //ACTIVE ACCOUNT
                $session->login($row['id']);
                $_SESSION['location']="users";
                $update_last_logged_q=User::find_sql("UPDATE users SET last_logged=NOW() WHERE id='{$session->user_id}'");
                header("Location: users/");
            }elseif($row['status']=='0'){
                //ACCOUNT INACTIVE
                echo "<script> alert('Sorry, your account is not active!'); window.location=''; </script>";
                die();
            }
        }
    }else{
        echo "<script> alert('Incorrect username or pass!'); window.location=''; </script>";
        die();
    }
}

?>