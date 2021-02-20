<!DOCTYPE html>
<?php include 'includes/libs.php'; ?>
<?php //include 'functions/functions.php'; 
?>
<title><?php echo $title ?> Admin Dashboard </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="brand"><i class="icon-leaf">Welcome <?php echo DB::getInstance()->getName("admin_tb", $_SESSION['id'], "admin_name", "admin_id") ?></i></a>
                <div id="app-nav-top-bar" class="nav-collapse">
                    <ul class="nav">




                    </ul>

                </div>
            </div>
        </div>
    </div>

    <div id="body-container">
        <div id="body-content">

            <div class="body-nav body-nav-horizontal body-nav-fixed">
                <div class="container">
                    <ul>
                        <li>
                            <a href="#">
                                <i class="icon-dashboard icon-large"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-calendar icon-large"></i> Schedule
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="icon-tasks icon-large"></i> Collab-lists
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-cogs icon-large"></i> Settings
                            </a>
                        </li>

                        <li>
                            <a href="index?!=logout|4525jsgsgysbbshjhs5626626216753563">
                                <i class="icon-lock icon-large"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <section class="nav nav-page">
                <div class="container">
                    <div class="row">
                        <div class="span7">
                            <header class="page-header">
                                <h3>Admin Dashboard<br/>
                                    <small>Monitor the collaboration platform</small>
                                </h3>
                            </header>
                        </div>

                    </div>
                </div>
            </section>
            <section class="page container">
                <?php
                $jsonData = array();
                $column = array();
                $userData = array();
                /** (
                  array("Pending", 20.42),
                  array("InProgress", 14.66),
                  array("OnHold", 2.09),
                  array("Complete", 62.30),
                  array("Deferred", 0.00),
                  array("Cancelled", 0.52),
                  );* */
                ?>

                <div class="row">
                    <div class="span14">
                        <div id="piechart"></div>

                    </div>
                    <div class="span14">
                        <div class="box">

                            <div class="box pattern pattern-sandstone">
                                <div class="box-header">
                                    <i class="icon-table"></i>
                                    <h5>
                                        The collaboration
                                    </h5>
                                </div>
                                <div class="box-content box-table">
                                    <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                        <thead>
                                            <tr>
                                                <th>Study</th>
                                                <th>Users</th>
                                                <th>Contributions</th>
                                                <th class="td-actions"> Last update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM contribution_tb";
                                            if (DB::getInstance()->checkRows($query)) {

                                                $users_list = DB::getInstance()->query($query);
                                                foreach ($users_list->results() as $users):
                                                    $data = array($users->contribution_title, countCollaborations($users->contribution_id));
                                                $data2 = array($users->contribution_title, countInvites($users->contribution_id));
                                                    array_push($jsonData, $data);
                                                    array_push($userData, $data2);
                                                    array_push($column, $users->contribution_title);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $users->contribution_title ?></td>
                                                        <td><?php echo countInvites($users->contribution_id); ?></td>
                                                        <td><?php echo countCollaborations($users->contribution_id); ?></td>
                                                        <td class="td-actions">
                                                            <?php echo getLastUpdate($users->contribution_id); ?>
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
                    </div>
                </div>
                <div class="span14">
                    <div class="box pattern pattern-sandstone">
                        <div class="box-header">
                            <i class="icon-list"></i>
                            <h5>Lists of events for today</h5>
                            <button class="btn btn-box-right" data-toggle="collapse" data-target=".box-list">
                                <i class="icon-reorder"></i>
                            </button>
                        </div>
                        <div class="box-content box-list collapse in">
                            <ul>
                                <?php
                                $query = "SELECT * FROM event_tb e, login_stats l, users_tb u WHERE u.users_id = l.users_id AND l.login_stats_id = e.login_stats_id AND l.login_date = '" . $date_today . "'  ORDER BY event_time DESC";
                                if (DB::getInstance()->checkRows($query)) {

                                    $users_list = DB::getInstance()->query($query);
                                    foreach ($users_list->results() as $users):
                                        ?>
                                        <li>
                                            <div>
                                                <a href="#" class="news-item-title"><?php echo $users->users_name ?></a>
                                                <p class="news-item-preview"><?php echo $users->events_body ?> <a href="#"><?php echo $users->event_time ?></a></p>
                                            </div>
                                        </li>
                                        <?php
                                    endforeach;
                                }
                                ?>

                            </ul>

                        </div>

                    </div>
                </div>

                <div class="span14">
                    <div id="barchart"></div>
                </div>
                <div class="span14">
                    <div class="box">
                        <div class="box-header">
                            <i class="icon-folder-open"></i>
                            <h5>Collaboration details</h5>
                        </div>
                        <div class="box-content">
                            <?php
                            $query = "SELECT * FROM contribution_tb";
                            if (DB::getInstance()->checkRows($query)) {

                                $users_list = DB::getInstance()->query($query);
                                foreach ($users_list->results() as $users):
                                    ?>
                                    <p>
                                        <?php echo $users->contribution_title ?><br/>
                                        <a href="#"><?php echo $users->contribution_details ?></a>
                                    </p>
                                    <?php
                                endforeach;
                            }
                            ?>

                        </div>
                    </div>
                </div>
        </div>


        <div class="row">
            <!--<div class="span3">
                <div class="box">
                    <div class="box-content">

                    </div>
                </div>
            </div>-->

            <script type="text/javascript">
                jQuery(document).ready(function () {

                    pieChart();
                    barChart();
                    function pieChart() {
                        $('#piechart').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: 0, //null,
                                plotShadow: false
                            },
                            title: {
                                text: 'The collaboration'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                        style: {
                                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                        }
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                    type: 'pie',
                                    name: 'Browser share',
                                    data: <?php echo json_encode($jsonData); ?>
                                }]
                        });
                    }

                    function barChart() {
                        $('#barchart').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: 0, //null,
                                plotShadow: false
                            },
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: 0, //null,
                                plotShadow: false
                            },
                            title: {
                                text: 'Users'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                        style: {
                                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                        }
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                    type: 'column',
                                    name: 'Browser share',
                                    data: <?php echo json_encode($userData); ?>
                                }]

                        });
                    }

                });
            </script>


        </div>



    </section>



</div>
</div>

<div id="spinner" class="spinner" style="display:none;">
    Loading&hellip;
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

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
                $(function () {
                    $('#sample-table').tablesorter();
                    $('#datepicker').datepicker();
                    $(".chosen").chosen();
                });
</script>

</body>
</html>