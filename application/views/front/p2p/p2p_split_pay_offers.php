<?php
$this->load->view('front/common/header');

// echo "<pre>";print_r($gettrade->tradeid);exit;

$tradeopentime = $gettrade->tradeopentime;
$currentDate = strtotime($tradeopentime);
if($min = $gettrade->payment_window){
    $futureDate = $currentDate + (60 * $min); //30 minute    
}else{
    $futureDate = $currentDate + (60 * 30); //30 minute
}

// $futureDate = time() + (60 * 30);
$getDateTime = date("F d, Y H:i:s", $futureDate);

if($type=='sell') {
    $action = base_url('p2p_bank/'.$type.'/'.$trade_id_enc);
} else if($type=='buy') {
    $action = base_url('p2p_pay/'.$type.'/'.$trade_id_enc);
}


?>


<div class="sb_main_content sb_oth_main">
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-8">
                <div class="sb_m_o_h1"> Pay To <?php echo $type=='sell' ? 'Buyer' : 'Seller'; ?></div>
                <div class="sb_m_common_pnl ">
                    <div class="spd spd_fs_22 spd_fw_600 sb_m_np2_cpy_set">
                        Trade ref:
                        <span class="sb_m_np2_cpy_txt">#<?php echo ($gettrade->tradeid); ?></span>
                        <i class="fal fa-clipboard sb_m_np2_cpy_btn spd_fs_14"></i>
                    </div>
                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_07  spd_mt_20">
                        <?php $attributes=array('id'=>'myBuyForm',"autocomplete"=>"off"); 
                              echo form_open_multipart($action,$attributes); ?>    
                            <input type="hidden" name="acPrice" id="acPrice" value="<?php print($gettrade->price);?>" />

                            <label for="amount of <?php echo getfiatcurrency($gettrade->fiat_currency); ?>">Amount of <?php echo getfiatcurrency($gettrade->fiat_currency); ?></label>
                            <input required min="<?php print($gettrade->minimumtrade);?>" max="<?php print($gettrade->maximumtrade); ?>"  type="text" name="split_fiat_currency" id="split_fiat_currency" class="sb_m_o_log_in_input split_fiat_currency" /> 

                            <!-- <label for="amount of " id="split_fiat_currency_error" class="split_fiat_currency_error error" style="display: none;">This field is required.</label> -->
                            <label for="amount of <?php echo getfiatcurrency($gettrade->cryptocurrency); ?>">Amount of <?php echo currency($gettrade->cryptocurrency); ?></label>
                            <input type="text" name="split_cryptocurrency" readonly id="split_cryptocurrency" class="sb_m_o_log_in_input">



                            <input type="submit" class="btn btn-info" id="submitbtn" name="submit" style="display: none;" >                        
                         <?php echo form_close();?>
                    </div>
              
                  
                    <div class="spd spd_fw_500 spd_fs_20 spd_mt_30 spd_mb_20 "> Advertisement Details</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sb_m_np2_ps_bx">

                                <div class="spd spd_fs_14 spd_mr_10 d-inline-block"> <?php echo $type=='sell' ? 'BUYING' : 'SELLING'; ?> FROM  <?php echo UserName($gettrade->user_id) ?></div>
                                <div class="spd spd_fs_14 spd_mr_10 d-inline-block">Price : <?php echo $gettrade->price. ' '.getfiatcurrency($gettrade->fiat_currency); ?></div>
                                <div class="spd spd_fs_14 spd_mr_10 d-inline-block">Amount limits : <?php echo $gettrade->minimumtrade . getfiatcurrency($gettrade->fiat_currency) . 
                                    '-' . $gettrade->maximumtrade . getfiatcurrency($gettrade->fiat_currency); ?></div>
                                <?php if($gettrade->payment_method==2){
                                  $Payment = $gettrade->bank;
                                }else {
                                    $Payment = get_paymentname($gettrade->payment_method);
                                } ?>
                                     
                                <div class="spd spd_fs_14 spd_mr_10 d-inline-block">Payment method : <?php echo $Payment; ?></div>
                                <div class="spd spd_fs_14 spd_mr_10 d-inline-block">Location : <?php echo get_countryname($gettrade->country); ?></div>
                                <div class="spd spd_fs_14 spd_mr_10 d-inline-block">Payment window <?php echo $gettrade->payment_window . ' minutes'; ?></div>
                                </div>
                            </div>
                        </div>
                   
                    </div>
                    <a href="javascript:;" class="sb_m_1_btn w-100 text-center spd_ml_00 iamreadytopaycls"> <?php echo strtoupper($type); echo ' '.strtoupper(getfiatcurrency($gettrade->fiat_currency)); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('front/common/footer');
