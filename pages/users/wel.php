<?php include 'includes/libs.php'; ?>
<title><?php echo $title ?> Welcome </title>
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div id="app-nav-top-bar" class="nav-collapse">
                    <ul class="nav">


                    </ul>
                    <ul class="nav pull-right">


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="body-container">
        <div id="body-content">
            <div class="body-nav body-nav-vertical body-nav-fixed">
                <div class="container">
                    <ul>

                        <li>
                            <a href="index?!=Reg|uewyiywuiywiuwe9287217725265363">
                                <i class="icon-user icon-large"></i> Create Account
                            </a>


                            <a href="index?!=login|uewyiyhdhhdhshjhhndbdj jksjksio198wef7ygbhjmsdcxwuiywiuwe9287217725265363">
                                <i class="icon-key icon-large"></i> Admin Access
                            </a>
                        </li>

                    </ul>
                </div>
            </div> 
            <section class="page container">
                <div class="row">

                    <div class="span16">
                        <legend class="lead">
                            The Collaboration Platform
                        </legend>
                        <p>
                            This is a software platform that adds broad social networking capabilities to work processes.  The goal is to foster innovation by incorporating knowledge management into your research processes so that collaborators can share information and solve problems more efficiently. 
                        </p>
                    </div>
                    <div class="span8">
                        <div class="box pattern pattern-sandstone">
                            <div class="box-header">
                                <i class="icon-list"></i>
                                <h5>Registered Research Institutions</h5>
                                <button class="btn btn-box-right" data-toggle="collapse" data-target=".box-list">
                                    <i class="icon-reorder"></i>
                                </button>
                            </div>
                            <div class="box-content box-list collapse in">
                                <ul>
                                    <?php
                                    $query = "SELECT * FROM institution_tb  ORDER BY institution_name ASC";
                                    if (DB::getInstance()->checkRows($query)) {

                                        $users_list = DB::getInstance()->query($query);
                                        foreach ($users_list->results() as $users):
                                            $query2 = "SELECT * FROM users_tb WHERE institution_id = '" . $users->institution_id . "'";
                                            $query3 = "SELECT * FROM contribution_tb c, users_tb s  WHERE c.user = s.users_id AND s.institution_id = '" . $users->institution_id . "'";

                                            $count_contributors = DB::getInstance()->countElements($query2);
                                            $count_contribution = DB::getInstance()->countElements($query3);
                                            ?>
                                            <li>
                                                <div>
                                                    <a href="index?!=s_reg&~=<?php echo $users->institution_id; ?>|eiejnnbbnwo903808902hjfdsg298082092" class="news-item-title"><?php echo $users->institution_name; ?> | <?php echo $users->institution_country; ?></a>

                                                    <button> (<?php echo $count_contribution; ?>) <i class="icon-book"></i></button> <button> (<?php echo $count_contributors; ?>) <i class="icon-group"></i></button>  
                                                    <p class="news-item-preview"><?php echo $users->institution_details; ?>.</p>
                                                </div>
                                            </li>
                                            <?php
                                        endforeach;
                                    }
                                    ?>

                                    <!--
                        <div class="box-collapse">
                            <button class="btn btn-box" data-toggle="collapse" data-target=".more-list">
                                Show More
                            </button>
                        </div>
                        <ul class="more-list collapse out">
                            <li>
                                <div>
                                    <a href="#" class="news-item-title">Duis aute irure dolor in reprehenderit</a>
                                    <p class="news-item-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                </div>
                            </li>
                            
                        </ul>
                                    -->
                            </div>

                        </div>
                    </div>


                    <div class="span8">

                        <div class="box">
                            <div class="box-header">
                                <i class="icon-book"></i>
                                <h5>Login to the collaboration platform</h5>
                            </div>
                            <?php
                            if (Input::exists()) {
                                if (Token::check(Input::get("login_token"))) {
                                    $username = Input::get("username");
                                    $password = SHA1(Input::get("password"));
                                    //$institution = Input::get("institution");
                                    $emmergencepassword = Input::get('password');
                                    $login = "SELECT * FROM users_tb WHERE users_email='$username' AND users_password='$password' ORDER BY users_id DESC LIMIT 1  ";
                                    if (DB::getInstance()->checkRows($login)) {
                                        $_SESSION['email'] = $username;
                                        $_SESSION['password'] = $password;
                                        $users_list = DB::getInstance()->query($login);
                                        foreach ($users_list->results() as $users) {
                                            $_SESSION['name'] = $users->users_name;
                                            $_SESSION['title'] = $users->users_designation;
                                            $_SESSION['login_type'] = DB::getInstance()->getName("user_role", $users->user_role_id, "user_role_name", "user_role_id");

                                            $_SESSION['user_role_id'] = $users->user_role_id;
                                            $_SESSION['institution_id'] = $users->institution_id;
                                            ;
                                            $_SESSION['institution_name'] = DB::getInstance()->getName("institution_tb", $users->institution_id, "institution_name", "institution_id");
                                            $_SESSION['id'] = $users->users_id;

                                            $insertQuery = DB::getInstance()->insert("login_stats", array(
                                                'login_date' => $date_today,
                                                'login_time' => $current_time,
                                                'users_id' => $users->users_id,
                                                'client_ip' => get_client_ip()
                                            ));
                                            if ($insertQuery){
                                                $login_id = DB::getInstance()->displayTableColumnValue("SELECT login_stats_id FROM login_stats ORDER BY login_stats_id DESC LIMIT 1","login_stats_id");
                                                $_SESSION['login_id'] = $login_id;
                                                 Redirect::to('index?!=dashboard|098765439494894mmmmmmkkopi90uij98047878238fnbbsjvds78252526bxbsbshjs');
                                            }
                                        }

                                        //DB::getInstance()->logs($username." Logged in.");
                                       
                                    } else {
                                        ?>
                                        <div class="alert alert-warning"><span>Login was not successful.</span></div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <form action="#" method="POST" class="form-inline">
                                <div class="box-content">



                                    <p>Provide your login Details </p>
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-envelope"></i></span>
                                        <input class="span4" type="text" name="username" required="" placeholder="Email address">
                                    </div>
                                    <div class="input-prepend">
                                        <br/>
                                        <span class="add-on"><i class="icon-key"></i></span>
                                        <input class="span4" type="password" name="password" placeholder="Password">
                                    </div>

                                    <div class="form-inline">
                                        <br/>
                                        <a href="index?!=forgot_password|38837892urhfvn,opeiiuy82773772366562781876ewtfyuewgdbhjs"> Forgot you password? click here</a>
                                    </div>
                                    <div class="form-inline">
                                        <br/>
                                        <input type="hidden" name="login_token" class="input" value="<?php echo Token::generate(); ?>">
                                        <button class="btn btn-primary" name="login_button" type='submit' id="submit" value='login_button'><i class="icon-lock"></i> Login to the platform</button>
                                    </div>



                                </div>

                            </form>
                        </div>


                    </div>
                </div>

            </section>



        </div>
    </div>


<?php include 'includes/footer.php'; ?>

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
    <script type="text/javascript">
        $(function () {
            $('#sample-table').tablesorter();
            $('#datepicker').datepicker();
            $(".chosen").chosen();
        });
    </script>

</body>
</html>