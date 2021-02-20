<?php
error_reporting(E_ALL);
require 'Mail/mail.php';

include 'includes/libs.php';
?>
<title><?php echo $title ?> Account </title>
</head>
<?php
$url_data = htmlspecialchars($_GET["~"]);
$splits = explode("|", $url_data);
$inst_id = $splits[0];
?>
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

                            <a href="index?!=wel|uewyiywuiynnncvbdyusdin jhsuisiuwiuwe9287217725265363">
                                <i class="icon-dashboard icon-large"></i> Home
                            </a>
                        </li>

                    </ul>
                </div>
            </div> 
            <section class="page container">
                <div class="row">


                    <?php
                    $flag = 0;
                    if (Input::exists() && Input::get("submitDetails")) {
                        $name = Input::get("name");
                        $email_work = Input::get("email_work");
                        $email_home = Input::get("email_home");
                        $area_expertise = Input::get("area_expertise");
                        $phone = Input::get("phone");
                        $address = Input::get("address");
                        $designation = Input::get("designation");

                        $password = sha1(Input::get("password"));
                        $institution = Input::get("institution");
                        $lead_id = 2;

                        $queryDup1 = "SELECT * FROM users_tb WHERE institution_id='$institution' AND user_role_id = '$lead_id' ";
                        if (DB::getInstance()->checkRows($queryDup1)) {
                            
                        } else {
                            $lead_id = 1;
                            $queryDup = "SELECT * FROM users_tb WHERE users_email='$email_work' OR users_email2 = '$email_home'";
                            if (DB::getInstance()->checkRows($queryDup)) {
                                echo '<div class="alert alert-warning">The Email address already Registered</div>';
                            } else {

                                $insertQuery = DB::getInstance()->insert("users_tb", array(
                                    'users_name' => $name,
                                    'users_email' => $email_work,
                                    'users_password' => $password,
                                    'user_role_id' => $lead_id,
                                    'institution_id' => $institution,
                                    'users_email2' => $email_home,
                                    'users_contact' => $phone,
                                    'users_expertise' => $area_expertise,
                                    'users_address' => $address,
                                    'users_designation' => $designation
                                ));
                                if ($insertQuery) {
                                    $flag ++;
                                    try {
                                        //Server settings
                                        $to = "openjamosesopm@gmail.com";
                                        $from = "2014bcs010@must.ac.ug";
                                        $subject = "Testing Text Email";
                                        $body = "This is a test email body that will be in text format";
                                        $mail = new Mail($to, $from, $subject, $body);
                                        $mail->send();
                                        $email_sent = 'Message sent successfully..!';
                                    } catch (Exception $e) {
                                        $email_sent = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                                    }




                                    echo'<div class="alert alert-success">Account Details Created successfully!</div>';
                                    echo'<div class="alert alert-warning"> ' . $email_sent . '</div>';
                                    echo'<div class="alert alert-success">Please click on  <a href="index?!=sv_instance" class="btn">Create Server Instance </a> to set up the server with your subscription details !</div>';

//Redirect::go_to('index.php?page=wel');
                                }
                            }
                        }
                    } else {
                        ?>

                        Completion <?php
                        if ($flag > 0) {
                            echo ' (40%)';
                        } else {
                            echo '(21%)';
                        }
                        ?>
                        <div class="progress progress-striped active">

                            <div class="bar" <?php
                            if ($flag > 0) {
                                echo 'style="width: 40%;"';
                            } else {
                                echo 'style="width: 21%;"';
                            }
                            ?> ></div>
                        </div>


                        <div class="span8">
                            <div class="blockoff-left">
                                <p> Create your account here..! </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <form action="#" method="POST" class="form-inline">
                            <div class="span8">
                                <div class="box">
                                    <div class="box-header">
                                        <i class="icon-book"></i>
                                        Personel your details
                                    </div>
                                    <div class="box-content">



                                        <div class="form-inline">


                                            <select class="chosen span4" name="institution" data-placeholder="Choose Research Institution..." required="">
                                                <option value=""></option>
                                                <?php
                                                $query = "SELECT * FROM institution_tb  ORDER BY institution_name ASC";
                                                if (DB::getInstance()->checkRows($query)) {

                                                    $users_list = DB::getInstance()->query($query);
                                                    foreach ($users_list->results() as $users):
                                                        ?>
                                                        <option <?php if ($inst_id == $users->institution_id) { ?> selected="" <?php } ?>value="<?php echo $users->institution_id; ?>"><?php echo $users->institution_name; ?></option>
                                                        <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-inline">

                                            <select class="chosen span3" name="designation" data-placeholder="choose your designation..." required="">
                                                <option value=""></option>
                                                <option value="Mr">Mr</option>
                                                <option value="Miss">Miss</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Dr">Doctor</option>
                                                <option value="Prof">Professor</option>
                                            </select>
                                        </div>

                                        <div class="input-prepend form-control">

                                            <input class="span4" type="text" required="" name="name" placeholder="Full Name">
                                        </div>

                                        <div class="input-prepend form-control">
                                            <input class="span4" type="text" required="" name="email_work" placeholder="Work Email address">
                                        </div>

                                        <div class="input-prepend form-control">

                                            <input class="span4" type="text" name="email_home" placeholder="Home Email address">
                                        </div>

                                        <div class="input-prepend form-control">

                                            <input class="span4" type="password" name="password" placeholder="Password">
                                        </div>




                                    </div>
                                    
                                </div>
                            </div>


                            <div class="span8">
                                <div class="box">
                                    <div class="box-header">

                                        Other details
                                    </div>
                                    <div class="box-content">

                                        <div class="input-prepend form-control">
                                            <br/>

                                            <textarea class="span4" rows="5"  required="" name="area_expertise" placeholder="Enter your Area of Expertise"></textarea>
                                        </div>

                                        <div class="input-prepend form-control">

                                            <input class="span4" type="text" required="" name="phone" placeholder="Phone contact">
                                        </div>

                                        <div class="input-prepend form-control">

                                            <input class="span4" type="text" name="address" placeholder="Physical address">
                                        </div>


                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" name="submitDetails" value="submitDetails" class="btn btn-primary">
                                            <i class="icon-lock"></i>
                                            submit details
                                        </button>

                                        <a href="index?!=sv_instance|9393939829ojkd29w920-12987327836535532672" class="btn btn-info"> Continue  <i class="ico icon-chevron-right"></i> </a>

                                    </div>
                                </div>
                            </div>

                        </form>
                    <?php } ?>




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