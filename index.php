<?php require_once('includes/header.php'); ?>
<!--Header Menu-->
<nav class="navbar navbar-default" id="nav-bar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php" id="home">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle service">Services</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle faq">FAQ</a>
                    <!-- <ul class="dropdown-menu">
                            <li><a href="blog-right-sidebar.html">Blog</a></li>
                            <li><a href="single-blog.html">Blog Details</a></li>
                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                        </ul> -->
                </li>
                <li><a href="#" class="news">News</a></li>
                <li><a href="#" class="contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                        <ul class="dropdown-menu">
                            <li><input type="text" placeholder="Search Query" /></li>
                        </ul>
                    </li> -->
                <?php if (isset($session->user_id)) { $loc=$_SESSION['location']; ?>
                    <li class="dropdown">
                        <a href="<?php echo "$loc/"; ?>" class="dropdown-toggle">My Portal</a>
                    </li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a href="login.php" class="dropdown-toggle">Login</a>
                    </li>
                    <li class="dropdown">
                        <a href="signup.php" class="dropdown-toggle ">SignUp</a>
                    </li>
                <?php } ?>


            </ul>
        </div>
    </div>
</nav>
<!-- Main Slider -->
<section class="main-slider" id="main-slider">
    <div class="carousel slide main-carousel" id="main-carousel">
        <div class="carousel-inner">
            <div class="item active" style="background: url('images/slider/1.jpg') no-repeat;background-size:cover">
                <div class="carousel-caption">
                    <div class="caption-content">
                        <h1><small data-animation="animated fadeInDown">Hench Capital</small> <span data-animation="animated fadeInRight">Innovative Hybrid Assets & Investment
                                Management Solutions</span></h1>
                        <p data-animation="animated fadeInUp">

                        </p>
                        <button class="btn btn-primary btn-lg" data-animation="animated fadeInUp">Join Us</button>
                    </div> <!-- .caption-content ends -->

                </div> <!-- .carousel-caption ends -->
            </div> <!-- .item active ends -->
            <div class="item" style="background: url('images/slider/investment4.jpg') no-repeat;background-size:cover">
                <div class="carousel-caption">
                    <div class="caption-content coin">
                        <h1><small data-animation="animated fadeInDown"></small> <span data-animation="animated fadeInDown">Innovative Hybrid Assets & Investment
                                Management Solutions</span></h1>
                        <p data-animation="animated fadeInUp">
                            Innovative Hybrid Assets & Investment Management Solutions
                        </p>
                        <button class="btn btn-primary btn-lg" data-animation="animated fadeInUp">Learn
                            More</button>
                    </div> <!-- .caption-content ends -->

                </div> <!-- .carousel-caption ends -->
            </div> <!-- .item active ends -->
        </div> <!-- .carousel-inner ends -->

        <!-- CONTROLS -->
        <a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
        </a> <!-- .left carousel-control ends -->

        <a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
        </a> <!-- .right carousel-control ends -->
    </div> <!-- .carousel slide ends -->
</section>

<section class="space">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="btcwdgt-chart" bw-cash="true" bw-theme="light"></div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="btcwdgt-price" bw-cash="true" bw-theme="light"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="btcwdgt-price" bw-cash="true" bw-theme="light" bw-cur="eur"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <coingecko-coin-compare-chart-widget coin-ids="bitcoin,ethereum,eos,ripple,litecoin" currency="usd" locale="en"></coingecko-coin-compare-chart-widget>
                <coingecko-coin-converter-widget coin-id="bitcoin" currency="usd" background-color="#ffffff" font-color="#4c4c4c" locale="en"></coingecko-coin-converter-widget>
            </div>
        </div>
    </div>
</section>

