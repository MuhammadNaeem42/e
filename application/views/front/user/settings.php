<?php 
  $this->load->view('front/common/header');
  // echo "<pre>"; print_r($users); die;
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
<div class="jb_middle_content jb_settings_page">
  <div class="container">
    <div class="jb_sett_out">
      <div class="row align-items-center">
        <div class="col-md-auto col-12 align-self-baseline">
          <div class="jb_sett_hdr_out">
            <div class="jb_sett_hdr_li jb_sett_hdr_li_act" data-nam="2fa"><i class="fal fa-lock"></i>2FA Authentication</div>
            <div class="jb_sett_hdr_li" data-nam="chpwd"><i class="fal fa-key"></i>Change Password</div>
            <div class="jb_sett_hdr_li " id="bank_section" data-nam="bkd"><i class="fal fa-building"></i>Bank Details</div>
          </div>
        </div>
        <div class="col-md col-12">
          <div class="jb_sett_tab_pane">
            <?php 
              $attributes1=array('id'=>'security','class'=>'deposit_form');
              $action1=base_url().'security';
              echo form_open($action1,$attributes1); 
              if($users->randcode=='' || $users->randcode=='disable')
              {
                $btn_content = $this->lang->line('ENABLE');
              }
                else{
                $btn_content = $this->lang->line('DISABLE');
              }                                     
              ?>
            <div class="jb_sett_tab_pane_li jb_sett_tab_pane_li_act" data-nam="2fa">
              <div class="row justify-content-center">
                <div class="col-md-7">
                  <div class="jb_h1">2FA Authentication</div>
                  <div class="jb_font_s_20 jb_font_w_500 jb_marg_b_5">Setup Authenticator</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50 jb_marg_b_25">Get <b>Google Authenticator</b> from Playstore or Apple store, Scan qr code or type code to setup your Google Authenticator</div>
                  <div class="row align-items-center justify-content-center">
                    <div class="col-md-auto col-6 d-flex justify-content-sm-center">
                      <img class="img-fluid jb_sett_2fa_img" src="<?php echo $url;?>" >
                    </div>
                    <div class="col-md-auto text-center">
                      <div class="jb_font_s_12 jb_font_w_400 jb_opac_p_50 jb_marg_b_25 d-inline-block" style="width: 30px;">( or )</div>
                    </div>
                    <div class="col-md col-12">
                      <div class="jb_log_in_set ">
                        <div class="jb_log_in_lbl">Type Code Manually</div>
                        <input type="text" class="jb_log_in_input" value="<?php echo $secret;?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div style="margin-right: 10px;"></div>
                <div class="col-md-7">
                  <div class="jb_font_s_20 jb_font_w_500 jb_marg_t_15 jb_marg_b_5">Use Authenticator</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50 jb_marg_b_25">Enter the 6 digits authentication code provided by<br class="jb_mbl_hide"> Google Authenticator</div>
                  <div class="jb_log_in_set jb_marg_b_20">
                    <div class="jb_log_in_lbl">Enter Authenticator Code</div>
                    <input type="text" class="jb_log_in_input" id="code" name="code" >
                    <input type="hidden" name="secret" id="secret" value="<?php echo $secret;?>">
                  </div>
                  <button class="jb_form_btn float-end"><?php echo $btn_content;?> 2FA</button>
                </div>
                <?php echo form_close(); ?>
              </div>
            </div>
            <div class="jb_sett_tab_pane_li" data-nam="chpwd">
              <?php 
              $attributes=array('id'=>'change_password1','class'=>'change_password_form');
              $action=base_url().'settings';
              echo form_open($action,$attributes); ?>
              <div class="jb_h1 ">Change Password</div>
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Old Password</div>
                    <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
                    <input type="password" name="oldpass" id="oldpass" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">New Password</div>
                    <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
                    <input type="password" name="newpass" id="newpass" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Confirm Password</div>
                    <i class="jb_log_in_ico fal fa-eye jh_password_ico"></i>
                    <input type="password" name="confirmpass" id="confirmpass" class="jb_log_in_input">
                  </div>
                </div>
              </div>
              <button name="chngpass" type="submit" class="jb_form_btn float-end">Submit</button>
              <?php echo form_close();?>
            </div>
            <div class="jb_sett_tab_pane_li" data-nam="bkd">
              <?php
                $attributes=array('id'=>'bankwire',"autocomplete"=>"off","class"=>"mt-4");
                $action = front_url() . 'update_bank_details';
                echo form_open_multipart($action,$attributes);
              ?>
              <div class="jb_h1 ">Bank Details</div>
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <div class="jb_log_in_set">
                    <div class="jb_log_in_lbl">Fiat Currency</div>
                    <i class="fal fa-arrow-down jb_log_in_input_sel_ico"></i>
                    <select class="jb_log_in_input" onChange="change_bank(this)" id="currency" name ="currency">
                      <!-- <option value="0"></option> -->
                        <?php
                        if(count($currencies)>0)
                        {
                            foreach($currencies as $cur)
                            {
                              if(!empty($user_bank))
                                    
                        
                        ?>
                      <option value="<?php echo $cur->id;?>" <?php if($act_cur==$cur->id){ echo "selected"; } ?> >
                        <?php echo $cur->currency_symbol;?>   
                      </option>
                      <?php
                        }
                        }
                        ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="jb_log_in_set">
                    <div class="jb_log_in_lbl">Account Holder Name</div>
                    <input type="text" id="bank_account_name" name="bank_account_name" value="<?php echo $user_bank->bank_account_name;?>" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Account Number</div>
                    <input type="text" id="bank_account_number" name="bank_account_number"  value="<?php echo $user_bank->bank_account_number;?>" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Bank Swift / Ifsc</div>
                    <input type="text" id="bank_swift" name="bank_swift" value="<?php echo $user_bank->bank_swift;?>" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">BIC</div>
                    <input type="text" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">IBAN</div>
                    <input type="text" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Bank Name</div>
                    <input type="text" id="bank_name" name="bank_name" value="<?php echo $user_bank->bank_name;?>" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Bank Address</div>
                    <input type="text" id="bank_address" name="bank_address" value="<?php echo $user_bank->bank_address;?>" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Bank City</div>
                    <input type="text" id="bank_city" name="bank_city" value="<?php echo $user_bank->bank_city;?>" class="jb_log_in_input">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Country</div>
                    <i class="fal fa-arrow-down jb_log_in_input_sel_ico"></i>
                    <select class="jb_log_in_input" name="bank_country" id="bank_country">
                      <option value="0"></option>
                      <?php if($countries) {
                        $banks = ($user_bank->bank_country!='')?$user_bank->bank_country:'';
                        foreach($countries as $co) {
                            ?>
                      <option <?php if($co->id==$banks) { echo "selected"; } else { } ?> value="<?php echo $co->id; ?>"><?php echo $co->country_name; ?></option>
                      <?php
                        }
                        } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="jb_log_in_set ">
                    <div class="jb_log_in_lbl">Postal Code</div>
                    <input type="text" id="bank_postalcode" name="bank_postalcode" value="<?php echo $user_bank->bank_postalcode;?>" class="jb_log_in_input">
                  </div>
                </div>
              </div>
              <?php if($user_bank->status!='Verified'){ ?>
              <button type="submit" class="jb_form_btn float-end">Submit</button>
              <?php }
                else
                {
                    echo "<a class='jb_form_btn jb_form_btn_red float-end'>Your Account Verified!</a>";
                }
              ?>
              <?php echo form_close();?>
            </div>
          </div>
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
  
  	var uri_seg = '<?php echo $this->uri->segment(2);?>';
  	if(uri_seg!='')
  	{
  		// console.log(uri_seg);	
  		$('#bank_section').click();
  	}
  	
  
  });
  
  
     $('#security').validate({
      errorClass: 'invalid-feedback',
          rules: {
              code: {
                  required: true,
                  number: true,
                  minlength: 6
              }
          },
          messages: {
              code: {
                  required: 'Please enter code',
                  number: 'Please enter valid code',
                  minlength:'Please 6 digit valid code'
              }
          }
      });
  
    $('#change_password1').validate({
      errorClass: 'invalid-feedback',
        rules: {
          oldpass: {
            required: true,
            remote: {
                      url: front_url+'oldpassword_exist',
                      type: "post",
                      csrf_token : csrfName,
                      data: {
                          oldpass: function() {
                          return $( "#oldpass" ).val();
                          }
                      }
                  }
          },
         newpass: {
            required: true
          },
          confirmpass: {
            required: true,
            equalTo : "#newpass"
          }
      },
       messages: {
          oldpass: {
            required: "Please enter Old Password",
             remote: "Invalid Old Password"
          },
          newpass: {
            required: "Please enter New Password"
          },
          confirmpass: {
            required: "Please enter Confirm Password",
            equalTo : "Confirm Password not matches with New Password"
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
  		}	
  });  
  
     $('#bankwire').validate({
      errorClass: 'invalid-feedback',
      rules: {
         
          currency: {
              required: true
          },
          bank_name: {
              required: true
          },
          bank_account_number: {
              required: true
          },
          bank_account_name: {
              required: true,
              lettersonly: true
          },
          bank_swift: {
              required: true
          },
          bank_address: {
               required: true
          },
          bank_city: {
              required: true,
              lettersonly: true
          },
          bank_country: {
              required: true,
             // lettersonly: true
          },
          bank_postalcode: {
              required: true,
              number: true,
              maxlength: 7,
              ZipChecker: function(element) {
                  values=$("#postal_code").val();
                  if( values =="0" || values =="00" || values =="000" || values =="0000" || values =="00000"  || values =="000000"   || values =="0000000" )
                  {
                      return true;
                  }
              }
          }
      },
      messages: {
          currency: {
              required: "Please select fiat currency"
          },
          bank_name: {
              required: "Please enter bank name"
          },
          bank_account_number: {
              required: "Please enter bank account number"
          },
          bank_account_name: {
              required: "Please enter bank account name",
              lettersonly: "Please enter letters only"
          },
          bank_swift: {
              required: "Please enter bank swift"
          },
          bank_address: {
              required: "Please enter bank address"
          },
          bank_city: {
              required: "Please enter bank city",
              lettersonly: "Please enter letters only"
          },
          bank_country: {
              required: "Please enter bank bank country"
          },
          bank_postalcode: {
              required: "Please enter postal code"
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
  		}
  });
  
  function copyToClipboard(text) {
      var copyText = document.getElementById("authenticator_key");  
      var input = document.createElement("textarea");
      input.value = copyText.textContent;
      document.body.appendChild(input);
      input.select();
      document.execCommand("Copy");
      input.remove();
  }
  
  // var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
  
  //         $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
  //             if (options.type.toLowerCase() == 'post') {
  //                 options.data += '&'+csrfName+'='+$("input[name="+csrfName+"]").val();
  //                 if (options.data.charAt(0) == '&') {
  //                     options.data = options.data.substr(1);
  //                 }
  //             }
  //         });
  
  //         $( document ).ajaxComplete(function( event, xhr, settings ) {
  //             if (settings.type.toLowerCase() == 'post') {
  //                 $.ajax({
  //                     url: front_url+"get_csrf_token", 
  //                     type: "GET",
  //                     cache: false,             
  //                     processData: false,      
  //                     success: function(data) {
  //                             var dataaa = $.trim(data);
  //                          $("input[name="+csrfName+"]").val(dataaa);
  //                     }
  //                 });
  //             }
  //         });
  
   function change_bank(coin)
   	{
  
   		var currency = coin.value;
  
   		// console.log(currency);
  
   		var base_url='<?php echo base_url();?>';
  		window.location.href = base_url+'bank_details/'+currency;
  	}
  
  
  
</script>