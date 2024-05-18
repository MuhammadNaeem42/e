<?php
$this->load->view('front/common/header');

// echo "<pre>";print_r($gettrade);exit;



if($gettrade->user_id == $user_id){
    // Buyer section
    $typeof = 'buyer';
    $nameof = ucfirst(username($gettrade->user_id));
}else{
    
    // seller section
    $typeof = 'seller';
    $nameof = ucfirst(username($gettrade->user_id));
}


$tradeopentime = $gettrade->tradeopentime;
$currentDate = strtotime($tradeopentime);
$min = $gettrade->payment_window;
if($min){
    $futureDate = $currentDate + (60 * $min); //30 minute    
}else{
    $futureDate = $currentDate + (60 * 30); //30 minute
}

// $futureDate = time() + (60 * 30);

$getDateTime = date("F d, Y H:i:s", $futureDate);
?>

<style>
.spd_clr_red { font-size: 16px; }    
</style>

<div class="sb_main_content sb_oth_main">
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-8">
                <div class="sb_m_o_h1"> Pay To Seller</div>
                <div class="sb_m_common_pnl ">
                    <div class="spd spd_fs_22 spd_fw_600 sb_m_np2_cpy_set">
                        Trade ref:
                        <span class="sb_m_np2_cpy_txt">#<?php echo ($gettrade->tradeid); ?></span>
                        <i class="fal fa-clipboard sb_m_np2_cpy_btn spd_fs_14"></i>
                    </div>
                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_07  spd_mt_20">
                        You are buying <span class="sb_m_np2_badg sb_m_np2_badg_green"><?php echo ($cryptoAmt); ?> <?php echo currency($gettrade->cryptocurrency); ?></span> from <span class="spd_clr_orange2"><?php echo $nameof; ?></span> <?php echo getfiatcurrency($gettrade->fiat_currency); ?> of the
                        seller is already locked and secured for this trade. Please send
                        payment to the seller then confirm below.
                    </div>
                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 spd_mb_20 spd_mt_25">
                        <!-- Time left to pay <span class="sb_m_np2_badg sb_m_np2_badg_light">
                            <p id="demo"></p>
                        </span> -->
                    </div>
                    <div class="spd spd_fs_16 spd_fw_400   sb_m_alert_pnl spd_mb_00">
                        Screenshot the <span class="spd_fw_700 spd_clr_red">Proof of payment</span> and Click on
                        <span class="spd_fw_700 spd_clr_red">I have paid seller</span> to have the trade processed In time
                    </div>
                    <div class="spd spd_fw_500 spd_fs_20 spd_mt_30 spd_mb_20 "> Payment Details</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sb_m_np2_ps_bx">
                                <div class="spd spd_fs_14 spd_fw_500  spd_mb_05">Amount to be paid</div>
                                <div class="spd spd_fs_22 spd_fw_700 spd_clr_orange"><?php echo ($fiatAmt); ?> <?php 
                                                            
                                echo getfiatcurrency($gettrade->fiat_currency);
                                                        
                                ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sb_m_np2_ps_bx">
                                <div class="spd spd_fs_14 spd_fw_500  spd_mb_05">Payment method</div>
                                <?php if($gettrade->payment_method==2){
                                  $Payment = $gettrade->bank;
                                }else {
                                    $Payment = get_paymentname($gettrade->payment_method);
                                } ?>
                                <div class="spd spd_fs_22 spd_fw_700 spd_clr_orange"><?php echo $Payment;?></div>
                            </div>
                        </div>
                    </div>

                    <?php $attributes=array('id'=>'myBuyForm',"autocomplete"=>"off"); 
                    $action = base_url().'p2p_pay_detail/'.$type.'/'.encryptIt($gettrade->tradeid);
                              echo form_open_multipart($action,$attributes); ?>  
                    <input type="hidden" name="fiat_amt" value="<?=$fiatAmt?>">
                    <input type="hidden" name="crypto_amt" value="<?=$cryptoAmt?>">
                    <button type="button" class="sb_m_1_btn w-100 text-center spd_ml_00 iamreadytopay">I am Ready To Pay</button>
                    <?php echo form_close();?>

                    <!-- <a href="javascript:;" data-tradeorder_id="<?php echo $gettrade->id; ?>"  data-trade_id="<?php echo $gettrade->tradeid; ?>" data-price="<?php if($f = $fiatAmt){
            echo $f; 
        }else{
            echo ($gettrade->price);
        }    ?>" data-price_symbol="<?php echo $fiatcurrency; ?>" data-fiatcurrency="<?php 
        if($c = $cryptoAmt){
            echo $c; 
        }else{
            echo ($gettrade->trade_amount);     
        }  ?>" data-fiatcurrency_symbol="<?php echo $crypto; ?>"  class="sb_m_1_btn w-100 text-center spd_ml_00 iamreadytopay">I am Ready To Pay</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('front/common/footer');
