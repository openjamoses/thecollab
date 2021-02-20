<?php
include 'includes/libs.php';
error_reporting(E_ALL);
?>
<title><?php echo $title ?> Details </title>
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
                            if (Input::exists() && Input::get("addCollaboration")) {
                                $title = Input::get("title");
                                $descriptions = Input::get("descriptions");
                                $study_title = Input::get("study_title");
                                $collab_id = Input::get("collab_id");

                                $insertQuery = DB::getInstance()->query("UPDATE contribution_tb SET contribution_title='" . $title . "',contribution_details='" . $descriptions . "',study_type_id='" . $study_title . "' WHERE contribution_id = '" . $collab_id . "' ");
                                if ($insertQuery) {
                                    $sql = "SELECT contribution_id FROM contribution_tb ORDER BY contribution_id DESC LIMIT 1";
                                    $collab_id = DB::getInstance()->displayTableColumnValue($sql, "contribution_id");
                                    $msg = '<div class="alert alert-success">Study Created successfully..!</div>';


                                    //$login_id = DB::getInstance()->displayTableColumnValue("SELECT login_stats_id FROM login_stats ORDER BY login_stats_id DESC LIMIT 1","login_stats_id");

                                    $event_body = "Updated new collaboration";
                                    $event_name = "Collaboration";
                                    $event_type = "Edit";
                                    $ipAddress = get_client_ip();
                                    $login_id = $_SESSION['login_id'];
                                    savenewEvent($current_time, $event_body, $ipAddress, $login_id, $event_name, $event_type);

                                    echo '<div class="alert alert-success">Collaboration details update successfull..!</div>';
                                    //Redirect::to('index?!=edit_collab&%=' . $collab_id . '|pooiiiii94948940pooo47878238fnbbsjvds78252526bxbsbshjs');
                                }

                                // Redirect::go_to('index.php?page=add_staff');
                            }
                            $id = 0;
                            $title = "";
                            $desc = "";
                            $type_id = 0;
                            if (@$_GET["m"]) {
                                $url_data = htmlspecialchars($_GET["m"]);
                                $splits = explode("|", $url_data);
                                $msg = $splits[0];
                                //echo $msg;
                            }

                            //if ()
                            $lead_id = 0;
                            $lead = "";
                            if (@$_GET["%"]) {
                                $url_data = htmlspecialchars($_GET["%"]);
                                $splits = explode("|", $url_data);
                                $id = $splits[0];

                                $title = DB::getInstance()->getName("contribution_tb", $id, "contribution_title", "contribution_id");
                                $type_id = DB::getInstance()->getName("contribution_tb", $id, "study_type_id", "contribution_id");
                                $desc = DB::getInstance()->getName("contribution_tb", $id, "contribution_details", "contribution_id");
                                $lead_id = DB::getInstance()->getName("contribution_tb", $id, "user", "contribution_id");
                                $lead = DB::getInstance()->getName("users_tb", $lead_id, "users_name", "users_id");
                            }
                            ?>
                            <form action="#" method="POST" class="form-inline">
                                <div class="box-header">
                                    <i class="icon-book"></i>
                                    <h5>Collaboration form</h5>
                                </div>
                                <div class="box-content">

                                    <p>Select the Study Category</p>
                                    <select  class="chosen span6" name="study_title" data-placeholder="Choose Study Category..." required="">
                                        <option value=""></option>
                                        <?php
                                        $query = "SELECT * FROM study_type  ORDER BY study_typ ASC";
                                        if (DB::getInstance()->checkRows($query)) {

                                            $users_list = DB::getInstance()->query($query);
                                            foreach ($users_list->results() as $users):
                                                ?>
                                                <option <?php
                                                if ($type_id == $users->study_type_id) {
                                                    echo 'selected=""';
                                                }
                                                ?>  value="<?php echo $users->study_type_id; ?>"><?php echo $users->study_typ; ?></option>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                    </select>

                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-th"></i></span>
                                        <input type="hidden" value="<?php echo $id; ?>" name="collab_id"/>
                                        <textarea rows="2" class="span5" name="title" placeholder="Enter the study title"><?php
                                            if ($id != 0) {
                                                echo $title;
                                            }
                                            ?></textarea>
                                    </div>
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-th"></i></span>
                                        <textarea class="span5" name="descriptions" rows="10"  placeholder="Enter the Study Details"><?php
                                            if ($id != 0) {
                                                echo $desc;
                                            }
                                            ?></textarea>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit"  name="addCollaboration" value="addCollaboration" class="btn btn-primary">
                                            <i class="icon-plus"></i>
                                            Update Collaboration
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>


                    <?php if ($id != 0) { ?>
                        <div class="span8">
                            <div class="box">

                                <?php
                                if (Input::exists() && Input::get("addObjective")) {
                                    $lead = Input::get("lead");
                                    $objective = Input::get("objective");
                                    $collab_id = Input::get("collab_id");
                                    $counts = 0;
                                    for ($x = 0; $x < count($objective); $x++) {
                                        DB::getInstance()->insert("study_objectives", array(
                                            'objectives_name' => $objective[$x],
                                            'objective_lead' => $lead[$x],
                                            'contribution_id' => $collab_id
                                        ));
                                        $counts ++;
                                    }
                                    $msg = '<div class="alert alert-success">Thank, ' . $counts . ' Objectives Added successful!</div>';


                                    // Redirect::go_to('index.php?page=add_staff');
                                    $event_body = "Added new objective";
                                    $event_name = "objective";
                                    $event_type = "Added";
                                    $ipAddress = get_client_ip();
                                    $login_id = $_SESSION['login_id'];
                                    savenewEvent($current_time, $event_body, $ipAddress, $login_id, $event_name, $event_type);
                                    Redirect::to('index?!=create_collab&%=' . $collab_id . '|pooiiiii94948940pooo47878238fnbbsjvds78252526bxbsbshjs');
                                }
                                if (@$_GET["m2"]) {
                                    $url_data = htmlspecialchars($_GET["m2"]);
                                    $splits = explode("|", $url_data);
                                    $msg = $splits[0];
                                    // echo $msg;
                                }
                                $sqlQuery = "SELECT * FROM study_objectives s, users_tb u WHERE u.users_id = s.objective_lead AND contribution_id = '" . $id . "'";

                                $obj_counts = DB::getInstance()->countElements($sqlQuery);
                                ?>

                                <div class="box-header">
                                    <i class="icon-book"></i>
                                    <h5>Research Objectives (<?php echo $obj_counts; ?>)</h5>
                                </div>
                                <div class="box-content">
                                    <?php
                                    if ($obj_counts == 0) {
                                        if ($lead_id == $_SESSION['id']) {
                                            echo '<div class="alert alert-warning"> Please add at least one Objective!</div>';
                                        } else {
                                            echo '<div class="alert alert-warning"> No objectives has been added yet!</div>';
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
                                                        <td><?php echo "" . $index . ")-   " . $users->objectives_name ?> <br/>
                                                            <a href=""><?php echo $users->users_name; ?></a>
                                                            |  <a href="index?!=activities&%=<?php echo $users->study_objectives_id; ?>|<?php echo $index; ?>|pooiiiii94948940pooo47878238fnbbsjvds78252526bxbsbshjs"> (<?php echo countInvitesObjectives($users->study_objectives_id); ?>) users | (<?php echo countActivities($users->study_objectives_id); ?>) activity(s)</a>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                    <?php if ($lead_id == $_SESSION['id']) { ?>
                                        <form action="#" method="POST">

                                            <p> Objective Lead</p>

                                            <input type="hidden" name="collab_id" value="<?php echo $id; ?>"/>
                                            <select class="chosen span5" name="lead[]" data-placeholder="Assign lead collaborator" required="">
                                                <option value=""></option>
                                                <option value="<?php echo $lead_id; ?>"><?php echo $lead; ?></option>

                                                <?php
                                                $query = "SELECT * FROM users_tb u, collab_invites c WHERE c.users_id = u.users_id AND contribution_id = '" . $id . "' ORDER BY users_name ASC";

                                                if (DB::getInstance()->checkRows($query)) {

                                                    $users_list = DB::getInstance()->query($query);
                                                    foreach ($users_list->results() as $users):
                                                        ?>
                                                        <option value="<?php echo $users->users_id; ?>"><?php echo $users->users_name; ?></option>
                                                        <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>


                                            <div class="input-prepend">
                                                <span class="add-on" onclick="add_element(<?php echo $id; ?>);"><i class="icon-plus-sign"></i></span>
                                                <textarea rows="2" class="span4" name="objective[]" placeholder="Enter the Objective here!"  required=""></textarea>

                                            </div>
                                            <div id="add_new">

                                            </div>
                                            <button type="submit" name="addObjective" value="addObjective" class="btn btn-info"><i class="icon icon-plus-sign"></i> Add Objective</button>
                                        </form>
                                    <?php } ?>
                                </div>


                            </div>
                        </div>
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



                                            function add_element(collab_id) {
                                                var row_ids = Math.round(Math.random() * 3000000000);
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'index?!=ajax_data|9032883832839308340987er',
                                                    data: {add_new_objective_rows: "All", row_ids: row_ids, collab_id: collab_id},
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