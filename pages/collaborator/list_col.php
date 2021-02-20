<?php
include 'includes/libs.php';
require 'Mail/mail.php';
?>
<title><?php echo $title ?> Collaborator </title>
</head>
<body>
    <?php include 'includes/top.php'; ?>
    <?php
    $url_data = htmlspecialchars($_GET["%"]);
    $splits = explode("|", $url_data);

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




                </div>
                <div class="row">


                    <div class="span16">


                        <div class="box">

                            <?php
                            $institution_id = $_SESSION['institution_id'];
                            $query = "SELECT * FROM contribution_tb c, users_tb u WHERE c.user = u.users_id AND u.institution_id = '" . $institution_id . "' ORDER BY contribution_date,contribution_time DESC";
                            if (DB::getInstance()->checkRows($query)) {

                                $users_list = DB::getInstance()->query($query);
                                foreach ($users_list->results() as $collab):
                                    $collab_id = $collab->contribution_id;
                                    $user_id = $collab->user;
                                    $collab_title = $collab->contribution_title;
                                    $collab_desc = $collab->contribution_details;
                                    $collab_date = $collab->contribution_date;
                                    $collab_by = $collab->users_designation . " " . $collab->users_name;
                                    if ($_SESSION['id'] == $user_id) {
                                        $collab_by = $collab_by . " (You)";
                                    }
                                    ?>

                                    <div class="box">


                                        <div class="span15">
                                            <div class="box pattern pattern-sandstone">
                                                <div class="box-header">
                                                    <i class="icon-list"></i>
                                                    <h5>Lists of collaboration at <?php echo $_SESSION['institution_name']; ?> </h5>
                                                    <button class="btn btn-box-right" data-toggle="collapse" data-target=".box-list">
                                                        <i class="icon-reorder"></i>
                                                    </button>
                                                </div>
                                                <div class="box-content box-list collapse in">
                                                    <ul>
                                                        <li>
                                                            <div>
                                                                <a href="#" class="news-item-title"><?php echo $collab_title; ?>  | <?php echo $collab_by; ?></a>
                                                                <p class="news-item-preview"><?php echo $collab_desc; ?></p>
                                                                <p class="news-item-preview">Other collaborators:</p>
                                                                <div class="box-content box-table">
                                                                    <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Invite status</th>
                                                                                <th>Name</th>
                                                                                <th class="td-actions">Contact</th>
                                                                                <th>Email</th>
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
                                                                                        } if ($_SESSION['id'] != $user_id) { echo ' disabled=""'; } echo 'onchange="invites(' . $users->users_id . ');" name="seleceted[]"/></td>
                                                        <td>' . $users->users_designation . ". " . $users->users_name . '</td>
                                                        <td>' . $users->users_contact . '</td>
                                                        <td>' . $users->users_email . '</td>
                                                        <td>' . $users->users_address . '</td>
                                                    </tr>';
                                                                                    }

                                                                                endforeach;
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>

                                                                </div>

                                                        </li>

                                                    </ul>
                                                    <div class="box-collapse">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                }
                                ?>


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