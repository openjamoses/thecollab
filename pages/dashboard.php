<?php include 'includes/libs.php'; ?>
<title><?php echo $title ?> Dashboard </title>
</head>
<body>
    <?php include 'includes/top.php'; ?>
    <div id="body-container">
        <div id="body-content">
            <?php include 'includes/nav.php'; ?>  
            <section class="page container">

                <div class="row">
                    <div class="span16">
                        <div class="box">
                            
                            <div class="box-content">
                                <div class="btn-group-box">
                                    <a href="index?!=create_collab|38837892urhfvn,opeiiuy82773772366562781876ewtfyuewgdbhjs"><button class="btn"><i class="icon-plus-sign icon-large"></i><br/>Create</button></a>
                                    <button class="btn"><i class="icon-user icon-large"></i><br/>Account</button>
                                    <button class="btn"><i class="icon-search icon-large"></i><br/>Search</button>
                                    <button class="btn"><i class="icon-list-alt icon-large"></i><br/>Reports</button>
                                    <button class="btn"><i class="icon-bar-chart icon-large"></i><br/>Charts</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="span16">
                        <div class="box pattern pattern-sandstone">
                            <div class="box-header">
                                <i class="icon-list"></i>
                                <h5>Your collaborations</h5>

                            </div>
                            <div class="box-content box-table">
                                <table id="sample-table" class="table table-hover tablesorter">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Project</th>
                                            <th>Descriptions</th>
                                            <th>Lead</th>
                                            <th>updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $user_id = $_SESSION['id'];
                                        $query = "SELECT DISTINCT contribution_details,users_designation,users_name, contribution_title,c.contribution_id,u.users_id FROM contribution_tb c, users_tb u, collab_invites i WHERE c.user = u.users_id  AND i.contribution_id=c.contribution_id AND i.users_id='$user_id' ORDER BY contribution_date,contribution_time DESC";
                                        if (DB::getInstance()->checkRows($query)) {

                                            $no = 0;
                                            $users_list = DB::getInstance()->query($query);
                                            foreach ($users_list->results() as $users):
                                                $msg = '<div class="alert alert-success">Setup collaboration detail for "' . $users->contribution_title . '".</div>';
                                                $no ++;
                                            ?>

                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td style="width: 20%">  <a href="index?!=create_collab&%=<?php echo $users->contribution_id; ?>|38837892urhfvn,opeiiuy82773772366562781876ewtfyuewgdbhjs"> <?php echo $users->contribution_title; ?> </a>
                                                    </td>
                                                    <td style="width: 40%"><?php echo $users->contribution_details; ?></td>
                                                    <td><?php echo $users->users_designation . " " . $users->users_name; ?></td>
                                                    <td></td>
                                                    <td style="width: 20%">
                                                        <a href="index?!=other_col&%=<?php echo $users->contribution_id; ?>|<?php echo $users->users_id; ?>|uewyiywuiynnncvbdyusdin jhsuisiuwiuwe9287217725265363" title="Collaborators" >(<?php echo countInvites($users->contribution_id); ?>)<i class="icon icon-group" ></i> </a>
                                                        &nbsp;&nbsp;<a href="index?!=add_ctb&%=<?php echo $users->contribution_id; ?>|<?php echo $users->users_id; ?>|uewyiywuiynnncvbdyusdin jhsuisiuwiuwe9287217725265363" title="make contribution">(<?php echo countCollaborations($users->contribution_id); ?>) <i class="icon icon-comments"></i></a>
                                                        <?php
                                                        if ($_SESSION['id'] == $users->users_id ) {
                                                            ?>
                                                            &nbsp;&nbsp; &nbsp;<a data-toggle="modal" href="index?!=edit_collab&%=<?php echo $users->contribution_id; ?>|38837892urkdkdkdkdkhfvnoeeoeopeiiuy82773772366562781876ewtfyuewgdbhjs" title="Edit the study"> <i class="icon icon-edit"></i></a>
                                                            <?php
                                                        }
                                                        ?> 
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="modal fade bs-modal-lg" id="modal_edit_collab" href="<?php echo $pupil->contribution_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="" method="POST">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title"> <i class="fa fa-comment"></i> Edit <?php $users->contribution_header; ?> Information</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Project Tittle:</label> 
                                                <input type="hidden" name="pupil_id" value="<?php echo $users->contribution_id; ?>">
                                                <input type="text" name="pupil_fname" id="std_fname" value="<?php $users->contribution_header; ?>"class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" name="pupil_lname" value="<?php echo $users->contribution_details; ?>"class="form-control" required>
                                            </div>


                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success pull-right" name="edit_pupil" value="edit_pupil">Save</button>
                                        </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>


                </div>
                <div class="row">
                    <!--<div class="span3">
                        <div class="box">
                            <div class="box-content">
        
                            </div>
                        </div>
                    </div>-->

                    <div class="span16">
                        <div class="row">
                            <div class="span8">


                                <script type="text/javascript">
                                    google.load('visualization', '1', {'packages': ['corechart']});
                                    google.setOnLoadCallback(drawVisualization);

                                    function drawVisualization() {
                                        visualization_data = new google.visualization.DataTable();

                                        visualization_data.addColumn('string', 'Task');

                                        visualization_data.addColumn('number', 'Hours per Day');


                                        visualization_data.addRow(['Work', 11]);

                                        visualization_data.addRow(['Eat', 2]);

                                        visualization_data.addRow(['Commute', 2]);

                                        visualization_data.addRow(['Watch TV', 2]);

                                        visualization_data.addRow(['Sleep', 7]);


                                        visualization = new google.visualization.PieChart(document.getElementById('piechart'));







                                        visualization.draw(visualization_data, {title: 'My Daily Activities', height: 260});


                                    }
                                </script>

                            </div>

                        </div>
                        <div class="row">
                            <div class="span8">
                                <div class="box">

                                    <div class="box-header">
                                        <i class="icon-bar-chart"></i>
                                        <h5>Charts</h5>
                                    </div>
                                    <div class="box-content">
                                        <div id="piechart"></div>
                                    </div>


                                </div>
                            </div>
                            <div class="span8">


                                <script type="text/javascript">
                                    google.load('visualization', '1', {'packages': ['corechart']});
                                    google.setOnLoadCallback(drawVisualization);

                                    function drawVisualization() {
                                        visualization_data = new google.visualization.DataTable();

                                        visualization_data.addColumn('string', 'Task');

                                        visualization_data.addColumn('number', 'Hours per Day');


                                        visualization_data.addRow(['Work', 11]);

                                        visualization_data.addRow(['Eat', 2]);

                                        visualization_data.addRow(['Commute', 2]);

                                        visualization_data.addRow(['Watch TV', 2]);

                                        visualization_data.addRow(['Sleep', 7]);
                                        visualization = new google.visualization.ColumnChart(document.getElementById('barchart'));
                                        visualization.draw(visualization_data, {title: 'My Daily Activities', height: 300});


                                    }
                                </script>
                                <div class="blockoff-left">
                                    <div id="barchart"></div>
                                </div>
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
    </script>

</body>
</html>