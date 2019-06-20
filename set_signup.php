<?php
require_once("init/init_all.php");      

if(isset($_POST['signup'])){
    global $db_init;
    
    $go = false;
    while($go == false){
        $ref_id = generate_ref_id();
        $query = User::find_sql("SELECT ref_id FROM users WHERE ref_id='$ref_id'");
        if(mysqli_num_rows($query)>0){
            $ref_id = generate_ref_id();
        }else{
            $go = true;
        }
    }
    
    //SETTING ALL THE VALUES TO A VARIABLE
    $ref_id = $ref_id;
    $fname = $db_init->escape(htmlentities($_POST ['fname']));
    $lname = $db_init->escape(htmlentities($_POST ['lname']));
    $email = $db_init->escape(htmlentities($_POST ['email']));
    $phone = $db_init->escape(htmlentities($_POST ['phone']));
    $country = $db_init->escape(htmlentities($_POST ['country']));
    $zip = $db_init->escape(htmlentities($_POST ['zip']));
    $pass = $db_init->escape(htmlentities($_POST ['pass']));
    $repass = $db_init->escape(htmlentities($_POST ['repass']));

    //CHECKING FOR pass LENGTH LESS THAN 6
    if( strlen($pass) < 6  ){
        //MAKE PUP UP
        echo "<script> alert('password Less than six!'); window.location='signup.php'; </script>";
        die();
    }

    //CHECKING IF pass IS THESAME WITH THE SECOND pass FIELD
    if( $pass !=$repass  ){
        //MAKE PUP UP
        echo "<script> alert('password not the same!'); window.location='signup.php'; </script>";
        die();
    }

    //CHECKING IF EMAIL ALREADY REGISTERED
    $confirm_email = User::confirm_email_users($email);
    if($db_init->num_rows($confirm_email)>0){
        //MAKE PUP UP
        echo "<script> alert('Emal already exists!'); window.location='signup.php'; </script>";
        die();
    }
    $confirm_email = User::confirm_email_admins($email);
    if($db_init->num_rows($confirm_email)>0){
        //MAKE PUP UP
        echo "<script> alert('Emal already exists!'); window.location='signup.php'; </script>";
        die();
    }

    //CHECKING IF ALL FIELDS ARE FILLED OUT
    if(empty($ref_id) || empty($fname) ||  empty($lname) || empty($phone) || empty($email) || empty($country) || empty($zip)){
        //MAKE PUP UP
        echo "<script> alert('All fields must be filled!'); window.location='signup.php'; </script>";
        die();
    }else{
        //REGISTERS USER IF EVERY THING IS CORRECT
        $register_user = User::register_user($ref_id, $fname, $lname, $email, $phone, $country, $pass, $zip);

        if($register_user){
            require 'phpmailer/PHPMailerAutoload.php';

            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $username= User::get_email_address(); 
            $pass2=User::get_email_password();
            $mail->Username = $username; 
            $mail->Password = $pass2;
        
            $mail->setFrom(User::get_email_address(), User::get_company_name());
            $mail->addAddress($email);
            
            $mail->Subject = 'ACCOUNT VERIFICATION';
            $mail ->AddEmbeddedImage('images/hench_logo.jpeg', 'logoimg');
            $mail->MsgHTML(User::verification_mail_message($ref_id, $pass, $email));
            if ($mail->send())
                echo "<script> alert('Registration Successful, kindly visit your email address to activate your signup!'); window.location='login.php'; </script>";
        }
    }
}

?>