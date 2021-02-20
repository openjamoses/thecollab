
<!-- /navbar -->
<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li><a href="index?!=dashboard|<?php echo $_SESSION['staff_no'] ?>ii83837929n22n2b2782ey27ey2hj228hjshhwhw"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
                <li><a  href="index?!=subjects|<?php echo $_SESSION['staff_no'] ?>092shshs898298837hsbjjsjhuyyue"><i class="icon-book"></i><span>Subjects</span> </a> </li>
                <li><a  href="index?!=class|<?php echo $_SESSION['staff_no'] ?>0846636bnjfjjjkjsjjiiiishsshgsgm"><i class="icon-building"></i><span>Classes</span> </a> </li>
                
                <li><a href="index?!=staffs|<?php echo $_SESSION['staff_no'] ?>99738947638736377638733873391"><i class="icon-list-alt"></i><span>Staffs</span> </a> </li>

                <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><span> <?php echo $student; ?>s</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $sqlQuery = "SELECT * FROM class_tb";

                        if (DB::getInstance()->checkRows($sqlQuery)) {
                            $users_list = DB::getInstance()->query($sqlQuery);
                            foreach ($users_list->results() as $users):
                                ?>
                                <li><a href="index?!=students&~=<?php echo $users->class_id; ?>|<?php echo $_SESSION['staff_no'] ?>"><?php echo $users->class_desc; ?></a></li>
                                <?php
                            endforeach;
                        }
                        ?>
                    </ul>
                </li>

                <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-tags"></i><span>Enrollment</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $sqlQuery = "SELECT * FROM class_tb";

                        if (DB::getInstance()->checkRows($sqlQuery)) {
                            $users_list = DB::getInstance()->query($sqlQuery);
                            foreach ($users_list->results() as $users):
                                ?>
                                <li><a href="index?!=enr&~=<?php echo $users->class_id; ?>|<?php echo $_SESSION['staff_no'] ?>93938733723799p312812ghsghje89281bbahhgwhqg"><?php echo $users->class_desc; ?></a></li>
                                <?php
                            endforeach;
                        }
                        ?>
                    </ul>
                </li>
                
                 <li class="dropdown active"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-copy"></i><span>Mark sheet</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $sqlQuery = "SELECT * FROM class_tb";

                        if (DB::getInstance()->checkRows($sqlQuery)) {
                            $users_list = DB::getInstance()->query($sqlQuery);
                            foreach ($users_list->results() as $users):
                                ?>
                        <li><a href="index?!=marksheet&~=<?php echo $users->class_id; ?>|<?php echo $_SESSION['staff_no'] ?>"> <i class="fa fa-check-circle"></i> <?php echo "  ".$users->class_name." Mark Sheet"; ?></a></li>
                                <?php
                            endforeach;
                        }
                        ?>
                    </ul>
                </li>
                
                
                <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-signal"></i><span>Reports</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $sqlQuery = "SELECT * FROM class_tb";

                        if (DB::getInstance()->checkRows($sqlQuery)) {
                            $users_list = DB::getInstance()->query($sqlQuery);
                            foreach ($users_list->results() as $users):
                                ?>
                        <li><a href="index?!=rpts&~=<?php echo $users->class_id; ?>|<?php echo $_SESSION['staff_no'] ?>"> <i class="fa fa-check-circle"></i> <?php echo "  ".$users->class_name." Report"; ?></a></li>
                                <?php
                            endforeach;
                        }
                        ?>
                    </ul>
                </li>
                <?php if ($_SESSION['role'] == 'Admin') { ?>
                 <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-reorder"></i><span>Promotion</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $sqlQuery = "SELECT * FROM class_tb";

                        if (DB::getInstance()->checkRows($sqlQuery)) {
                            $users_list = DB::getInstance()->query($sqlQuery);
                            foreach ($users_list->results() as $users):
                                ?>
                                <li><a href="index?!=pro_&~=<?php echo $users->class_id; ?>|<?php echo $_SESSION['staff_no'] ?>93938733723799p312812ghsghje89281bbahhgwhqg"><?php echo $users->class_desc; ?></a></li>
                                <?php
                            endforeach;
                        }
                        ?>
                    </ul>
                </li>
                <?php } ?>
                
                 <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Setups</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="index?!=gs|<?php echo $_SESSION['staff_no'] ?>hjweui83291202hfbhsdjgdjhbsbsbbsanashw722626278">Grading scale</a></li>
                        <li><a href="index?!=exm_|<?php echo $_SESSION['staff_no'] ?>hjweui832nnddndnfnnfw938491202hfmfffmme,mbhsdjgdjhbsbsbbsanashw722626278">Exam setup</a></li>
                        
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /container --> 
    </div>
    <!-- /subnavbar-inner --> 
</div>



