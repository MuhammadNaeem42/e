<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css"> -->
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
				<li class="active">Deposit</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Fiat Deposit Management <!--<small>header small text goes here...</small>--></h1>
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
                            <h4 class="panel-title">Fiat Deposit Management</h4>
                        </div>

					<?php if($view=='view_all'){ ?>
                        <div class="panel-body">
                        <div class="clearfix">
                       	
						</div>
						 
                            <div class="table-responsive">
                                <table id="datas-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Email</th>
										<!-- <th class="text-center">Transaction Id</th> -->
                                        <th class="text-center">Description</th>
										<th class="text-center">Date & Time</th>
										<th class="text-center">Currency</th>
										<th class="text-center">Amount</th> 
										<th class="text-center">Total Amount</th>
										<th class="text-center">Status</th>
										<th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
									
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
					<?php } else if($view == 'add')
					{
						?>
						<div class="panel-body">
						<?php $attributes=array('class'=>'form-horizontal','id'=>'add_deposit');
						echo form_open_multipart($action,$attributes); ?>
                             <fieldset>
                                    <!--<legend>Change Password</legend>-->

                                     
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Username</label>
                                        <div class="col-md-4">
                                        <div>
										<select data-placeholder="User Name..." class="chosen-select" multiple style="width:350px; height: 200px;" tabindex="4" id="user_id" name="user_id">
											<option value="">Select</option>
											<?php foreach($users as $user_details){ ?>
											<option value="<?php echo $user_details->id;?>"><?php echo $user_details->jab_username;?></option>
											<?php } ?>
											</select>
											</div>
                                        </div>
                                    </div>
		                                
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Transaction Id</label>
                                        <div class="col-md-4">
										<input type="text" name="trans_id" id="trans_id" class="form-control" placeholder="Transaction ID" />
                                        </div>
                                    </div>
		                                    

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Description</label>
                                        <div class="col-md-4">
										<input type="text" name="description" id="description" class="form-control" placeholder="Description" />
                                        </div>
                                    </div>
                                     
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Amount</label>
                                        <div class="col-md-4">
										<input type="text" name="amount" id="amount" class="form-control" placeholder="Amount"  />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
                                        </div>
                                    </div>
                                </fieldset>    
                            </form>
                        </div>
						<?php 
					}
					else{ ?>
					<div class="panel-body">
						<?php $attributes=array('class'=>'form-horizontal','id'=>'deposit');
				echo form_open_multipart($action,$attributes);
				//$country = get_countryname($admin_bankdetails->bank_country);
				    
                $country = get_countryname($user_bankdetails->bank_country);


				if($deposit->transaction_id == '')
	            {
	              $transaction_id = '-';
	            }
	            else
	            {
	            	$transaction_id = $deposit->transaction_id;
	            }
	            if($deposit->bank_id!=0)
	            {
	              $account_no = get_user_bank_details($deposit->bank_id,$deposit->user_id);
                  // print_r($account_no);
	              $account_no1 = $account_no->bank_account_number;
	              if($account_no1 == '')
	              {
	                $account_no1 = '-';
	                $bank_swift = '-';
	              	$bank_account_name = '-';
	              	$bank_name = '-';
	              	$bank_address = '-';
	              	$bank_postalcode = '-';
	              	$bank_city = '-';
	              	$country_name = '-';
	              }
	              else
	              {
	              	$bank_swift = $account_no->bank_swift;
	              	$bank_account_name = $account_no->bank_account_name;
	              	$bank_name = $account_no->bank_name;
	              	$bank_address = $account_no->bank_address;
	              	$bank_postalcode = $account_no->bank_postalcode;
	              	$bank_city = $account_no->bank_city;
	              	$country_name = $country->country_name;
	              }  
	            }
	            else
	            {
	              $account_no1 = '-';
	              $bank_swift = '-';
	              $bank_account_name = '-';
	              $bank_name = '-';
	              $bank_address = '-';
	              $bank_postalcode = '-';
	              $bank_city = '-';
	              $country_name = '-';
	            }		

	             
				?>
                                <fieldset>
                                  
								<div class="form-group">
                                <label class="col-md-2 control-label">Username</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo getUserDetails($deposit->user_id,'jab_fname'); ?>
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
								<?php echo $transaction_id; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Requested Amount</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo number_format($deposit->amount,2); ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Fees</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo number_format($deposit->fee,2); ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Transfer Amount</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo number_format($deposit->transfer_amount,2); ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo ($deposit->description!='')?$deposit->description:'-'; ?>
                                </div>
                            	</div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Deposited On</label>
                                <div class="col-md-8 control-label text-left">
								<?php  echo date('d-M-Y H:i',$deposit->datetime);?>
                                </div>
                            	</div>

                                <div class="form-group">
                                <label class="col-md-2 control-label">Pay Via</label>
                                <div class="col-md-8 control-label text-left">
                                <?php echo ucfirst($deposit->payment_method); ?>
                                </div>
                                </div>

                            	<div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $deposit->status; ?>
                                </div>
                            	</div>

                                <h4 style="text-align: center"> Bank Details </h4>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Bank Account Number</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $user_bankdetails->bank_account_number; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Bank Swift</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $user_bankdetails->bank_swift; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Bank Account Name</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $user_bankdetails->bank_account_name; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Bank Name</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $user_bankdetails->bank_name; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Bank Address</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $user_bankdetails->bank_address; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Bank Postal code</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $user_bankdetails->bank_postalcode; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Bank City</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $user_bankdetails->bank_city; ?>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-2 control-label">Bank Country</label>
                                <div class="col-md-8 control-label text-left">
								<?php echo $country; ?> 
                                </div>
                                </div>

                                <?php if($deposit->status=='Pending'){ 
                                	$url = admin_url().'deposit/status/'.$deposit->trans_id.'/Completed';
                                 ?>
                                <a class="btn btn-small btn-success" href="<?php echo $url; ?>"   style='margin-left:20px;'>Complete</a>
                                <a class="btn btn-small btn-danger" href="#myModal"  data-toggle="modal" style='margin-left:20px;'>Reject</a>
                                <?php } ?>
                                </fieldset>
                            </form>
                        </div>
					<?php }

					



					 ?> 
                    </div>
                    <!-- end panel -->
                </div>
			</div>
			<!-- end row -->

	<div id="myModal" class="modal fade adm_pop">
	<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
          <h4>Reason to reject</h4>
        </div>
        <div class="modal-body">
            <div class="paddingT15 paddingB15"> 
             <center><?php echo form_open(admin_url().'deposit/reject/'.$deposit->trans_id); ?>
			<textarea name="mail_content" class="form-control" required></textarea>
			<br/>
			<button class="btn btn-small btn-danger" style='margin-left:20px;'>REJECT</button>
			<?php echo form_close(); ?></center>
            </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
        </div>
    </div>
    </div>
    </div>
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
		var admin_url='<?php echo admin_url(); ?>';
		
$(document).ready(function() {
    $('#datas-table').DataTable( {
        "responsive" : true,
        "processing" : true,
        "pageLength" : 10,
        "serverSide": true,
        "order": [[0, "asc" ]],
        "searching": true,
        "ajax": admin_url+"deposit/deposit_ajax"
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