<?php
$this->load->view('front/common/header');

// print_r($gettrade);exit;

$tradeopentime = $gettrade->tradeopentime;
// $currentDate = strtotime($tradeopentime);
$currentDate = time();
if ($min = $gettrade->payment_window) {
    $futureDate = $currentDate + (60 * $min); //30 minute    
} else {
    $futureDate = $currentDate + (60 * 30); //30 minute
}

// $futureDate = time() + (60 * 30);
$getDateTime = date("F d, Y H:i:s", $futureDate);

if($gettrade->buyerid == $user_id){
    // seller section
    $typeof = 'seller';
    $nameof = ucfirst(username($gettrade->sellerid));
}else if($gettrade->sellerid == $user_id){
    // Buyer section
    $typeof = 'buyer';
    $nameof = ucfirst(username($gettrade->buyerid));    
} else {
    $nameof = ucfirst(username($gettrade->user_id));
}


// echo "<pre>";print_r($gettrade);



// if($gettrade->user_id == $user_id){
//     // Buyer section
//     $typeof = 'buyer';
//     $nameof = ucfirst(username($gettrade->user_id));
// }else{
    
//     // seller section
//     $typeof = 'seller';
//     $nameof = ucfirst(username($gettrade->user_id));
// }

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
                        You are buying <span class="sb_m_np2_badg sb_m_np2_badg_green"><?php echo $cryptoAmt?> <?php echo currency($gettrade->cryptocurrency); ?></span> from <span class="spd_clr_orange2"><?php echo $nameof; ?></span> <?php echo getfiatcurrency($gettrade->fiat_currency); ?> of the
                    seller is already locked and secured for this trade. Please send
                    payment to the seller then confirm below.
                </div>
                <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 spd_mb_20 spd_mt_25">
                    Time left to pay <span class="sb_m_np2_badg sb_m_np2_badg_light">
                        <!-- Display the countdown timer in an element -->
                        <p id="demo"></p>
                    </span>
                </div>
                <div class="spd spd_fs_16 spd_fw_400   sb_m_alert_pnl spd_mb_00">
                    Screenshot the <span class="spd_fw_700 spd_clr_red">Proof of payment</span> and Click on
                    <span class="spd_fw_700 spd_clr_red">I have paid seller</span> to have the trade processed In time
                </div>
                <div class="spd spd_fw_500 spd_fs_20 spd_mt_30 spd_mb_20 "> Payment Details</div>
                <div class="sb_m_np2_sel_settt ">

                    <?php

                    if ($gettrade && ($gettrade->payment_method==2)) { 
                        
                        ?>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                                Transfer money to account number </br>
                                <span class="sb_m_np2_cpy_txt"><?php echo strtoupper($gettrade->bank_acc_number); ?> </span><i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                            Bank account name </br>
                            <span class="sb_m_np2_cpy_txt"><?php echo strtoupper($gettrade->bank_acc_name); ?> </span><i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                        Bank </br>
                        <span class="sb_m_np2_cpy_txt"><?php echo strtoupper($gettrade->bank); ?></span><i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                    IFSC code </br>
                    <span class="sb_m_np2_cpy_txt"><?php echo strtoupper($gettrade->bank_ifsc); ?> </span><i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                Exactly with the amount </br>
                <span class="sb_m_np2_cpy_txt"> <?php echo $fiatAmt; ?> <?php echo strtoupper(getfiatcurrency($gettrade->fiat_currency)); ?> </span><i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
            Exactly with the content </br>
            <span class="sb_m_np2_cpy_txt"><?php echo $gettrade->terms_conditions; ?> </span>
            <i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
        </div>
    </div>
    <!-- <div class="col-md-12">
        <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 spd_mb_15">
            to be confirmed for this transaction Buyer bears INR sending fee
        </div>
    </div> -->
</div>
<?php  }else{ ?>
      <div class="row ">
            <div class="col-md-6">
                <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                Transfer money to account number </br>
                <span class="sb_m_np2_cpy_txt"><?php echo strtoupper($gettrade->paytm); ?> </span><i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
            </div>
        </div>       
<?php } ?>
</div>
<div class="row">
    <div class="col-md-6 col-auto">
        <a href="<?=base_url().'offer'?>" class="sb_m_2_btn sb_m_2_btn_red w-100 text-center spd_ml_00"><span>Cancel </span></a>
    </div>
    <div class="col-md-6 col">
        <!-- <a href="<?php //echo base_url('p2p_pay_verify/' . $trade_id_enc); ?>" class="sb_m_1_btn  w-100 text-center spd_ml_00">I have Paid Seller</a> -->
        <?php $attributes=array('id'=>'myBuyForm',"autocomplete"=>"off"); 
            // $action = base_url().'p2p_pay_confirmation/'.$type.'/'.encryptIt($gettrade->tradeid);
            $action = '';
            echo form_open_multipart($action,$attributes); ?>
            <input type="hidden" name="oid" id="oid" value="<?=$tradeorder_id_enc?>">
            <input type="hidden" name="tradeid" id="tradeid" value="<?=$gettrade->tradeid?>">
            <input type="hidden" name="fiat_amt" id="fiat_amt" value="<?=$fiatAmt?>">
            <input type="hidden" name="crypto_amt" id="crypto_amt" value="<?=$cryptoAmt?>">
            <input type="hidden" name="type" id="type" value="<?=$type?>">
            <button type="button" class="sb_m_1_btn  w-100 text-center spd_ml_00 sb_m_2_btn_orange">I have Paid Seller</button>
        <?php echo form_close();?>    

        <!-- <a href="javascript:;" data-tradeorder_id="<?php echo $gettrade->id; ?>"  data-trade_id="<?php echo $gettrade->tradeid; ?>" data-price="<?php if($f = $this->input->get('f')){
            echo $f; 
        }else{
            echo ($gettrade->price);
        }    ?>" data-price_symbol="<?php echo $fiatcurrency; ?>" data-fiatcurrency="<?php 
        if($c = $this->input->get('c')){
            echo $c; 
        }else{
            echo ($gettrade->trade_amount);     
        }  ?>" data-fiatcurrency_symbol="<?php echo $crypto; ?>"  class="sb_m_1_btn  w-100 text-center spd_ml_00 sb_m_2_btn_orange" >I have Paid Seller</a> -->
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
    let baseURL = "<?php echo base_url(); ?>";
    let currentURL = url = window.location.href;
    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();
    let _type = "<?php echo $type; ?>";

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



    function insertParam(key, value) {
        key = encodeURIComponent(key);
        value = encodeURIComponent(value);

        // kvp looks like ['key1=value1', 'key2=value2', ...]
        var kvp = document.location.search.substr(1).split('&');
        let i = 0;

        for (; i < kvp.length; i++) {
            if (kvp[i].startsWith(key + '=')) {
                let pair = kvp[i].split('=');
                pair[1] = value;
                kvp[i] = pair.join('=');
                break;
            }
        }

        if (i >= kvp.length) {
            kvp[kvp.length] = [key, value].join('=');
        }

        // can return this or...
        let params = kvp.join('&');

        let removePage = params.split('&').map(function(v) {
            return v.includes('page') ? "page=1" : v;
        }).filter(n => n).join('&');


        // reload page with new params
        document.location.search = removePage;
    }


    function removeURLParameter(url, parameter) {
        //prefer to use l.search if you have a location/link object
        var urlparts = url.split('?');
        if (urlparts.length >= 2) {

            var prefix = encodeURIComponent(parameter) + '=';
            var pars = urlparts[1].split(/[&;]/g);

            //reverse iteration as may be destructive
            for (var i = pars.length; i-- > 0;) {
                //idiom for string.startsWith
                if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                    pars.splice(i, 1);
                }
            }

            return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
        }
        return url;
    }