<!--Offer-->
<section id="offer" class="space">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 no-padding main-heading text-center">
                <h2 class="title">Services</h2>
            </div>
        </div>
    </div>
    <div class="owl-carousel owl-theme" id="h-carousel">
        <div class="">
            <div class="service-block fadeInUp" style="margin-bottom:10px">
                <div class="inner" style="box-shadow:1px 1px 2px rgb(50,50,50,.3), -1px -1px 2px rgb(50,50,50,.3);max-height:455px">
                    <div class="service-image">
                        <img class="img-responsive" src="images/services/1.jpg" alt="service" style="height:250px;width:100%">
                        <a href="#" class="hover center"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="service-text" style="padding:20px">
                        <a href="#" target="_parent">
                            <h3 class="title">Hedge Funds</h3>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.</p>
                        <a target="_parent" href="single-services.html" class="simple">Read More<i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="service-block fadeInUp">
                <div class="inner" style="box-shadow:1px 1px 2px rgb(50,50,50,.3), -1px -1px 2px rgb(50,50,50,.3);max-height:455px">
                    <div class="service-image">
                        <img class="img-responsive" src="images/services/2.jpg" alt="service" style="height:250px;width:100%">
                        <a href="#" class="hover center"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="service-text" style="padding:20px">
                        <a href="#" target="_parent">
                            <h3 class="title">Private Equities</h3>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.</p>
                        <a target="_parent" href="single-services.html" class="simple">Read More<i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="service-block fadeInUp">
                <div class="inner" style="box-shadow:1px 1px 2px rgb(50,50,50,.3), -1px -1px 2px rgb(50,50,50,.3);max-height:455px">
                    <div class="service-image">
                        <img class="img-responsive" src="images/services/3.jpeg" alt="service" style="height:250px;width:100%">
                        <a href="#" class="hover center"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="service-text" style="padding:20px">
                        <a href="#" target="_parent">
                            <h3 class="title">Cryptocurrency Mining</h3>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.</p>
                        <a target="_parent" href="single-services.html" class="simple">Read More<i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="service-block fadeInUp">
                <div class="inner" style="box-shadow:1px 1px 2px rgb(50,50,50,.3), -1px -1px 2px rgb(50,50,50,.3);max-height:455px">
                    <div class="service-image">
                        <img class="img-responsive" src="images/services/4.jpg" alt="service" style="height:250px;width:100%">
                        <a href="#" class="hover center"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="service-text" style="padding:20px">
                        <a href="#" target="_parent">
                            <h3 class="title">Cryptocurrency Trading</h3>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.</p>
                        <a target="_parent" href="single-services.html" class="simple">Read More<i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="service-block fadeInUp">
                <div class="inner" style="box-shadow:1px 1px 2px rgb(50,50,50,.3), -1px -1px 2px rgb(50,50,50,.3);max-height:455px">
                    <div class="service-image">
                        <img class="img-responsive" src="images/services/5.jpg" alt="service" style="height:250px;width:100%">
                        <a href="#" class="hover center"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="service-text" style="padding:20px">
                        <a href="#" target="_parent">
                            <h3 class="title">ICOS</h3>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.</p>
                        <a target="_parent" href="single-services.html" class="simple">Read More<i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="service-block fadeInUp">
                <div class="inner" style="box-shadow:1px 1px 2px rgb(50,50,50,.3), -1px -1px 2px rgb(50,50,50,.3);max-height:455px">
                    <div class="service-image">
                        <img class="img-responsive" src="images/services/6.png" alt="service" style="height:250px;width:100%">
                        <a href="#" class="hover center"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="service-text" style="padding:20px">
                        <a href="#" target="_parent">
                            <h3 class="title">OTC brokering &amp; Escrow services</h3>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.</p>
                        <a target="_parent" href="single-services.html" class="simple">Read More<i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="service-block fadeInUp">
                <div class="inner" style="box-shadow:1px 1px 2px rgb(50,50,50,.3), -1px -1px 2px rgb(50,50,50,.3);max-height:455px">
                    <div class="service-image">
                        <img class="img-responsive" src="images/services/7.jpg" alt="service" style="height:250px;width:100%">
                        <a href="#" class="hover center"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="service-text" style="padding:20px">
                        <a href="#" target="_parent">
                            <h3 class="title">Trading education and signals</h3>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.</p>
                        <a target="_parent" href="single-services.html" class="simple">Read More<i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="service-block fadeInUp">
                <div class="inner" style="box-shadow:1px 1px 2px rgb(50,50,50,.3), -1px -1px 2px rgb(50,50,50,.3);max-height:455px">
                    <div class="service-image">
                        <img class="img-responsive" src="images/services/8.jpg" alt="service" style="height:250px;width:100%">
                        <a href="#" class="hover center"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                    <div class="service-text" style="padding:20px">
                        <a href="#" target="_parent">
                            <h3 class="title">Forex Trading</h3>
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing.</p>
                        <a target="_parent" href="single-services.html" class="simple">Read More<i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .h:before {
        background-color: transparent;
    }
