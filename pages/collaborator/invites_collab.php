<?php
include 'includes/libs.php';
require 'Mail/mail.php';
?>
<title><?php echo $title ?> Invites </title>
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

    if ($_SESSION['id'] == $user_id) {
        $collab_by = $collab_by . " (You)";
    }
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
                                    $to = $email_work;
                                    $from = "2014bcs010@must.ac.ug";
                                    $subject = "Invitation to collaborate on ".$collab_title;
                                    $body = "Hello $name, \n You have been invited to collaborate on the project entitled above";
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
                            <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                <thead>
                                    <tr>

                                        <th>Study title</th>
                                        <th>Creation Date</th>
                                        <th>Lead Collaborator</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $collab_title; ?></td>
                                        <td><?php echo $collab_date; ?></td>
                                        <td><?php echo $collab_by; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            </div>

                    </div>


                    <div class="span16">
                        <div id="DIV" class="blockoff-left">
                            <p> List of collaborators </p>
                        </div>
                        <?php if ($_SESSION['id'] == $user_id) { ?>
                            <p class="alert alert-info">Click on the checkbox to invite a collaborator </p>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="span16">
                        <div class="box">
                            <div class="box-header">

                                <i class="icon-group"></i>
                                Other Registered Collaborators
                            </div>

                            <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                <thead>
                                    <tr>

                                        <th colspan="2">Name</th>
                                        <th>Contacts</th>
                                        <th>Email</th>
                                        <th>Expertise</th>
                                        <th>Address</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $institution_id = $_SESSION['institution_id'];
                                    $query = "SELECT * FROM users_tb s, user_role r WHERE r.user_role_id = s.user_role_id AND institution_id = '" . $institution_id . "' ORDER BY users_name ASC";
                                    if (DB::getInstance()->checkRows($query)) {


                                        $users_list = DB::getInstance()->query($query);
                                        foreach ($users_list->results() as $users):
                                            //$status = "not invited";

                                            if ($users->users_id != $user_id) {
                                                echo '<tr>
                                                        <td><input type="checkbox"';
                                                if (checkUserInvites($collab_id, $users->users_id)) {
                                                    echo 'checked=""';
                                                } if ($_SESSION['id'] != $user_id) {
                                                    echo 'disabled="" ';
                                                } echo ' onchange="invites(' . $users->users_id . ');" name="seleceted[]"/></td>
                                                        <td>' . $users->users_designation . ". " . $users->users_name . '</td>
                                                        <td>' . $users->users_contact . '</td>
                                                        <td>' . $users->users_email . '</td>
                                                        <td>' . $users->users_expertise . '</td>
                                                        <td>' . $users->users_address . '</td>
                                                        
                                                    </tr>';
                                            }

                                        endforeach;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <div class="box-footer">
                                <p>The study descriptions</p>
                                <p class="alert alert-success"> <?php echo $collab_desc; ?></p>

                            </div>
                            <a class="btn btn-info" href="index?!=new_col&%=83278567812362533628278|762666236266265356356"> <i class="fa fa-user"></i> register new collaborator</a>
                        
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