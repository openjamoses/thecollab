<?php include 'includes/libs.php'; ?>
<title><?php echo $title ?> Objectives </title>
</head>
<body>
    <?php include 'includes/top.php'; ?>
    <div id="body-container">
        <div id="body-content">
            <?php include 'includes/nav.php'; ?>  
            <section class="page container">

                <div class="row">

                    <div class="span8">
                        <div class="box">
                            <?php
                            $url_data = htmlspecialchars($_GET["%"]);
                            $splits = explode("|", $url_data);
                            $id = $splits[0];
                            $no = $splits[1];
                            $lead_id = 0;

                            $name = "";
                            $lead = "";
                            $collab_name = "";
                            $collab_id = 0;
                            $query = "SELECT objectives_name,users_name,c.contribution_title,s.contribution_id, objective_lead FROM study_objectives s, users_tb u, contribution_tb c WHERE objective_lead = u.users_id AND c.contribution_id = s.contribution_id AND s.study_objectives_id = '" . $id . "' ";
                            $users_list = DB::getInstance()->query($query);
                            foreach ($users_list->results() as $users):
                                $name = $users->objectives_name;
                                $lead = $users->users_name;
                                $collab_name = $users->contribution_title;
                                $collab_id = $users->contribution_id;
                                $lead_id = $users->objective_lead;
                            endforeach;
                            //$name = DB::getInstance()->getName("study_objectives", $id, "objectives_name", "study_objectives_id");
                            ?>

                            <div class="box-header">
                                <i class="icon-book"></i>
                                <h5><?php echo $collab_name; ?></h5>

                            </div>
                            <div class="box-content">

                                <div id="DIV"></div>

                                <table id="sample-table" class="table table-hover tablesorter">

                                    <thead>
                                        <tr>
                                            <th><?php echo "Objective-" . $no . ":  " . $name; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p><i class="icon-group"></i> List of Collaborators responsible</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <a href=""> <?php echo $lead; ?> </a> lead
                                            </td>
                                        </tr>
                                        <?php
                                        $query = "SELECT * FROM users_tb u, collab_invites c WHERE c.users_id = u.users_id AND contribution_id = '" . $collab_id . "' ORDER BY users_name ASC";

                                        if (DB::getInstance()->checkRows($query)) {
                                            $users_list = DB::getInstance()->query($query);
                                            foreach ($users_list->results() as $users):
                                                if ($_SESSION['id'] == $lead_id) {
                                                    if ($users->users_id != $lead_id) {
                                                        ?>
                                                        <tr>
                                                            <td><input type="checkbox" <?php if (checkUserObjectives($id, $users->invites_id)) { ?> checked="" <?php } ?> onchange="invites(<?php echo $users->invites_id; ?>, <?php echo $id; ?>);" class="btn btn-default" id="" value="<?php echo $users->users_id; ?>"/>  <a href=""> <?php echo $users->users_name; ?></a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    if (checkUserObjectives($id, $users->invites_id) && $users->users_id != $lead_id) {
                                                        ?>
                                                        <tr>
                                                            <td> <a href=""> <?php echo $users->users_name; ?></a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            endforeach;
                                        }
                                        ?>
                                    </tbody>
                                </table>


                            </div>


                        </div>
                    </div>



                    <div class="span8">
                        <div class="box">

                            <?php
                            if (Input::exists() && Input::get("addActivity")) {
                                $activity = Input::get("activity");
                                $obj_id = Input::get("obj_id");
                                $counts = 0;
                                for ($x = 0; $x < count($activity); $x++) {
                                    DB::getInstance()->insert("study_activity", array(
                                        'study_activity_name' => $activity[$x],
                                        'study_objectives_id' => $obj_id
                                    ));
                                    $counts ++;
                                }
                                $msg = "";
                                if ($counts > 0) {
                                    $msg = 'Thank, ' . $counts . ' activities added successful!';
                                    $event_body = "Added new ".$counts." activity(s)";
                                    $event_name = "activity";
                                    $event_type = "Added";
                                    $ipAddress = get_client_ip();
                                    $login_id = $_SESSION['login_id'];
                                    savenewEvent($current_time, $event_body, $ipAddress, $login_id, $event_name, $event_type);
                                }
                                
                                
                                    
                                Redirect::to('index?!=activities&%=' . $id . '|'.$no.'|0059595&m2=' . $msg . '|49jjji99494|pooiiiii94948940pooo47878238fnbbsjvds78252526bxbsbshjs');
                                // Redirect::go_to('index.php?page=add_staff');
                            }
                            if (@$_GET["m2"]) {
                                $url_data = htmlspecialchars($_GET["m2"]);
                                $splits = explode("|", $url_data);
                                $msg = $splits[0];
                                echo $msg;
                            }
                            $sqlQuery = "SELECT * FROM study_activity WHERE study_objectives_id = '" . $id . "'";
                            $obj_counts = DB::getInstance()->countElements($sqlQuery);
                            ?>
                            <div class="box-header">
                                <i class="icon-bookmark"></i>
                                <h5>Activities (<?php echo $obj_counts; ?>)</h5>
                            </div>
                            <div class="box-content">
                                <?php
                                if ($obj_counts == 0) {
                                    if (checkUserInvitesObjective($collab_id,$id, $_SESSION['id'])) {
                                        ?>
                                        <div class="alert alert-warning"> Please add at least one activity!</div>
                                    <?php } else { ?>
                                        <div class="alert alert-warning"> No activity has been registered!</div>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                if (DB::getInstance()->checkRows($sqlQuery)) {
                                    ?>
                                    <table id="sample-table" class="table table-hover tablesorter">

                                        <tbody>
                                            <?php
                                            $index = 0;
                                            $users_list = DB::getInstance()->query($sqlQuery);
                                            foreach ($users_list->results() as $users):
                                                $index ++;
                                                ?>
                                                <tr>
                                                    <td> <?php echo "activity-" . $index . ":    "; ?> <strong> <?php echo $users->study_activity_name ?> </strong>                                  
                                                    </td>

                                                </tr>

                                                <?php
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <?php if (checkUserInvitesObjective($collab_id, $id, $_SESSION['id'])) { ?>
                                    <form action="#" method="POST">
                                        <input type="hidden" name="obj_id" value="<?php echo $id; ?>"/>
                                        <div class="input-prepend">
                                            <span class="add-on" onclick="add_element();"><i class="icon-plus-sign"></i></span>
                                            <textarea rows="2" class="span4" name="activity[]" placeholder="Enter the activity here!"  required=""></textarea>
                                        </div>
                                        <div id="add_new">

                                        </div>
                                        <button type="submit" name="addActivity" value="addActivity" class="btn btn-info"><i class="icon icon-plus-sign"></i> save</button>
                                    </form>
                                <?php } ?>
                            </div>


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



                                            function add_element() {
                                                var row_ids = Math.round(Math.random() * 3000000000);
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'index?!=ajax_data|9032883832839308340987er',
                                                    data: {add_new_activity_rows: "All", row_ids: row_ids},
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

                                            function invites(invite_id, objectives_id) {
                                                //alert(user_id+" :: "+collab_id);
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'index?!=ajax_data|9032883832839308340987er',
                                                    data: {invite_user_objectives: "All", invite_id: invite_id, objectives_id: objectives_id},
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
    </script>

</body>
</html>