$(document).ready(function() {
    $(document).on("click", ".sb_m_2_btn_orange", function(e) {
        e.preventDefault();
        let _this = $(this);
        _this.prop('disabled', true);
        
        let oid = $('#oid').val();
        let tradeid = $('#tradeid').val();
        let type = $('#type').val();
        let fiat_amt = $('#fiat_amt').val();
        let crypto_amt = $('#crypto_amt').val();
        let status = '<?=$status?>';

               

        let data = {
            orderId: oid,
            trade_id: tradeid,
            fiat_amt: fiat_amt,        
            crypto_amt: crypto_amt,
            type: type, 
            status: status,      
            trade_btn_buy: 'submit'
        };

        // console.log( data )
        // return false; 

        $.ajax({
            type: "POST",
            url: baseURL + "p2porderbuy",
            data: data,
            dataType: "json",
            success: function(response) {

                // console.log(response); return false;

                let fiat_amt1 = $('#fiat_amt').val();
                let crypto_amt1 = $('#crypto_amt').val();

                _this.prop('disabled', false);
                // console.log(response, response.status == false && response.code == '401');return;
                if (response.status == false && response.code == '401') {
                    let removeRedirects = removeURLParameter(document.location.search, 'offer');
                    let here = "<?php echo base_url('signin') ?>" + removeRedirects + '&redirect=offer';
                    window.location.href = here;

                } else if (response.status == false) {
                    // window.location.reload(1);
                    tata.warn('Stormbit!', response.msg);  
                    window.location.href = baseURL;
                } else if (response.status == true) {

                    if(response.type == 'success'){
                        tata.success('Stormbit! ' + response.msg);                            
                    }else if(response.type == 'warn'){
                        tata.warn('Stormbit!', response.msg);    
                    }

                    if(fiat_amt1 && crypto_amt1) {
                        setTimeout(function(){
                            // console.log(response.type, response.msg, baseURL + 'p2p_pay_confirmation/' + _type + '/' + response.redirect + '?c=' + crypto_amt1 + '&f=' + fiat_amt1);
                            // window.location.href = baseURL + 'p2p_pay_confirmation/' + _type + '/'  + response.redirect + '?c=' + c + '&f=' + f;
                            url = baseURL + 'p2p_pay_confirmation/' + _type + '/'  + response.redirect;
                            $('#myBuyForm').attr('action', url).submit();

                           // $( "#myBuyForm" ).trigger( "submit" );
                        },1000);
                    } else {
                        // setTimeout(function(){
                        //     window.location.href = baseURL + 'p2p_pay_confirmation/' + response.redirect;},1000);
                    }




                }
            }
        });
    });
});
</script>
</body>

</html>