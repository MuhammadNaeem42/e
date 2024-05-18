<?php
$this->load->view('front/common/header');
?>
 <div class="sb_main_content sb_oth_main">
    <div class="container">
       <div class="row  justify-content-center" >
          <div class="col-md-6">
             <div class="sb_m_o_h1">Attention!</div>
             <div class="sb_m_common_pnl ">
                <div class=" sb_m_alert_pnl" >
                   You will have 15 minutes to pay the seller and click the I have paid seller 
                   button. If you pay seller but dont click I have paid seller within 15 minutes, 
                   we will refund the seller's Bitcoin and you will lose money.
                </div>
                <div class="row justify-content-center">
                   <div class="col-auto">
                      <a href="javascript:;" class="sb_m_1_btn agreecls">Agree</a>
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
<script>
   let baseURL = "<?php echo base_url(); ?>"
   let redirectURL = "<?php echo base_url('p2p_buyer_deposit/'.$trade_id_enc); ?>";
   let currentURL = "<?php echo current_url(); ?>";
   jQuery(document).ready(function($) {
      $(document).on('click', '.agreecls', function(e) {
         e.preventDefault();
         $.ajax({
         url: currentURL,
         type: 'POST',
         dataType: 'json',
         data: {'submit': "<?php echo uniqid(); ?>" },
         })
         .done(function(s) {
            console.log("success", s);
         })
         .fail(function(e) {
            console.log("error", e);
         })
         .always(function(response) {
            console.log("complete", response);

              if (response.status == false && response.code == '401') {
                        let removeRedirects = removeURLParameter(document.location.search, 'offer');
                        let here = "<?php echo base_url('signin') ?>" + removeRedirects + '&redirect=offer';
                        window.location.href = here;

                    } else if (response.status == false) {
                        window.location.reload(1);
                    } else if (response.status == true) {

                        <?php 
                        if($c = $this->input->get('c') && $f = $this->input->get('f')){  ?>
                            let c= "<?php echo $this->input->get('c'); ?>";
                            let f= "<?php echo $this->input->get('f'); ?>";
                            if(response.type == 'success'){
                                tata.success('Stormbit! ' + response.msg);                            
                            }else if(response.type == 'warn'){
                                tata.warn('Stormbit!', response.msg);    
                            }                            
                            setTimeout(function(){
                                console.log(response.type, response.msg, baseURL + 'p2p_buyer_deposit/' + response.redirect + '?c=' + c + '&f=' + f);
                                window.location.href = baseURL + 'p2p_buyer_deposit/' + response.redirect + '?c=' + c + '&f=' + f;},1000);
                        <?php }else{  ?>
                            if(response.type == 'success'){
                                tata.success('Stormbit! ' + response.msg);                            
                            }else if(response.type == 'warn'){
                                tata.warn('Stormbit!', response.msg);    
                            }
                            setTimeout(function(){
                                window.location.href = baseURL + 'p2p_buyer_deposit/' + response.redirect;},1000);
                        <?php } ?>

                    }
         });
      })
      
      
   });
</script>
</body>
</html>