</style>
<!--Counter-->
<section id="counter" class="space blue-overlay parallax1 h" style="box-shadow:1px 1px 2px rgb(50,50,50), -1px -1px 2px rgb(50,50,50);margin-bottom:50px;background-image: url('images/slider/investment1.jpg');padding:0">
    <div class="container-fluid">
        <div class="row">
            <div class="counter col-sm-5" style="height:250px;background:url('images/about.png') no-repeat center center;background-size:40%">
                <!-- <img class="img-responsive" src="" alt="man" style="height:200px"> -->
            </div>

            <div class="counter-heading col-sm-7 who-we-block" style="height:250px;text-align:justify;background-color:#023669;padding-top: 15px">
                <h2 style="color:#1193D4;text-shadow:1px 1px 2px #000"><i class="fa fa-money"></i> How it works</h2>

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height:80%">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active" style="text-align:center;color:rgb(255,255,255)">
                            <h2>Create Account <i class="fa fa-user"></i></h2>
                            <p>Signup to create an account with us for free </p>
                        </div>
                        <div class="item" style="text-align:center;color:rgb(255,255,255)">
                            <h2>Fund Account <i class="fa fa-bitcoin"></i></h2>
                            <p>Choose suitable investment plan and proceed to make deposit </p>
                        </div>
                        <div class="item" style="text-align:center;color:rgb(255,255,255)">
                            <h2> Earn Profits <i class="fa fa-thumbs-up"></i></h2>
                            <p> Watch account automatically traded with growth of profits at a ninty-two percent
                                winning
                                rate </p>
                        </div>
                        <div class="item" style="text-align:center;color:rgb(255,255,255)">
                            <h2>Withdraw <i class="fa fa-bank"></i></h2>
                            <p>Simple and swift funds withdrawals round the clock </p>
                        </div>
                    </div>

                </div>



            </div>

        </div>
    </div>
</section>
<!--Inquiry-->
<section id="inquiry" class="bg">
    <div class="inquiry-block">
        <div class="inner col-sm-12 no-padding">
            <div class="col-sm-6 inquiry-image no-padding">
                <img src="images/inquiry.jpg" alt="inquiry" class="img-responsive">
            </div>
            <div class="col-sm-6 inquiry-text">
                <h3>Have You Any Question?</h3>
                <p>Curabitur eu adipiscing lacus, a iaculis diam. Nullam placerat blandit auctor. Nulla accumsan
                    ipsum et nibh rhoncus, eget tempus sapien ultricies.Curabitura iaculis diam. </p>
                <br />
                <div class="default-form">
                    <form method="post" action="#" id="contact-form" novalidate="novalidate">
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input name="name" class="form-cntrol" value="" placeholder="Name *" required="" type="text">
                                </div>
                                <div class="form-group">
                                    <input name="email" value="" placeholder="Email *" required="" type="email">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input name="subject" value="" placeholder="Subject *" type="text">
                                </div>
                                <div class="form-group">
                                    <input name="phone" value="" placeholder="Phone *" required="" type="text">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea name="message" placeholder="Requirement" required=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-left">
                            <button type="submit" name="ask_question" class=" btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Counter-->
<section id="counter" class="space blue-overlay parallax1">
    <div class="container">
        <div class="row">
            <div class="counter-heading col-sm-7">
                <div class="heading">
                    <h2 class="title">Start Your Alternative Investing Journey Now. </h2>
                </div>
                <div class="counter-base col-sm-12 no-padding">
                    <div class="col-sm-4 counter-block" data-count="1235">
                        <div class="odometer">0</div>
                        <h3>Project finished</h3>
                    </div>
                    <div class="col-sm-4 counter-block" data-count="3569">
                        <div class="odometer">0</div>
                        <h3>Trophy achived</h3>
                    </div>
                    <div class="col-sm-4 counter-block" data-count="7895">
                        <div class="odometer">0</div>
                        <h3>Expert workers</h3>
                    </div>
                    <div class="col-12 text-center">
                        <a href="#" class="btn btn-primary btn-lg" data-animation="animated fadeInUp" style="color:#fff">Join Now</a>
                    </div>
                </div>
            </div>
            <div class="counter col-sm-5">
                <img class="img-responsive" src="images/man.png" alt="man">
            </div>
        </div>
    </div>
</section>

