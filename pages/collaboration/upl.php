<?php
error_reporting(E_ALL);
include 'includes/libs.php';
?>
<title> Uploads </title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>

</head>
<body>
    <?php include 'includes/top.php'; ?>
    <div id="body-container">
        <div id="body-content">
            <section class="page container">
                <?php
                $url_data = htmlspecialchars($_GET["%"]);
                $splits = explode("|", $url_data);
                $collab_id = $splits[0];
                $obj_id = $splits[1];
                $cont_id = $splits[2];

                $collab_title = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_title", "contribution_id");
                $collab_desc = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_details", "contribution_id");
                $collab_date = DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_date", "contribution_id") . " " . DB::getInstance()->getName("contribution_tb", $collab_id, "contribution_time", "contribution_id");
                $body = DB::getInstance()->getName("study_objectives", $obj_id, "objectives_name", "study_objectives_id");
                ?>
                <div class="row">

                    <div class="span16">
                        <div class="box pattern pattern-sandstone">
                            <div class="box-header">
                                <i class="icon-tags"></i>
                                <h5><?php echo $collab_title; ?></h5>
                            </div>
                            <div class="box-content box-list collapse in">
                                <?php
                                $query2 = "SELECT * FROM study_activity sa, contributers c WHERE sa.study_activity_id = c.study_activity_id AND c.contributers_id = '$cont_id'  GROUP BY c.study_activity_id ";
                                if (DB::getInstance()->checkRows($query2)) {
                                    ?>
                                    <ul>
                                        <li>
                                            <a class="label label-info"><?php echo $body; ?></a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <?php
                                        $subCount = 0;
                                        $obj2_list = DB::getInstance()->query($query2);
                                        foreach ($obj2_list->results() as $users2):
                                            if ($users2->contributers_id == $cont_id) {
                                                $subCount ++;
                                                $query3 = "SELECT * FROM contributers c, users_tb u WHERE c.contributer_user = u.users_id AND c.study_activity_id = '$users2->study_activity_id'";
                                                ?>
                                                <li>
                                                    <a  href=""class="label label-inverse"><i class="icon-hand-up"></i>    <strong><?php echo $users2->study_activity_name; ?></strong></a>

                                                    <p class="label label-info"></p>
                                                    <?php
                                                    $obj3_list = DB::getInstance()->query($query3);
                                                    foreach ($obj3_list->results() as $users3):
                                                        ?>
                                                        <div style="margin-left: 50px; margin: 0 auto;">
                                                            <p><?php echo $users3->contribution_body; ?></p>
                                                            <a class="word" href="https//docs.google.com/gview?url=http://collab.globalautosystems.co.ug/uploads/15585391630DemandeService.pdf&embedded=true">Open a Word document in Fancybox</a>
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

                                                                <?php echo $users4->upload_name; ?>  <a href="<?php echo $upload_directory.$users4->upload_name; ?>" onclick="downloads(<?php echo $users4->upload_id; ?>);"><i class="icon-download-alt"></i> downloads </a>
                                                                <div id="msg_<?php echo $users4->upload_id; ?>"></div>
                                                                
                                                                <iframe src="https://docs.google.com/gview?url=<?php echo $server_url.$upload_directory . $user4->upload_name; ?>&embedded=true" width="100%" height="100px"></iframe>
                                                                
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                            <p>  <font color="green" size="2"> <?php echo $users3->contribution_date . " " . $users3->contribution_time; ?> </font>  by <a href=""> <?php echo $users3->users_designation . " " . $users3->users_name; ?> </a></p>
                                                            <br/>
                                                        </div>

                                                        <?php
                                                    endforeach;
                                                    ?>
                                                    <div>
                                                        ...
                                                        <br/>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        endforeach;
                                        ?>


                                    </ul>
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