?>

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();
    let p2ppaydetails = "<?php echo base_url('p2p_pay_detail/'.$type.'/'.$trade_id_enc); ?>";
    let baseURL = "<?php echo base_url(); ?>";
    let currentURL = url = window.location.href;

    // Update the count down every 1 second
    // var x = setInterval(function() {

    //     // Get today's date and time
    //     var now = new Date().getTime();

    //     // Find the distance between now and the count down date
    //     var distance = countDownDate - now;

    //     // Time calculations for days, hours, minutes and seconds
    //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    //     // Display the result in the element with id="demo"
    //     document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
    //         minutes + "m " + seconds + "s ";

    //     // If the count down is finished, write some text
    //     if (distance < 0) {
    //         clearInterval(x);
    //         document.getElementById("demo").innerHTML = "EXPIRED";
    //     }
    // }, 1000);


    $(function() {
        jQuery(document).on('click','.iamreadytopay', function(event) {
            event.preventDefault();

            let _this = $(this);
            let f= "<?php echo $fiatAmt; ?>";
            let c= "<?php echo $cryptoAmt; ?>";
            
            if(f && c) {
                $( "#myBuyForm" ).trigger( "submit" );
            } else {
                tata.warn('Stormbit!', 'Invalid Data');  
            }
            return false;    



            let trade_id = _this.data('trade_id');
            let price = _this.data('price');
            let price_symbol = _this.data('price_symbol');
            let fiatcurrency = _this.data('fiatcurrency');
            let tradeorder_id = _this.data('tradeorder_id');
            let fiatcurrency_symbol = _this.data('fiatcurrency_symbol');
            let _type = "<?php echo $type; ?>";

            let data = {
                'trade_id': trade_id,
                'tradeorder_id': tradeorder_id,
                fiatcurrency: f,        
                cryptocurrency: c,
                type: _type,       
                trade_btn_buy: 'submit'
            };
            

            $.ajax({
            url: baseURL + "p2porderbuy",
            type: 'POST',
            dataType: 'json',            
            data: data,
            })
            .done(function() {
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function(response) {
                // console.log("complete", response);
                 _this.prop('disabled', false);
                    // console.log(response, response.status == false && response.code == '401');return;
                    if (response.status == false && response.code == '401') {
                        let removeRedirects = removeURLParameter(document.location.search, 'offer');
                        let here = "<?php echo base_url('signin') ?>" + removeRedirects + '&redirect=offer';
                        window.location.href = here;

                    } else if (response.status == false) {
                        window.location.reload(1);
                    } else if (response.status == true) {

                        var f1= "<?php echo $fiatAmt; ?>";
                        var c1= "<?php echo $cryptoAmt; ?>";

                        // console.log( f1, c1 ); return false;
                        <?php 
                        if($cryptoAmt && $fiatAmt){  ?>
                            if(response.type == 'success'){
                                tata.success('Stormbit! ' + response.msg);                            
                            }else if(response.type == 'warn'){
                                tata.warn('Stormbit!', response.msg);    
                            }                            
                            setTimeout(function(){
                                console.log(response.type, response.msg, baseURL + 'p2p_pay_detail/' + _type + '/' + response.redirect + '?c=' + c1 + '&f=' + f1);
                                // window.location.href = baseURL + 'p2p_pay_detail/' + _type + '/'  + response.redirect + '?c=' + c + '&f=' + f;
                            },1000);
                        <?php }else{  ?>
                            if(response.type == 'success'){
                                tata.success('Stormbit! ' + response.msg);                            
                            }else if(response.type == 'warn'){
                                tata.warn('Stormbit!', response.msg);    
                            }
                            setTimeout(function(){
                                window.location.href = baseURL + 'p2p_pay_detail/' + response.redirect;},1000);
                        <?php } ?>

                    }                
            });
        });
        
        
    });
</script>
</body>

</html>