<!--History-->
<section id="history" class="space">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 history-block">
                <div class="inner">
                    <h3>Company Progress</h3>
                    <p>Praesent eu rhoncus nibh. Quisque tincidunt, nisi in enetis commodo, neque quam pharetra
                        dolor, nec lacinia urna quam. nisi in enenatis commodo Praesent eu rhoncus nibh. nec lacinia
                        urna quam. nisi in enenatis commodo Praesent eu rhoncus nibh.</p>
                    <div class="skills">
                        <div class="skill-block">
                            <div class="skill" data-percent="75%">
                                <div class="skill-box"></div>
                                <span>75%</span>
                            </div>
                            <h6>2017</h6>
                        </div>
                        <div class="skill-block">
                            <div class="skill" data-percent="85%">
                                <div class="skill-box"></div>
                                <span>85%</span>
                            </div>
                            <h6>2018</h6>
                        </div>
                        <div class="skill-block">
                            <div class="skill" data-percent="95%">
                                <div class="skill-box"></div>
                                <span>95%</span>
                            </div>
                            <h6>2019</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 history-block">
                <div class="inner">
                    <h3>FAQ</h3>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class="fa fa-angle-down"></i> How can i start ?</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    Just signup to create an account with us for free
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse2"><i class="fa fa-angle-down"></i> How do i fund my account
                                        ?</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Choose suitable investment plan and proceed to make deposit
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse3"><i class="fa fa-angle-down"></i> How do i earn
                                        profits?</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Watch account automatically traded with growth of profits at a ninty-two percent
                                    wining rate.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse4"><i class="fa fa-angle-down"></i> How do i withdraw ?</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Simple and swift funds withdrawals round the clock
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--News-->
<section class="recent-news space bg">
    <div class="container">
        <!--main-heading-->
        <div class="col-sm-12 no-padding main-heading text-center">
            <h2 class="title">Latest News</h2>
        </div>
        <div class="row">
            <?php
            $query_news = User::find_sql("SELECT * FROM hench_news WHERE status='1' ORDER BY id DESC LIMIT 3");
            if (mysqli_num_rows($query_news) > 0) {
                $index = 1;
                while ($news_rows = mysqli_fetch_assoc($query_news)) {
                    $id = $news_rows["id"];
                    $title = $news_rows["title"];
                    $picture = $news_rows["picture"];
                    $date = date('jS F, Y | h:ia', strtotime($news_rows["date"]));

                    $trunc = wordwrap($news_rows["details"], 120, "[{@}]");
                    $exp = explode("[{@}]", $trunc);
                    $detail = $exp[0] . "...";

                    $explode = uniqid('', true);
                    $exp = explode('.', $explode);
                    $end = end($exp);
                    $start = $exp[0];

                    ?>
                    <article class="col-sm-4">
                        <div class="news-block">
                            <div class="article-thumb">
                                <a href="single-blog.php?news_token=<?php echo $end . $id . $start; ?>&tk=<?php echo $start; ?>&key=<?php echo $end; ?>" target="_parent">
                                    <img class="img-responsive" src="newsphotos/<?php echo $picture; ?>" alt="#">
                                </a>
                            </div>
                            <div class="article-info">
                                <h3 class="article-title">
                                    <a href="single-blog.php?news_token=<?php echo $end . $id . $start; ?>&tk=<?php echo $start; ?>&key=<?php echo $end; ?>" target="_parent"><?php echo $title; ?>
                                        Finance</a></h3>
                                <ul class="meta">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-calendar"></i>
                                            <span class="meta-date"><?php echo $date; ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user"></i>
                                            <span class="meta-author">Hench Admin</span>
                                        </a>
                                    </li>
                                </ul>
                                <p><?php echo $detail; ?></p>
                                <a href="single-blog.php?news_token=<?php echo $end . $id . $start; ?>&tk=<?php echo $start; ?>&key=<?php echo $end; ?>" class="btn btn-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    </article>
                <?php
            }
        } else {
            echo "No News Uploaded!";
        }
        ?>

        </div>
    </div>
</section>

