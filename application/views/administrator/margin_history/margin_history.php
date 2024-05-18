<!-- begin #content -->
		<div id="content" class="content">
			<?php 
		$error = $this->session->flashdata('error');
		if($error != '') {
			echo '<div class="alert alert-danger">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&#10005;</button>'.$error.'</div>';
		}
		$success = $this->session->flashdata('success');
		if($success != '') {
			echo '<div class="alert alert-success">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&#10005;</button>'.$success.'</div>';
		} 
		?>
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="<?php echo admin_url();?>">Home</a></li>
				<li class="active"><?php echo ucfirst($view); ?> History</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><?php echo ucfirst($view); ?> History <!--<small>header small text goes here...</small>--></h1>
			<p class="text-right m-b-10">
								<!--<a href="<?php echo admin_url().'pair/add';?>" class="btn btn-primary">Add New</a>-->
							</p>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
				<div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <!--<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>-->
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title"><?php echo ucfirst($view); ?> History</h4>
                        </div>
                        <div class="panel-body">
                        <div class="clearfix">
                       	<div class="input-group inp_grp1">
                        <input type="text" name="search_string" id="search_string" class="form-control" placeholder="Search" value="<?php if(isset($_GET['search_string']) && !empty($_GET['search_string'])){ echo $_GET['search_string']; } else{ echo ''; } ?>" />
                        <span class="input-group-addon">
						<button class="btn btn-small btn-success" onclick="search()" style='margin-left:20px;'><div class="fa fa-refresh"></div></button> 
						</span>
						</div>
						</div>
						<br/><br/>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Date & Time</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Currency</th>
                                        <th class="text-center">Amount</th>
                                        <?php if($view=='margin') { ?>
                                        <th class="text-center">Price</th>
                                        <?php } ?>
										<th class="text-center">Fee</th>
										<th class="text-center">Range</th>
										<th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
									<?php
								if ($trade_history->num_rows() > 0) {
									if($this->uri->segment(4)!=''){ $i = $this->uri->segment(4)+1; }else { $i = 1; }
									foreach($trade_history->result() as $result) {
										//$from_currency_symbol = getcryptocurrency($result->from_currency_id);
										echo '<tr>';
										echo '<td>' . $i . '</td>';
										echo '<td>' . $result->created_date . '</td>';
										echo '<td>' . $result->username . '</td>';
										echo '<td>' . $result->currency_symbol. '</td>';
										echo '<td>' . $result->swap_amount . '</td>';
										if($view=='margin') {
											echo '<td>' . $result->Price . '</td>';
										}
										echo '<td>' . $result->rate . '</td>';
										echo '<td>' . $result->range . ' Days</td>';
										echo '<td>' . ucfirst($result->swap_status) . '</td>';
										echo '</tr>';
										$i++;
									}					
								}
								else {
									echo '<tr>';
									echo '<td colspan="9">' . 'No Records Found!!' . '</td>';
									echo '</tr>';
								} 
								?>
                                    </tbody>
                                </table>
                                <?php if(isset($_GET['search_string']) && !empty($_GET['search_string'])){ }else { ?>
                                <ul class="pagination">
                                <?php echo $this->pagination->create_links(); ?>
                                </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo admin_source();?>/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/ckeditor/ckeditor.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo admin_source();?>/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo admin_source();?>/crossbrowserjs/respond.min.js"></script>
		<script src="<?php echo admin_source();?>/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo admin_source();?>/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo admin_source();?>/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="<?php echo admin_source();?>/plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/DataTables/js/jquery.dataTables.js"></script>
	<script src="<?php echo admin_source();?>/js/jquery.validate.min.js"></script>
	<script src="<?php echo admin_source();?>/js/apps.min.js"></script>
	
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
	var typos='<?php echo $view; ?>';
		$(document).ready(function() {
			App.init();
		});

		function search() {//alert();
    		var search = $('#search_string').val();
    		var url = '<?php echo admin_url(); ?>';
    		if(search!=''){
    		window.location.href=url+'margin_history/'+typos+'/?search_string='+search; }
    		else { window.location.href=url+'margin_history/'+typos; }
		}
	</script>
	<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','<?php echo admin_source()."www.google-analytics.com/analytics.js";?>','ga');
      ga('create', 'UA-53034621-1', 'auto');
      ga('send', 'pageview');
    </script>