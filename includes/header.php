<?php require_once('init/init_all.php'); ?>
<?php

if (isset($_GET['confirm']) && !empty($_GET['confirm'])) {
    $confirm_id = $_GET['confirm'];

    $explode = explode('-', $confirm_id);
    if ($explode && count($explode) == 10) {
        $user_unique_id = $explode[5] . $explode[7] . $explode[9];
        $update_query = User::find_sql("UPDATE users SET status=1 WHERE ref_id = '$user_unique_id'");
        if ($update_query) {
            echo "<script> alert('Account Verified Successfully!'); window.location='login.php'; </script>";
        } else {
            echo "<script> alert('Cannot find this account!'); window.location='login.php'; </script>";
        }
    }
}

if (isset($_GET['recorver']) && !empty($_GET['recorver'])) {
    global $db_init;

    $confirm_id = $_GET['recorver'];
    $explode = explode('-', $confirm_id);
    if ($explode && count($explode) == 10) {
        $user_unique_id = $explode[5] . $explode[7] . $explode[9];
        $query = User::find_sql("SELECT email FROM users WHERE ref_id='{$user_unique_id}' LIMIT 1");
        if ($db_init->num_rows($query) == 1) {
            while ($row = $db_init->fetch_array($query)) {
                $email = $row['email'];
                $_SESSION['email'] = $email;
            }
            $_SESSION['ref_id'] = $user_unique_id;
            echo "<script> window.location='repass.php'; </script>";
        } else {
            echo "<script> alert('something went wrong, try again later!'); window.location='index.php'; </script>";
        }
    }
}

?>
<?php
if (isset($_POST['ask_question'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    if (!empty($name) || !empty($email) || !empty($subject) || !empty($phone) || !empty($message)) {
        $result = User::create_question($name, $email, $subject, $phone, $message);
        if ($result) {
            echo "<script> alert('Message sent successfully!'); </script>";
        }
    } else {
        echo "<script> alert('All fields must be filled out!'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- Basic Page Needs
  ================================================== -->
    <title>Hench Capital</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="canyonthemes">
    <!-- Mobile Specific Meta
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <!--Stylesheet-->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/icon-font.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <!-- <link rel="stylesheet" href="css/owl.carousel.css" type="text/css" /> -->
    <link rel="stylesheet" href="css/owl.carousel_old.css" type="text/css" />
    <link rel="stylesheet" href="css/owl.theme.css" type="text/css" />
    <link rel="stylesheet" href="css/owl.transitions.css" type="text/css" />
    <link rel="stylesheet" href="css/odometer-theme-minimal.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .sticky {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
        }

        .no-js #loader {
            display: none;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('./preloader.gif') center no-repeat #fff;
        }
    </style>
</head>

<body>
<div class="se-pre-con"></div>

    <!--Top bar-->
    <section id="top-bar">
        <div class="container">
            <div class="row">
                <div id="logo" class="col-sm-3 col-md-3">
                    <a class="logo" href="#">
                        <h1><img class="default-logo" src="images/hench_logo.jpeg" alt="hench capital" style="height:100px"></h1>
                    </a>
                </div>
                <div id="top2" class="col-sm-9 col-md-9 hidden-xs">
                    <ul class="contact-info">
                        <li class="contact-phone"><i class="pe-7s-phone"></i>
                            <p class="contact-content"> <span class="contact-title">Phone Number:</span> <span>01 -
                                    12345 6789</span></p>
                        </li>
                        <li class="contact-email"><i class="pe-7s-mail"></i>
                            <p class="contact-content"> <span class="contact-title">Contact Mail:</span>
                                <span>info@example.com</span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>