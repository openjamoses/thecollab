<?php
if (isset($_SESSION['email']) || isset($_SESSION['id'])) {
    Redirect::to('index?!=logout|' . $_SESSION['email']);
}
?>
<?php include 'includes/libs.php'; ?>
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
                            <legend>For Admin login only! Please Login</legend>

                            <?php
                            if (Input::exists()) {
                                if (Token::check(Input::get("login_token"))) {
                                    $username = Input::get("username");
                                    $password = SHA1(Input::get("password"));
                                    $emmergencepassword = Input::get('password');
                                    $login = "SELECT * FROM admin_tb WHERE admin_email='$username' AND admin_password='$password'";
                                    if (DB::getInstance()->checkRows($login)) {
                                        $_SESSION['email'] = $username;
                                        $_SESSION['password'] = $password;
                                        $_SESSION['login_type'] = "Admin";
                                        $_SESSION['id'] = $user_id = DB::getInstance()->getName("admin_tb", $username, "admin_id", "admin_email");
                                        
                                        //DB::getInstance()->logs($username." Logged in.");
                                        Redirect::to('index?!=admin_dashboard|' . $username . '9494894047878238fnbbsjvds78252526bxbsbshjs');
                                    } else {
                                        ?>
                                        <div class="alert alert-warning"><span>Login was not successful.</span></div>
                                        <?php
                                    }
                                }
                            }
                            ?>

                            <form action='#' method='POST' id='loginForm' class='form-signin' autocomplete='off'>
                                <div class="form-inner">
                                    <div class="input-prepend">

                                        <span class="add-on" rel="tooltip" title="Username or E-Mail Address" data-placement="top"><i class="icon-envelope"></i></span>
                                        <input type='text' placeholder="Enter your username" class='span4' name="username" id='username'/>
                                    </div>

                                    <div class="input-prepend">

                                        <span class="add-on"><i class="icon-key"></i></span>
                                        <input type='password' placeholder="Enter your password" name="password" class='span4' id='password'/>
                                    </div>
                                    <label class="checkbox" for='remember_me'>Remember me
                                        <input type='checkbox' id='remember_me'
                                               />
                                    </label>
                                </div>
                                <footer class="signin-actions">
                                    <input type="hidden" name="login_token" class="input" value="<?php echo Token::generate(); ?>">
                                    <input class="btn btn-primary" name="login_button" type='submit' id="submit" value='Login'/>
                                    <a href="index?!=wel" > Back</a>
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