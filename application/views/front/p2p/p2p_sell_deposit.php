<?php
   $this->load->view('front/common/header');
   ?>
         <div class="sb_main_content sb_oth_main">
            <div class="container">
               <div class="row  justify-content-center" >
                  <div class="col-md-7 col-xxl-5">
                     <div class="sb_m_o_h1"> Deposit Coin</div>
                     <div class="sb_m_common_pnl ">
                        <div class="row">
                           <div class="col">
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
                           </div>
                           <div class="col-auto">
                              <a href="javascript:;" class="sb_m_o_forg_btn sb_m_2_btn select_currency_btn" id="select_currency_btn"><span>Submit</span></a>
                              <!-- <button class="sb_m_o_forg_btn sb_m_2_btn select_currency_btn"><span>Submit</span></button> -->
                           </div>
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
                           <div class="col-auto">
                            <div class="qr-img"></div>                              
                              <div class="spd spd_fs_16 spd_fw_400 spd_mt_10 spd_mb_30 spd_clr_op_08">
                                 Scan to Deposit
                              </div>
                           </div>
                        </div>
                        <a href="#" class="sb_m_2_btn  w-100 text-center spd_ml_00"><span>Transaction History </span></a>
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

   $(function() {      
      $(document).on('click', '#select_currency_btn', function(event) {
         event.preventDefault();
         /* Act on the event */
         let _this = $(this);
         let sym = $('#select_currency').val();
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

      // $('#select_currency_btn').trigger('click');
      
   });
         
</script>   
   </body>
</html>