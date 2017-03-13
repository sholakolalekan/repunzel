<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "handlerDbConnection.php";
require_once './settings.php';

session_start();

if (isset($_GET['reason'])) {
    $reason = htmlspecialchars($_GET['reason']);
} else {
    header("location: /index.php");
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo $sitename; ?> | <?php echo $reason; ?> </title>
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery.min.js"></script>
        <!---- start-smoth-scrolling---->
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });</script>
        <link rel="icon" type="image/png" href="/images/favicon.ico">
        <script type="text/javascript" src="/js/force.js"></script>
        <!--<script type="text/javascript" src="/js/processSignup.js"></script>-->
        <!---- start-smoth-scrolling---->
        <!-- Custom Theme files -->
        <link href="css/theme-style.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    </script>
    <!----font-Awesome----->
    <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
    <!----font-Awesome----->
    <!----webfonts---->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
    <!----//webfonts---->
    <!----start-top-nav-script---->
    <script>
            $(function () {
                var pull = $('#pull');
                menu = $('nav ul');
                menuHeight = menu.height();
                $(pull).on('click', function (e) {
                    e.preventDefault();
                    menu.slideToggle();
                });
                $(window).resize(function () {
                    var w = $(window).width();
                    if (w > 320 && menu.is(':hidden')) {
                        menu.removeAttr('style');
                    }
                });
            });</script>
    <!----//End-top-nav-script---->
</head>
<body>
    <!----start-container---->
    <div id="home" class=" scroll">
        <div class="container">
            <!---- start-logo---->
            <div class="logo">
                <a href="/index.php"><img src="images/logoed.png" title="ddc" /></a>
            </div>
            <!---- //End-logo---->
            <!----start-top-nav---->
            <nav class="top-nav">
                <ul class="top-nav">
                    <li id="homeBt"><a href="index.php">Home</a></li>
                    <li id="newsBt"><a href="news.php">News</a></li>
                    <li id="loginBt" class="contatct-active"><a href="login.php">Login</a></li>
                </ul>
                <a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
            </nav>

            <!----//End-top-nav---->
        </div>
    </div>

    <!----start-contact---->
    <div id="contact" class="contact"> 

        <div class="contact-grids">

            <div class="col-md-2 contact-left">


            </div>
            <div class="col-md-8 contact-left">
                <h3><span> </span> <?php echo $reason; ?></h3>
                <?php
                if ($reason == 'Signup Success') {



                    echo '<p>Welcome ' . $_SESSION['new_user'] . '</p>
                <p>Your registration was successful, and a message with an activation link has been sent to your inbox. Please access this email and click the activation 
                    link therein to activate your account.</p>
                <p>Thanks,</p><p> Admin.</p>';
                } else {
                    if (isset($_GET['reference'])) {
                        $referenceCode = htmlspecialchars($_GET['reference']);

                        $sql = "UPDATE investors SET account_status='active' WHERE reference_code='" . $referenceCode . "'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        $helpQuery = "SELECT * FROM investors WHERE reference_code='" . $referenceCode . "'";
                        $result = $conn->query($helpQuery);
                        if ($row = $result->fetch_assoc()) {
                            $email = $row['email'];
                            $package = $row['package'];
                            $status = 'pending';
                            $transaction_code = strtoupper(substr(md5(uniqid("this is my site 491", true)), 0, 10));

                            if ($package == 'starter') {
                                $amount = '10000';
                            } else if ($package == 'bronze') {
                                $amount = '20000';
                            } else if ($package == 'silver') {
                                $amount = '50000';
                            } else if ($package == 'gold') {
                                $amount = '70000';
                            } else if ($package == 'platinum') {
                                $amount = '100000';
                            } else {
                                $amount = '200000';
                            }
                        }



                        $insertQuery = "INSERT INTO ph (provider, amount, status, transaction_code )"
                                . " VALUES('$email','$amount', '$status', '$transaction_code')";

                        $result = $conn->query($insertQuery);

                        echo '<p>Great Stuff.</p>
                <p>Your account has been activated, you can now proceed to login with the email and password that you provided during your registration.</p>
                <p>Cheers,</p><p> Admin.</p>';
                    }
                }
                ?>




            </div>
            <div class="col-md-2 contact-left">


            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
    <!----//End-contact---->

    <!----start-footer---->
    <div class="footer">
        <div class="container">
            <div class="footer-left">
                    <!--<a href="#"><img src="images/footer-logo.png" title="mabur" /></a>-->
                <p>Created by <a href="#">lucho</a></p>
            </div>
            <script type="text/javascript">
                $(document).ready(function () {
                    /*
                     var defaults = {
                     containerID: 'toTop', // fading element id
                     containerHoverID: 'toTopHover', // fading element hover id
                     scrollSpeed: 1200,
                     easingType: 'linear' 
                     };
                     */

                    $().UItoTop({easingType: 'easeOutQuart'});

                });
            </script>
            <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
        </div>
    </div>
    <!----//End-footer---->


    <!----//End-container---->
</body>
</html>





