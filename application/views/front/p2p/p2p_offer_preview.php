<?php
   $this->load->view('front/common/header');
   // echo "<pre>";print_r($p2p_trade);exit;
   ?>
         <div class="sb_main_content sb_oth_main">
            <div class="container">
               <div class="row  justify-content-center" >
                  <div class="col-md-8">
                     <div class="sb_m_o_h1"> Advertisement Preview</div>
                     <div class="sb_m_common_pnl ">
                        <div class="sb_m_np2_sel_settt ">
                           <div class="row ">
                              <div class="col-md-6">
                                 <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                                 <?php echo ($p2p_trade->actualtradebuy=='sell') ? 'Selling' : 'Buying' ?> From 
                                    </br>
                                    <span class=" spd_clr_orange2"><?php echo strtoupper(username($p2p_trade->user_id)); ?> </span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 ">
                                    Price </br>
                                    <span class="spd_clr_green"><?php echo (($p2p_trade->price));  echo  ' '.strtoupper(getfiatcurrency($p2p_trade->fiat_currency)); ?> </span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 ">
                                    Amount limits </br>
                                    <span class="spd_clr_green d-flex align-items-center">
                                       <div class="sb_m_np2_badg sb_m_np2_badg_green spd_fw_600 spd_fs_16 spd_mb_00 spd_ml_00"> <?php
                                       echo $p2p_trade->minimumtrade; echo ' ' .strtoupper(getfiatcurrency($p2p_trade->fiat_currency)); ?></div>
                                       &nbsp;-&nbsp;&nbsp;
                                       <div class="sb_m_np2_badg sb_m_np2_badg_green spd_fw_600 spd_fs_16 spd_mb_00 spd_ml_00"> <?php echo $p2p_trade->maximumtrade; echo ' ' .strtoupper(getfiatcurrency($p2p_trade->fiat_currency)); ?></div>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 ">
                                    Payment method </br>
                                    <span ><?php echo $payment_method->payment_name; ?> </span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 ">
                                    Location </br>
                                    <span ><?php echo get_countryname($p2p_trade->country); ?> </span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 ">
                                    Payment Timing </br>
                                    <span ><?php echo $p2p_trade->payment_window; ?> Minutes </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="spd spd_fs_16 spd_fw_400 spd_mt_10 spd_mb_30 spd_clr_orange">
                           Your  account needs to have <?=getfiatcurrency($p2p_trade->fiat_currency)?> for this
                           advertisement to show publicly.
                        </div>
                        <div class="row ">
                           <div class="col-md col-auto ">
                              <a href="<?php echo base_url('p2p_cancel/'.encryptIt($offer_id)); ?>" class="sb_m_2_btn sb_m_2_btn_red w-100 text-center spd_ml_00"><span>Cancel </span></a>
                           </div>
                           <div class="col-md col-auto ">
                              <a href="<?php echo base_url('update_offer/'.$offer_id); ?>" class="sb_m_2_btn  w-100 text-center spd_ml_00"><span>Edit </span></a>
                           </div>
                           <?php //if($p2p_trade->actualtradebuy == 'sell'){ ?>
                           <!-- <div class="col-md-6 col-4 ">
                              <a href="<?php //echo base_url('p2p_sell_deposit/'.$offer_id); ?>" class="sb_m_1_btn spd_ml_00 w-100 text-center">Deposit</a>
                           </div> -->
                           <?php //} ?>
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
   </body>
</html>