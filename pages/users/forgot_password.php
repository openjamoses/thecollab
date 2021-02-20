<?php
if (isset($_SESSION['email']) || isset($_SESSION['id'])) {
    Redirect::to('index?!=logout|' . $_SESSION['email']);
}
?>
<?php
include 'includes/libs.php';
require 'Mail/mail.php';
?>
<title><?php echo $title ?> Login </title>
</head>
<body>

    <div id="body-container">
        <div id="body-content">


            <div class='container'>

                <div class="signin-row row">
                    <div class="span4"></div>
                    <div class="span8">
                        <div class="container-signin">
                            <legend>To recover your password, please enter your email address you used when creating account</legend>

                            <?php
                            if (Input::exists()) {
                                if (Token::check(Input::get("login_token"))) {
                                    $username = Input::get("username");

                                    $login = "SELECT * FROM users_tb WHERE users_email='$username'  ORDER BY users_id DESC LIMIT 1";
                                    if (DB::getInstance()->checkRows($login)) {

                                        $users_list = DB::getInstance()->query($login);
                                        foreach ($users_list->results() as $users):
                                            echo '<div class="alert alert-info">We have sent you a varification on your email. Please open your email to reset your password!</div>';
                                            $recoveryCode = rand(1, 1000000);
                                            $_SESSION['recoveryCode'] = $recoveryCode;
                                            $_SESSION['username'] = $username;
                                            try {
                                                //Server settings
                                                $to = $username;
                                                $subject = "Recover your password";
                                                $body = "Hi, This is your password recovery code '" . $recoveryCode . "' ";
                                                $mail = new Mail($to, $donot_reply_email, $subject, $body);
                                                $mail->send();
                                                $email_sent = 'Message sent successfully..!';
                                                Redirect::to('index?!=recovery|' . $username . '9494894047878238fnbbsjvds78252526bxbsbshjs');
                                            } catch (Exception $e) {
                                                $email_sent = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                                            }
                                        endforeach;

                                        //DB::getInstance()->logs($username." Logged in.");
                                        //Redirect::to('index?!=admin_dashboard|' . $username . '9494894047878238fnbbsjvds78252526bxbsbshjs');
                                    } else {
                                        ?>
                                        <div class="alert alert-warning"><span>We couldn't find your email.</span></div>
                                        <?php
                                    }
                                }
                            }
                            ?>

                            <form action='#' method='POST' id='loginForm' class='form-signin' autocomplete='off'>
                                <div class="form-inner">
                                    <div class="input-prepend">

                                        <span class="add-on" rel="tooltip"  title="Enter your E-Mail ID" data-placement="top"><i class="icon-envelope"></i></span>
                                        <input type='text' class='span4' name="username" placeholder="Enter your E-Mail ID" id='username'/>

                                        <input type="hidden" name="login_token" class="input" value="<?php echo Token::generate(); ?>">
                                        <input class="btn btn-primary" name="login_button" type='submit' id="submit" value='Recover my password'/>

                                    </div>



                                </div>
                                <footer class="signin-actions">
                                    <a href="index?!=wel" > Back to home page</a>
                                </footer>
                            </form>
                        </div>
                    </div>
                    <div class="span3"></div>
                </div>


                <!--<div class="span4">
    
                    </div>-->
            </div>


        </div>
    </div>


    <script type="text/javascript">
        $(function () {
            document.forms['loginForm'].elements['j_username'].focus();
            $('body').addClass('pattern pattern-sandstone');
            $("[rel=tooltip]").tooltip();
        });
    </script>
    <script src="js/bootstrap/bootstrap-transition.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-alert.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-modal.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-dropdown.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-scrollspy.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-tab.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-tooltip.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-popover.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-button.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-collapse.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-carousel.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-typeahead.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-affix.js" type="text/javascript" ></script>
    <script src="js/bootstrap/bootstrap-datepicker.js" type="text/javascript" ></script>
    <script src="js/jquery/jquery-tablesorter.js" type="text/javascript" ></script>
    <script src="js/jquery/jquery-chosen.js" type="text/javascript" ></script>
    <script src="js/jquery/virtual-tour.js" type="text/javascript" ></script>


</body>
</html>