<?php
error_reporting(E_ALL);
include 'includes/libs.php';
?>
<title><?php echo $title ?> Platform </title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>

</head>
<body>
    <?php include 'includes/top.php'; ?>
    <div id="body-container">
        <div id="body-content">
            <?php include 'includes/nav.php'; ?>  
            <section class="page container">
                <?php
                $institution_id = $_SESSION['institution_id'];
                $query = "SELECT * FROM contribution_tb c, users_tb u WHERE c.user = u.users_id AND u.institution_id = '" . $institution_id . "' ORDER BY contribution_date,contribution_time DESC";
                if (DB::getInstance()->checkRows($query)) {

                    $users_list = DB::getInstance()->query($query);
                    foreach ($users_list->results() as $users):
                        $msg = '<div class="alert alert-success">Setup collaboration detail for "' . $users->contribution_title . '".</div>';
                        ?>
                        <div class="row">
                            <div class="span16">
                                <div class="box pattern pattern-sandstone">
                                    <div class="box-header">
                                        <i class="icon-tags"></i>
                                        <h5><?php echo $users->contribution_title; ?>  |   <?php echo $users->users_name; ?></h5>
                                    </div>



                                    <div class="box-content box-list collapse in">


                                        <ul>

                                            <?php
                                            $session_id = $_SESSION['id'];
                                            $objQuery = "SELECT * FROM study_objectives s WHERE  s.contribution_id = '$users->contribution_id' ";

                                            //$query = "SELECT study_activity_name, users_name, users_designation FROM contributers c, study_objectives so,users_tb u,study_activity sa WHERE sa.study_activity_id = c.study_activity_id AND so.study_objectives_id = sa.study_objectives_id AND so.contribution_id = '" . $collab_id . "' AND  c.contributer_user = u.users_id ORDER BY contributers_id ASC";


                                            $counter = 0;

                                            if (DB::getInstance()->checkRows($objQuery)) {

                                                $obj_list = DB::getInstance()->query($objQuery);
                                                foreach ($obj_list->results() as $users1):
                                                    $counter ++;
                                                    $query2 = "SELECT * FROM study_activity sa, contributers c WHERE sa.study_activity_id = c.study_activity_id AND sa.study_objectives_id = '$users1->study_objectives_id' GROUP BY c.study_activity_id ";
                                                    if (DB::getInstance()->checkRows($query2)) {
                                                        ?>
                                                        <ul>
                                                            <li><strong>
                                                                    <a class="form-control label label-info" href=""><?php echo "Objective " . $counter . ':   '; ?> <?php echo $users1->objectives_name; ?></a> <br/></strong>
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
                                                                            <p>  <?php if (checkUplpoads($users3->contributers_id)) { ?> <a target="_blank" href="index?!=upl&%=<?php echo $users->contribution_id; ?>|<?php echo $users1->study_objectives_id; ?>|<?php echo $users3->contributers_id; ?>|hjejejhjehgvjhvbsdbwdhfj"> (<?php echo countUplpoads($users3->contributers_id) ?>)<i class="icon icon-upload-alt"></i>uploads </a>   |  <?php } ?> <font color="green" size="2"> <?php echo $users3->contribution_date . " " . $users3->contribution_time; ?> </font>  by <a href=""> <?php echo $users3->users_designation . " " . $users3->users_name; ?> </a></p>
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
                        endforeach;
                    }
                    ?>

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