<?php
error_reporting(E_ALL);
include 'includes/libs.php';
?>
<title><?php echo $title ?> Collaborations </title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>

</head>
<body>
    <?php include 'includes/top.php'; ?>
    <div id="body-container">
        <div id="body-content">
            <?php include 'includes/nav.php'; ?>  
            <section class="page container">
                <?php
                $url_data = htmlspecialchars($_GET["%"]);
                $splits = explode("|", $url_data);
                $collab_id = $splits[0];
                $user_id = $splits[1];
                $collab_title = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_title", "contribution_id");
                $collab_desc = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_details", "contribution_id");
                $collab_date = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_date", "contribution_id") . " " . DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_time", "contribution_id");
                $collab_by = DB::getInstance()->getName("users_tb", $user_id, "users_designation", "users_id") . ". " . DB::getInstance()->getName("users_tb", $user_id, "users_name", "users_id");
                ?>
                <div class="row">
                    <div class="span16">
                        <div class="box pattern pattern-sandstone">
                            <div class="box-header">
                                <i class="icon-tags"></i>
                                <h5><?php echo $collab_title; ?>  |   <?php echo $collab_by; ?></h5>
                            </div>



                            <div class="box-content box-list collapse in">


                                <ul>
                                    <?php
                                    $session_id = $_SESSION['id'];
                                    $objQuery = "SELECT * FROM study_objectives s WHERE  s.contribution_id = '$collab_id' ";

                                    //$query = "SELECT study_activity_name, users_name, users_designation FROM contributers c, study_objectives so,users_tb u,study_activity sa WHERE sa.study_activity_id = c.study_activity_id AND so.study_objectives_id = sa.study_objectives_id AND so.contribution_id = '" . $collab_id . "' AND  c.contributer_user = u.users_id ORDER BY contributers_id ASC";


                                    $counter = 0;

                                    if (DB::getInstance()->checkRows($objQuery)) {

                                        $obj_list = DB::getInstance()->query($objQuery);
                                        foreach ($obj_list->results() as $users):
                                            $counter ++;
                                            $query2 = "SELECT * FROM study_activity sa, contributers c WHERE sa.study_activity_id = c.study_activity_id AND sa.study_objectives_id = '$users->study_objectives_id' GROUP BY c.study_activity_id ";
                                            if (DB::getInstance()->checkRows($query2)) {
                                                ?>
                                                <ul>
                                                    <li><strong>
                                                            <a class="form-control label label-info" href=""><?php echo "Objective " . $counter . ':   '; ?> <?php echo $users->objectives_name; ?></a> <br/></strong>
                                                        <br/>
                                                        <?php
                                                        $subCount = 0;
                                                        $obj2_list = DB::getInstance()->query($query2);
                                                        foreach ($obj2_list->results() as $users2):
                                                            $subCount ++;
                                                            $query3 = "SELECT * FROM contributers c,users_tb u WHERE c.contributer_user = u.users_id AND c.study_activity_id = '$users2->study_activity_id'";
                                                            ?>

                                                            <a  href=""class="label label-inverse"><i class="icon-hand-up"></i>    <strong><?php echo $users2->study_activity_name; ?></strong></a>
                                                            <p class="label label-info"></p>
                                                            <?php
                                                            $obj3_list = DB::getInstance()->query($query3);
                                                            foreach ($obj3_list->results() as $users3):
                                                                ?>
                                                                <div style="margin-left: 50px; margin: 0 auto;">
                                                                    <p class="news-item-preview"><?php echo $users3->contribution_body; ?></p>

                                                                </div>
                                                                <div>
                                                                    <p>  <?php if (checkUplpoads($users3->contributers_id)) { ?> <a target="_blank" href="index?!=upl&%=<?php echo $collab_id; ?>|<?php echo $users->study_objectives_id; ?>|<?php echo $users3->contributers_id; ?>|hjejejhjehgvjhvbsdbwdhfj"> (<?php echo countUplpoads($users3->contributers_id) ?>)<i class="icon icon-upload-alt"></i>uploads </a>   |  <?php } ?> <font color="green" size="2"> <?php echo $users3->contribution_date . " " . $users3->contribution_time; ?> </font>  by <a href=""> <?php echo $users3->users_designation . " " . $users3->users_name; ?> </a></p>
                                                                    <br/>
                                                                </div>

                                                                <?php
                                                            endforeach;
                                                            ?>

                                                            <div>
                                                                ...
                                                                <br/>
                                                            </div>
                                                            <?php
                                                        endforeach;
                                                        ?>

                                                        <?php
                                                        //$upload_path = getUplpoads($users->contributers_id);
                                                        ///if ($upload_path != "") {
                                                        ?>
                                                    </li>
                                                </ul>
                                                <?php
                                            }
                                        endforeach;
                                    }
                                    ?>
                                </ul> </div>
                        </div>
                    </div>


                    <?php
                    if (Input::exists() && Input::get("addContribution")) {
                        $contribution = Input::get("contribution");
                        $activity = Input::get("activity");
                        $insertQuery = DB::getInstance()->insert("contributers", array(
                            'study_activity_id' => $activity,
                            'contribution_body' => $contribution,
                            'contribution_date' => $date_today,
                            'contribution_time' => $current_time,
                            'contributer_user' => $_SESSION['id']
                        ));

                        if ($insertQuery) {
                            $query = "SELECT contributers_id FROM contributers ORDER BY contributers_id DESC LIMIT 1";
                            $contribution_id = DB::getInstance()->displayTableColumnValue($query, "contributers_id");
                            try {
                                if (isset($_FILES["uploads"])) {
                                    foreach ($_FILES['uploads']['tmp_name'] as $key => $tmp_name) {
                                        $file_name = $key . $_FILES['uploads']['name'][$key];
                                        $file_size = $_FILES['uploads']['size'][$key];
                                        $file_tmp = $_FILES['uploads']['tmp_name'][$key];
                                        $file_type = $_FILES['uploads']['type'][$key];
                                        $file_details = time() . $file_name;
                                        move_uploaded_file($file_tmp, $upload_directory . "" . $file_details);
                                        try {

                                            //encryptFile($upload_directory . $file_details, $_SESSION['password'], $upload_directory . $file_details . '.enc');
                                            //$file_details = $file_details . ".enc";
                                            //unlink($upload_directory . $file_details);
                                        } catch (Exception $ex) {
                                            
                                        }
                                        DB::getInstance()->insert("upload_tb", array(
                                            'upload_type' => $file_type,
                                            'upload_name' => $file_details,
                                            'contributers_id' => $contribution_id,
                                            //'upload_temp' => $file_tmp,
                                            'upload_size' => $file_size
                                        ));
                                    }
                                }
                                
                                $event_body = "Added new contribution";
                                $event_name = "contribution";
                                $event_type = "Added";
                                $ipAddress = get_client_ip();
                                $login_id = 1;
                                savenewEvent($current_time, $event_body, $ipAddress, $login_id, $event_name, $event_type);
                                
                            } catch (Exception $ex) {
                                echo '' . $ex;
                            }
                        }
                    }
                    ?>
                    <?php
                    //echo $objQuery;
                    $objQuery = "SELECT DISTINCT s.study_objectives_id,objectives_name,users_name,s.contribution_id, objective_lead FROM collab_invites i,study_objectives s, users_tb u, objective_users o WHERE (( i.invites_id = o.invites_id AND i.users_id = u.users_id AND o.study_objectives_id = s.study_objectives_id AND o.invites_id = i.invites_id AND i.users_id = '$session_id' ) OR ( objective_lead = u.users_id AND objective_lead = '$session_id' )) AND i.contribution_id = '$collab_id' AND s.contribution_id = '$collab_id' ";
                    if (DB::getInstance()->checkRows($objQuery)) {
                        ?>
                        <div class="span16">
                            <div class="box pattern pattern-sandstone">
                                <div class="box-header">
                                    <i class="icon-edit"></i>
                                    <h5>Add your contribution form </h5>
                                </div>
                                <form action="#" method="POST" enctype="multipart/form-data" class="">
                                    <div class="box-content box-table">


                                        <div class="box-content box-list collapse in">
                                            <ul>
                                                <li>
                                                    <div class="header">

                                                    </div>
                                                    <div>


                                                        <select class="chosen span6" name="objective" id="objectives_id" onchange="selectActivity(<?php echo $collab_id ?>, <?php echo $session_id ?>)" data-placeholder="Select Objective" required="">
                                                            <option value=""></option>

                                                            <?php
                                                            $users_list = DB::getInstance()->query($objQuery);
                                                            foreach ($users_list->results() as $users):
                                                                ?>
                                                                <option value="<?php echo $users->study_objectives_id; ?>"><?php echo $users->objectives_name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div id="divActivity">

                                                    </div>

                                                    <div class="input-prepend">
                                                        <a class="label label-info"  onclick="add_element();" title="Click here to generate the attachment form"> <i class="icon-plus-sign"></i>Click to add File attachment(s)</a>
                                                    </div>

                                                    <div id="add_new" class="input-prepend">
                                                    </div>
                                                    <div class="input-prepend">
                                                        <textarea class="span4" name="contribution" rows="6"  required="" placeholder="Enter your contribution" id="my_editor" ></textarea>
                                                    </div>

                                                    <div class="box-footer">
                                                        <button type="submit" disabled="" name="addContribution" value="addContribution" id="BTNsubmit" class="btn btn-default">
                                                            <i class="icon-plus"></i>
                                                            Submit contribution
                                                        </button>

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>




                </div>
            </section>
        </div>

    </div>
    <script>
        CKEDITOR.replace('my_editor');
    </script>

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

        function selectActivity(collab_id, users_id) {
            var objectives_id = document.getElementById("objectives_id").options[document.getElementById("objectives_id").selectedIndex].value;
            //alert(user_id+" :: "+collab_id);
            $.ajax({
                type: 'POST',
                url: 'index?!=ajax_data|9032883832839308340987er',
                data: {fetch_activity_by_user: "All", objectives_id: objectives_id, collab_id: collab_id, users_id: users_id},
                success: function (response) {
                    //if (response === 0) {
                    //var div = "<div class='alert alert-warning'> No activity has been registered!</div>";

                    var substring = "No activity has been registered for this objective!";
                    if (response.includes(substring)) {
                        document.getElementById("BTNsubmit").disabled = true;
                    } else {
                        document.getElementById("BTNsubmit").disabled = false;
                    }
                    $("#divActivity").html(response);
                    //alert(response);

                    //document.getElementById("my_editor").disabled = true;
                    //document.getElementById("my_editor").disabled = true;
                    //document.getElementById("submit").disabled = false;
                },
                error: function () {
                    alert('Exception!');
                }
            })
        }


        function add_element() {
            var row_ids = Math.round(Math.random() * 3000000000);
            $.ajax({
                type: 'POST',
                url: 'index?!=ajax_data|9032883832839308340987er',
                data: {add_new_files_rows: "All", row_ids: row_ids},
                success: function (response) {
                    //alert(row_ids);
                    document.getElementById('add_new').insertAdjacentHTML('beforeend',
                            '' + response);
                },
                error: function () {
                    alert('Exception!');
                }
            })

        }
        function delete_item(element_id) {
            $('#' + element_id).html('');
        }

    </script>


</body>
</html>