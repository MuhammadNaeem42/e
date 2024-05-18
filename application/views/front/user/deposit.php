<?php 
  $this->load->view('front/common/header');
  ?>
<div class="jb_middle_content jb_depos_withd_page">
  <div class="container">
    <div class="jb_depwith_hdr">
      <div class="jb_depwith_hdr_li jb_depwith_hdr_li_act" data-nam="Receive">Receive</div>
      <div class="jb_depwith_hdr_li" onClick="withdraw_section()" data-nam="Send">Send</div>
    </div>
    <div class="jb_depwith_out">
      <div class="jb_depwith_pane">
        <div class="jb_depwith_pane_li jb_depwith_pane_li_act"  data-nam="Send">
          <div class="row align-items-center ">
            <div class="col-md-8">
              <div class="row jb_marg_b_10">
                <div class="col-md-6 col-6">
                  <div class="jb_depwith_dp_not jb_bg_lg_green">
                    <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75 jb_marg_b_5">Total Amount</div>
                    <div class="jb_font_s_16 jb_font_w_500 ">0.00000000</div>
                  </div>
                </div>
                <div class="col-md-6 col-6">
                  <div class="jb_depwith_dp_not jb_bg_lg_blue">
                    <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75 jb_marg_b_5">Available Balance</div>
                    <div class="jb_font_s_16 jb_font_w_500 "><?=number_format($user_balance,8)?></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8">
                  <div class="row g-0 ">
                    <div class="col-auto p-0">
                      <div class="jb_log_in_set jb_depwith_dp_cyrp">
                        <i class="fal fa-arrow-down jb_log_in_input_sel_ico"></i>
                        <select class="jb_log_in_input" onChange="change_address(this)">
                          <?php
                            if(count($all_currency) > 0)
                            {
                            foreach ($all_currency as $currency) 
                            		{
                            ?>
                          <option value="<?php echo $currency->id.'#'.$currency->type.'#'.$currency->currency_symbol;?>" <?=($sel_currency->id == $currency->id)?'selected':''?>>
                            <?=$currency->currency_symbol?>
                          </option>
                          <?php } } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col p-0">
                      <div class="jb_log_in_set jb_depwith_dp_cyrp2">
                        <i class="jb_log_in_ico fal fa-clipboard" onclick="copy_function()"></i>
                        <input type="text" class="jb_log_in_input" id="copy_addr" value="<?php echo $crypto_address;?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-4 jb_depwith_dp_cyrp_btn_set justify-content-between">
                  <a href="#" class="jb_form_btn jb_form_btn_blue">Share</a>
                  <a href="#" class="jb_form_btn">Save</a>
                </div> -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="jb_font_s_16 jb_font_w_500 text-center jb_marg_b_15">For <?=$sel_currency->currency_symbol;?> Deposit Only</div>
              <img src="<?php echo $First_coin_image;?>" class="jb_depwith_dp_qr">
            </div>
          </div>
          <div class="jb_depwith_imp">
            <h5 class="jb_font_s_18 jb_font_w_500">Caution</h5>
            <p>This address is only for <?=$sel_currency->currency_name;?>(<?=$sel_currency->currency_symbol;?>) deposits</p>
            <p>Sending any other coin or token to this address may result in the loss of your deposit and is not eligible for recovery</p>
            <!-- <p class="mb-0">Deposit confirmations: 3</p> -->
          </div>
        </div>
        <div class="jb_depwith_pane_li"  data-nam="Receive">
        <?php 
          $action = '';
          $attributes = array('id'=>'withdrawcoin','autocomplete'=>"off",'class'=>'deposit_form'); 
          echo form_open($action,$attributes); ?>
          <div class="row">
            <div class="col-md-4">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Asset</div>
                <i class="fal fa-arrow-down jb_log_in_input_sel_ico"></i>
                <select class="jb_log_in_input" onChange="change_address(this)">
                  <?php
                    if(count($all_currency) > 0)
                    {
                      foreach ($all_currency as $currency) 
                            {
                       ?>
                  <option value="<?php echo $currency->id.'#'.$currency->type.'#'.$currency->currency_symbol;?>" <?=($sel_currency->id == $currency->id)?'selected':''?>>
                    <?=$currency->currency_symbol?>
                  </option>
                  <?php } } ?>
                </select>
                <!-- <select class="jb_log_in_input">
                  <option value="0"></option>
                  <option value="1">BTC</option>
                  <option value="1">ETH</option>
                  </select> -->
              </div>
            </div>
            <div class="col-md-4">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Min Withdraw Amount</div>
                <input type="text" class="jb_log_in_input">
              </div>
            </div>
            <div class="col-md-4">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Max Withdraw Amount</div>
                <input type="text" class="jb_log_in_input">
              </div>
            </div>
            <div class="col-md-6">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Withdraw Address</div>
                <input type="text" class="jb_log_in_input">
                <div class="jb_log_in_err_msg" style="color:#666">This address is only for BTC based Bitcoin(BTC).</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Withdraw Amount</div>
                <input type="text" class="jb_log_in_input">
                <div class="jb_depwith_pane_li_side_lbl">BTC</div>
              </div>
            </div>
          </div>
          <div class="row jb_marg_b_10 jb_depwith_w_ro">
            <div class="col-md-4 col-6">
              <div class="jb_depwith_dp_not jb_bg_lg_green">
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75 jb_marg_b_5">Total Amount</div>
                <div class="jb_font_s_16 jb_font_w_500 "><?=$user_balance;?> <?=$sel_currency->currency_symbol;?></div>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="jb_depwith_dp_not jb_bg_lg_blue">
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75 jb_marg_b_5">Available Balance</div>
                <div class="jb_font_s_16 jb_font_w_500 "><?=$user_balance;?> <?=$sel_currency->currency_symbol;?></div>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="jb_depwith_dp_not">
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75 jb_marg_b_5">Withdraw Fees</div>
                <div class="jb_font_s_16 jb_font_w_500 ">0.6BTC</div>
              </div>
            </div>
            <div class="col-md-12 col-12 "><a href="#" class="jb_form_btn float-end">Submit</a></div>
          </div>
          <div class="jb_depwith_imp">
            <h5 class="jb_font_s_18 jb_font_w_500">Caution</h5>
            <p>This address is only for <?=$sel_currency->currency_name;?>(<?=$sel_currency->currency_symbol;?>) deposits</p>
            <p class="mb-0">Sending any other coin or token to this address may result in the loss of your deposit and is not eligible for recovery</p>
          </div>
        </div>
      </div>
    </div>
    <div class="jb_depwith_out">
      <div class="jb_depwith_pane">
        <div class="jb_depwith_pane_li jb_depwith_pane_li_act"  data-nam="Send">
          <div class="jb_h2">Send History</div>
          <div class="table-responsive  jb_repo_table_out">
            <table class="table table-borderless table-hover">
              <thead>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Coin</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Transaction Id</th>
                  <th scope="col">Time</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(isset($deposit_history) && !empty($deposit_history))
                    {
                      $a=0;
                      foreach($deposit_history as $deposit)
                      {
                  
                        $cur_details = getcryptocurrencydetail($deposit->currency_id);
                        if(empty($deposit->transaction_id))
                        {
                          $transaction_id = '-';
                        }
                        else
                        {
                          $transaction_id = $deposit->transaction_id;
                        } 
                  
                  
                  ?>
                <tr>
                  <th scope="row">2</th>
                  <td class="jb_repo_coin_set_td"><img src="<?php echo $cur_details->image;?>" class="jb_repo_coin_set_td_ico">
                    <?php echo $cur_details->currency_symbol;?><span><?php echo $cur_details->currency_name;?></span>
                  </td>
                  <td><?php echo number_format($deposit->amount,8);?></td>
                  <td><?php echo $transaction_id;?></td>
                  <td class="jb_repo_coin_set_td_date"><?php echo date('d-M-Y H:i',$deposit->datetime);?></td>
                  <td>
                  <?php if($deposit->status=="Completed"){?>
                      <div class="jb_repo_stat_lbl jb_bg_green"> <?php echo $deposit->status;?></div>
                    <?php } ?> 
                    <?php if($deposit->status=="Pending") {?>
                      <div class="jb_repo_stat_lbl"> <?php echo $deposit->status;?></div>
                    <?php }  ?>
                    <?php if($deposit->status=="Cancelled"){?>
                      <div class="jb_repo_stat_lbl jb_bg_red"> <?php echo $deposit->status;?></div><?php } ?>
                  </td>
                </tr>
                <?php } }?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="jb_depwith_pane_li "  data-nam="Receive">
          <div class="jb_h2">Receive History</div>
          <div class="table-responsive  jb_repo_table_out">
            <table class="table table-borderless table-hover">
              <thead>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Coin</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Transaction Id</th>
                  <th scope="col">Time</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td class="jb_repo_coin_set_td"><img src="assets/images/aico-3.png" class="jb_repo_coin_set_td_ico">
                    TUSD<span>USD</span>
                  </td>
                  <td>2.50000000</td>
                  <td>01234567890123456789012345678912</td>
                  <td class="jb_repo_coin_set_td_date">20-12-2019 15:35</td>
                  <td>
                    <div class="jb_repo_stat_lbl jb_bg_green"> Success</div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td class="jb_repo_coin_set_td"><img src="assets/images/aico-3.png" class="jb_repo_coin_set_td_ico">
                    TUSD<span>USD</span>
                  </td>
                  <td>2.50000000</td>
                  <td>01234567890123456789012345678912</td>
                  <td class="jb_repo_coin_set_td_date">20-12-2019 15:35</td>
                  <td>
                    <div class="jb_repo_stat_lbl jb_bg_red"> Cancelled</div>
                  </td>
                </tr>
              </tbody>
            </table>
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

  function withdraw_section() {
    // alert("TERTE");
    var symbol = '<?php echo $this->uri->segment(2);?>';
    window.location.href = base_url+'withdraw/'+symbol;
  }

  function copy_function() 
  {
    var copyText = document.getElementById("copy_addr");
    copyText.select();
    document.execCommand("COPY");
    tata.info('JAB! ','Copied');
  }

  function change_address(sel)
  {
  
  
    var arr1 = sel.value;
    var arr = arr1.split('#');
    var currency_id = arr[0];
    var type = arr[1];
    var symbol = arr[2];
    window.location.href = base_url+'deposit/'+symbol;
  
  }        	
  
  
  
</script>