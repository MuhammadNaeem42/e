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
<div class="jb_middle_content jb_login_page">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="jb_log_set">
          <?php
            $action = front_url()."signin";
            $attributes = array('id'=>'loginuserFrom','autocomplete'=>"off",'class'=>'');
            echo form_open($action,$attributes);
          ?>
          <div class="jb_log_hdr">User Login</div>
          <div class="jb_log_in_set">
            <div class="jb_log_in_lbl">Username</div>
            <i class="jb_log_in_ico fal fa-users"></i>
            <input type="text" name="login_detail" id="login_detail" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Password</div>
            <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
            <input type="password" name="login_password" id="login_password" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">2FA</div>
            <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
            <input type="password" name="login_tfa" id="login_tfa" class="jb_log_in_input">
          </div>
          <div class="row justify-content-between">
            <div class="col-auto">
              <a href="<?php echo base_url();?>register" class="jb_log_link">Register</a>
              <a href="<?php echo base_url();?>forgot_password" class="jb_log_link">Forgot Password?</a>
            </div>
            <div class="col-auto"><button type="submit" class="jb_log_btn">Submit</button></div>
          </div>
          <?php echo form_close();?>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 justify-content-end">
        <img src="<?php echo front_img();?>login-side.png" class="img-fluid">
      </div>
    </div>
  </div>
</div>
<?php 
  $this->load->view('front/common/footer');
?>
<script type="text/javascript">
  $(document).ready(function () {
  $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    if (options.type.toLowerCase() == 'post') {
      options.data += '&' + csrfName + '=' + $("input[name=" + csrfName + "]").val();
      if (options.data.charAt(0) == '&') {
        options.data = options.data.substr(1);
      }
    }
  });

  $(document).ajaxComplete(function (event, xhr, settings) {
    if (settings.type.toLowerCase() == 'post') {
      $.ajax({
        url: front_url + "get_csrf_token",
        type: "GET",
        cache: false,
        processData: false,
        success: function (data) {

          $("input[name=" + csrfName + "]").val(data);
        }
      });
    }
  });

});
$.validator.addMethod("emailcheck", function (value) {
  return (/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/.test(value));
}, "Please enter valid email address");


$('#loginuserFrom').validate({
  errorClass: 'invalid-feedback',
  rules: {
    login_detail: {
      required: true,
      email: true,
      emailcheck: true,
    },
    login_password: {
      required: true
    },
    login_tfa: {
      number: true,
      minlength: 6
    }
  },
  messages: {
    login_detail: {
      required: "Please enter email",
      email: "Please enter valid email address",
      emailcheck: "Please enter valid email address"
    },
    login_password: {
      required: "Please enter password"
    },
    login_tfa: {
      number: "Please enter valid tfa code",
      minlength: "Enter 6 digit valid tfa code"
    }
  },
  invalidHandler: function (form, validator) {
    if (!validator.numberOfInvalids()) {
      return;
    } else {
      var error_element = validator.errorList[0].element;
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
  submitHandler: function (form) {

    $('#submit_btn').prop('disabled');
    $('.spinner-border').css('display', 'inline-block');

    var $form = $(form);
    $.ajax({
      url: front_url + "login_check",
      type: "POST",
      data: $form.serialize(),
      cache: false,
      processData: false,
      success: function (data) {
        // console.log(data);
        var d = jQuery.parseJSON(data);
        if (d.status == 0) {
          //tata.error(d.msg);
          tata.warn(d.msg);
          $('#submit_btn').prop('enabled');
          $('.spinner-border').css('display', 'none');
        } else {
          tata.info(d.msg);
          if (d.tfa_status == 1) {
            $('#submit_btn').prop('enabled');
            $('.spinner-border').css('display', 'none');
          } else {
            tata.success(d.msg);
            setTimeout(function() {
              // haBo+RixRVvetGULPtCCGQ==   -----> loggedin
              // BUpWfQkOJsrafUmBcAO+BQ==   -----> exchange
              localStorage.setItem("haBo+RixRVvetGULPtCCGQ==", "BUpWfQkOJsrafUmBcAO+BQ==");
              // console.log(data, '----');return false;

              if (d.login_url == 'dashboard') {
                window.location.href = front_url + "dashboard";
              } else {
                window.location.href = front_url + "dashboard";
              }
            }, 500);
          }
        }
      }
    });
    return false;
    // }
  }
});
</script>