<?php 
  $this->load->view('front/common/header');
  // print_r($this->session);
  if($users->verify_level2_status=="" || $users->verify_level2_status=="Pending" || $users->verify_level2_status=="Rejected")
  {
    $kyc_status = '⚠ KYC Not Verified';
    $background = 'rgb(236 74 74)';
  }
  else
  {
    $kyc_status = 'KYC Verified';
    $background = '#16b786';
  }
?>
<div class="jb_middle_content jb_dashboard_page ">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="jb_h1">Crypto Assets</div>
        <div class="jb_dash_m_ast_out_out">
          <div class="jb_dash_m_ast_out">
            <div class="jb_dash_m_ast_out_scrl">
            <?php
            // echo "<pre>"; print_r($all_currency);
                    if(count($all_currency) > 0)
                    {
                      foreach ($all_currency as $currency) 
                            {
                       ?>
              <div class="jb_dash_m_ast_li">
                <img src="<?php echo $currency->image;?>" class="jb_dash_m_ast_li_img">
                <div class="jb_dash_m_ast_li_txt_1"><?php echo $currency->currency_symbol; ?> / USD <span class="jb_hmkl_txt_grn"><i class="fal fa-arrow-up"></i>1.8%</span></div>
                <div class="jb_dash_m_ast_li_txt_2"><?php echo $currency->balance.$currency->currency_symbol; ?></div>
              </div>
              <?php } } ?>
            </div>
          </div>
        </div>
        <div class="jb_h1">Market</div>
        <div class="coin-list__main"  data-aos="fade-down" data-aos-duration="1000" data-aos-delay="400" >
          <div class="jb_home_mark_set">
            <div class="jb_home_mark_row jb_home_mark_header">
              <div class="jb_home_mark_li jb_hmkl_1">S.No </div>
              <div class="jb_home_mark_li jb_hmkl_2">Coins </div>
              <div class="jb_home_mark_li jb_hmkl_3">Price </div>
              <div class="jb_home_mark_li jb_hmkl_4 " >24h Changes </div>
              <div class="jb_home_mark_li jb_hmkl_5">Market Cap </div>
              <div class="jb_home_mark_li jb_hmkl_6">Last 48 Hrs </div>
              <div class="jb_home_mark_li jb_hmkl_7">  </div>
            </div>
            <div class="jb_home_mark_table_body">
              <div class="jb_home_mark_row">
                <div class="jb_home_mark_li jb_hmkl_1">1 </div>
                <div class="jb_home_mark_li jb_hmkl_2"><img src="<?php echo front_img();?>aico-4.png" class="jb_home_mark_li_ico"> Bitcoin <span>BTC</span> </div>
                <div class="jb_home_mark_li jb_hmkl_3">$56,623.54 </div>
                <div class="jb_home_mark_li jb_hmkl_4 jb_hmkl_txt_grn">+1.45% </div>
                <div class="jb_home_mark_li jb_hmkl_5">$880,423,640,582 </div>
                <div class="jb_home_mark_li jb_hmkl_6">
                  <div id="total-revenue-chart-1"></div>
                </div>
                <div class="jb_home_mark_li jb_hmkl_7"><a href="#" class="btn">Buy / Sell</a> </div>
              </div>
              <div class="jb_home_mark_row">
                <div class="jb_home_mark_li jb_hmkl_1">2 </div>
                <div class="jb_home_mark_li jb_hmkl_2"><img src="<?php echo front_img();?>aico-2.png" class="jb_home_mark_li_ico"> Ethereum <span>ETH</span> </div>
                <div class="jb_home_mark_li jb_hmkl_3">$56,623.54 </div>
                <div class="jb_home_mark_li jb_hmkl_4 jb_hmkl_txt_grn">+1.45% </div>
                <div class="jb_home_mark_li jb_hmkl_5">$880,423,640,582 </div>
                <div class="jb_home_mark_li jb_hmkl_6">
                  <div id="total-revenue-chart-2"></div>
                </div>
                <div class="jb_home_mark_li jb_hmkl_7"><a href="#" class="btn">Buy / Sell</a> </div>
              </div>
              <div class="jb_home_mark_row">
                <div class="jb_home_mark_li jb_hmkl_1">3 </div>
                <div class="jb_home_mark_li jb_hmkl_2"><img src="<?php echo front_img();?>aico-6.png" class="jb_home_mark_li_ico"> Binance <span>BNB</span> </div>
                <div class="jb_home_mark_li jb_hmkl_3">$56,623.54 </div>
                <div class="jb_home_mark_li jb_hmkl_4 jb_hmkl_txt_grn">+1.45% </div>
                <div class="jb_home_mark_li jb_hmkl_5">$880,423,640,582 </div>
                <div class="jb_home_mark_li jb_hmkl_6">
                  <div id="total-revenue-chart-3"></div>
                </div>
                <div class="jb_home_mark_li jb_hmkl_7"><a href="#" class="btn">Buy / Sell</a> </div>
              </div>
              <div class="jb_home_mark_row">
                <div class="jb_home_mark_li jb_hmkl_1">4 </div>
                <div class="jb_home_mark_li jb_hmkl_2"><img src="<?php echo front_img();?>aico-7.png" class="jb_home_mark_li_ico"> Tron <span>TRX</span> </div>
                <div class="jb_home_mark_li jb_hmkl_3">$56,623.54 </div>
                <div class="jb_home_mark_li jb_hmkl_4 jb_hmkl_txt_red">+1.45% </div>
                <div class="jb_home_mark_li jb_hmkl_5">$880,423,640,582 </div>
                <div class="jb_home_mark_li jb_hmkl_6">
                  <div id="total-revenue-chart-4"></div>
                </div>
                <div class="jb_home_mark_li jb_hmkl_7"><a href="#" class="btn">Buy / Sell</a> </div>
              </div>
              <div class="jb_home_mark_row">
                <div class="jb_home_mark_li jb_hmkl_1">5 </div>
                <div class="jb_home_mark_li jb_hmkl_2"><img src="<?php echo front_img();?>aico-3.png" class="jb_home_mark_li_ico"> Ripple <span>XRP</span> </div>
                <div class="jb_home_mark_li jb_hmkl_3">$56,623.54 </div>
                <div class="jb_home_mark_li jb_hmkl_4 jb_hmkl_txt_grn">+1.45% </div>
                <div class="jb_home_mark_li jb_hmkl_5">$880,423,640,582 </div>
                <div class="jb_home_mark_li jb_hmkl_6">
                  <div id="total-revenue-chart-5"></div>
                </div>
                <div class="jb_home_mark_li jb_hmkl_7"><a href="#" class="btn">Buy / Sell</a> </div>
              </div>
              <div class="jb_home_mark_row">
                <div class="jb_home_mark_li jb_hmkl_1">6 </div>
                <div class="jb_home_mark_li jb_hmkl_2"><img src="<?php echo front_img();?>aico-8.png" class="jb_home_mark_li_ico"> Litecoin <span>LTC</span> </div>
                <div class="jb_home_mark_li jb_hmkl_3">$56,623.54 </div>
                <div class="jb_home_mark_li jb_hmkl_4 jb_hmkl_txt_grn">+1.45% </div>
                <div class="jb_home_mark_li jb_hmkl_5">$880,423,640,582 </div>
                <div class="jb_home_mark_li jb_hmkl_6">
                  <div id="total-revenue-chart-6"></div>
                </div>
                <div class="jb_home_mark_li jb_hmkl_7"><a href="#" class="btn">Buy / Sell</a> </div>
              </div>
              <div class="jb_home_mark_row">
                <div class="jb_home_mark_li jb_hmkl_1">7 </div>
                <div class="jb_home_mark_li jb_hmkl_2"><img src="<?php echo front_img();?>aico-9.png" class="jb_home_mark_li_ico"> USD Coin <span>USDC</span> </div>
                <div class="jb_home_mark_li jb_hmkl_3">$56,623.54 </div>
                <div class="jb_home_mark_li jb_hmkl_4 jb_hmkl_txt_grn">+1.45% </div>
                <div class="jb_home_mark_li jb_hmkl_5">$880,423,640,582 </div>
                <div class="jb_home_mark_li jb_hmkl_6">
                  <div id="total-revenue-chart-7"></div>
                </div>
                <div class="jb_home_mark_li jb_hmkl_7"><a href="#" class="btn">Buy / Sell</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 jb_dashboard_pg_side">
        <div class="jb_h1">Overview</div>
        <div class="jb_dash_side_out">
          <div class="row align-items-center jb_marg_b_30">
            <div class="col-auto jb_dashboard_pg_sid_img_out">
              <a href="<?php echo base_url();?>profile" class="jb_dashboard_pg_sid_img_i"><i class="fal fa-pencil "></i></a>
              <img src="<?php echo $users->profile_picture;?>" class="jb_dash_side_img">
            </div>
            <div class="col" style="padding-left: 5px;">
              <div class="jb_font_s_14 jb_font_w_400  jb_opac_p_50">Your Wallet Balance</div>
              <div class="jb_font_s_26 jb_font_w_500 jb_marg_b_10 ">$<?php echo $tot_balance; ?></div>
              <div class="row ">
                <div class="col-6 px-2">
                  <a href="#" class="jb_form_btn w-100">Send</a>
                </div>
                <div class="col-6 px-2">
                  <a href="#" class="jb_form_btn w-100 jb_form_btn_blue">Receive</a>
                </div>
              </div>
            </div>
          </div>
          <hr class="jb_dashboard_pg_sid_hr">
          <div id="donut-wallet" style="height:220px;"></div>
        </div>
        <div class="jb_h1">Activities</div>
        <div class="jb_dash_side_out jb_dash_side_acti_out">
          <div class="jb_dash_side_acti_scrl">
            <div class="jb_dash_side_acti_li">
              <div class="row align-items-center">
                <div class="col-7">
                  <div class="jb_font_s_16 jb_font_w_500">192.121.151.181</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">11.00 Am, 10-12-2022</div>
                </div>
                <div class="col-5 text-end">
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75">Chrome</div>
                </div>
              </div>
            </div>
            <div class="jb_dash_side_acti_li">
              <div class="row align-items-center">
                <div class="col-7">
                  <div class="jb_font_s_16 jb_font_w_500">192.121.151.181</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">11.00 Am, 10-12-2022</div>
                </div>
                <div class="col-5 text-end">
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75">Chrome</div>
                </div>
              </div>
            </div>
            <div class="jb_dash_side_acti_li">
              <div class="row align-items-center">
                <div class="col-7">
                  <div class="jb_font_s_16 jb_font_w_500">192.121.151.181</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">11.00 Am, 10-12-2022</div>
                </div>
                <div class="col-5 text-end">
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75">Chrome</div>
                </div>
              </div>
            </div>
            <div class="jb_dash_side_acti_li">
              <div class="row align-items-center">
                <div class="col-7">
                  <div class="jb_font_s_16 jb_font_w_500">192.121.151.181</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">11.00 Am, 10-12-2022</div>
                </div>
                <div class="col-5 text-end">
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75">Chrome</div>
                </div>
              </div>
            </div>
            <div class="jb_dash_side_acti_li">
              <div class="row align-items-center">
                <div class="col-7">
                  <div class="jb_font_s_16 jb_font_w_500">192.121.151.181</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">11.00 Am, 10-12-2022</div>
                </div>
                <div class="col-5 text-end">
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75">Chrome</div>
                </div>
              </div>
            </div>
            <div class="jb_dash_side_acti_li">
              <div class="row align-items-center">
                <div class="col-7">
                  <div class="jb_font_s_16 jb_font_w_500">192.121.151.181</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">11.00 Am, 10-12-2022</div>
                </div>
                <div class="col-5 text-end">
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75">Chrome</div>
                </div>
              </div>
            </div>
            <div class="jb_dash_side_acti_li">
              <div class="row align-items-center">
                <div class="col-7">
                  <div class="jb_font_s_16 jb_font_w_500">192.121.151.181</div>
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_50">11.00 Am, 10-12-2022</div>
                </div>
                <div class="col-5 text-end">
                  <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75">Chrome</div>
                </div>
              </div>
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
<script type="text/javascript">
  function myFunction(input,id) {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById(input);
  filter = input.value.toUpperCase();
  table = document.getElementById(id);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
  td = tr[i].getElementsByTagName("td")[1];
  
  
  
  if (td) {
  txtValue = td.textContent || td.innerText;
  if (txtValue.toUpperCase().indexOf(filter) > -1) {
  tr[i].style.display = "";
  } else {
  tr[i].style.display = "none";
  }
  }
  }
  }
  
  
  
</script>