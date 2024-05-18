<?php
$this->load->view('front/common/header');
// print_r($p2p_tradearr);exit;
?>
<div class="sb_main_content sb_oth_main">
   
   <div class="container">
    <?php $attributes=array('id'=>'paymentform',"autocomplete"=>"off"); 
          echo form_open_multipart($action,$attributes); ?>    
      <input type="hidden" name="c" value="<?php echo $crypto_amt;?>">    
      <input type="hidden" name="f" value="<?php echo $fiat_amt;?>">
      <input type="hidden" name="continue" value="continue">    
      <div class="row  justify-content-center" >
         <div class="col-md-6">
            <div class="sb_m_o_h1">Payment Details</div>
            <div class="sb_m_common_pnl ">
               <div class="row">
                  <div class="col-md-6">
                     <div class="sb_m_o_log_in_set sb_m_o_log_in_vldr_fail">
                        <div class="sb_m_o_log_in_lbl">Payment method</div>

                    <select class="sb_m_o_log_in_input" name="payment_method" id="payment_method"> 

                    <?php foreach ($payment_method as $key => $val) {
                      if($p2p_tradearr->payment_method == $val->id){ ?>
                        <option selected value="<?=$val->id?>"><?=$val->payment_name?></option>
                    <?php }} ?> 

                    </select>  



                       <!-- <select class="sb_m_o_log_in_input" name="payment_method" id="payment_method"> <?php

                        if($p2p_tradearr->payment_method==1){ ?>                         
                         <option <?php echo $p2p_tradearr->payment_method==1 ? 'selected' :''; ?> value="1">Paytm</option>
                      <?php }
                      if($p2p_tradearr->payment_method==2){
                       ?>
                         <option <?php echo $p2p_tradearr->payment_method==2 ? 'selected' :''; ?> value="2">Bank</option>
                      <?php } ?>
                      </select>  -->
                   </div>
                </div>

                <div class="col-md-6 paytm" style="display:none;">
                  <div class="sb_m_o_log_in_set ">
                     <div class="sb_m_o_log_in_lbl"><?=get_paymentname($p2p_tradearr->payment_method)?></div>
                     <input type="text" class="sb_m_o_log_in_input" name="paytm" value="<?php echo $p2p_tradearr->paytm ? $p2p_tradearr->paytm :'';  ?>">
                  </div>
               </div>



               <div class="col-md-6 bank_details" style="display:none;">
                  <div class="sb_m_o_log_in_set ">
                     <div class="sb_m_o_log_in_lbl">Bank Name </div>
                      <!-- <input type="text" class="sb_m_o_log_in_input" readonly name="bank" value="<?php echo get_servicename($p2p_tradearr->bank) ? get_servicename($p2p_tradearr->bank) :'';  ?>"> -->
                      <input type="text" class="sb_m_o_log_in_input" readonly name="bank" value="<?php echo $p2p_tradearr->bank ? $p2p_tradearr->bank :'';  ?>">
                 </div>
              </div>

              <div class="col-md-6 bank_details" style="display:none;">
               <div class="sb_m_o_log_in_set ">
                  <div class="sb_m_o_log_in_lbl">Bank account name</div>
                  <input type="text" class="sb_m_o_log_in_input" name="bank_acc_name" id="bank_acc_name" autocomplete="off" value="">
               </div>
            </div>
            <div class="col-md-6 bank_details" style="display:none;">
               <div class="sb_m_o_log_in_set ">
                  <div class="sb_m_o_log_in_lbl">Account Number</div>
                  <input type="text" class="sb_m_o_log_in_input" name="bank_acc_number" id="bank_acc_number"  autocomplete="off" >
               </div>
            </div>
            <div class="col-md-6 bank_details" style="display:none;">
               <div class="sb_m_o_log_in_set ">
                  <div class="sb_m_o_log_in_lbl">IFSC Code</div>
                  <input type="text" class="sb_m_o_log_in_input" name="bank_ifsc" id="bank_ifsc"  autocomplete="off">
               </div>
            </div>
         </div>
         <div class="row justify-content-center">
            <div class="col-12">
               <!-- <input type="submit" value="submit" name="submit" style="display: none;">                -->
               <button type="submit" class="sb_m_1_btn w-100 text-center continuecls">Continue</button>
               <!-- <input type="submit" class="sb_m_1_btn w-100 text-center continuecls" name="continue" value="Continue"> -->
               
               <!-- <a href="javascript:;" class="sb_m_1_btn w-100 text-center continuecls" name="continue">Continue</a> -->
            </div>
         </div>
      </div>
   </div>
</div>
<?php echo form_close();?>
</div>

</div>
<?php
$this->load->view('front/common/footer');
?>
<script>
  var base_url = '<?php echo base_url(); ?>';
  var front_url = '<?php echo front_url(); ?>';
  var currentURL = '<?php echo current_url(); ?>';
  $(function() {
   $(document).on('click, change', '#payment_method', function(e) {
      // e.preventDefault();
      let _this = $(this);
      let type = _this.val();
      // console.log(type);
      if (type == 2) {
       $('.bank_details').show();
       $('.paytm').hide();
    } else {
      $('.paytm').show();
       $('.bank_details').hide();
       
    }

 });

   $('#payment_method').trigger('change');


   $.validator.addMethod("greaterThan",
      function(value, element, param) {
        var $otherElement = $(param);
        return parseFloat(value, 10) > parseFloat($otherElement.val(), 10);
     });


$(document).on('click', '.continuecls', function(e){
      // e.preventDefault();
   $('#paymentform').validate({
      rules: {
         bank: {
          required: true
       },
       paytm: {
          required: true
       },
       bank_acc_name: {
          required: true
       },
       bank_acc_number: {
          required: true
       },    
       bank_ifsc: {
          required: true
       }      
    },        
   submitHandler: function(form) {

    // alert('test')
      var $form = $(form);
      form.submit();
      // return false;
      
      
   }

   });

   })


});
</script>
</body>
</html>