<?php
include 'includes/libs.php';
require 'Mail/mail.php';
?>
<title><?php echo $title ?> Register </title>
</head>
<body>
    <?php include 'includes/top.php'; ?>
    <?php
    $url_data = htmlspecialchars($_GET["%"]);
    $splits = explode("|", $url_data);
    $collab_id = $splits[0];
    $user_id = $splits[1];
    $collab_title = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_title", "contribution_id");
    $collab_desc = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_details", "contribution_id");
    $collab_date = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_date", "contribution_id") . " " . DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_time", "contribution_id");
    $collab_by = DB::getInstance()->getName("users_tb", $user_id, "users_designation", "users_id") . ". " . DB::getInstance()->getName("users_tb", $user_id, "users_name", "users_id");

//$collab_desc = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_details", "contribution_id");
    ?>
    <div id="body-container">
        <div id="body-content">
            <?php include 'includes/nav.php'; ?>  
            <section class="page container">
                <div class="row">


                    <?php
                    $flag = 0;



// Notice that $image_content_id is the optional Content-ID header value of the
// attachment. Must be enclosed by angle brackets (<>)
// Pull in the raw file data of the image file to attach it to the message.
                    //$image_data = file_get_contents('image.jpg');
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
                        $lead_id = 1;
                        $queryDup = "SELECT * FROM users_tb WHERE users_email='$email_work' OR users_email2 = '$email_home'";
                        if (DB::getInstance()->checkRows($queryDup)) {
                            echo '<div class="alert alert-warning">The Email address already Registered</div>';
                        } else {

                            $insertQuery = DB::getInstance()->insert("users_tb", array(
                                'users_name' => $name,
                                'users_email' => $email_work,
                                'users_password' => $password,
                                'user_role_id' => 1,
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

                                // echo'<div class="alert alert-success">Account Details Created successfully!</div>';
                                //echo'<div class="alert alert-warning"> ' . $email_sent . '</div>';
                                //echo'<div class="alert alert-success">Please click on  <a href="index?!=sv_instance" class="btn">Create Server Instance </a> to set up the server with your subscription details !</div>';
                                //Redirect::to('index?!=dashboard|9494894047878238fnbbsjvds78252526bxbsbshjs');
                            }
                        }
                        //}
                    }
                    ?>







                    <!--                        <div class="progress progress-striped active">
                    
                                                <div class="bar" <?php
                    if ($flag > 0) {
                        echo 'style="width: 40%;"';
                    } else {
                        echo 'style="width: 21%;"';
                    }
                    ?> ></div>
                                            </div>-->

                    <div class="span16">
                        <div class="blockoff-left">
                            <p> Study Title: <strong class="label label-success"><?php echo $collab_title; ?></strong></p>
                            <p> Created Date:<strong class="label label-info"> <?php echo $collab_date; ?> </strong></p>
                            <p> Lead Collaborator: <strong> <?php echo $collab_by; ?> </strong></p>
                        </div>

                    </div>

                    <?php if ($_SESSION['login_type'] == 'Lead Collaborator') { ?>
                        <div class="span6">
                            <div class="blockoff-left">
                                <p> Add new collaborator here!! </p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="span10">
                        <div id="DIV" class="blockoff-left">
                            <p > Invite collaborators here!! </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form action="#" method="POST" class="form-inline">
                        <div class="span6">
                            <div class="box">
                                <div class="box-header">
                                    <i class="icon-book"></i>
                                    Collaborator details
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
                                                    if ($_SESSION['institution_id'] == $users->institution_id) {
                                                        ?>
                                                        <option selected="" value="<?php echo $users->institution_id; ?>"><?php echo $users->institution_name; ?></option>
                                                        <?php
                                                    }
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-inline">

                                        <select class="chosen span3" name="designation" data-placeholder="choose your designation..." required="">

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
                                        <br/>
                                        <input class="span4" type="text" required="" name="email_work" placeholder="Work Email address">
                                    </div>

                                    <div class="input-prepend form-control">

                                        <input class="span4" type="text" name="email_home" placeholder="Home Email address">
                                    </div>

                                    <div class="input-prepend form-control">

                                        <input class="span4" type="password" name="password" placeholder="Password">
                                    </div>

                                    <div class="input-prepend form-control">
                                        <br/>

                                        <textarea class="span4" rows="5"  required="" name="area_expertise" placeholder="Enter collaborator Area of Expertise"></textarea>
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
                                </div>
                            </div>
                        </div>
                    </form>


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

        $(document).ready(function () {
            //$(document).ready(getCollaborators());
        });

        function invites(user_id) {
            var collab_id = <?php echo $collab_id; ?>;
            //alert(user_id+" :: "+collab_id);
            $.ajax({
                type: 'POST',
                url: 'index?!=ajax_data|9032883832839308340987er',
                data: {invite_collaborator: "All", user_id: user_id, collab_id: collab_id},
                success: function (response) {
                    $("#DIV").html(response);
                    //alert(response);
                    //getCollaborators();
                },
                error: function () {
                    alert('Exception!');
                }
            })
        }

        function getCollaborators() {
            var collab_id = <?php echo $collab_id; ?>;
            var user_id = <?php echo $user_id; ?>;
            $.ajax({
                type: 'POST',
                url: 'index?!=ajax_data|9032883832839308340987er',
                data: {invite_collaborator: "All", collab_id: collab_id},
                success: function (response) {
                    //$("#messageDIV").html(response);
                    //alert(response);
                    //$("#img").innerHTML = '<img src="images/staff/"' + response + '>';

                    //var splits = response.split('!');
                    //document.getElementById('staff_no').value = response;
                    //$("#subjectContent_" + regno).append(response);

                },
                error: function () {
                    alert('Exception!');
                }
            })
        }
    </script>

</body>
</html>