<!--Testimonials-->
<section class="testimonial-section" style="background: url(images/desk1.jpg) no-repeat center;">
    <div class="container">
        <div class="sec-title text-center">
            <h2>Testimonial<span>s</span></h2>
            <p>See comment from our various contributors</p>
            <div class="icon-quort">
                <i class="fa fa-quote-right" aria-hidden="true"></i>
            </div>
        </div>
        <!--Testimonial Carousel-->
        <div class="testimonial-carousel two-column-carousel">
            <!--Slide Item-->
            <div class="slide-item">
                <div class="inner-box text-center">
                    <div class="info-outer">
                        <div class="text">
                            "Just after giving up the possibility of having a steady extra income without
                            compromising my free time with worries of adopting strenuous multi level marketing (MLM)
                            options, Hench Capital has helped with the opportunity to earn passively and
                            conveniently too.""
                        </div>
                    </div>
                    <figure class="author-image img-circle"><img class="img-circle" src="images/avatar/1.jpeg" alt="" style="width:130px;height:130px"></figure>
                    <div class="author-info">
                        <h4>Kari Vallin</h4>
                        <div class="designation"> (Finland)</div>
                    </div>
                </div>
            </div>
            <!--Slide Item-->
            <div class="slide-item">
                <div class="inner-box text-center">
                    <div class="info-outer">
                        <div class="text">
                            "I think there is no better option to get a good returning interests on money than
                            investing in a Hedge fund trading platform such as this. So much worth it to me and
                            better than the banks."
                        </div>
                    </div>
                    <figure class="author-image img-circle"><img class="img-circle" src="images/avatar/2.jpeg" alt="" style="width:130px;height:130px"></figure>
                    <div class="author-info">
                        <h4>Mike Seligman </h4>
                        <div class="designation">(USA)</div>
                    </div>
                </div>
            </div>
            <!--Slide Item-->
            <div class="slide-item">
                <div class="inner-box text-center">
                    <div class="info-outer">
                        <div class="text">
                            "Since I started working with Hench Capital , they have surpassed my expectations of
                            working with financial advisors. Transitioning to retirement has been much easier,
                            thanks to the Hench Capital team."
                        </div>
                    </div>
                    <figure class="author-image img-circle"><img class="img-circle" src="images/avatar/3.jpeg" alt="" style="width:130px;height:130px"></figure>
                    <div class="author-info">
                        <h4>Binali Canveren</h4>
                        <div class="designation">(Turkey)</div>
                    </div>
                </div>
            </div>
            <!--Slide Item-->
            <div class="slide-item">
                <div class="inner-box text-center">
                    <div class="info-outer">
                        <div class="text">
                            "After losing both funds and trust in the financial firm I previously was with, I was
                            advised to try this company and I can say Hench Capital has distinguished itself by far
                            in my 13 months of being a part of this community."
                        </div>
                    </div>
                    <figure class="author-image img-circle"><img class="img-circle" src="images/avatar/4.jpeg" alt="" style="width:130px;height:130px"></figure>
                    <div class="author-info">
                        <h4>Felix Sergey</h4>
                        <div class="designation">(Germany)</div>
                    </div>
                </div>
            </div>
            <!--Slide Item-->
            <div class="slide-item">
                <div class="inner-box text-center">
                    <div class="info-outer">
                        <div class="text">
                            "In very easy steps I have experienced a turn around in financial status and now my
                            family’s budget has become very flexible as we earn more and have more to live on.
                            Whatever money you have or social class you belong, Hench Capital has got you covered."
                        </div>
                    </div>
                    <figure class="author-image img-circle"><img class="img-circle" src="images/avatar/5.jpeg" alt="" style="width:130px;height:130px"></figure>
                    <div class="author-info">
                        <h4>Tricia Woodridge</h4>
                        <div class="designation"> (Australia)</div>
                    </div>
                </div>
            </div>
            <!--Slide Item-->
            <div class="slide-item">
                <div class="inner-box text-center">
                    <div class="info-outer">
                        <div class="text">
                            "I have being a stay at home mom earning from Hench Capital for almost two years and
                            truly it has been the very typical passive income experience I’ve had and now I have
                            friends already on the platform earning as well and results proven success and
                            consistent basis. Hench Capital is for everyone!"
                        </div>
                    </div>
                    <figure class="author-image img-circle"><img class="img-circle" src="images/avatar/6.jpeg" alt="" style="width:130px;height:130px"></figure>
                    <div class="author-info">
                        <h4>Helen Bowman</h4>
                        <div class="designation">(Canada)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Partner -->
<!-- <section class="partner-logo bg-color space">
        <div class="container">
            <div class="row">
                <div id="clients-logo" class="owl-carousel">
                    <div class="item">
                        <a target="_blank" href="#"><img class="img-responsive" src="images/clients/logo-1.png" alt="Client 1"></a>
                    </div>
                    <div class="item">
                        <a target="_blank" href="#"><img class="img-responsive" src="images/clients/logo-2.png" alt="Client 2"></a>
                    </div>
                    <div class="item">
                        <a target="_blank" href="#"><img class="img-responsive" src="images/clients/logo-3.png" alt="Client 3"></a>
                    </div>
                    <div class="item">
                        <a target="_blank" href="#"><img class="img-responsive" src="images/clients/logo-4.png" alt="Client 4"></a>
                    </div>
                    <div class="item">
                        <a target="_blank" href="#"><img class="img-responsive" src="images/clients/logo-5.png" alt="Client 5"></a>
                    </div>
                    <div class="item">
                        <a target="_blank" href="#"><img class="img-responsive" src="images/clients/logo-6.png" alt="Client 6"></a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

<?php require_once('includes/footer.php'); ?>