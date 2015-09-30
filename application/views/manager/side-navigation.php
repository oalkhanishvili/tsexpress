 <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> საერთო</a>
                    </li>
                    <li>
                        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li <?php if (stripos($_SERVER['REQUEST_URI'],'manager/amanatebi') !== false) {echo 'class="active"';} ?>>
                        <a href="<?php echo site_url('manager/amanatebi'); ?>"><i class="fa fa-fw fa-table"></i> ამანათები</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-arrows-v"></i> ბანერები <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo1" class="collapse">
                            <li>
                                <a href="<?php echo site_url('manager/slider'); ?>"><i class="glyphicon glyphicon-picture"></i> სლაიდერი</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('manager/slider'); ?>"><i class="glyphicon glyphicon-picture"></i> ბანერები</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (stripos($_SERVER['REQUEST_URI'],'manager/users_list') !== false) {echo 'class="active"';} ?>>
                        <a href="<?php echo site_url('manager/users_list');?>"><i class="fa fa-fw fa-user"></i> მომხმარებლები</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> გვერდები <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="<?php echo site_url('manager/top_page'); ?>"><i class="fa fa-fw fa-file"></i> ზედა გვერდები</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('manager/left_navigation'); ?>"><i class="fa fa-fw fa-file"></i> გვერდითა ნავიგაცია</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank-page.html"><i class="fa fa-fw fa-credit-card"></i> ტრანზაქციები</a>
                    </li>
                    <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>