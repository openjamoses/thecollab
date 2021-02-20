<?php
if ((empty($_SESSION['hotel_user_id'])) && (empty($_SESSION['hotel_emmergencepassword']))) {
    Redirect::to('index.php?page=' . $crypt->encode("logout"));
}
?>
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo">
            <a href="index.php?page=<?php echo $crypt->encode("dashboard") ?>">
                <span class="logo-icon fa fa-hotel fa-rotate-45"></span>
                <span class="logo-default" >LVR</span> </a>
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
            <li><a href="javascript:void(0)" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
        </ul>
        <!-- start mobile menu -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- end mobile menu -->
        <!-- start header menu -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- start notification dropdown -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge orange-bgcolor"> 6 </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">Notifications</span></h3>
                            <span class="notification-label purple-bgcolor">New 6</span>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">just now</span>
                                        <span class="details">
                                            <span class="notification-icon circle green-bgcolor"><i class="fa fa-check"></i></span> Congratulations!. </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown-menu-footer">
                                <a href="javascript:void(0)"> All notifications </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- end notification dropdown -->
                <!-- start manage user dropdown -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle " src="images/staff/<?php echo $_SESSION['hotel_profile_picture'] ?>" />
                        <span class="username username-hide-on-mobile"><?php echo $_SESSION['hotel_staff_names'] ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <?php if(!isset($_SESSION['hotel_emmergencepassword'])){?>
                        <li>
                            <a href="index.php?page=<?php echo $crypt->encode('staff_profile') . '&staff_id=' . $crypt->encode($_SESSION['hotel_staff_id']); ?>"><i class="fa fa-user"></i>Profile</a>
                        </li>
                        <li>
                            <a data-toggle="modal" href="#account_settings"><i class="fa fa-gear"></i>Account Update</a>
                        </li>
                        <?php }?>
                        <li class="divider"> </li>
                        <li>
                            <a href="index.php?page=<?php echo $crypt->encode("logout"); ?>">
                                <i class="fa fa-lock"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>


<?php
if (Input::exists() && Input::get("edit_my_account") == "edit_my_account") {
    $username = Input::get("username");
    $old_password = sha1(Input::get('old_password'));
    $new_password = sha1(Input::get('new_password'));
    $query1 = DB::getInstance()->checkRows("select * from user where  Username='$username' AND Password='$old_password'");
    if ($query1) {
        $queryUpdate = DB::getInstance()->query("update  user set Password='$new_password' where  Username='$username' AND Password='$old_password'");
        if ($queryUpdate) {
            $message = "Your account password has been changed successfully";
        } else {
            $message = "Could not update your password";
        }
    } else {
        $message = "Incorrect old password";
    }
    redirect($message, "");
}
?>
<div class="modal fade" id="account_settings" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated">
            <form action="" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">My Account Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Username</label> 
                                <input type="hidden" value="<?php echo $_SESSION['hotel_user_id']; ?>" name="user_id" class="form-control">
                                <input type="text" value="<?php echo $_SESSION['hotel_username']; ?>" name="username" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Old Password</label> 
                                <input type="password" name="old_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>New Password:</label>
                                <input type="password" name="new_password" id="new_password" pattern="[a-zA-Z0-9]{8,}" title="Password must be a minimum of 8 letters" onkeyup="emptyConfirm();" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Re-Enter password:</label>
                                <input type="password" id="confirm_password" required onkeyup="compare_password(this.value);" class="form-control" pattern="[a-zA-Z0-9]{8,}" title="Password must be a minimum of 8 letters">
                            </div>
                            <strong id="check_password" style="color: red">Passwords enetered must match</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" name="edit_my_account" id="edit_my_account_button" disabled value="edit_my_account" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function compare_password(confirm) {
        if (confirm != "") {
            var old_password = document.getElementById("new_password").value;
            if (confirm == old_password) {
                document.getElementById("edit_my_account_button").disabled = false;
                document.getElementById("check_password").style.display = "none";
            } else {
                document.getElementById("edit_my_account_button").disabled = true;
                document.getElementById("check_password").style.display = "block";
            }

        } else {
            document.getElementById("edit_my_account_button").disabled = true;
            document.getElementById("check_password").style.display = "block";
        }
    }
    function emptyConfirm() {
        document.getElementById("confirm_password").value = "";
        document.getElementById("edit_my_account_button").disabled = true;
    }
</script>