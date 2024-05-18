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
<div class="jb_middle_content jb_profile_page">
  <div class="container">
    <div class="jb_comn_card">
      <div class="jb_h1 jb_marg_b_20">Edit Profile</div>
        <?php 
          $attributes=array('id'=>'verification_form',"autocomplete"=>"off"); 
            $action = front_url() . 'profile-edit';
          echo form_open_multipart($action,$attributes); 
        ?>
        <div class="row ">
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <div class="jb_log_in_lbl">Full Name</div>
              <input type="text" id="firstname" name="firstname" value="<?php echo $users->jab_fname; ?>" class="jb_log_in_input">
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <div class="jb_log_in_lbl">Last Name</div>
              <input type="text" id="lastname" name="lastname" value="<?php echo $users->jab_lname; ?>" class="jb_log_in_input">
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <?php $usermail = getUserEmail($users->id);?>
              <div class="jb_log_in_lbl">Email</div>
              <input type="text" id="email" name="email" disabled value="<?php echo ($usermail)?$usermail:'';?>" class="jb_log_in_input">
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <div class="jb_log_in_lbl">Phone No</div>
              <input type="text" id="phone" name="phone" value="<?php echo ($users->jab_phone)?$users->jab_phone:'';?>" class="jb_log_in_input">
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <div class="jb_log_in_lbl">Address</div>
              <input type="text" id="address" name="address" value="<?php echo $users->street_address;?>" class="jb_log_in_input">
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <div class="jb_log_in_lbl">City</div>
              <input type="text" id="city" name="city" value="<?php echo ($users->city)?$users->city:'';?>" class="jb_log_in_input">
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <div class="jb_log_in_lbl">Country</div>
              <select name="register_country" id="register_country" class="jb_log_in_input">
                <option value="0"></option>
                <!-- <option value="1">India</option>
                <option value="1">Canada</option> -->
                <?php if($countries) {
                    foreach($countries as $co) {
                      ?>
                  <option <?php if($co->id==$users->country) { echo "selected"; } ?>
                    value ="<?php echo $co->id; ?>"><?php echo $co->country_name; ?></option>
                  <?php
                    }
                  } ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <div class="jb_log_in_lbl">Postal Code </div>
              <input type="text" id="postal_code" name="postal_code" value="<?php echo ($users->postal_code)?$users->postal_code:'';?>" class="jb_log_in_input">
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set ">
              <div class="jb_log_in_lbl" style="color: transparent;">Profile Picture</div>
              <input type="file" onchange="Imgupload(this,'profile_img')" name="profile_photo" id="profile-picture" value="<?php echo $users->profile_picture; ?>" class="jb_log_in_input ">
              <div class="error"></div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="jb_log_in_set">
              <?php if(!empty($users->profile_picture)) { ?>
              <img src="<?php echo $users->profile_picture;?>" id="profile_img"  style="height: 100px;width: 100px;" ><?php } else { ?>
              <img src="" id="profile_img"  style="height: 100px;width: 100px;" >
              <?php } ?>
            </div>
          </div>
          <div class="col-md-auto  jb_marg_l_auto ">  <button id="submit_btn" type="submit" class="jb_form_btn ">Submit</button></div>
        </div>
        <?php echo form_close();?>
    </div>
  </div>
</div>
<?php 
  $this->load->view('front/common/footer');
  ?>
<script type="text/javascript">
  $('#verification_form').validate({
    errorClass: 'invalid-feedback',
    rules: {
      firstname: {
        required: true
      },
      lastname: {
        required: true
      },
      address: {
        required: true
      },
      city: {
        required: true,
        lettersonly: true
      },
      state: {
        required: true,
        lettersonly: true
      },
      postal_code: {
        required: true,
        number: true,
        maxlength: 7,
        ZipChecker: function (element) {
          values = $("#postal_code").val();

          if (values == "0" || values == "00" || values == "000" || values == "0000" || values == "00000" || values == "000000" || values == "0000000") {
            return true;

          }

        }

      },
      phone: {
        required: true
      }
    },
    messages: {
      firstname: {
        required: "Please enter full name"
      },
      lastname: {
        required: "Please enter last name"
      },
      address: {
        required: "Please enter address"
      },
      city: {
        required: "Please enter city",
        lettersonly: "Please enter letters only"
      },
      state: {
        required: "Please enter state",
        lettersonly: "Please enter letters only"
      },
      postal_code: {
        required: "Please enter postal code"
      },
      phone: {
        required: "Please enter phone number"
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
      $(element).parent().addClass('jb_log_in_vldr_fail');
    },
    unhighlight: function (element) {
      $(element).parent().removeClass('error');
      $(element).parent().removeClass('jb_log_in_vldr_fail');
    },
    submitHandler: function (form) {
      $('#submit_btn').prop('disabled');
      var $form = $(form);
      form.submit();

    }
  });

  function Imgupload(input, src) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#' + src).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>