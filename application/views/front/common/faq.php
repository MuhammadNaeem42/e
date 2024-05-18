<?php 
  $this->load->view('front/common/header');
  ?>
<div class="jb_middle_content jb_faq_page">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="jb_h1">Faq</div>
        <?php
          if($faqs){ $j=0; foreach($faqs as $faq){ $j++; 
          ?>
          <div class="jb_acrd ">
            <div class="jb_acrd_hd"><?=$faq->english_question;?><i class="fal fa-plus jb_acrd_hd_cls"></i></div>
            <div class="jb_acrd_p"><?=$faq->english_description;?></div>
          </div>
        <?php } } ?>
      </div>
    </div>
  </div>
</div>

<?php 
  $this->load->view('front/common/footer');
  ?>