<?php include(app_path().'/common/admin/header.php'); ?>

            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Welcome back, <?php if($admin->first_name!='') echo $admin->first_name.' '.$admin->last_name; else echo $admin->username; ?></h3>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">Last 7 days regsitrations</h6>
                                <div class="dropdown no-arrow d-none"><button class="btn btn-link btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area"><canvas data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;<?php echo $chart_data['day1']; ?>&quot;,&quot;<?php echo $chart_data['day2']; ?>&quot;,&quot;<?php echo $chart_data['day3']; ?>&quot;,&quot;<?php echo $chart_data['day4']; ?>&quot;,&quot;<?php echo $chart_data['day5']; ?>&quot;,&quot;<?php echo $chart_data['day6']; ?>&quot;,&quot;<?php echo $chart_data['day7']; ?>&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Signups&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;<?php echo $chart_data['day1_d']; ?>&quot;,&quot;<?php echo $chart_data['day2_d']; ?>&quot;,&quot;<?php echo $chart_data['day3_d']; ?>&quot;,&quot;<?php echo $chart_data['day4_d']; ?>&quot;,&quot;<?php echo $chart_data['day5_d']; ?>&quot;,&quot;<?php echo $chart_data['day6_d']; ?>&quot;,&quot;<?php echo $chart_data['day7_d']; ?>&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}]}}}"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4"></div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold m-0">Most Recent Registrations</h6>
                            </div>
                            <ul class="list-group list-group-flush">
                                <?php 
                                if(!empty($recent_users)) {
                                    foreach($recent_users as $user) {
                                ?>
                                <li class="list-group-item">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <h6 class="mb-0"><strong><?php echo $user->first_name.' '.$user->last_name; ?></strong></h6><span class="text-xs"><?php echo date_format(new DateTime($user->on_date), 'd-m-Y H:i'); ?></span></div>
                                        <div class="col-auto">
                                            <div class="custom-control custom-checkbox"><a href="<?php echo url('admin/edit-user/'.$user->id); ?>"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a></div>
                                        </div>
                                    </div>
                                </li>
                                <?php } } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col"></div>
                </div>
            </div>
        </div>
        
<?php include(app_path().'/common/admin/footer.php'); ?>