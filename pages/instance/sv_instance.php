<?php
include 'includes/libs.php';
error_reporting(0);
?>

<title><?php echo $title ?> Payments </title>
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
                    
                    <div id="app-nav-top-bar" class="nav-collapse">
                        <ul class="nav">
                            
                            
                        </ul>
                        <ul class="nav pull-right">
                           
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <div id="body-container">
        <div id="body-content">
            <div class="body-nav body-nav-vertical body-nav-fixed">
                <div class="container">
                    <ul>

                        <li>


                            <a href="index?!=wel|uewyiywuiynnncvbdyusdin jhsuisiuwiuwe9287217725265363">
                                <i class="icon-dashboard icon-large"></i> Home
                            </a>
                            
                        </li>

                    </ul>
                </div>
            </div> 
            <section class="page container">
                <div class="row">



                    <div class="span8">
                        <div class="blockoff-left">
                            <p> Please choose your Billing rates from the Options bellow..! </p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php
                    if (Input::exists() && Input::get("submitRI")) {
                        $name = Input::get("name");
                        $country = Input::get("country");
                        $description = Input::get("description");

                        $photo = ($_FILES['photo']['name']);
                        $tmp_name = $_FILES["photo"]["tmp_name"];

                        $photo_name_array = explode(".", $photo);
                        $destination = $name . '_' . date('Ymdh') . '.' . end($photo_name_array);

                        $target_dir = "images/institution/";
                        $target_file = $target_dir . basename($destination);


                        $queryDup = "SELECT * FROM institution_tb WHERE institution_name='$name'";
                        if (DB::getInstance()->checkRows($queryDup)) {
                            echo '<div class="alert alert-warning">Research Institution already Registered</div>';
                        } else {

                            $insertQuery = DB::getInstance()->insert("institution_tb", array(
                                'institution_name' => $name,
                                'institution_country' => $country,
                                'institution_details' => $description,
                                'institution_logo' => $destination
                            ));
                            if ($insertQuery) {
                                echo'<div class="alert alert-success">Research Institution registered successfully</div>';
                            }
                        }
                        // Redirect::go_to('index.php?page=add_staff');
                    }
                    ?>

                    <form  action="#" method="POST" class="form-inline">

                        <?php
                        $query = "SELECT * FROM billing_rate br, billing b WHERE br.billing_id = b.billing_id GROUP BY br.billing_id ";
                        if (DB::getInstance()->checkRows($query)) {
                            $users_list = DB::getInstance()->query($query);
                            foreach ($users_list->results() as $users):
                                ?>
                                <div class="span5">
                                    <div class="box pattern pattern-sandstone">
                                        <div class="box-header">
                                            <i class="icon-table"></i>
                                            <h5>
                                                <?php echo $users->billing_name." ( $".number_format($users->billing_amount)." )"; ?>
                                            </h5>
                                        </div>
                                        <div class="box-content box-table">
                                            <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                                <thead>
                                                    <tr>
                                                        <th>Service Available</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $query2 = "SELECT * FROM billing_rate WHERE billing_id = '$users->billing_id'";
                                                    $users_list2 = DB::getInstance()->query($query2);
                                                    foreach ($users_list2->results() as $users2):
                                                        ?>
                                                        <tr>
                                                            <td> 
                                                                <a href="#" class="btn btn-small btn-default">
                                                                    <i class="btn-icon-only icon-ok"></i>
                                                                </a>
 <?php echo $users2->billing_particular; ?></td>

                                                            
                                                        </tr>
                                                    <?php endforeach;
                                                    ?>

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>
                                                            
                                                            <a  href="index?!=pay&~=<?php echo $users->billing_id; ?>" name="submitDetails" value="submitDetails" class="btn btn-primary">
                                        
                                        <i class="icon-shopping-cart"></i> Choose and Continue <i class="icon-chevron-right"></i>
                                    </a> 
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                <?php
                            endforeach;
                        }
                        ?>




                    </form>


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