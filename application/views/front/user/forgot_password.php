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
<div class="jb_middle_content jb_forgot_page" >
  <div class="container">
    <div class="row align-items-center justify-content-around">
      <div class="col-md-4 col-7 justify-content-left">
        <img src="<?php echo front_img();?>forgot-password-side.png" class="img-fluid jb_mbl_mar_bot_20">
      </div>
      <div class="col-md-6 justify-content-center">
        <div class="jb_log_set">
          <?php 
            $action = front_url()."login";
            $attributes = array('id'=>'forgot_user','autocomplete'=>"off",'class'=>'auth_form'); 
            echo form_open($action,$attributes);
            ?>
          <div class="jb_log_hdr">Forgot Password</div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Email Id</div>
            <i class="jb_log_in_ico fal fa-envelope"></i>
            <input type="text" name="forgot_detail" id="forgot_detail" class="jb_log_in_input">
          </div>
          <div class="row justify-content-between">
            <div class="col-auto">
              <a href="<?php echo base_url();?>signin" class="jb_log_link">Login</a>
              <a href="<?php echo base_url();?>register" class="jb_log_link">Create Account?</a>
            </div>
            <div class="col-auto"><button class="jb_log_btn" id="submit">Submit</button></div>
          </div>
          <?php echo form_close();?>
        </div>
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
  
  
    $('#forgot_user').validate({
         errorClass: 'invalid-feedback',
         rules: {
          forgot_detail: {
            required: true,
            email:true,
            emailcheck: true,
          }
         },
         messages: {
             forgot_detail: {
                 required: "Please enter email",
                 email: "Please enter valid email address",
                 emailcheck: "Please enter valid email address"
             }
         },
         invalidHandler: function(form, validator) {
             if (!validator.numberOfInvalids())
             {
              $("#submit").prop('disabled',true);
                 return;
             }
             else
             {
              $("#submit").prop('disabled',false);
                 var error_element=validator.errorList[0].element;
                 error_element.focus();
             }
         },
         highlight: function (element) {
           //$(element).parent().addClass('error')
         },
         unhighlight: function (element) {
           $(element).parent().removeClass('error')
         },
         submitHandler: function(form) {
  
             $('#submit').prop('disabled',true);
             var $form = $(form);
         
             $.ajax({
             url: front_url+"forgot_check", 
             type: "POST",             
             data: $form.serialize(),
             cache: false,             
             processData: false,    
             beforeSend: function() {
                 $(':button[type="submit"]').prop('disabled', true);
             },
             success: function(data) {
                 //console.log(data);
                 var d = jQuery.parseJSON(data);
                 if(d.status==0)
                 {
                     $('#forgot_detail').val('');
                     $(':button[type="submit"]').prop('disabled', false);
  
                    
                      tata.error(d.msg,"Error");
                 }
                 else
                 { 
                    
                     $('#forgot_detail').val('');
                     $(':button[type="submit"]').prop('disabled', false);
  
                     
                     tata.success('success',d.msg);
  
                 }
             }
         });
         return false;
         }
     });
</script>