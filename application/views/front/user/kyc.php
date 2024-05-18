<?php 
  $this->load->view('front/common/header');
  
  ?>
<div class="jb_middle_content jb_kyc_page">
  <div class="container">
    <div class="jb_comn_card">
      <div class="jb_h1 jb_marg_b_25">KYC</div>
      <style>
        .jb_kyc_card .jb_h2{margin-bottom: 10px;}
        .jb_kyc_card:hover{border-color: var(--mainclr);}
        .jb_kyc_card{
        display: flex;
        flex-wrap: wrap;
        flex: 1 100%;
        position: relative;
        border-radius: 10px;
        border:2px dashed #eee;
        padding: 20px;
        justify-content: start;
        text-align: start;
        }
        .jb_kyc_card_img:before{content:"";display: block;width:100%; height: 100%; z-index: 1; position: absolute;top:0px;left: 0px; cursor: pointer;}
        .jb_kyc_card_img{
        width: 100%;
        height:150px;
        object-fit: contain;
        margin-top:30px;
        position: relative;
        z-index: 1;
        cursor: pointer;
        }
        .jb_kyc_card_input{
        display: none;
        }
        .jb_kyc_inps .jb_log_in_input{font-size: 14px;}
        .jb_kyc_inps .jb_log_in_input_sel_ico{text-align: right !important;}
        .jb_kyc_inps{
        width:150px;position: relative;z-index: 2;margin: 0px;
        }
        .jb_kyc_success{border-color: #00c766;}
        @media(max-width:600px){
        .jb_kyc_inps{width:100%;}
        .jb_kyc_card{  margin-bottom: 25px;}
        }
        button {
          -webkit-appearance: button;
          border: none;
        }
        
        button.jb_form_btn {
          font-weight: 700;
        }
        .jb_kyc_stat_btn {
          padding: 5px;
          font-size: 14px;
          border-radius: 5px;
          width: 30px;
          text-align: center;
          line-height: 15px;
          display: inline-block;
          margin-left: 10px;
          color: #ffffff;
        }
      </style>
      <?php
        $attributes = array('id'=>'verification_forms'); 
        $action = front_url() . 'kyc_verification';
        echo form_open_multipart($action,$attributes);
      ?> 
      <div class="row jb_marg_b_25">
        <div class="col-md-4">
          <div class="jb_kyc_card">
            <div class="row align-items-center">
              <div class="col-md">
                <div class="jb_font_s_20 jb_font_w_500 jb_marg_b_5">Address Proof
            <?php
                if(($users->photo_1_status==0 || $users->photo_1_status==2)){
                  ?>
              <i class="fal fa-times-circle bg-warning jb_kyc_stat_btn"></i>
              <input type="file" name="photo_id_1" id="photo_id_1" onchange="Imgupload(this,'address_proof')" class="jb_kyc_card_input"><?php } else if($users->photo_1_status==3) { ?> 
                <i class="fal fa-check-circle bg-success jb_kyc_stat_btn"></i>
              <?php } ?>
                  <!-- <i class="fal fa-check-circle bg-success jb_kyc_stat_btn"></i> -->
                </div>
                
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">Maximum file size should be below 2mb</div>
              </div>
              <div class="col-md-auto">
                <div class="jb_log_in_set jb_kyc_inps">
                  <i class="fal fa-caret-right jb_log_in_input_sel_ico "></i>
                  <select class=" jb_log_in_input">
                    <option value="1">Address Proof</option>
                  </select>
                </div>
              </div>
            </div>
            <?php
            if(($users->photo_1_status==0 || $users->photo_1_status==2)){
              ?>
              <img src="<?php echo front_img();?>file-upload-ico.png" id="address_proof" class="jb_kyc_card_img">
            <?php } else { ?>
              <img src="<?php echo $users->photo_id_1;?>" name="photo_id_1" id="address_proof" class="jb_kyc_card_img">
            <?php } ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="jb_kyc_card">
            <div class="row align-items-center">
              <div class="col-md">
                <div class="jb_font_s_20 jb_font_w_500 jb_marg_b_5">Identity Proof
                  <?php
                  if(($users->photo_2_status==0 || $users->photo_2_status==2)){
                    ?>
                  <i class="fal fa-times-circle bg-warning jb_kyc_stat_btn"></i>
                  <input type="file" name="photo_id_2" id="photo_id_2" onchange="Imgupload(this,'identity_proof')" class="jb_kyc_card_input"><?php } else if($users->photo_1_status==3) { ?> 
                    <i class="fal fa-check-circle bg-success jb_kyc_stat_btn"></i>
                  <?php } ?>
                </div>
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">Maximum file size should be below 2mb</div>
              </div>
              <div class="col-md-auto">
                <div class="jb_log_in_set jb_kyc_inps">
                  <i class="fal fa-caret-right jb_log_in_input_sel_ico "></i>
                  <select class=" jb_log_in_input">
                    <option value="1">Identity Proof</option>
                  </select>
                </div>
              </div>
            </div>
            <?php
            if(($users->photo_2_status==0 || $users->photo_2_status==2)){
              ?>
              <img src="<?php echo front_img();?>file-upload-ico.png" id="identity_proof" class="jb_kyc_card_img">
            <?php } else { ?>
              <img src="<?php echo $users->photo_id_2;?>" id="identity_proof" class="jb_kyc_card_img">
              <?php } ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="jb_kyc_card jb_kyc_success">
            <div class="row align-items-center">
              <div class="col-md">
                <div class="jb_font_s_20 jb_font_w_500 jb_marg_b_5">Selfie Proof
                  <?php
                  if(($users->photo_3_status==0 || $users->photo_3_status==2)){
                    ?>
                  <i class="fal fa-times-circle bg-warning jb_kyc_stat_btn"></i>
                  <input type="file" name="photo_id_3" id="photo_id_3" onchange="Imgupload(this,'selfie_proof')" class="jb_kyc_card_input"><?php } else if($users->photo_1_status==3) { ?> 
                    <i class="fal fa-check-circle bg-success jb_kyc_stat_btn"></i>
                  <?php } ?>
                </div>
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">Maximum file size should be below 2mb</div>
              </div>
              <div class="col-md-auto">
                <div class="jb_log_in_set jb_kyc_inps">
                  <i class="fal fa-caret-right jb_log_in_input_sel_ico "></i>
                  <select class=" jb_log_in_input">
                    <option value="1">Selfie</option>
                  </select>
                </div>
              </div>
            </div>
            <?php
            if(($users->photo_3_status==0 || $users->photo_3_status==2)){
              ?>
              <img src="<?php echo front_img();?>file-upload-ico.png" id="selfie_proof" class="jb_kyc_card_img">
              <!-- <video src="<?php echo front_img();?>success-vid.mp4" id="selfie_proof" class="jb_kyc_card_img" autoplay muted></video> -->
            <?php } else { ?>
              <img src="<?php echo $users->photo_id_3;?>" id="selfie_proof" class="jb_kyc_card_img">
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="row justify-content-between">
        <div class="col-md-12">
          <?php
            if($users->photo_1_status!=1 && $users->photo_2_status!=1 && $users->photo_3_status!=1){
          ?>
          <button class="jb_form_btn float-end" id="verification_btn" type="submit"> Submit</button>
          <?php
            }
            ?>
        </div>
        <!-- <div class="col-auto"><a href="" class="jb_log_btn">Submit</a></div> -->
      </div>
      <?php echo form_close();?>
    </div>
  </div>
</div>
<?php 
  $this->load->view('front/common/footer');
  ?>
<script type="text/javascript">
  $(document).ready(function () {
  
  $('form').submit(function() {
    $(this).find("button[type='submit']").prop('disabled',true);
    $('#verification_btn').html('Loading .........');
  
  });
  
  });
  
  
  	function Imgupload(input,src)
  	{	
  		
  		  if (input.files && input.files[0]) {
            var reader = new FileReader();
  		  reader.onload = function(e) {
              $('#'+src).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); 
          }
  	}
  
  
</script>