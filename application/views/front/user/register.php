<?php 
  $this->load->view('front/common/header');
?>
<style>
	[type=button], [type=reset], [type=submit], button {
    -webkit-appearance: button;
    border: none;
	}
	
	button.jb_log_btn {
    font-weight: 700;
	}
</style>
<div class="jb_middle_content jb_register_page" >
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-6">
				<?php $attributes=array('id'=>'register_user','class'=>'auth_form','autocomplete'=>"off");
					echo form_open($action,$attributes); $settings = $site_common['site_settings'];
				?>
        <div class="jb_log_set">
          <div class="jb_log_hdr">Register</div>
          <div class="jb_log_in_set">
            <div class="jb_log_in_lbl">Username</div>
            <i class="jb_log_in_ico fal fa-users"></i>
            <input type="text" name="username" id="username" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Email Id</div>
            <i class="jb_log_in_ico fal fa-envelope"></i>
            <input type="text" id="register_email" name="register_email" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Password</div>
            <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
            <input type="password" name="register_password" id="register_password" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Confirm Password</div>
            <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
            <input type="password" name="register_cpassword" id="register_cpassword" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Gender</div>
            <i class="fal fa-arrow-down jb_log_in_input_sel_ico"></i>
            <select class="jb_log_in_input" name="gender" id="gender">
              <option value=""></option>
              <option value="1">Male</option>
              <option value="2">Female</option>
            </select>
          </div>
          <label class="jb_log_chk_bx_lbl">
						<input type="checkbox" name="terms" id="terms"> 
						I agree to the <a href="" class="jb_log_chk_bx_lbl_a">Terms & Conditions</a> 
					</label>
          <div class="row justify-content-between">
            <div class="col-auto">
              <a href="<?php echo base_url();?>signin" class="jb_log_link">Login</a>
              <a href="<?php echo base_url();?>forgot_password" class="jb_log_link">Forgot Password?</a>
            </div>
            <div class="col-auto"><button class="jb_log_btn" type="submit"> Submit</button></div>
            <!-- <div class="col-auto"><a href="" class="jb_log_btn">Submit</a></div> -->
          </div>
        </div>
				<?php echo form_close();?>
      </div>
    </div>
  </div>
</div>
<?php 
  $this->load->view('front/common/footer');
?>
<script type="text/javascript">
  var base_url='<?php echo base_url();?>';
  var front_url='<?php echo front_url();?>';
  
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
  
  // alert(csrfName)
  
  $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
		if (options.type.toLowerCase() == 'post') {
			options.data += '&'+csrfName+'='+$("input[name="+csrfName+"]").val();
			if (options.data.charAt(0) == '&') {
				options.data = options.data.substr(1);
			}
		}
  });
  
  $( document ).ajaxComplete(function( event, xhr, settings ) {
      if (settings.type.toLowerCase() == 'post') {
				$.ajax({
					url: front_url+"get_csrf_token", 
					type: "GET",
					cache: false,             
					processData: false,      
					success: function(data) {
						console.log(data);
						$("input[name="+csrfName+"]").val(data);
					}
				});
      }
  });
  $(document).ready(function () {
		jQuery.validator.addMethod("alphanumeric", function(value, element) {
			return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
		});
  
  	$('#register_user').validate({
      errorClass: 'invalid-feedback',
          rules: {
              username: {
              required: true
          },
					register_email: {
						required: true,
						email: true,
						remote: {
							url: front_url+'email_exist',
							type: "post",
							csrf_token : csrfName,
							data: {
									email: function() {
											return $( "#register_email" ).val();
									}
							}
						}
          },
         
          register_password: {
              required: true,
              minlength: 8,
              alphanumeric: true
          },
          register_cpassword: {
              required: true,
              equalTo : "#register_password"
          },
          gender: {
              required: true
          },
          terms: {
              required:true
          }
      },
      messages: {
          username: {
              required:"Please enter Username"
          },
         register_email: {
              required:"Please enter email",
              //email: "<?php echo $this->lang->line('Please enter valid email address')?>"
              remote: "Entered Email Address Already Exists"
          },
          register_password: {
              required: "Please enter password",
              minlength: "Password should be Minimum 8 characters ",
              alphanumeric: "Password should contains special characters,uppercase,lowecase and numbers"
          },
          register_cpassword: {
              required: "Please enter Confirm Password",
              equalTo : "Please enter same password"
          },
          gender: {
              required: "Please select gender"
          }
      },
      invalidHandler: function(form, validator) {
        if(!validator.numberOfInvalids())
        {
          return;
        }
        else
        {
          var error_element=validator.errorList[0].element;
          error_element.focus();
        }
      },
      highlight: function (element) {
        $(element).parent().addClass('jb_log_in_vldr_fail');
      },
      unhighlight: function (element) {
        $(element).parent().removeClass('error');
        $(element).parent().removeClass('jb_log_in_vldr_fail');
      },
      submitHandler: function(form) 
      {
      	$('#submit_btn').prop('disabled');
      	var $form = $(form);
       	form.submit();
        
      }
  	});
  });
</script>