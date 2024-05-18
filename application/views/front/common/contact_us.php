<?php 
  $this->load->view('front/common/header');
  ?>
  <style>
    [type=button], [type=reset], [type=submit], button {
      -webkit-appearance: button;
      border: none;
    }
    
    button.jb_form_btn {
      font-weight: 700;
    }
  </style>
<div class="jb_middle_content jb_contact_page ">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="jb_cont_set">

          <?php 
            $attributes=array('role'=>'form','id'=>'contactform',"autocomplete"=>"off",'action'=>$action,'class'=>'deposit_form'); 
            echo form_open($action,$attributes); 
            ?>
          <div class="jb_h1">Enquire Now</div>
          <div class="jb_log_in_set">
            <div class="jb_log_in_lbl">Name</div>
            <i class="jb_log_in_ico fal fa-users"></i>
            <input type="text" id="name" name="name" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Email</div>
            <i class="jb_log_in_ico fal fa-envelope"></i>
            <input type="text" id="email" name="email" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set">
            <div class="jb_log_in_lbl">Subject</div>
            <i class="jb_log_in_ico fal fa-edit"></i>
            <input type="text" id="subject" name="subject" class="jb_log_in_input">
          </div>
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Comments</div>
            <i class="jb_log_in_ico fal fa-sticky-note"></i>
            <input type="text" id="comments" name="comments" style="height: 100px; line-height: 1.3;" class="jb_log_in_input">
          </div>
          <button type="submit" class="jb_form_btn w-100" id="submit">Submit</button>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5">
        <img src="<?php echo front_img();?>cont-side.png" class="img-fluid">
      </div>
    </div>
  </div>
</div>
<?php 
  $this->load->view('front/common/footer');
  ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
  $(document).ready(function () {
    $.validator.methods.email = function (value, element) {
      return this.optional(element) || /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value);
    }
    $('#contactform').validate({
      // $("#submit").prop('disabled',true);
      errorClass: 'invalid-feedback',
      rules: {
        name: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        subject: {
          required: true
        },
        comments: {
          required: true
        }

      },
      messages: {
        name: {
          required: "Please enter name"
        },
        email: {
          required: "Please enter email",
          email: "Please enter valid Email address"
        },
        subject: {
          required: "Please enter subject"
        },
        comments: {
          required: "Please enter message"
        }
      },
      invalidHandler: function (form, validator) {
        if (!validator.numberOfInvalids()) {
          $("#submit").prop('disabled',true);
          return;
        } else {
          $("#submit").prop('disabled',false);
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
        $("#submit").prop('disabled',true);
        var response = grecaptcha.getResponse();
        // console.log(response);

        //recaptcha failed validation
        if (response.length == 0 || response.length == '') {
          $('#cp_error').css('display', 'block');
          $('#cp_error').html('Please Verify here');
          return false;
        }
        //recaptcha passed validation
        else {
          $('#cp_error').html('');
          form.submit();
        }
        //
      }
    });
  });
</script>