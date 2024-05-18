<footer class="footer">
      <div class="container">
        <div class="footer__main">
          <div class="row">
            <div class="col-xl-4 col-md-8">
              <div class="info">
                <h6>Get Touch</h6>
                <ul class="list">
                  <li>
                    <p>+12 345 678 901</p>
                  </li>
                  <li>
                    <p>Info@demoproduct.Com</p>
                  </li>
                  <li>
                    <p>
                      Morbi condimentum justo sem, bibendum suscipit nisi luctus nec-96522
                    </p>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-4 col-md-4">
              <div class="widget-link s1">
                <h6 class="title text-uppercase">LINKS</h6>
                <ul>
                  <div class="row">
                    <div class="col-md-6">
                      <li class="jb_buycrypto_modal_tot_btn"><a href="#">Buy Crypto</a></li>
                      <li><a href="<?php echo base_url();?>cms/about-us">About</a></li>
                      <li><a href="<?php echo base_url();?>register">Register</a></li>
                      <li><a href="<?php echo base_url();?>signin">Sign In</a></li>
                    </div>
                    <div class="col-md-6">
                      <li><a href="<?php echo base_url();?>forgot_password">Forgot Password</a></li>
                      <li><a href="#">Markets</a></li>
                      <li><a href="#">Exchange</a></li>
                      <li><a href="<?php echo base_url();?>profile">Profile</a></li>
                    </div>
                  </div>
                </ul>
              </div>
            </div>
            <div class="col-xl-4 col-md-4">
              <div class="widget-link s3">
                <h6 class="title">LEARN</h6>
                <ul>
                  <div class="row">
                    <div class="col-md-6">
                      <li><a href="#">How To Buy Crypto?</a></li>
                      <li><a href="#">How To Sell Crypto ?</a></li>
                      <li><a href="<?php echo base_url();?>register">How To Register?</a></li>
                      <li><a href="<?php echo base_url();?>forgot_password">Forgot Password?</a></li>
                    </div>
                    <div class="col-md-6">
                      <li><a href="<?php echo base_url();?>cms/terms-and-conditions">Terms & Condition</a></li>
                      <li><a href="<?php echo base_url();?>cms/privacy-policy">Privacy Policy</a></li>
                      <li><a href="<?php echo base_url();?>faq">FAQ</a></li>
                      <li><a href="#">When I kokaotr?</a></li>
                    </div>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid bg">
        <div class="footer__bottom text-center">
          <p>Copyrights © 2023 All Rights Reserved</p>
        </div>
      </div>

      <div class="jb_buycrypto_modal_tot_out">
      <?php
        $fiat = get_all_currency_fiat();
        $crypto = get_all_currency_digital();
      ?>
      <style>
        .jb_buy_ct_wt_t1_ca_set .jb_depwith_dp_cyrp2 .jb_log_in_input {
          border-radius: 5px 5px 5px 5px;
          border-left-color: #ccc;

        }
        .sell_upload .jb_supo_exp_ch_btm {
          position: relative;
        }
        .sell_upload .jb_supo_exp_ch_btm .jb_supo_exp_ch_text_fil {
          right: 25px;
        }
      </style>
        <div class="jb_buycrypto_modal">
      <div class="jb_buycrypto_modal_in">
        <div class="jb_buycrypto_modal_hdr">  <i class="fal fa-times jb_buycrypto_modal_cls"></i></div>
        <div class="jb_buycrypto_modal_in_scrl">
          <div class="jb_buycrypto_modal_tabs jb_bctomt_1 jb_buycrypto_modal_tab_act">
            <div class="jb_buy_ct_wt_out">
              <!-- <div class="jb_buy_ct_wt_tab_head_set">
                <div class="jb_buy_ct_wt_tab_head jb_buy_ct_wt_tab_head-1 jb_buy_ct_wt_tab_head_act">Buy</div>
                <div class="jb_buy_ct_wt_tab_head jb_buy_ct_wt_tab_head-2">Sell</div>
              </div> -->
              <div class="jb_buy_ct_wt_tab_body_set jb_buy_ct_wt_tab_body_set_act scmpwc-1">
                <?php if(empty($user_id)) { ?>
                  <!-- <div class="jb_font_s_20 jb_font_w_500 jb_hmkl_txt_red text-center">Login Your Blackcube Account</div> -->
                <?php } ?>
                <div class="jb_buy_ct_wt_inp_set lin_box">
                  <form id="buy_form">
                    <div class="jb_buy_ct_wt_inp_lbl">Spend</div>
                    <input type="number" class="jb_buy_ct_wt_inp_input" id="spend_sell" name="spend_sell" onkeyup="myFunctiontwo()" >
                    <span class="jb_log_in_err_msg" id="spend_sell_error" ></span>
                    <div class="jb_buy_ct_wt_coin_set" id="spend_fiat">
                      <img src="<?php echo $fiat[0]->image;?>" class="jb_buy_ct_wt_coin_img spend_img">
                      <div class="jb_buy_ct_wt_coin_lbl"><?php echo $fiat[0]->currency_symbol; ?></div>
                      <i class="fal fa-chevron-right jb_buy_ct_wt_coin_lbl_i"></i>
                      <span class="jb_log_in_err_msg" id="buy_balance" style="color: blue;"></span>
                    </div>
                    <div class="jb_buy_ct_wt_coin_total_set">
                      <div class="jb_buy_ct_wt_coin_total_set_in">
                        <div class="jb_buy_ct_wt_coin_total_set_center">
                          <div class="jb_buy_ct_wt_coin_total_set_top">Select Currency <i class="fal fa-times"></i></div>
                          <div class="jb_buy_ct_wt_coin_total_set_body">
                            <input type="text" class="jb_buy_ct_wt_coin_total_set_body_inp" placeholder="Search Coin Here">
                          </div>
                          <div class="jb_buy_ct_wt_coin_total_set_body_scrl">
                            <?php
                            if(count($fiat) > 0)
                            {
                              foreach ($fiat as $currency) 
                              { ?>
                                <div class="jb_buy_ct_wt_coin_total_set_li spend">
                                  <img src="<?php echo $currency->image;?>" class="jb_buy_ct_wt_coin_total_set_li_img">
                                  <div class="jb_buy_ct_wt_coin_total_set_li_1"><?php echo $currency->currency_symbol; ?></div>
                                  <div class="jb_buy_ct_wt_coin_total_set_li_2"><?php echo $currency->currency_name; ?> </div>
                                </div>
                              <?php }
                            } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>


                <div class="jb_buy_ct_wt_inp_set1">
                  <button class="jb_buy_ct_wt_btm_anchor jb_bctomt_btn_2 jb_bctomt_btn_2_swap" > SWAP </button>
                </div>

                <div class="jb_buy_ct_wt_inp_set">
                  <div class="jb_buy_ct_wt_inp_lbl">Receive</div>
                  <!-- <div class="jb_buy_ct_wt_inp_lbl_rht">Estimated Discount : 1900</div> -->
                  <input type="number" class="jb_buy_ct_wt_inp_input" id="receive_sell"  >
                  <div class="jb_buy_ct_wt_coin_set" id="receive_crypto">
                    <img src="<?php echo $crypto[0]->image;?>" class="jb_buy_ct_wt_coin_img receive_img">
                    <div class="jb_buy_ct_wt_coin_lbl"><?php echo $crypto[0]->currency_symbol;?></div>
                    <i class="fal fa-chevron-right jb_buy_ct_wt_coin_lbl_i"></i>
                  </div>
                  <div class="jb_buy_ct_wt_coin_total_set">
                    <div class="jb_buy_ct_wt_coin_total_set_in">
                      <div class="jb_buy_ct_wt_coin_total_set_center">
                        <div class="jb_buy_ct_wt_coin_total_set_top">Select Currency <i class="fal fa-times"></i></div>
                        <div class="jb_buy_ct_wt_coin_total_set_body">
                          <input type="text" class="jb_buy_ct_wt_coin_total_set_body_inp" placeholder="Search Coin Here">
                        </div>
                        <div class="jb_buy_ct_wt_coin_total_set_body_scrl">
                          <?php
                          if(count($crypto) > 0)
                          {
                            foreach ($crypto as $currency) 
                            { ?>
                              <div class="jb_buy_ct_wt_coin_total_set_li receive">
                                <img src="<?php echo $currency->image;?>" class="jb_buy_ct_wt_coin_total_set_li_img">
                                <div class="jb_buy_ct_wt_coin_total_set_li_1"><?php echo $currency->currency_symbol; ?></div>
                                <div class="jb_buy_ct_wt_coin_total_set_li_2"><?php echo $currency->currency_name; ?> </div>
                              </div>
                            <?php }
                          } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- <div class="jb_buy_ct_wt_inp_set">
                  <div class="jb_buy_ct_wt_inp_lbl">Receive Address</div>
                  <div class="jb_buy_ct_wt_inp_lbl_rht">Estimated Discount : 1900</div>  style="color:red;"
                  <input type="text" class="jb_buy_ct_wt_inp_input" id="receive_address">                  
                  <span class="jb_log_in_err_msg" id="receive_address_error" ></span>
                </div> -->

                <div class="jb_buy_ct_wt_btm_h1">Estimated Price : 1 <span  id="currenct_first_coin"></span> = <span id="currenct_one"> </span> <span  id="currenct_second_coin"></span></div>
                <?php if(empty($user_id)) { ?>
                  <a href="<?php echo base_url();?>signin" class="jb_buy_ct_wt_btm_anchor jb_bctomt_btn_2" id="buy_submit">Sign In</a>
                <?php } else {  ?>
                  <a href="#" class="jb_buy_ct_wt_btm_anchor jb_bctomt_btn_2" id="buy_submit" onclick="buynow()">Buy Now</a>
                <?php } ?>
              </div>

              
            </div>
          </div>
          <div class="jb_buycrypto_modal_tabs jb_bctomt_2 sell">
            <div class="jb_buy_ct_wt_out">
              <div class="jb_buy_ct_wt_t1_h1">Debit / Credit Card</div>
              <div class="jb_buy_ct_wt_t1_p">1 <span class="spend_one" id="spend_one"></span> - <span class="spend_value"></span> <span class="spend_two" id="spend_two"></span></div>
              <!-- <div class="jb_buy_ct_wt_t1_p">Receive Address  - <span id="receive_address_pay"></span></div> -->
              <div class="jb_buy_ct_wt_t1_hset rece_address">
                <div class="row">
                  <div class="col-12">
                    <div class="jb_buy_ct_wt_t1_h_h1">Receive Address</div>
                    <!-- <div class="jb_buy_ct_wt_inp_lbl_rht">Estimated Discount : 1900</div> -->
                    <div class="jb_buy_ct_wt_t1_h_h2"><span id="receive_address_pay"></span></div>
                  </div>
                </div>
              </div>
              <div class="jb_buy_ct_wt_t1_hset">
                <i class="fal fa-arrow-right jb_buy_ct_wt_t1_h_arw_ico"></i>
                <div class="row">
                  <div class="col-6">
                    <div class="jb_buy_ct_wt_t1_h_h1"><img src="<?php echo front_img();?>aico-1.png" class="jb_buy_ct_wt_t1_h_img spend_currency_img">&nbsp;&nbsp;Spend</div>
                    <div class="jb_buy_ct_wt_t1_h_h2"><span id="spend_currency_pay"></span> <span class="spend_one"></span></div>
                  </div>
                  <div class="col-6 text-end">
                    <div class="jb_buy_ct_wt_t1_h_h1">Receive&nbsp;&nbsp;<img src="<?php echo front_img();?>aico-1.png" class="jb_buy_ct_wt_t1_h_img receive_currency_img"></div>
                    <div class="jb_buy_ct_wt_t1_h_h2"><span id="receive_currency_pay"></span> <span class="spend_two"></span></div>
                  </div>
                </div>
              </div>
              <div class="user_address">
                <div class="jb_buy_ct_wt_t1_h2">Visa / Master Card</div>
                <div class="jb_buy_ct_wt_t1_ca_set_out">
                  <!-- <div class="jb_buy_ct_wt_t1_ca_set">
                    <div class="jb_buy_ct_wt_t1_ca_h1">JAB card</div>
                    <div class="jb_buy_ct_wt_t1_ca_h2">1234 5678 9101 1213</div>
                    <i class="fal fa-check jb_buy_ct_wt_t1_ca_btn jb_bctomt_btn_3"></i>
                  </div> -->
                  <!-- <div class="jb_buy_ct_wt_t1_ca_set" onclick="paypal_enable()"> -->
                  <div class="jb_buy_ct_wt_t1_ca_set" onclick="confirm_order()">
                    <form method='post' id="paypal_form" action='<?= base_url(); ?>paypal'>
                      <input type='hidden' name='spend_currency' class='spend_currency'>
                      <input type='hidden' name='receive_currency' class='receive_currency'>
                      <input type='hidden' name='receive_address' class='receive_address'>
                      <input type='hidden' name='currenct_one' class='currenct_one'>
                      <input type='hidden' name='spend' class='spend'>
                      <input type='hidden' name='receive' class='receive'>
                      <input type='hidden' name='userid' class='userid'>
                    </form>
                    <!-- <a href="<?php echo base_url();?>paypal" class="jb_buy_ct_wt_t1_ca_set"> -->
                    <div class="jb_buy_ct_wt_t1_ca_h1">Paypal</div>
                    <div class="jb_buy_ct_wt_t1_ca_h2">Pay via paypal payment</div>
                    <i class="fal fa-check jb_buy_ct_wt_t1_ca_btn jb_bctomt_btn_3"></i>
                    <!-- </a> -->
                  </div>
                  <!-- <div class="jb_buy_ct_wt_t1_ca_set">
                    <img class="jb_buy_ct_wt_t1_ca_img_ico" src="<?php echo front_img();?>cryp-ico-1.png">
                    <img class="jb_buy_ct_wt_t1_ca_img_ico" src="<?php echo front_img();?>cryp-ico-2.png">
                    <i class="fal fa-plus jb_buy_ct_wt_t1_ca_btn jb_bctomt_btn_5"></i>
                  </div> -->
                </div>
              </div>
              <div class="admin_address">
                <div class="jb_buy_ct_wt_t1_h2">Deposit Address</div>
                <div class="jb_buy_ct_wt_t1_ca_set_out">
                  <div class="jb_buy_ct_wt_t1_ca_set ">
                      <div class="jb_buy_ct_wt_t1_ca_h1 jb_font_w_500 text-center jb_marg_b_15">For <span class="spend_one"></span> Deposit Only</div>
                      <img src="" class="jb_depwith_dp_qr" id="crypto_img" >
                      <br>
                      <div class = "jb_log_in_set jb_depwith_dp_cyrp2">
                        <i class="fal fa-copy jb_log_in_ico jb_buy_ct_wt_t1_ca_btn " style="top:10px" onClick="copy_function()"></i>
                        <input type="text" class="jb_log_in_input" id="crypto_address" readonly>
                      </div>
                      <span class="copy_but jb_buy_ct_wt_t1_ca_h2" id="inputGroup-sizing-sm"></span>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-6">
                  <div class="jb_buy_ct_wt_t2_btn jb_buy_ct_wt_t2_btn_gray jb_bctomt_btn_1">Previous</div>
                </div>
                <div class="col-6 nxt">
                  <div class="jb_buy_ct_wt_t2_btn jb_bctomt_btn_3" onclick="confirm_order_sell()">Next</div>
                </div>
              </div>
            </div>
          </div>
          <div class="jb_buycrypto_modal_tabs jb_bctomt_3">
            <div class="jb_buy_ct_wt_out">
              <div class="jb_buy_ct_wt_t1_h1">Confirm Order</div>
              <div class="jb_buy_ct_wt_t1_hset">
                <i class="fal fa-arrow-right jb_buy_ct_wt_t1_h_arw_ico"></i>
                <div class="row">
                  <div class="col-6">
                    <div class="jb_buy_ct_wt_t1_h_h1"><img src="<?php echo front_img();?>aico-1.png" class="jb_buy_ct_wt_t1_h_img spend_currency_img">&nbsp;&nbsp;Spend</div>
                    <div class="jb_buy_ct_wt_t1_h_h2"><span id="spend_currency_pay_cnf"></span> <span class="spend_one_cnf"></span></div>
                  </div>
                  <div class="col-6 text-end">
                    <div class="jb_buy_ct_wt_t1_h_h1">Receive&nbsp;&nbsp;<img src="<?php echo front_img();?>aico-1.png" class="jb_buy_ct_wt_t1_h_img receive_currency_img"></div>
                    <div class="jb_buy_ct_wt_t1_h_h2"><span id="receive_currency_pay_cnf"></span> <span class="spend_two_cnf"></span></div>
                  </div>
                </div>
              </div>
              <div class="jb_buy_ct_wt_t2_li pay_type">
                Pay With
                <div class="jb_buy_ct_wt_t2_li_rht"> <span class="pay_with"></span> </div>
              </div>
              <div class="jb_buy_ct_wt_t2_li sell_upload">
                <form method='post' id="sell_form" action='<?= base_url(); ?>sellcrypto' enctype="multipart/form-data" >
                  <input type='hidden' name='spend_currency' class='spend_currency'>
                  <input type='hidden' name='receive_currency' class='receive_currency'>
                  <input type='hidden' name='receive_address' class='receive_address'>
                  <input type='hidden' name='currenct_one' class='currenct_one'>
                  <input type='hidden' name='spend' class='spend'>
                  <input type='hidden' name='receive' class='receive'>
                  <input type='hidden' name='userid' class='userid'>
                  <div class="jb_supo_exp_ch_btm">
                    <input type="text" name="message" id="message" data-emoji-input="unicode" class="jb_supo_exp_ch_text" placeholder="Enter transaction details or upload">
                    <i class="fal fa-file jb_supo_exp_ch_text_fil"></i>
                    <input type="file" class="jb_supo_exp_ch_text_fil_in" id="imageUpload2" name="image">
                    <label id="img_error" class="error" style="color:red"></label>
                  </div>
                  <!-- <label id="img_error" class="error"></label> -->
                  <img id="support_img" src="" alt="Support Img" style="display: none;" class="jb_depwith_dp_qr img-fluid mb-6 proof_img"><label style="color: #ffffff;" id="image_name">
                </form>
              </div>
              <div class="jb_buy_ct_wt_t2_li">
                Price
                <div class="jb_buy_ct_wt_t2_li_rht"> 1 <span class="spend_one" id="spend_one"></span> ~ <span class="spend_value"></span> <span class="spend_two" id="spend_two"></span> </div>
                <!-- <div class="jb_buy_ct_wt_t2_li_rht"> 1 BTC ~ 9,656 EUR </div> -->
              </div>
              <div class="jb_buy_ct_wt_t2_li">
                Fees
                <div class="jb_buy_ct_wt_t2_li_rht"> 0 <span class="spend_one_cnf"></span>  </div>
              </div>
              <div class="jb_buy_ct_wt_t2_li">
                Total 
                <div class="jb_buy_ct_wt_t2_li_rht"> <span id="payable"></span> <span class="spend_one_cnf"></span></div>
                <!-- <div class="jb_buy_ct_wt_t2_li_rht"> 1,000 EUR </div> -->
              </div>
              <div class="row justify-content-center">
                <div class="col-6">
                  <div class="jb_buy_ct_wt_t2_btn jb_buy_ct_wt_t2_btn_gray jb_bctomt_btn_2_prev">Previous</div>
                </div>
                <div class="col-6">
                  <div class="jb_buy_ct_wt_t2_btn jb_bctomt_btn_4" onclick="paynow()">Confirm</div>
                </div>
              </div>
            </div>
          </div>
          <div class="jb_buycrypto_modal_tabs jb_bctomt_4">
            <div class="jb_buy_ct_wt_out">
              <video src="<?php echo front_img();?>success-vid.mp4" class="jb_buy_ct_wt_repo_stat_img" muted autoplay ></video>
              <div class="jb_buy_ct_wt_t1_h1">Transaction Successfull</div>
              <div class="jb_buy_ct_wt_repo_stat_p">200 EUR order submitted, View History to view your order status</div>
              <div class="row justify-content-center">
                <div class="col-12">
                  <div class="jb_buy_ct_wt_t2_btn jb_buy_ct_wt_t2_btn_gray">View History</div>
                </div>
              </div>
            </div>
          </div>
          <div class="jb_buycrypto_modal_tabs jb_bctomt_5">
            <div class="jb_buy_ct_new_modal_pane_cnt_bdy">
              <div>
                <div class="jb_buy_ct_new_modal_pane_cnt_h2">Fill Card Details</div>
                <div class="row">
                  <div class="col-12">
                    <div class="jb_buy_ct_new_modal_pane_inpset">
                      <div class="jb_buy_ct_new_modal_pane_inp_lbl">Card Name</div>
                      <input type="text" class="jb_buy_ct_new_modal_pane_inp_ut">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="jb_buy_ct_new_modal_pane_inpset">
                      <div class="jb_buy_ct_new_modal_pane_inp_lbl">Card Number</div>
                      <input type="text" class="jb_buy_ct_new_modal_pane_inp_ut">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="jb_buy_ct_new_modal_pane_inpset">
                      <div class="jb_buy_ct_new_modal_pane_inp_lbl">Expiry Date</div>
                      <input type="text" class="jb_buy_ct_new_modal_pane_inp_ut">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="jb_buy_ct_new_modal_pane_inpset jb_buy_ct_new_inpset_vldr_failed">
                      <div class="jb_buy_ct_new_modal_pane_inp_lbl">CVV</div>
                      <input type="text" class="jb_buy_ct_new_modal_pane_inp_ut">
                    </div>
                  </div>
                </div>
              </div>
              <div >
                <div class="jb_buy_ct_new_modal_pane_cnt_h2">Fill Card Billing Address</div>
                <div class="row">
                  <div class="col-12">
                    <div class="jb_buy_ct_new_modal_pane_inpset">
                      <div class="jb_buy_ct_new_modal_pane_inp_lbl">Country</div>
                      <select class="jb_buy_ct_new_modal_pane_inp_ut">
                        <option value="0"></option>
                        <option value="0">India</option>
                        <option value="0">Canada</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="jb_buy_ct_new_modal_pane_inpset">
                      <div class="jb_buy_ct_new_modal_pane_inp_lbl">Address</div>
                      <input type="text" class="jb_buy_ct_new_modal_pane_inp_ut">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="jb_buy_ct_new_modal_pane_inpset">
                      <div class="jb_buy_ct_new_modal_pane_inp_lbl">City</div>
                      <input type="text" class="jb_buy_ct_new_modal_pane_inp_ut">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="jb_buy_ct_new_modal_pane_inpset">
                      <div class="jb_buy_ct_new_modal_pane_inp_lbl">Postal Code</div>
                      <input type="text" class="jb_buy_ct_new_modal_pane_inp_ut">
                    </div>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-6">
                    <div class="jb_buy_ct_wt_t2_btn jb_buy_ct_wt_t2_btn_gray jb_bctomt_btn_2">Previous</div>
                  </div>
                  <div class="col-6">
                    <div class="jb_buy_ct_wt_t2_btn jb_bctomt_btn_2" >Submit</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
    </footer>
    <script src="<?php echo front_js();?>aos.js"></script>
    <!-- <script src="<?php echo front_js();?>jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="<?php echo front_js();?>jquery.easing.js"></script>
    <script src="<?php echo front_js();?>popper.min.js"></script>
    <script src="<?php echo front_js();?>bootstrap.min.js"></script>
    <script src="<?php echo front_js();?>jquery.peity.min.js"></script>
    <script src="<?php echo front_js();?>Chart.bundle.min.js"></script>
    <script src="<?php echo front_js();?>apexcharts.js"></script>
    <script src="<?php echo front_js();?>switchmode.js"></script>
    <!-- <script src="<?php echo front_js();?>chart.js"></script> -->
    <!-- Swiper JS -->
    <script src="<?php echo front_js();?>swiper-bundle.min.js"></script>
    <script src="<?php echo front_js();?>swiper.js"></script>
    <script src="<?php echo front_js();?>app.js"></script>

    <!-- Wallet Chart -->
    <script src="<?php echo front_js();?>raphael-min.js"></script>
    <script src="<?php echo front_js();?>morris.min.js"></script>
    
    <!-- datepicker JS -->
    <script src="<?php echo front_js();?>datepickerpluigin.js"></script>
    <script src="<?php echo front_js();?>datepicker.js"></script>

    <script src="<?php echo front_js();?>tata.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>    
    

