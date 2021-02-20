<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll">
            <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="images/staff/<?php echo $_SESSION['hotel_profile_picture'] ?>" class="img-circle user-img-circle" alt="" />
                        </div>
                        <div class="pull-left info">
                            <h5>
                                <a href=""><?php echo $_SESSION['hotel_staff_names'] ?></a>
                                <span class="profile-status online"></span>
                            </h5>
                            <p class="profile-title"><?php echo $_SESSION['hotel_role']; ?></p>
                        </div>
                    </div>
                </li>
                <li class="nav-item start active open">
                    <a href="index.php?page=<?php echo $crypt->encode("dashboard"); ?>">
                        <i class="fa fa-dashboard"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <?php if ($_SESSION['hotel_role'] == "Admin" || $_SESSION['hotel_role'] == "Super Admin") { ?>
                    <li class="nav-item  "> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-wrench"></i>
                            <span class="title">Hotel Settings</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("hotel_setting"); ?>" >About Hotel</a>
                            </li>
                            <li class="nav-item">
                                <!--<a href="index.php?page=<?php echo $crypt->encode("departments"); ?>" >Departments</a>-->
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  "> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-users"></i>
                            <span class="title">Hotel Staff</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_staff"); ?>" >Add Staff Member</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_staff"); ?>" >All Staff Members</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-user"></i>
                            <span class="title">System Users</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_user"); ?>" >Add System User</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_users"); ?>" >All Users</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-comments"></i>
                            <span class="title">Facility Management</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("bars"); ?>" >Hotel Bars</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("restaurants"); ?>" >Hotel Restaurants</a>
                            </li>
                            <li class="nav-item">
                                <!--<a href="index.php?page=<?php echo $crypt->encode("stores"); ?>" >Stores</a>-->
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("rooms"); ?>" >Rooms</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("services"); ?>" >Services</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                }
                if ($_SESSION['hotel_role'] == "Admin" || $_SESSION['hotel_role'] == "Super Admin" || $_SESSION['hotel_role'] == "Restaurant Manager") {
                    ?>
                    <li class="nav-item"> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-home "></i><span class="title">Restaurant</span><span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("dishes_served"); ?>" >Dishes served</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("customer_dish_order") ?>" >New Customer Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_customer_dish_orders") ?>" >View Customer orders</a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_restaurant_summary_sheet") ?>" >Restaurant Summary Sheet</a>
                            </li>
                        </ul>
                    </li>
                <?php }if ($_SESSION['hotel_role'] == "Admin" || $_SESSION['hotel_role'] == "Super Admin" || $_SESSION['hotel_role'] == "Store Manager") { ?>
                    <li class="nav-item"> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-folder "></i><span class="title">Store</span><span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("assets"); ?>" >Assets & Materials</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("new_purchase_order") ?>" >New Purchase Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_purchase_orders") ?>" >View Purchase Orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_cash_voucher") ?>" >Add Cash Voucher</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_cash_vouchers") ?>" >View Cash Vouchers</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_goods_received_note") ?>" >Add Goods Received Note</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_goods_received_notes") ?>" >View Goods Received Notes</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("store_stock_taking")."&store_name=".$crypt->encode("Main Store"); ?>" >Add Stock Taking</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_store_stock_taking")."&store_name=".$crypt->encode("Main Store"); ?>" >View Stock Takings</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_requisition_forms"); ?>" >View Requisition/ Issue Forms</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-home "></i><span class="title">Kitchen</span><span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("department_requisition_form")."&department=".$crypt->encode("Kitchen"); ?>" >Requisition Form</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_goods_received")."&department=".$crypt->encode("Kitchen"); ?>" >Items Received Entry</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("commodities_and_issuing"); ?>" >Items And Issuing</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_kitchen_stock_taking"); ?>" >Add stock taking</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_kitchen_stock_taking"); ?>" >View stock takings</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("apportionment"); ?>" > Meat Apportionment</a>
                            </li>
                        </ul>
                    </li>
                <?php }if ($_SESSION['hotel_role'] == "Admin" || $_SESSION['hotel_role'] == "Super Admin" || $_SESSION['hotel_role'] == "Bar Manager") { ?>
                    <li class="nav-item"> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-home "></i><span class="title">Bar</span><span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("drinks"); ?>" >Drinks served</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("department_requisition_form")."&department=".$crypt->encode("Bar"); ?>" >Requisition Form</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("drinks_stock"); ?>" >Drinks served Stock</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("bar_stock_taking") ?>" >Bar Stock Accounting</a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_bar_customer_order") ?>" >New Customer Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_bar_customer_orders") ?>" >View Customer orders</a>
                            </li>
                            <!------Reports------>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_bar_stock_accounting") ?>" >View Bar Stock accounting Sheet</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_bar_clearance") ?>" >Bar Clearance</a>
                            </li>
                        </ul>
                    </li>
                <?php }if ($_SESSION['hotel_role'] == "Admin" || $_SESSION['hotel_role'] == "Super Admin" || $_SESSION['hotel_role'] == "Receptionist") { ?>
                    <li class="nav-item"> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-recycle"></i>
                            <span class="title">Reception</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("staff_room_booking"); ?>" >Staff Room Booking</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_customer_booking"); ?>" >Register Customer Booking</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_customer_bookings"); ?>" >View Customer Bookings</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_customer"); ?>" >Register Other Customer Account</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_customers"); ?>" >View Other Customer Accounts</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_night_auditor_report") ?>">Night Auditor report</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_daily_rooming_list") ?>">Daily Rooming lIst</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("customer_service_order") ?>" >Add Other Service Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_customer_service_orders") ?>" >View Other Service orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_daily_rooming_list") ?>">View Daily Rooming List</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_night_auditor_report") ?>">View Night Auditor report</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("sales_reconciliation") ?>">Sales Reconciliation</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("add_customer_payments") ?>" >Receive Customer Payments</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_customer_payments") ?>" >View Customer Payments</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("view_tax_invoice") ?>" >View Guest Bill(Tax Invoice)</a>
                            </li>
                        </ul>
                    </li>
                <?php }if ($_SESSION['hotel_role'] == "Admin" || $_SESSION['hotel_role'] == "Super Admin") { ?>
                    <li class="nav-item"> 
                        <a href="#" class="nav-link nav-toggle">
                            <i class="fa fa-home "></i><span class="title">House Keeping</span><span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("lineane_name") ?>" >Lineane</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?page=<?php echo $crypt->encode("lineane_dispensing") ?>" >Lineane Dispensing</a>
                            </li>
                            <li class="nav-item">
                                <!--<a href="index.php?page=<?php echo $crypt->encode("lineane_stock_taking") ?>" >Lineane Stock Taking</a>-->
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="index.php?page=<?php echo $crypt->encode("logout"); ?>">
                        <i class="fa fa-power-off"></i>
                        <span class="title">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>