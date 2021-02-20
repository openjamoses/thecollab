<?php
error_reporting(E_ALL);
include 'includes/libs.php';
?>
<title><?php echo $title ?> Downloads </title>
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
                $query = "SELECT DISTINCT contribution_title,study_objectives_id, objectives_name, users_name FROM contribution_tb c, users_tb u, study_objectives s WHERE s.contribution_id = c.contribution_id AND objective_lead = u.users_id AND c.user = u.users_id AND u.institution_id = '" . $institution_id . "' ORDER BY contribution_date,contribution_time DESC";
                if (DB::getInstance()->checkRows($query)) {

                    $users_list = DB::getInstance()->query($query);
                    foreach ($users_list->results() as $users):
                        ?>
                        <div class="row">

                            <div class="span16">
                                <div class="box pattern pattern-sandstone">
                                    <div class="box-header">
                                        <i class="icon-tags"></i>
                                        <h5><?php echo $users->contribution_title; ?> | <?php echo $users->users_name; ?> </h5>
                                    </div>
                                    <div class="box-content box-list collapse in">
                                        <?php
                                        $query2 = "SELECT * FROM study_activity sa, contributers c WHERE sa.study_activity_id = c.study_activity_id AND sa.study_objectives_id = '$users->study_objectives_id'  GROUP BY c.study_activity_id ";
                                        if (DB::getInstance()->checkRows($query2)) {
                                            ?>
                                            <ul>
                                                <li>
                                                    <a class="label label-info"><?php echo $users->objectives_name; ?></a>
                                                </li>
                                            </ul>
                                            <ul>
                                                <?php
                                                $subCount = 0;
                                                $obj2_list = DB::getInstance()->query($query2);
                                                foreach ($obj2_list->results() as $users2):
                                                    //if ($users2->contributers_id == $cont_id) {
                                                    $subCount ++;
                                                    $query3 = "SELECT * FROM contributers c, users_tb u WHERE c.contributer_user = u.users_id AND c.study_activity_id = '$users2->study_activity_id'";
                                                    ?>
                                                    <li>
                                                        <a  href=""class="label label-inverse"><i class="icon-hand-up"></i>    <strong><?php echo $users2->study_activity_name; ?></strong></a>

                                                        <p class="label label-info"></p>
                                                        <?php
                                                        $obj3_list = DB::getInstance()->query($query3);
                                                        foreach ($obj3_list->results() as $users3):
                                                            if (checkUplpoads($users3->contributers_id)) {
                                                                ?>
                                                                <div style="margin-left: 50px; margin: 0 auto;">
                                                                    <p><?php echo $users3->contribution_body; ?></p>
                                                                </div>
                                                                <div>
                                                                    <br/>
                                                                    <?php
                                                                    $up_counts = 0;
                                                                    $query4 = "SELECT * FROM upload_tb u WHERE contributers_id = '$users3->contributers_id'";
                                                                    $obj4_list = DB::getInstance()->query($query4);
                                                                    foreach ($obj4_list->results() as $users4):
                                                                        $up_counts ++;
                                                                        ?>

                                                                        <a target="_blank" href="index?!=read|oekeme"><?php echo $users4->upload_name; ?></a>  <a href="<?php echo $upload_directory . $users4->upload_name; ?>" onclick="downloads(<?php echo $users4->upload_id; ?>);"><i class="icon-download-alt"></i> </a>
                                                                        <div id="msg_<?php echo $users4->upload_id; ?>"></div>

                                                                        
                                                                        

                                                                        <br/>
                                                                        <?php
                                                                    endforeach;
                                                                    ?>
                                                                    <p>  <font color="green" size="2"> <?php echo $users3->contribution_date . " " . $users3->contribution_time; ?> </font>  by <a href=""> <?php echo $users3->users_designation . " " . $users3->users_name; ?> </a></p>
                                                                    <br/>
                                                                </div>

                                                                <?php
                                                            }
                                                        endforeach;
                                                        ?>
                                                        <div>
                                                            ...
                                                            <br/>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    //}
                                                endforeach;
                                                ?>


                                            </ul>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                }
                ?>
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
    <script src="js/jquery/jquery-tablesorter.js" type="text/javascript" ></script>
    <script src="js/jquery/jquery-chosen.js" type="text/javascript" ></script>
    <script src="js/jquery/virtual-tour.js" type="text/javascript" ></script>
    <script type="text/javascript">

                                                                            $(document).ready(function () {
                                                                                $(".word").fancybox({
                                                                                    'width': 600, // or whatever
                                                                                    'height': 320,
                                                                                    'type': 'iframe'
                                                                                });
                                                                            }); //  ready 



                                                                            function downloads(upload_id) {
                                                                                //alert(upload_id);
                                                                                $.ajax({
                                                                                    type: 'POST',
                                                                                    url: 'index?!=ajax_data|9032883832839308340987er',
                                                                                    data: {add_download_file: "All", upload_id: upload_id},
                                                                                    success: function (response) {
                                                                                        //alert(response);
                                                                                        $("#msg_" + upload_id).html(response);
                                                                                        document.getElementById("label_" + upload_id).disabled = true;
                                                                                    },
                                                                                    error: function () {
                                                                                        alert('Exception!');
                                                                                    }
                                                                                })

                                                                            }

    </script>


</body>
</html>