<script>
    $(document).ready(function(){
    
    $(".jb_buy_ct_wt_coin_total_set_body_inp").on("keyup", function() {
    var value = $(this).val().toLowerCase();
      
      $(this).closest(".jb_buy_ct_wt_coin_total_set_center").find(".jb_buy_ct_wt_coin_total_set_li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    });
  }); 

  function myFunctionOne() {
    var api = "4891c73c50ace720f748d26213d03ec07879ed02780338cbaff0cfb43395a718";

    var spend = $("#spend_buy").val();
    var spend_currency = $('#spend_crypto .jb_buy_ct_wt_coin_lbl').text();

    var receive = $("#receive_buy").val();
    var receive_currency = $('#receive_fiat .jb_buy_ct_wt_coin_lbl').text();
    // alert(spend);
    // alert(spend_currency);
    if($.isNumeric(spend) && parseFloat(spend) > 0) {  
      $("#spend_buy_error").text('');
      var post_data = {
        coinname    : spend_currency,
        amount      : spend
      };
      $.ajax({
        url: front_url+"user_balance_check", 
        type: "POST",
        data: post_data,
        success: function(data) {
          var res = jQuery.parseJSON(data);
          $("#sell_balance").text("Your Balance: "+res.user_balance);
          if(res.error) {
            $("#spend_buy_error").text(res.error);
            $("#spend_buy").val("");
            $('#receive_buy').val("");
            // console.log(data);
          }
          else {
            // https://api.coinconvert.net/convert/NZD/BTC?amount=3
            // console.log('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+spend_currency+'&tsyms='+receive_currency);
            $.getJSON('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+spend_currency+'&tsyms='+receive_currency+'&api_key='+api, 
            function(data) {
              $.each(data, function (cur, rate) {
                obj = Object.entries(rate);
                current = obj[0][1];
                var update = spend * current;
                if($.isNumeric(update)) {
                  $('#receive_buy').val(update.toFixed(2));
                }
                else {
                  $('#receive_buy').val(0);
                }
                $("#currenct_first_coin_buy").text(spend_currency);  
                $("#currenct_second_coin_buy").text(receive_currency);  
                if($.isNumeric(current)) {
                  $('#currenct_one_buy').text(current);
                }
                else {
                  $('#currenct_one_buy').text(0);
                }
                // $("#currenct_one_buy").text(current);   
                // alert(current);
              });
            });
          }
        }
      });
    }
    else {
      $('#receive_buy').val("");
      $("#sell_balance").text("");
      $("#spend_buy_error").text('Please enter valid number');
    }
  }

  function myFunctiontwo() {

  }

  function myFunctiontwo_old() {
    var api = "4891c73c50ace720f748d26213d03ec07879ed02780338cbaff0cfb43395a718";
    var spend = $("#spend_sell").val();
    var regExp = "^\\d+$";
    // alert(spend.match(regExp));
    var spend_currency = $('#spend_fiat .jb_buy_ct_wt_coin_lbl').text();
    var receive = $("#receive_sell").val();
    var receive_currency = $('#receive_crypto .jb_buy_ct_wt_coin_lbl').text();
    $(".validationMessage").remove();
    // alert($.isNumeric(spend));
    // alert(spend_currency);
    if($.isNumeric(spend) && spend.match(regExp) && spend > 0) {      
      $("#spend_sell_error").text('');
      // console.log('https://api.coinconvert.net/convert/'+spend_currency+'/'+receive_currency+'?amount='+spend);
      // console.log('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+spend_currency+'&tsyms='+receive_currency+'&api_key='+api);
      // $.getJSON('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+spend_currency+'&tsyms='+receive_currency+'&api_key='+api, 
      // function(data) {
      //   $.each(data, function (cur, rate) {
      //     obj = Object.entries(rate);
      //     // console.log(obj);
      //     current = obj[0][1];
      //     var update = spend * current;
      //     // $("#currenct_one").text(current);   
      //     // alert(current);
      //   });
      // });
      // $ajax_Res = ajax_check_bln(spend_currency,spend);
      // console.log($ajax_Res);
      var post_data = {
        coinname    : spend_currency,
        amount      : spend
      };
      $.ajax({
        url: front_url+"user_balance_check", 
        type: "POST",
        data: post_data,
        success: function(data) {
          var res = jQuery.parseJSON(data);
          $("#buy_balance").text("Your Balance: "+res.user_balance);   
          if(res.error) {
            $("#spend_sell_error").text(res.error);
            $("#spend_sell").val("");
            $('#receive_sell').val("");
            // console.log(data);
          }
          else {
            $.getJSON('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+spend_currency+'&tsyms='+receive_currency+'&api_key='+api, 
            function(data) {
              $.each(data, function (cur, rate) {
                obj = Object.entries(rate);
                // console.log(obj);
                current = obj[0][1];
                var update = spend * current;
                // $("#currenct_one").text(current);   
                // alert(current);
                
                if($.isNumeric(update)) {
                  $('#receive_sell').val(update.toFixed(8));
                }
                else {
                  $('#receive_sell').val(0);
                }
                $("#currenct_first_coin").text(spend_currency);  
                $("#currenct_second_coin").text(receive_currency);  
                if($.isNumeric(current)) {
                  $('#currenct_one').text(current);
                }
                else {
                  $('#currenct_one').text(0);
                }
              });
            });
          }
        }
      });
    }
    else {
      $('#receive_sell').val("");
      $("#buy_balance").text("");
      $("#spend_sell_error").text('Please enter valid amount');
    }
  }

  // function ajax_check_bln(spend_currency,spend) {
  //   var post_data = {
  //     coinname    : spend_currency,
  //     amount      : spend
  //   };
  //   $.ajax({
  //     url: front_url+"user_balance_check", 
  //     type: "POST",
  //     data: post_data,
  //     success: function(data) {
  //       var res = jQuery.parseJSON(data);
  //       console.log(data);
  //     }
  //   });
  // }

  function buynow() {
    var userid = <?php echo !empty($user_id) ? $user_id : '0' ?>;
    if(userid > 0) {
      
    } else {
      
      
    }
  }
  
  function copy_function() {
    var copyText = document.getElementById("crypto_address");
    copyText.select();
    document.execCommand("copy");
    tata.info('JAB! ','Copied');
    $('.copy_but').html('Copied');
  } 

  function confirm_order_sell() {
    // confirm_order();
    var userid = <?php echo !empty($user_id) ? $user_id : '0' ?>;
    var spend = $("#spend_buy").val();
    var spend_currency = $('#spend_crypto .jb_buy_ct_wt_coin_lbl').text();
    var receive = $("#receive_buy").val();
    var receive_currency = $('#receive_fiat .jb_buy_ct_wt_coin_lbl').text();
    var currenct_one = $(".spend_value").text(); 
    var spend_coinimg = $(".spend_img_sell").attr("src");
    var receive_coinimg = $(".receive_img_sell").attr("src"); 
    var receive_address = $("#crypto_address").val();

    $(".pay_type").hide();
    $(".sell_upload").show();
    $(".spend_one_cnf").text(spend_currency);
    $(".spend_two_cnf").text(receive_currency);
    $(".spend_value_cnf").text(currenct_one);
    $("#spend_currency_pay_cnf").text(spend);
    $("#payable").text(spend);
    $("#receive_currency_pay_cnf").text(receive);
    $(".pay_with").text("Sell");

    $(".spend_currency").val(spend_currency);
    $(".receive_currency").val(receive_currency);
    $(".receive_address").val(receive_address);
    $(".currenct_one").val(currenct_one);
    $(".spend").val(spend);
    $(".receive").val(receive);
    $(".userid").val(userid);

  }
  function confirm_order() {
    var spend_currency = $("#spend_one").text();  
    var receive_currency = $("#spend_two").text();  
    var currenct_one = $(".spend_value").text();   
    var spend = $("#spend_currency_pay").text(); 
    var receive = $("#receive_currency_pay").text(); 
    var receive_address = $("#receive_address_pay").text();
    var spend_coinimg = $(".spend_currency_img").attr("src");  
    var receive_coinimg = $(".receive_currency_img").attr("src");  
    
    $(".sell_upload").hide();
    $(".pay_type").show();
    $(".rece_address").show();
    $(".pay_with").text("Paypal");
    $(".spend_one_cnf").text(spend_currency);
    $(".spend_two_cnf").text(receive_currency);
    $(".spend_value_cnf").text(currenct_one);
    $("#spend_currency_pay_cnf").text(spend);
    $("#payable").text(spend);
    $("#receive_currency_pay_cnf").text(receive);
  }

  

  function paynow() {
    var pay_type = $(".pay_with").text();
    if(pay_type == "Paypal") {
      paypal_enable();
    }
    if(pay_type == "Sell") {
      if(!$('input[type="file"]').val() && !$("#message").val()) {
        alert('No file is uploaded, do not submit.');
        // No file is uploaded, do not submit.
        $("#img_error").html("Please enter proof of transaction");
        return false;
      }
      else {
        $("#img_error").html("");
        $("#sell_form").submit();
      }
    }
  }


  function paypal_enable() {
    var userid = <?php echo !empty($user_id) ? $user_id : '0' ?>;
    if(userid > 0) {
      var spend_currency = $("#spend_one").text();  
      var receive_currency = $("#spend_two").text();  
      var currenct_one = $(".spend_value").text();   
      var spend = $("#spend_currency_pay").text(); 
      var receive = $("#receive_currency_pay").text(); 
      var receive_address = $("#receive_address_pay").text();
      $(".spend_currency").val(spend_currency);
      $(".receive_currency").val(receive_currency);
      $(".receive_address").val(receive_address);
      $(".currenct_one").val(currenct_one);
      $(".spend").val(spend);
      $(".receive").val(receive);
      $(".userid").val(userid);
      $("#paypal_form").submit();
    }
    else {
      var error = "Login your jab account";
      tata.warn('JAB!', error);
    }
  }
  $("#imageUpload2").change(function() {
    readURL4(this);
  });


  function readURL4(input) {
    if (input.files && input.files[0]) {
      var file = input.files[0];
      var fileType = file["type"];
      var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
      var fileSize=(input.files[0].size);
      if(fileSize > 2000000) {
        $("#img_error").html("File size must be less than 2MB.");
        $("#imageUpload2").val("");
      };
      if ($.inArray(fileType, validImageTypes) < 0) {
        // invalid file type code goes here.
        $("#img_error").html("Wrong extension type.");
        // alert("Wrong extension type.");
        $("#imageUpload2").val("");
        // $('#submit_btn').prop('disabled');
      }
      var reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById("support_img").style.display = "block";
        $('#support_img').attr('src', e.target.result);
        $("#img_error").html("");
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }


</script>
<script>
  $( "body" ).delegate( ".receive", "click", function() {
    var api = "4891c73c50ace720f748d26213d03ec07879ed02780338cbaff0cfb43395a718";

    var coinname = $(this).find(".jb_buy_ct_wt_coin_total_set_li_1").text();
    var coinimg = $(this).find(".jb_buy_ct_wt_coin_total_set_li_img").attr("src");

    var spend = $("#spend_sell").val();
    var spend_currency = $('#spend_fiat .jb_buy_ct_wt_coin_lbl').text();
    var regExp = "^\\d+$";
    $(".validationMessage").remove();

    var spend_sell = $("#spend_buy").val();
    var spend_currency_sell = $('#spend_crypto .jb_buy_ct_wt_coin_lbl').text();
    if($.isNumeric(spend) && spend.match(regExp) && spend > 0) {
      $.getJSON('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+spend_currency+'&tsyms='+coinname+'&api_key='+api, 
      function(data) {
        $.each(data, function (cur, rate) {
          obj = Object.entries(rate);
          current = obj[0][1];
          var update = spend * current;
          var sell_update = spend_sell * current;
          
          if($.isNumeric(update)) {
            $('#receive_sell').val(update.toFixed(8));
          }
          else {
            $('#receive_sell').val(0);
          }
          if($.isNumeric(sell_update)) {
            $('#receive_buy').val(sell_update.toFixed(2));
          }
          else {
            $('#receive_buy').val(0);
          }

          $("#currenct_first_coin").text(spend_currency);  
          $("#currenct_second_coin").text(coinname);  
          if($.isNumeric(current)) {
            $('#currenct_one').text(current);
          }
          else {
            $('#currenct_one').text(0);
          }
          // $("#currenct_one").text(current);   

          
          $("#currenct_first_coin_buy").text(spend_currency_sell);  
          $("#currenct_second_coin_buy").text(coinname);  
          if($.isNumeric(current)) {
            $('#currenct_one_buy').text(current);
          }
          else {
            $('#currenct_one_buy').text(0);
          }
          // $("#currenct_one_buy").text(current);   
          // alert(current);
        });
      });
    }   
    else {
      $("#spend_sell").val("");
      $('#receive_sell').val("");
      $("#buy_balance").text("");
      $("#spend_sell_error").text('Please enter valid amount');
    }
      

    $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_lbl").text(coinname);
    $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_img").attr("src", coinimg);
    $(this).closest(".jb_buy_ct_wt_coin_total_set").hide();
    
  });
  
  $( "body" ).delegate( ".spend", "click", function() {
    var api = "4891c73c50ace720f748d26213d03ec07879ed02780338cbaff0cfb43395a718";

    var coinname = $(this).find(".jb_buy_ct_wt_coin_total_set_li_1").text();
    var coinimg = $(this).find(".jb_buy_ct_wt_coin_total_set_li_img").attr("src");

    var spend = $("#spend_sell").val();
    var regExp = "^\\d+$";

    var receive_currency = $('#receive_crypto .jb_buy_ct_wt_coin_lbl').text();

    var spend_sell = $("#spend_buy").val();
    $(".validationMessage").remove();
    var receive_currency_sell = $('#receive_fiat .jb_buy_ct_wt_coin_lbl').text();

    var post_data = {
      coinname    : coinname,
      amount      : spend
    };
    if($.isNumeric(spend) && spend.match(regExp) && spend > 0) {
      $.ajax({
        url: front_url+"user_balance_check", 
        type: "POST",
        data: post_data,
        success: function(data) {
          var res = jQuery.parseJSON(data);
          $("#buy_balance").text("Your Balance: "+res.user_balance); 
          if(res.error) {
            $("#spend_sell_error").text(res.error);
            $("#spend_sell").val("");
            $('#receive_sell').val("");
            // console.log(data);
          }
          else {
            $.getJSON('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+coinname+'&tsyms='+receive_currency+'&api_key='+api, 
            function(data) {
              $.each(data, function (cur, rate) {
                obj = Object.entries(rate);
                current = obj[0][1];
                var update = spend * current;
                var sell_update = spend_sell * current;

                if($.isNumeric(update)) {
                  $('#receive_sell').val(update.toFixed(8));
                }
                else {
                  $('#receive_sell').val(0);
                }
                if($.isNumeric(sell_update)) {
                  $('#receive_buy').val(sell_update.toFixed(2));
                }
                else {
                  $('#receive_buy').val(0);
                }

                $("#currenct_first_coin").text(coinname);  
                $("#currenct_second_coin").text(receive_currency);  
                // $("#currenct_one").text(current);
                if($.isNumeric(current)) {
                  $('#currenct_one').text(current);
                }
                else {
                  $('#currenct_one').text(0);
                }

                $("#currenct_first_coin_buy").text(coinname);  
                $("#currenct_second_coin_buy").text(receive_currency);  
                // $("#currenct_one_buy").text(current);   
                if($.isNumeric(current)) {
                  $('#currenct_one_buy').text(current);
                }
                else {
                  $('#currenct_one_buy').text(0);
                }
                // alert(current);
              });
            });
          }
        }
      });
    }    
    else {
      $("#spend_sell").val("");
      $('#receive_sell').val("");
      $("#buy_balance").text("");
      $("#spend_sell_error").text('Please enter valid amount');
    }
    $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_lbl").text(coinname);
    $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_img").attr("src", coinimg);
    $(this).closest(".jb_buy_ct_wt_coin_total_set").hide();
    
  });

  $( "body" ).delegate( ".receive_sell", "click", function() {
    var api = "4891c73c50ace720f748d26213d03ec07879ed02780338cbaff0cfb43395a718";

    var spend = $("#spend_buy").val();
    $(".validationMessage").remove();
    var spend_currency = $('#spend_crypto .jb_buy_ct_wt_coin_lbl').text();

    var receive = $("#receive_buy").val();
    var receive_currency = $('#receive_fiat .jb_buy_ct_wt_coin_lbl').text();

    var coinname = $(this).find(".jb_buy_ct_wt_coin_total_set_li_1").text();
    var coinimg = $(this).find(".jb_buy_ct_wt_coin_total_set_li_img").attr("src");
    if($.isNumeric(spend) && parseFloat(spend) > 0) {  
      var post_data = {
        coinname    : coinname,
        amount      : spend
      };
      $.ajax({
        url: front_url+"user_balance_check", 
        type: "POST",
        data: post_data,
        success: function(data) {
          var res = jQuery.parseJSON(data);
          $("#sell_balance").text("Your Balance: "+res.user_balance);
          if(res.error) {
            $("#spend_buy_error").text(res.error);
            $("#spend_buy").val("");
            $('#receive_buy').val("");
            // console.log(data);
          }
          else {
            $.getJSON('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+coinname+'&tsyms='+receive_currency+'&api_key='+api, 
            function(data) {
              $.each(data, function (cur, rate) {
                obj = Object.entries(rate);
                current = obj[0][1];
                var sell_update = spend * current;

                if($.isNumeric(sell_update)) {
                  $('#receive_buy').val(sell_update.toFixed(2));
                }
                else {
                  $('#receive_buy').val(0);
                }

                $("#currenct_first_coin_buy").text(coinname);  
                $("#currenct_second_coin_buy").text(receive_currency);  
                // $("#currenct_one_buy").text(current);   
                if($.isNumeric(current)) {
                  $('#currenct_one_buy').text(current);
                }
                else {
                  $('#currenct_one_buy').text(0);
                }
                // alert(current);
              });
            });
          }
        }
      });
    }
    else {
      $('#receive_buy').val("");
      $("#sell_balance").text("");
      $("#spend_buy_error").text('Please enter valid number');
    }

    $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_lbl").text(coinname);
    $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_img").attr("src", coinimg);
    $(this).closest(".jb_buy_ct_wt_coin_total_set").hide();
    
  });
  
  $( "body" ).delegate( ".spend_sell", "click", function() {
    var api = "4891c73c50ace720f748d26213d03ec07879ed02780338cbaff0cfb43395a718";

    var coinname = $(this).find(".jb_buy_ct_wt_coin_total_set_li_1").text();
    var coinimg = $(this).find(".jb_buy_ct_wt_coin_total_set_li_img").attr("src");

    var spend_currency = $('#spend_crypto .jb_buy_ct_wt_coin_lbl').text();

    var spend_sell = $("#spend_buy").val();
    $(".validationMessage").remove();
    var receive_currency_sell = $('#receive_fiat .jb_buy_ct_wt_coin_lbl').text();
    if($.isNumeric(spend_sell) && parseFloat(spend_sell) > 0) {  
      $.getJSON('https://min-api.cryptocompare.com/data/pricemulti?fsyms='+spend_currency+'&tsyms='+coinname+'&api_key='+api, 
      function(data) {
        $.each(data, function (cur, rate) {
          obj = Object.entries(rate);
          current = obj[0][1];
          var sell_update = spend_sell * current;

          if($.isNumeric(sell_update)) {
            $('#receive_buy').val(sell_update.toFixed(2));
          }
          else {
            $('#receive_buy').val(0);
          }

          // $('#receive_buy').val(update.toFixed(8));
          $("#currenct_first_coin_buy").text(spend_currency);  
          $("#currenct_second_coin_buy").text(coinname);  
          // $("#currenct_one_buy").text(current);  
          if($.isNumeric(current)) {
            $('#currenct_one_buy').text(current);
          }
          else {
            $('#currenct_one_buy').text(0);
          } 
          // alert(current);
        });
      });
    }
    else {
      $('#receive_buy').val("");
      $("#sell_balance").text("");
      $("#spend_buy_error").text('Please enter valid number');
    }
    // $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_lbl").text(coinname);
    // $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_img").attr("src", coinimg);
    // $(this).closest(".jb_buy_ct_wt_coin_total_set").hide();
    
  });
  
  $(".jb_buy_ct_wt_coin_set").click(function(){
    $(this).closest(".jb_buy_ct_wt_inp_set").find(".jb_buy_ct_wt_coin_total_set").show();
  });
  $(".jb_buy_ct_wt_coin_total_set_top i").click(function(){
    $(this).closest(".jb_buy_ct_wt_coin_total_set").hide();
  });
  
  
  
  
  // $(".jb_buy_ct_wt_tab_head-1").click(function(){
  //   $(this).addClass("jb_buy_ct_wt_tab_head_act");
  //   $(".jb_buy_ct_wt_tab_head-2").removeClass("jb_buy_ct_wt_tab_head_act");    
  //   $(".scmpwc-1").addClass("jb_buy_ct_wt_tab_body_set_act");
  //   $(".scmpwc-2").removeClass("jb_buy_ct_wt_tab_body_set_act");
  // });
  // $(".jb_buy_ct_wt_tab_head-2").click(function(){
  //   $(this).addClass("jb_buy_ct_wt_tab_head_act");
  //   $(".jb_buy_ct_wt_tab_head-1").removeClass("jb_buy_ct_wt_tab_head_act");    
  //   $(".scmpwc-2").addClass("jb_buy_ct_wt_tab_body_set_act");
  //   $(".scmpwc-1").removeClass("jb_buy_ct_wt_tab_body_set_act");
  // });
  
  
  // $(".sJABwtreth-1").click(function(){
  //   $(this).addClass("jb_buy_ct_wt_repo_tab_head_act");
  //   $(".sJABwtreth-2").removeClass("jb_buy_ct_wt_repo_tab_head_act");    
  //   $(".sJABwtrebdy-1").addClass("jb_buy_ct_wt_repo_tab_body_act");
  //   $(".sJABwtrebdy-2").removeClass("jb_buy_ct_wt_repo_tab_body_act");
  // });
  // $(".sJABwtreth-2").click(function(){
  //   $(this).addClass("jb_buy_ct_wt_repo_tab_head_act");
  //   $(".sJABwtreth-1").removeClass("jb_buy_ct_wt_repo_tab_head_act");    
  //   $(".sJABwtrebdy-2").addClass("jb_buy_ct_wt_repo_tab_body_act");
  //   $(".sJABwtrebdy-1").removeClass("jb_buy_ct_wt_repo_tab_body_act");
  // });
</script>
<script>
  // $(".jb_buy_ct_new_modal_pane_cnt_h1_cls").click(function(){
  //   $(this).closest(".jb_buy_ct_new_modal_pane").removeClass("jb_buy_ct_new_modal_pane_act");
  // });
  // $(".jb_buy_ct_new_modal_btn").click(function(){
  //   $(".jb_buy_ct_new_modal_pane").removeClass("jb_buy_ct_new_modal_pane_act");
  //   var nam = $(this).attr("data-modname");
  //   $(".jb_buy_ct_new_modal_pane").each(function(){
  //     if($(this).attr("data-modname") == nam){
  //       $(".jb_buy_ct_new_modal_pane").addClass("jb_buy_ct_new_modal_pane_act");
  //     }
  //   });
  // });
</script>
<script>
  $('#buy_form').validate({
    errorClass: 'invalid-feedback',
    rules: {
        
      spend_sell: {
        required: true,
        digits: true
      },
    },
    messages: {
        
      spend_sell: {
        required: "Please enter amount",
        digits: "Please enter numbers Only",
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
      // var $form = $(form);
      // $("#submit").attr("disabled", true);
      // form.submit();
    }
  });
  // console.log(<?php echo $donut_wallet; ?>);
  var donut_wallet = <?php echo !empty($donut_wallet) ? $donut_wallet : '0' ; ?>;
  var userid = <?php echo !empty($user_id) ? $user_id : '0' ?>;
  if(userid > 0) {
    Morris.Donut({
      element: 'donut-wallet',
      data: donut_wallet
    });
  }
</script>

<script>
  var base_url='<?php echo base_url();?>';
  var front_url='<?php echo front_url();?>';
  var user_id='<?php echo $user_id;?>';
  var ip_address = '<?php echo $ip_address;?>';
  var get_os     = '<?php echo $get_os;?>';
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
  var success = "<?php echo $this->session->flashdata('success')?>";
  var error = "<?php echo $this->session->flashdata('error')?>";

  $(document).ready(function() {
  if(success!=''){
  tata.success('Blackcube Exchange! '+success);
  
  }
  if(error!=''){
      tata.warn('Blackcube Exchange!', error);
  }
    $('.datatable').DataTable();
  });
  
  
</script>
    
  </body>
</html>			
      
      
      
     