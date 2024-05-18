<?php 
  $this->load->view('front/common/header');
  ?>
<div class="jb_middle_content jb_forgot_page" >
  <div class="container">
    <div class="row align-items-center justify-content-around">
      <div class="col-md-4 col-7 justify-content-left">
        <img src="<?php echo front_img();?>forgot-password-side.png" class="img-fluid jb_mbl_mar_bot_20">
      </div>
      <div class="col-md-6 justify-content-center">
        <?php
          $action = "";
          $attributes = array('id'=>'reset_pw_user','autocomplete'=>"off",'class'=>'');
          echo form_open($action,$attributes);
          ?> 
        <div class="jb_log_set">
          <div class="jb_log_hdr">Reset Password</div>
          <style>
            .jb_log_in_forg_btn{
            display: inline-block;
            padding:7px 15px;
            position: absolute;
            right:10px;top:7px;
            z-index: 9;
            }
            .jb_log_in_forg_hr{
            opacity: 1;
            background: #00000014;
            margin: 30px 0px;
            }
            [type=button], [type=reset], [type=submit], button {
              -webkit-appearance: button;
              border: none;
            }
            
            button.jb_log_btn {
              font-weight: 700;
            }
          </style>
          <div class="jb_log_in_set">
            <div class="jb_log_in_lbl">New Password</div>
            <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
            <input type="password" name="reset_password" id="reset_password" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set">
            <div class="jb_log_in_lbl">Confirm Password</div>
            <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
            <input type="password" name="reset_cpassword" id="reset_cpassword" class="jb_log_in_input">
          </div>
          <div class="row justify-content-between">
            <div class="col-auto">
              <a href="<?php echo base_url();?>signin" class="jb_log_link">Login</a>
              <a href="<?php echo base_url();?>register" class="jb_log_link">Register</a>
            </div>
            <div class="col-auto"><button type="submit" class="jb_log_btn">Submit</button></div>
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
  $(document).ready(function() {
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
  
  	$("input[name="+csrfName+"]").val(data);
  	}
  	});
  	}
  	});
  
  	});
  	$.validator.addMethod("emailcheck", function(value) {
  	return (/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/.test(value));
  	},"Please enter valid email address");
  
  
  	$('#reset_pw_user').validate({
  	errorClass: 'invalid-feedback',
  	    rules: {
  	      reset_password: {
  	        required: true,
  	        minlength: 8
  	      },
  	      reset_cpassword: {
  	        required: true,
  	        equalTo : "#reset_password"
  	      }
  	    },
  	    messages: {
        reset_password: {
          required: "Please enter password",
          minlength: "Minimum 8 characters, including UPPER / lower case with numbers & special characters"
        },
        reset_cpassword: {
          required: "Please enter Confirm Password",
          equalTo : "Please enter same password"
        }
      }, 
  	invalidHandler: function(form, validator) {
  	if (!validator.numberOfInvalids())
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
  	$(element).parent().addClass('jb_log_in_vldr_fail')
  	},
  	unhighlight: function (element) {
  	$(element).parent().removeClass('error');
  	$(element).parent().removeClass('jb_log_in_vldr_fail');
  	},
  	submitHandler: function(form)
  	{
  
  		var $form = $(form);
          	form.submit();
  	
  // }
  }
  });
</script>