?>

<script>
    let currentURL = "<?php echo current_url(); ?>";
    let split_amt_url = "<?php echo base_url('p2p_pay/'.$type.'/'.$trade_id_enc); ?>";
    let split_buy_url = "<?php echo base_url('p2p_bank/'.$type.'/'.$trade_id_enc); ?>";
  

    // function price_calculation(val)
    // {

    //   var acPrice = $('#acPrice').val();
    //   var minimum = $('#minimum').val();
    //   var maximum = $('#maximum').val();
    //   var final_value = val / acPrice;
    //   $('#split_cryptocurrency').val(final_value.toFixed(6));
    // }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        // if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        if (charCode > 31 && (charCode != 46 && (charCode < 48 || charCode > 57))) {
            return false;
        }
        return true;
    }

    $(document).ready(function () {


    $(document).on('click', '.iamreadytopaycls', function(event) {
        // event.preventDefault();
        $('#submitbtn').trigger('click');        
    });

    $(document).on('click', '#submitbtn', function(event) {
        $('#myBuyForm').validate({ // initialize the plugin
                rules: {
                    split_fiat_currency: {
                        required: true,
                        number:true,
                        // min:"<?php print($gettrade->minimumtrade);?>",
                        // max:"<?php print($gettrade->maximumtrade); ?>"                
                        range: ["<?php print($gettrade->minimumtrade);?>", "<?php print($gettrade->maximumtrade); ?>"]
                    }
                },
                submitHandler: function(form) {                
                    
                    crypto1 = document.getElementById("split_cryptocurrency").value;
                    tradeAmt = '<?=$gettrade->trade_amount?>';
                    if(parseFloat(tradeAmt) < parseFloat(crypto1)) {
                       tata.warn('Amount you have entered is more than your trade amount'); 
                       return false; 
                    }
                    // console.log(tradeAmt, crypto1);
                    // return false; 
                    var $form = $(form);
                    form.submit();
                           

                    // $.ajax({
                    //     url: currentURL,
                    //     type: 'POST',
                    //     dataType: 'json',
                    //     data: {submit: "<?php echo uniqid(); ?>"},
                    // })
                    // .done(function() {
                    //     console.log("success");
                    // })
                    // .fail(function() {
                    //     console.log("error");
                    // })
                    // .always(function(response) {
                    //     // console.log("complete", response);
                    //     if(response.status ==true){
                    //         let _type = "<?php echo $type; ?>";
                    //         // console.log('_type', _type);               
                    //         let c = $('#split_cryptocurrency').val();
                    //         let f = $('#split_fiat_currency').val();        
                    //         if(c && f){
                    //             $('#split_fiat_currency_error').hide();                           
                    //             if(_type == 'sell'){                
                    //                 // window.location.href = split_buy_url + '?c=' + c + '&f=' + f;
                    //                 window.location.href = split_buy_url;
                    //                 // console.log( split_buy_url + '?c=' + c + '&f=' + f )
                    //             }else if(_type == 'buy'){
                    //                 // window.location.href = split_amt_url + '?c=' + c + '&f=' + f;
                    //                 window.location.href = split_amt_url;
                    //                 // console.log( split_amt_url + '?c=' + c + '&f=' + f )
                    //             }

                    //             return false;  
                    //         }else{
                    //             $('#split_fiat_currency_error').show();
                    //         }    
                    //     }
                         
                    //     });                    
                }
            }); 
        });



    $(document).on('keyup', '#split_fiat_currency', function(event) {
        event.preventDefault();
        /* Act on the event */
      let val = $(this).val();
      var acPrice = $('#acPrice').val();
      var minimum = $('#minimum').val();
      var maximum = $('#maximum').val();
      var final_value = val / acPrice;

      console.log( val, acPrice )
      $('#split_cryptocurrency').val(final_value.toFixed(6));
    });


});
</script>
</body>
</html>