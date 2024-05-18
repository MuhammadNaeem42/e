<?php 
  $this->load->view('front/common/header');
  ?>
<style>
  button {
  -webkit-appearance: button;
  border: none;
  }
  button.d-block {
  font-weight: 700;
  }
  .img_preview { 
  display: none;
  }
  .img-fluid {
  width: 150px;
  }
</style>
<div class="jb_middle_content jb_support_page">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="jb_h1  jb_mb_25">Queries</div>
        <div class="jb_supo_suppo_list_out">
          <a href="#" class="d-block">
            <div class="jb_supo_suppo_list">
              <div class="jb_supo_suppo_list_h1"><?php echo ucfirst($support->subject);?></div>
            </div>
          </a>
          <a href="#" class="d-block">
            <div class="jb_supo_suppo_list">
              <div class="jb_supo_suppo_list_h1"><?php echo time_calculator($support->created_on); ?></div>
            </div>
          </a>
          <a href="#" class="d-block">
            <div class="jb_supo_suppo_list">
              <div class="jb_supo_suppo_list_h1"><?php echo getSupportCategory($support->category);?></div>
            </div>
          </a>
          <a href="#" class="d-block">
            <div class="jb_supo_suppo_list">
              <div class="jb_supo_suppo_list_h1"><?php echo  ucfirst(htmlentities($support->message)); ?></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-8">
        <div class="jb_h1  jb_mb_25"><?php echo ucfirst($support->subject);?></div>
        <div class="jb_supo_chat_set">
          <div class="jb_supo_exp_ch_bdy_out jb_supo_exp_pag_scroll">
            <div class="jb_supo_exp_ch_bdy  ">
              <?php
                if(isset($support_reply) && !empty($support_reply)){
                  $i=0;
                  foreach($support_reply as $reply) 
                  {  
                    $i++;
                    $time = time_calculator($reply->created_on);
                    $reply_msg = $reply->message;
                    $reply_file = $reply->image;
                    if($reply->user_id ==0) 
                    {
                ?>					
              <div class="jb_supo_exp_ch_li_blk">
                <div class="jb_supo_exp_ch_li">
                  <img src="<?php echo front_img();?>avt.png" class="jb_supo_exp_ch_li_img">
                  <?php if(isset($reply_file) && !empty($reply_file)){ ?> 
                  <img src="<?php echo $reply_file;?>" class="img-fluid"> 
                  <!-- <a href="#" onclick="myFunction('<?php echo $reply_file;?>')" style="font-size: 15px;" ><i class="far fa-eye"></i></a> -->
                  <?php } ?>
                  <?php echo $reply_msg;?>
                </div>
              </div>
              <?php } else { ?>
              <!-- <div class="jb_supo_exp_ch_li_blk">
                <div class="jb_supo_exp_ch_li">
                  <img src="assets/images/avt.png" class="jb_supo_exp_ch_li_img">
                  <img src="assets/images/avt2.png" class="img-fluid">
                </div>
                </div> -->
              <div class="jb_supo_exp_ch_li_blk">
                <div class="jb_supo_exp_ch_li cht_me">
                  <img src="<?php echo front_img();?>avt2.png" class="jb_supo_exp_ch_li_img">
                  <?php if(isset($reply_file) && !empty($reply_file)){ ?>
                  <img src="<?php echo $reply_file;?>" class="img-fluid">  
                  <!-- <a href="#" onclick="myFunction('<?php echo $reply_file;?>')" style="font-size: 15px;" ><i class="far fa-eye"></i></a> -->
                  <?php } ?>
                  <?php echo $reply_msg;?>
                </div>
              </div>
              <?php } } } ?>
            </div>
          </div>
          <?php
            $attributes=array('id'=>'reply');
            echo form_open_multipart($action,$attributes);
            ?>
          <div class="jb_supo_exp_ch_btm">
            <input type="text" name="message" id="message" data-emoji-input="unicode" class="jb_supo_exp_ch_text" placeholder="Type Message">
            <i class="fal fa-file jb_supo_exp_ch_text_fil"></i>
            <input type="file" class="jb_supo_exp_ch_text_fil_in" id="imageUpload2" name="image">
            <button type="submit" class="d-block"><i class=" jb_supo_exp_ch_text_i fal fa-arrow-right"></i></button>
            <label id="img_error" class="error"></label>
          </div>
          <img id="support_img" src="" alt="Support Img" style="display: none;" class="img-fluid mb-6 proof_img"><label style="color: #ffffff;" id="image_name">
          <?php
            echo form_close();
            ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="img-fluid" id="img01">
  <div id="caption"></div>
</div>
<?php 
  $this->load->view('front/common/footer');
  $user_id    = $this->session->userdata('user_id');
  $ip_address = $_SERVER['REMOTE_ADDR'];
  $get_os     = $_SERVER['HTTP_USER_AGENT'];
  ?>
<script type="text/javascript">
  var base_url='<?php echo base_url();?>';
  var front_url='<?php echo front_url();?>';
  var user_id='<?php echo $user_id;?>';
  var ip_address = '<?php echo $ip_address;?>';
  var get_os     = '<?php echo $get_os;?>';
  
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
    if(settings.type.toLowerCase() == 'post') {
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
  
  
  $("#imageUpload2").change(function() {
    document.getElementById("support_img").style.display = "block";
    readURL4(this);
  });
  
  var modal = document.getElementById("myModal");
  
  var img = document.getElementById("rep_img");
  var modalImg = document.getElementById("img01");
  var span = document.getElementsByClassName("close")[0];

  function myFunction(src) {
  
    modal.style.display = "block";
    modalImg.src = src;
  }
  
  span.onclick = function() { 
    modal.style.display = "none";
  }

  function readURL4(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#support_img').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  
  
  
  $('#reply').validate({
    errorClass: 'invalid-feedback',
    rules: {
        
      message: {
        required: true
      }
    },
    messages: {
        
      message: {
        required: "Please enter message"
      }
    },
  });
</script>
<script>
  // Get the modal
  var modal = document.getElementById("myModal");
  
  var img = document.getElementById("rep_img");
  var modalImg = document.getElementById("img01");
  var span = document.getElementsByClassName("close")[0];
  function myFunction(src) {
  
    modal.style.display = "block";
    modalImg.src = src;
  }
  
  span.onclick = function() { 
    modal.style.display = "none";
  }
  
</script>