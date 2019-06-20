<?php require_once('includes/header.php') ?>
<?php
if(isset($_POST['update_pass'])){
    global $db_init;

    if(isset($_SESSION['ref_id']) && isset($_SESSION['email'])){
      $pass = $db_init->escape(htmlentities($_POST ['pass']));
      $re_pass = $db_init->escape(htmlentities($_POST ['re_pass']));
      if(strlen($pass)<6){
        echo "<script> alert('Password too short, must be more than 6!'); window.location='repass.php'; </script>";
        die();
      }
      if($pass != $re_pass){
        echo "<script> alert('The two passwords mismatch!'); window.location='repass.php'; </script>";
        die();
      }
      $epassword = md5($pass);
      $user_unique_id = $_SESSION['ref_id'];
      $email = $_SESSION['email'];
      $update = User::find_sql("UPDATE users SET pass='{$epassword}' WHERE ref_id = '$user_unique_id' AND email = '{$email}'");
          if($update){
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

            $mail->Subject = 'ACCOUNT AUTHENTICATION SUCCESSFUL';
            $mail ->AddEmbeddedImage('../images/hench_logo.jpeg', 'logoimg');
            $mail->MsgHTML(User::completed_forgotten_password_message($user_unique_id, $pass, $email));
        
            if ($mail->send())
                unset($_SESSION['ref_id']);
                unset($_SESSION['email']);
                echo "<script> alert('Password Updated Successfully, experience the best from us!'); window.location='index.php'; </script>";
            }
    }else{
      echo "<script> alert('Session timeout!'); window.location='index.php'; </script>";
    }
  }
  
  
  ?>
    <!--Breadcrumb-->

    <section id="breadcrumb" class="space nav-bar">

        <div class="container">

            <div class="row">

                <div class="col-sm-6 breadcrumb-block">

                    <h2>Hench | New Password</h2>

                </div>

                <div class="col-sm-6 breadcrumb-block text-right">

                    <ol class="breadcrumb">

                        <li><a href="index.php">Home</a></li>

                        <li>New Password</li>

                    </ol>

                </div>

            </div>

        </div>

    </section>

    <!--Contact Us-->

    <section id="contact" class="space">

        <div class="container">

            <div class="row">


                <div class="col-sm-5 col-sm-offset-4 contact-block" style="box-shadow:1px 1px 2px  #000;padding:10px">

                    <div class="col-sm-12 main-heading">

                        <h3>Change Password</h3>

                    </div>
                    <div class="col-sm-12" style="padding:20px;text-align: center">
                        <i class="fa fa-lock fa-5x"></i>
                    </div>

                    <form action="#" id="contact-form" role="form" method="POST">

                        <div class="form-group col-sm-12 padding-left">

                            <input type="password" class="form-control" name="pass" required placeholder="Enter Password">

                            <input type="password" class="form-control" name="re_pass"  required placeholder="Retype Password">

                        </div>


                        <div class="col-sm-12  no-padding">

                            <input type="submit" name="update_pass" class="btn btn-default" value="Change">

                        </div>

                    </form>

                </div>



            </div>

        </div>

    </section>


<?php require_once('includes/footer.php'); ?>