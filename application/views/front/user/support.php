<?php 
  $this->load->view('front/common/header');
  ?>
<style>
	button {
    -webkit-appearance: button;
    border: none;
	}
	
	button.jb_log_btn {
    font-weight: 700;
	}
  .img_preview { 
    display: none;
  }
</style>
<div class="jb_middle_content jb_profile_page">
  <div class="container">
    <div class="jb_comn_card">
      <div class="jb_h1 jb_marg_b_20">Support Ticket</div>
      <?php 
        $attributes=array('id'=>'support_form',"autocomplete"=>"off","class"=>"mt-4");
        $action = front_url() . 'support';
        echo form_open_multipart($action,$attributes);
        ?>
      <div class="row ">
        <div class="col-md-6">
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Subject</div>
            <input type="text" id="subject" name="subject" class="jb_log_in_input">
          </div>
        </div>
        <div class="col-md-6">
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Category</div>
            <select class="jb_log_in_input" name="category" id="category">
              <?php foreach ($category as $category_value) { 
                ?>
              <option value="<?php echo $category_value->id; ?>"><?php echo ($category_value->name); ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-12">
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Message</div>
            <textarea id="message" name="message" style="height: 100px; line-height: 1.3;" class="jb_log_in_input"></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Image</div>
            <input type="file" name="image" id="imgInp4" accept=".png, .jpg, .jpeg, .doc,.docx" class="jb_log_in_input ">
            <div class="error"></div>
          </div>
          <img id="support_img" src=""  alt="Support Img" style="display:none;width:55px" class="jb_log_in_input">
          <span class="custom-text pl-2 error" id="img_error"></span>
        </div>
        <div class="col-md-6">
          <!-- <div class="jb_log_in_set ">
            <div class="jb_log_in_lbl">Subject</div>
            <input type="text" id="subject" name="subject" class="jb_log_in_input">
          </div> -->
        </div>
        <div class="col-md-4 img_preview">
          <div class="jb_log_in_set">
            <img src="" id="profile_img"  style="height: 100px;width: 100px;" >
          </div>
        </div>
        <div class="col-md-auto  jb_marg_l_auto ">  <button id="submit_btn" type="submit" class="jb_form_btn" name="submit_tick">Submit</button></div>
      </div>
      <?php echo form_close();?>
    </div>
    <div class="jb_depwith_out">
      <div class="jb_depwith_pane">
        <div class="jb_comn_card">
          <div class="jb_h2">Support History</div>
          <div class="table-responsive jb_repo_table_out">
            <table class="table table-borderless table-hover datatable">
              <thead>
                <tr>
                  <th scope="col">Ticket ID</th>
                  <th scope="col">Date & Time</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(isset($support) && !empty($support))
                  {
                    $a=0;
                    $username = UserName($this->session->userdata('user_id'), $prefix.'username');
                    foreach(array_reverse($support) as $support_list)
                    {
                      $a++;
                      if($support_list->close==0){
                          $ticket_type = "open-black";
                      }else{
                          $ticket_type = "jb_bg_red";
                      }
                  ?>
                <tr>
                  <td class="jb_repo_coin_set_td">
                    <div class="jb_repo_stat_lbl jb_bg_red"><?php echo $support_list->ticket_id;?></div>
                  </td>
                  <td class="jb_repo_coin_set_td_date"><?php echo date("m/d/Y h:i a",$support_list->created_on);?></td>
                  <td><?php echo ucfirst($support_list->subject); ?></td>
                  <td class="<?php echo $ticket_type; ?>">
                    <div class="jab_repo_tbl_stat">
                      <?php
                        if($support_list->close==0){
                          echo '<a style="color:#fff;" class="jb_form_btn"  href='.base_url().'support_reply/'.$support_list->ticket_id.'>'.$this->lang->line('Open').'</a>';
                        }
                        else{
                          echo "Closed";                   
                        }
                      ?>
                    </div>
                  </td>
                </tr>
                <?php } }?>
              </tbody>
            </table>
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
  var base_url='<?php echo base_url();?>';
  var front_url='<?php echo front_url();?>';
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';

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

  function readURL4(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#support_img').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
  }


  $('#imgU4').click(function(){

    $("#imgInp4").trigger("click");

  });
  $("#imgInp4").change(function() {
    document.getElementById("support_img").style.display = "block";
      readURL4(this);
  });
  $('#support_form').validate({
    errorClass: 'invalid-feedback',
    rules: {
      subject: {
        required: true
      },
      message: {
        required: true
      }
    },
    messages: {
      subject: {
        required: "Please enter subject"
      },
      message: {
        required: "Please enter message"
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
      var $form = $(form);
      form.submit();
    }

  });
  function Imgupload(input, src) {
    $(".img_preview").css("display","block");
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#' + src).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>