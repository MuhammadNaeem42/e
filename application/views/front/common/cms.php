<?php 
$this->load->view('front/common/header');
?>
<?php if($cms->link == 'about-us') { //echo "<pre>"; print_r($cms); ?> 
  <div class="jb_middle_content jb_about_page ">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-md-6">
          <img src="<?php echo front_img();?>about-side.png" class="img-fluid">
        </div>
        <div class="col-md-6">
          <?php echo $cms->english_content_description;?>
          <!-- <div class="jb_h1">Know Our JAB</div>
          <p class="jb_pri_priv_p text-justify">
            Nam lacinia ipsum nulla, quis cursus nisl semper quis. Suspendisse et metus ut dolor condimentum commodo. Integer congue ac nisi a auctor. Ut ut urna dapibus est cursus tempus.nascetur ridiculus mus. Duis fringilla vitae nunc ut sollicitudin. Nam interdum justo ligula, eget accumsan quam pretium ut. Sed ultricies hendrerit purus, vitae eleifend lorem porta at. Mauris malesuada enim sit amet odio vestibulum vehicula. Donec mattis posuere porttitor. Sed hendrerit faucibus tortor sit amet consequat. In turpis ante, volutpat quis imperdiet sed, rutrum sit amet nulla.
            <br> <br>
            Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis fringilla vitae nunc ut sollicitudin. Nam interdum justo ligula, eget accumsan quam pretium ut. Sed quis ipsum rhoncus, finibus arcu eu, iaculis sem. Donec sit amet elit semper, vestibulum nisl vitae, eleifend eros. Praesent efficitur aliquet risus, nec viverra felis rhoncus eu. Curabitur a massa et justo pharetra finibus vel ac ipsum.
          </p> -->
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<?php if($cms->link == 'terms-and-conditions') { //echo "<pre>"; print_r($cms); ?> 
<div class="jb_middle_content jb_terms_page">
  <div class="container">
    <div class="jb_card_out">
      <?php echo $cms->english_content_description;?>
    </div>
  </div>
</div>
<?php } ?>
<?php if($cms->link == 'privacy-policy') { //echo "<pre>"; print_r($cms); ?> 
<div class="jb_middle_content jb_privacy_page">
  <div class="container">
    <div class="jb_card_out">
      <?php echo $cms->english_content_description;?>
    </div>
  </div>
</div>
<?php } ?>
<?php 
$this->load->view('front/common/footer');
?>