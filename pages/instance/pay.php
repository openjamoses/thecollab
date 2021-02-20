<?php
include 'includes/libs.php';
error_reporting(0);
?>

<title><?php echo $title ?> Register </title>
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


                     <?php
                                    $url_data = htmlspecialchars($_GET["~"]);
                                    $splits = explode("|", $url_data);
                                    $bill_id = $splits[0];
                                    $bill_name = DB::getInstance()->getName("billing", $bill_id, "billing_name", "billing_id");
                                    $bill_amount = DB::getInstance()->getName("billing", $bill_id, "billing_amount", "billing_id");
                                    $message =  'Please provide your Credit card Details in the form bellow, to make the payments for ' . $bill_name . ' at a cost of ' . number_format($bill_amount) . ' USD ';
                                    ?>

                    <div class="span8">
                        <div class="blockoff-left">
                            <p> <?php echo $message; ?> </p>
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
                        <div class="span8">
                            <div class="box">
                                <div class="box-header">
                                    <i class="icon-shopping-cart"></i>
                                   Please provide your credit card details to complete your subscription.!
                                </div>
                                <div class="box-content">


                                    <div class="input-prepend form-control">

                                        <input class="span4" name="cardNumber" type="text" placeholder="Enter Card Number" required="">
                                    </div>
                                    <div class="input-prepend form-control">

                                        <input class="span4" name="CVC" type="text" placeholder="Enter CVC" required="">
                                    </div>



                                    <div class="input-prepend form-control">

                                        <input class="span4" name="expiration" type="text" placeholder="Enter Expiration (MM/YYYY)" required="">
                                    </div>
                                    

                                    <div class="input-prepend form-control">

                                        <input class="span4" name="exp_year" type="text" placeholder="Enter Expiry year" required="">
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <button type="submit" name="submitRI" value="submitRI" class="btn btn-primary">
                                        <i class="icon-shopping-cart"></i>
                                        Submit payments
                                    </button>
                                </div>
                            </div>
                        </div>

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