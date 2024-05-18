<?php
   $this->load->view('front/common/header');

$futureDate = time() + (60 * 30);
$getDateTime = date("F d, Y H:i:s", $futureDate);
   ?>
<div class="sb_main_content sb_oth_main">
   <div class="container">
      <div class="row  justify-content-center" >
         <div class="col-md-7 col-xxl-5">
            <div class="sb_m_o_h1"> Deposit Address</div>
            <div class="sb_m_common_pnl ">
               <div class="spd spd_fs_22 spd_fw_600 sb_m_np2_cpy_set">
                  Trade ref: 
                  <span class="sb_m_np2_cpy_txt">#<?php echo $tradeorderid_enc; ?></span>
                  <i class="fal fa-clipboard sb_m_np2_cpy_btn spd_fs_14"></i>
               </div>
               <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_07  spd_mt_20"> 
                  You are buying  <span class="sb_m_np2_badg sb_m_np2_badg_green">0.52 USDT</span> from <span class="spd_clr_orange2">Trader</span> Tether USDT of the
                  seller is already locked and secured for this trade. Please send
                  payment to the seller then confirm below.
               </div>
               <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 spd_mb_20 spd_mt_25"> 
                  Time left to pay  <span class="sb_m_np2_badg sb_m_np2_badg_light">
                     <!-- Display the countdown timer in an element -->
                        <p id="demo"></p></span>
               </div>
               <div class="sb_m_o_log_in_set">
                  <div class="sb_m_o_log_in_lbl">Network</div>
                  <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                  <select class="sb_m_o_log_in_input select_currency" id="select_currency">
                     <?php                      
                     if ($get_admin_wallet) {
                          foreach ($get_admin_wallet as $ckey => $cur) {                           
                      ?>
                              <option value="<?php echo $ckey; ?>">
                                  <?php echo $ckey; ?>
                              </option>
                      <?php
                          }
                      } ?>
                  </select>
               </div>
               <div class="spd spd_fs_16 spd_fw_600 spd_mb_10"> Note:</div>
               <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 spd_mb_30">
                  You have to deposit at least <span class="spd_clr_op_10 spd_fw_600">1 USDT</span> to be credited. Any deposit that is
                  less than <span class="spd_clr_op_10 spd_fw_600">1 USDT</span> will not be retunded
               </div>
               <div class="row">
                  <div class="col">
                     <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Deposit address</div>
                        <input type="text" class="sb_m_o_log_in_input sym_result" value="">
                     </div>
                  </div>
                  <div class="col-auto">
                     <a href="#" class="sb_m_o_forg_btn sb_m_2_btn"><span>Copy</span></a>
                  </div>
               </div>
               <div class="row justify-content-center">
                  <div class="col-auto ">
                     <div class="qr-img"></div>
                     <div class="spd spd_fs_16 spd_fw_400 spd_mt_10 spd_mb_30 spd_clr_op_08">
                        Scan to Deposit
                     </div>
                  </div>
               </div>
               <div class="spd spd_fs_16 spd_fw_400   sb_m_alert_pnl spd_mb_30"> 
                  When deposit time went out the trade will be cancelled. Any deposit comes after that will be credited to your account.
               </div>
               <a href="#" class="sb_m_2_btn  sb_m_2_btn_red  spd_ml_00"><span>Cancel </span></a>
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
   let baseURL = "<?php echo base_url(); ?>";    
    let currentURL = url = window.location.href;
    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo $getDateTime?"$getDateTime":''; ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
        minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);

   $(function() {      
      $(document).on('change', '#select_currency', function(event) {
         event.preventDefault();
         /* Act on the event */
         let _this = $(this);
         let sym = _this.val();
         $.ajax({
            url: baseURL +"get_address/",
                type: "POST",
                data: {"currency_symbol" : sym },
                success: function(data) {
                  var result = JSON.parse(data);                  
                  var imag = result.img;
                  // $(".coin").show();
                  $(".qr-img").html('<img src="'+imag+'" alt="" class="img-responsive">');
                  $(".sym_result").val(result.address);
                  // $("#mycur_name").html(myvar[0]);
                }
            });

      });

      $('#select_currency').trigger('change');
      
   });
         
</script>     
</body>
</html>