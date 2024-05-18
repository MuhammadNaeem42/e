<?php
$this->load->view('front/common/header');

// echo "<pre>";print_r($gettrade->tradeid);exit;

// $tradeopentime = $gettrade->tradeopentime;
// $currentDate = strtotime($tradeopentime);
// if($min = $gettrade->payment_window){
//     $futureDate = $currentDate + (60 * $min); //30 minute    
// }else{
//     $futureDate = $currentDate + (60 * 30); //30 minute
// }

$futureDate = time() + (60 * 30);

$getDateTime = date("F d, Y H:i:s", $futureDate);
?>

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
                        You are buying <span class="sb_m_np2_badg sb_m_np2_badg_green"><?php echo ($gettrade->trade_amount); ?> <?php echo currency($gettrade->cryptocurrency); ?></span> from <span class="spd_clr_orange2">Trader</span> Tether USDT of the
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sb_m_np2_ps_bx">
                                <div class="spd spd_fs_14 spd_fw_500  spd_mb_05">Amount to be paid</div>
                                <div class="spd spd_fs_22 spd_fw_700 spd_clr_orange"><?php echo ($gettrade->price); ?> <?php 
                                                            
                                echo getfiatcurrency($gettrade->fiat_currency);
                                                        
                                ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="sb_m_np2_ps_bx">
                                <div class="spd spd_fs_14 spd_fw_500  spd_mb_05">Bank transfer content</div>
                                <div class="spd spd_fs_22 spd_fw_700 spd_clr_orange"><?php echo ($gettrade->price); ?> <?php echo getfiatcurrency($gettrade->fiat_currency); ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url('p2p_pay_details/'.$trade_id_enc); ?>" class="sb_m_1_btn w-100 text-center spd_ml_00">I am Ready To Pay</a>
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
</script>
</body>
</html>