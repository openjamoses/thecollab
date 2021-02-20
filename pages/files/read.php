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
                
                        <div class="row">

                            <div class="span16">
                                <div class="box pattern pattern-sandstone">
                                    
                                    <div class="box-content box-list collapse in">
                                        <iframe src="https://docs.google.com/gview?url=http://collab.globalautosystems.co.ug/uploads/15585391630DemandeService.pdf&embedded=true" style="width:100%; height:600px;" frameborder="0"></iframe>
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