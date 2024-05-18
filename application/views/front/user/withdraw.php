<?php 
  $this->load->view('front/common/header');
  ?>
<style>
  button {
  -webkit-appearance: button;
  border: none;
  }
  button.jb_form_btn {
  font-weight: 700;
  }
</style>
<div class="jb_middle_content jb_depos_withd_page">
  <div class="container">
    <div class="jb_depwith_hdr">
      <div class="jb_depwith_hdr_li" onClick="send_section()" data-nam="Receive">Receive</div>
      <div class="jb_depwith_hdr_li jb_depwith_hdr_li_act" data-nam="Send">Send</div>
    </div>
    <div class="jb_depwith_out">
      <div class="jb_depwith_pane">
        <div class="jb_depwith_pane_li"  data-nam="Send">
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
                    <div class="jb_font_s_16 jb_font_w_500 ">0.00000000</div>
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
                <div class="col-md-4 jb_depwith_dp_cyrp_btn_set justify-content-between">
                  <a href="#" class="jb_form_btn jb_form_btn_blue">Share</a>
                  <a href="#" class="jb_form_btn">Save</a>
                </div>
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
        <div class="jb_depwith_pane_li jb_depwith_pane_li_act"  data-nam="Receive">

          <?php 
            $action = '';
            $attributes = array('id'=>'withdrawcoin','autocomplete'=>"off",'class'=>'deposit_form'); 
            echo form_open($action,$attributes); ?>
          <div class="row">
            <div class="col-md-4">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Asset</div>
                <i class="fal fa-arrow-down jb_log_in_input_sel_ico"></i>
                <select class="jb_log_in_input" onChange="change_coin(this)" name="ids">
                  <?php
                    if(count($currency) > 0)
                    {
                    foreach ($currency as $currencys) 
                    {
                    ?>
                  ?>
                  <option value="<?php echo $currencys->id.'_'.$currencys->type.'_'.$wallet['Exchange AND Trading'][$currencys->id].'_'.$currencys->currency_symbol;?>" <?=($sel_currency->id == $currencys->id)?'selected':''?>>
                    <?=$currencys->currency_symbol?>
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
                <input type="text" class="jb_log_in_input" readonly value="<?=$sel_currency->min_withdraw_limit;?>" >
              </div>
            </div>
            <div class="col-md-4">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Max Withdraw Amount</div>
                <input type="text" class="jb_log_in_input" readonly value="<?=$sel_currency->max_withdraw_limit;?>" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Withdraw Address</div>
                <input type="text" class="jb_log_in_input" name="address" id="address">
                <div class="jb_log_in_err_msg" style="color:#666">This address is only for <?=$sel_currency->currency_symbol;?> based <?php echo $sel_currency->currency_name.' ('.$sel_currency->currency_symbol.')';?>.</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="jb_log_in_set ">
                <div class="jb_log_in_lbl">Withdraw Amount</div>
                <input type="text" class="jb_log_in_input" id="amount" name="amount" onkeyup="calculate();">
                <div class="jb_depwith_pane_li_side_lbl"><?=$sel_currency->currency_symbol;?></div>
              </div>
            </div>
          </div>
          <div class="row jb_marg_b_10 jb_depwith_w_ro">
            <div class="col-md-4 col-6">
              <div class="jb_depwith_dp_not jb_bg_lg_green">
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75 jb_marg_b_5">Available Balance</div>
                <div class="jb_font_s_16 jb_font_w_500 "><?=$user_balance;?> <?=$sel_currency->currency_symbol;?></div>
              </div>
            </div>
            <div class="col-md-4 col-6">
              <div class="jb_depwith_dp_not jb_bg_lg_blue">
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75 jb_marg_b_5">Withdraw Fees</div>
                <div class="jb_font_s_16 jb_font_w_500 ">
                  <span id="fees_p">0</span> <span class="sym"><?=$selcsym?></span>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-12">
              <div class="jb_depwith_dp_not">
                <div class="jb_font_s_14 jb_font_w_400 jb_opac_p_75 jb_marg_b_5">Amount You will receive</div>
                <div class="jb_font_s_16 jb_font_w_500 ">
                  <span id="amount_receive">0</span> <span class="sym"><?=$selcsym;?></span>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-12 "><button class="jb_form_btn float-end" name="withdrawcoin" type="submit">Submit</button></div>
          </div>
          <div class="jb_depwith_imp">
            <h5 class="jb_font_s_18 jb_font_w_500">Caution</h5>
            <p>This address is only for <?=$sel_currency->currency_name;?>(<?=$sel_currency->currency_symbol;?>) deposits</p>
            <p class="mb-0">Sending any other coin or token to this address may result in the loss of your deposit and is not eligible for recovery</p>
          </div>
        </div>
        <?php
          echo form_close();
          ?>
      </div>
    </div>
    <div class="jb_depwith_out">
      <div class="jb_depwith_pane">
        <div class="jb_depwith_pane_li"  data-nam="Send">
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
                    <div class="jb_repo_stat_lbl jb_bg_red"> Cancelled</div>
                  </td>
                </tr>
                <?php } }?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="jb_depwith_pane_li jb_depwith_pane_li_act"  data-nam="Receive">
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
              <?php
                if(isset($withdraw_history) && !empty($withdraw_history))
                  {
                    // print_r($withdraw_history);
                    $a=0;
                    foreach($withdraw_history as $withrdaw)
                    {
                      $cur_details = getcryptocurrencydetail($withrdaw->currency_id);
                      if(empty($withrdaw->transaction_id))
                      {
                        $transaction_id = '-';
                      }
                      else
                      {
                        $transaction_id = $withrdaw->transaction_id;
                      } 
                      $a++;



                ?>
                <tr>
                <input type="hidden" name="hidden" id="copy" value="<?=$withrdaw->crypto_address;?>">
                  <th scope="row"><?= $a; ?></th>
                  <td class="jb_repo_coin_set_td"><img src="<?php echo $cur_details->image;?>" class="jb_repo_coin_set_td_ico">
                    <?php echo $cur_details->currency_symbol;?><span><?php echo $cur_details->currency_name;?></span>
                  </td>
                  <td><?php echo number_format($withrdaw->amount,8);?></td>
                  <td><div class="jab_with_copy_tran"><i class="fal fa-file jab_with_copy_ico float-end" onclick="copy_function()"></i><?php echo $transaction_id;?></div></td>
                  <td class="jb_repo_coin_set_td_date"><?php echo $withrdaw->datetime;?></td>
                  <td>
                    <?php if($withrdaw->status=="Completed"){?>
                      <div class="jb_repo_stat_lbl jb_bg_green"> <?php echo $withrdaw->status;?></div>
                    <?php } ?> 
                    <?php if($withrdaw->status=="Pending") {?>
                      <div class="jb_repo_stat_lbl"> <?php echo $withrdaw->status;?></div>
                    <?php }  ?>
                    <?php if($withrdaw->status=="Cancelled"){?>
                      <div class="jb_repo_stat_lbl jb_bg_red"> <?php echo $withrdaw->status;?></div><?php } ?>
                  </td>
                </tr>
                <?php } } ?>
                <!-- <tr>
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
                </tr> -->
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
  $.validator.addMethod("noSpace", function(value, element) { 
    return value.indexOf(" ") < 0 && value != ""; 
  }, "No space please and don't leave it empty");

  $("#withdrawcoin").validate({
    errorClass: 'invalid-feedback',
    rules: {
      address: {
        required: true,
        noSpace: true
      },
      amount: {
        required: true,
        number:true
      },
      ids: {
        required: true
      },
      destination_tag: {
        number: true
      }
    },
    messages: {
      address: {
        required: "Please enter address"
      },
      amount: {
        required: "Please enter Amount",
        number: "Invalid Amount"
      },
      ids: {
        required: "Please select currency"
      },
        destination_tag: {
          number: 'Please enter numbers only'
        }
    },
    highlight: function (element) {
    $(element).parent().addClass('jb_log_in_vldr_fail')
    },
    unhighlight: function (element) {
    $(element).parent().removeClass('jb_log_in_vldr_fail');
    },
    submitHandler: function(form) 
    { 

      var fees_type = '<?php echo $fees_type;?>';
      var fees = '<?php echo $fees;?>';
  
  
      var amount = $('#amount').val();
  
      if(fees_type=='Percent'){
          var fees_p = ((parseFloat(amount) * parseFloat(fees))/100);
          var amount_receive = parseFloat(amount) - parseFloat(fees_p);
      }
      else{
          var fees_p = fees;
          var amount_receive = parseFloat(amount) - parseFloat(fees_p);
      }
      if(parseFloat(amount_receive)<=0){
        tata.warn({ message: 'Please enter valid amount' });
        return false;
      }
      else if(parseFloat(amount)<=parseFloat(fees_p)){
      
        tata.warn({ message: 'Please enter valid amount' });
        return false;
      }
      else{
        form.submit();
      }
    }     
  });
  
  
  
  
  
  function copy_function() 
  {
  	var copyText = document.getElementById('copy');
  	copyText.select();
  	document.execCommand("COPY");
  	tata.info('JAB! ','Copied');
  }
  function change_coin(sel)
  {
  
  
    var arr1 = sel.value;
    var arr = arr1.split('_');
    var currency_id = arr[0];
    var type = arr[1];
    var symbol = arr[3];
    // console.log(symbol);
    window.location.href = base_url+'withdraw/'+symbol;
  
  
  }        	
  
  
  function calculate(){
      
    var fees_type = '<?php echo $fees_type;?>';
    var fees = '<?php echo $fees;?>';

    var amount = $('#amount').val();

    if(fees_type=='Percent'){
        var fees_p = ((parseFloat(amount) * parseFloat(fees))/100);
        var amount_receive = parseFloat(amount) - parseFloat(fees_p);
    }
    else{
        var fees_p = fees;
        var amount_receive = parseFloat(amount) - parseFloat(fees_p);
    }
    $('#fees_p').html(fees_p);
    if(amount_receive<=0){
      $('.error').html('Please enter valid amount');
      $('.jab_log_frm_s_lbl').addClass('fail_vldr');
      $('#amount_receive').html('0');
    }
    else{
      $('.error').html('');
      $('.jab_log_frm_s_lbl').removeClass('fail_vldr');
      $('#amount_receive').html(amount_receive);
    }
  }
</script>
<script type="text/javascript">
  function send_section() {
    // alert("TERTE");
    var symbol = '<?php echo $this->uri->segment(2);?>';
    window.location.href = base_url+'deposit/'+symbol;
  }
  function withdraw_section() {
    // alert("TERTE");
    var symbol = '<?php echo $this->uri->segment(2);?>';
    window.location.href = base_url+'withdraw/'+symbol;
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