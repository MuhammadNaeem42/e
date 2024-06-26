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
				<li class="active">Crypto Withdraw</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Crypto Withdraw Management <!--<small>header small text goes here...</small>--></h1>
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
                            <h4 class="panel-title">Crypto Withdraw Management</h4>
                        </div>
					<?php if($view=='view_all'){ ?>
                        <div class="panel-body">
						<br/>
                            <div class="table-responsive">
                                <table id="datas-table" class="table table-striped table-bordered" id="cwithdraw">
                                    <thead>
                                        <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">User Email</th>
										<th class="text-center">Date & Time</th>
										<th class="text-center">Currency</th>
										<th class="text-center">Amount</th>
										<th class="text-center">Status</th>
										<th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
									<?php
								/*if ($deposit->num_rows() > 0) {
								$i = 1; 
									foreach($deposit->result() as $result) {
                                        $user = getUserDetails($result->user_id);
										if($user->usertype==1)
                                        {
                                            $usertype ="Personal";
                                            $username = 'jab_username';
                                        }
                                        else 
                                        {
                                            $usertype ="Company";
                                            $username = 'company_name';
                                        }
                                        $username = 'jab_username';
										echo '<tr>';
										echo '<td>' . $i . '</td>';
										echo '<td>' . $user->$username . '</td>';
										echo '<td>' . gmdate("d-m-Y h:i:s", $result->datetime) . '</td>';
										echo '<td>' . $result->currency_symbol . '</td>';
										echo '<td>' . $result->amount . '</td>';
										echo '<td>' . $result->status . '</td>';
										echo '<td>';
										echo '<a href="' . admin_url() . 'withdraw/crypto_view/' . $result->trans_id . '" title="Edit this Crypto Withdraw"><i class="fa fa-eye text-primary"></i></a>&nbsp;&nbsp;&nbsp;';
										echo '</td>';

										echo '</tr>';
										$i++;
									}					
								} */
								?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
					<?php }else{ ?>
					<div class="panel-body">
						<?php $attributes=array('class'=>'form-horizontal','id'=>'deposit');
				echo form_open_multipart($action,$attributes);
										
				?>
                                <fieldset>
                                  
								<div class="form-group">
                                <label class="col-md-2 control-label">User Email</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo getUserEmail($deposit->user_id); ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Currency</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $deposit->currency_symbol; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Transaction Id</label>
                                <div class="col-md-8 control-label text-left">
								<?php if($deposit->wallet_txid!='') { echo $deposit->wallet_txid; } else { echo '------'; } ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Amount</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $deposit->amount; ?>
                                </div>
                                </div>
                            	<div class="form-group">
                                <label class="col-md-2 control-label">To address</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $deposit->crypto_address; ?>
                                </div>
                            	</div>
         
                                <div class="form-group">
                                <label class="col-md-2 control-label">Withdrawed On</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo gmdate("d-m-Y h:i:s", strtotime($deposit->datetime)); ?>
                                </div>
                            	</div>
                                </fieldset>
                            </form>
                        </div>
					<?php } ?> 
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
	
	<script src="<?php echo admin_source();?>/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo admin_source();?>/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="<?php echo admin_source();?>/plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="<?php echo admin_source();?>/plugins/DataTables/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo admin_source();?>/plugins/DataTables/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo admin_source();?>/js/jquery.validate.min.js"></script>
	<script src="<?php echo admin_source();?>/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
	$(document).ready(function() {
		
		$('#cms').validate({
			rules: {
				heading: {
					required: true
				},
				title: {
					required: true
				},
				meta_keywords: {
					required: true,
				},
				meta_description: {
					required: true
				},
				content_description: {
					required: true,
				}
				
			},
			highlight: function (element) {
				//$(element).parent().addClass('error')
			},
			unhighlight: function (element) {
				$(element).parent().removeClass('error')
			}
		});
	});
</script> 
	<script>
		$(document).ready(function() {
			App.init();
		});
		$(document).ready(function() {
         $.fn.dataTableExt.sErrMode = 'throw';
         $('#cwithdraw').DataTable();
        } );

        var admin_url='<?php echo admin_url(); ?>';
		
$(document).ready(function() {
    $('#datas-table').DataTable( {
    	"responsive" : true,
        "processing" : true,
        "pageLength" : 10,
        "serverSide": true,
        "order": [[0, "asc" ]],
        "searching": true,
        "ajax": admin_url+"withdraw/cryptowithdraw_ajax"
    });
        });

	
	</script>
	 <script async
src="https://www.googletagmanager.com/gtag/js?id=G-FDX8TJF8SG"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-FDX8TJF8SG');
</script>