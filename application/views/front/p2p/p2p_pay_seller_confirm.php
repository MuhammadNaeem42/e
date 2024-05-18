<?php
$this->load->view('front/common/header');

$c= $crypto_amt;
$f= $fiat_amt;
$user_id = $this->session->userdata('user_id');
$tradeid = $gettrade->tradeid;
$id = $gettrade->order_id;

$dispute_link = base_url('p2p_dispute/' . $tradeid . '/' . $id);

$tradeopentime = $gettrade->tradeopentime;
$currentDate = strtotime($tradeopentime);
if ($min = $gettrade->payment_window) {
    $futureDate = $currentDate + (60 * $min); //30 minute    
} else {
    $futureDate = $currentDate + (60 * 30); //30 minute
}

// echo $user_id."<hr>";
// echo $type;echo "<br>";
// echo "<pre>";print_r($gettrade);
$getDateTime = date("F d, Y H:i:s", $futureDate);

if($gettrade->buyerid == $user_id){
    // Buyer section
    $typeof = 'buyer';
    // $nameof = ucfirst(username($gettrade->buyerid));
    $nameof = ucfirst(username($gettrade->sellerid));
}else{
    // seller section
    $typeof = 'seller';
    // $nameof = ucfirst(username($gettrade->sellerid));
    $nameof = ucfirst(username($gettrade->buyerid));
}
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
                        You are buying <span class="sb_m_np2_badg sb_m_np2_badg_green">

                            <?php echo $crypto_amt;                     

                    ?><?php echo currency($gettrade->cryptocurrency); ?></span> from <span class="spd_clr_orange2"><?php echo $nameof; ?></span> <?php echo getfiatcurrency($gettrade->fiat_currency); ?> of the
                        seller is already locked and secured for this trade. Please send
                        payment to the seller then confirm below.
                    </div>
                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 spd_mb_20 spd_mt_25">
                        Waiting for the seller to check the payment <span class="sb_m_np2_badg sb_m_np2_badg_light">
                            <!-- Display the countdown timer in an element -->
                            <p id="demo"></p>
                        </span>
                    </div>
                    <div class="spd spd_fs_16 spd_fw_400   sb_m_alert_pnl spd_mb_00">
                        <span class="spd_fw_700 spd_clr_red"> Attention!</span> Please upload proof of payment so that the transaction can be
                        automatically completed In case the seller does not confirm. Otherwise
                        after <?php echo $min ? $min : 30; ?> minutes the transaction will be automatically canceled
                    </div>
                    <?php if($typeof=='buyer'){ ?>
                    <div class="spd spd_fw_400 spd_fs_16 spd_mt_30 spd_mb_20 spd_op_07"> 
                    <?php if($gettrade->paid_invoice_confirmation=='') { echo 'Please upload the paid Invoice for this transaction to confirm your payment'; }?>    
                    </div>
                    <form action="" id="fileForm" method="post" enctype="multipart/form-data">
                    <div class="sb_m_np2_file_up_set">
                    <?php if($gettrade->paid_invoice_confirmation=='') {?>    
                        <input type="file" class="sb_m_np2_file_up_input paid_invoice_confirmation proof_confitmation" name="paid_invoice_confirmation">
                        <div class="sb_m_np2_file_up_in">
                            <i class="fal fa-file-upload"></i>
                            Click To Upload Payment Proof
                        </div>
                    <?php }?>    
                        <div id="paid_invoice_confirmation_preview" class="gallery"><?php echo ($gettrade->paid_invoice_confirmation)?
                        '<a data-lightbox="image-1" href="'.$gettrade->paid_invoice_confirmation.'"><img src="'.$gettrade->paid_invoice_confirmation.'"  height="100" width="100" alt="image"></a>':'';
                         ?></div>
                    </div>
                    </form>
                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 spd_mb_20 spd_mt_25">
                        <!-- Submit proof of sent funds <span class="sb_m_np2_badg sb_m_np2_badg_light">
                            <p id="demo"></p>
                        </span> -->
                    </div>
                    <!-- <form action="" id="fileForm1" method="post" enctype="multipart/form-data">
                        <div class="sb_m_np2_file_up_set">
                            <input type="file" class="sb_m_np2_file_up_input sent_proof_confitmation proof_confitmation" name="sent_proof_confitmation">
                            <div class="sb_m_np2_file_up_in">
                                <i class="fal fa-file-upload"></i>
                                Click To Proof of sent funds
                            </div>
                            <div id="sent_proof_confitmation_preview" class="gallery"><?php echo ($gettrade->sent_proof_confitmation)?
                        '<a data-lightbox="image-2"  href="'.$gettrade->sent_proof_confitmation.'" ><img src="'.$gettrade->sent_proof_confitmation.'" height="100" width="100" alt=" image"></a>':'';
                         ?></div>
                        </div>
                    </form> -->
                    <?php }else{ ?>
                        <?php if($gettrade->paid_invoice_confirmation){ ?>
                         <div id="paid_invoice_confirmation_preview" class="gallery"><?php echo ($gettrade->paid_invoice_confirmation)?                        
                        '<a data-lightbox="image-1" href="'.$gettrade->paid_invoice_confirmation.'"><img src="'.$gettrade->paid_invoice_confirmation.'"  height="100" width="100" alt="image"></a>':'';
                         ?></div>
                     <?php } 
                     if($gettrade->sent_proof_confitmation){
                     ?>
                            <div id="sent_proof_confitmation_preview" class="gallery"><?php echo ($gettrade->sent_proof_confitmation)?
                        '<a data-lightbox="image-2"  href="'.$gettrade->sent_proof_confitmation.'"><img src="'.$gettrade->sent_proof_confitmation.'" height="100" width="100" alt=" image"></a>':'';
                         ?></div>
                    <?php } } ?>
                        <div class="row spd_mb_35">
                            <div class="col-auto ">
                                <!-- <a href="javascript:;" data-toggle="modal" data-target="#largeModal" class="sb_m_2_btn sb_m_2_btn_red  spd_ml_00 p2p_order_cancel"><span>Cancel </span></a> -->
                            </div>
                            <div class="col-auto ">
                                <a target="_blank" href="javascript:;" class="sb_m_2_btn spd_ml_00 dispute_link"><span>Dispute</span></a>
                            </div>
                            <?php if($typeof=='buyer' ){ ?>
                            <!-- <div class="col-auto ">
                                <a href="tel:+919000000000" class="sb_m_1_btn spd_ml_00">Summon Trader</a>
                            </div> -->
                            <?php } ?>
                            
                        <?php if($typeof=='seller' && $gettrade->paid_invoice_confirmation && $gettrade->escrowstatus=='waiting' && $gettrade->tradestatus1=='open'){ ?>
                            
                             <div class="col-auto ">
                                <a href="javascript:;" class="sb_m_1_btn spd_ml_00 sb_m_2_btn_green">I have receive payemnt</a>
                            </div>
                        <?php } ?>
                        </div>
                    
                    <!-- <div class="sb_m_np2_ps_setttt ">
                        <span class="sb_m_np2_badg sb_m_np2_badg_green spd_fw_600 spd_fs_16">BUY</span> <img src="assets/img/aico-4.png" class="sb_m_np2_ps_ico">Tether USDT
                    </div> -->
                    <?php if($typeof != 'seller'){ ?>
                    <div class="sb_m_np2_sel_settt spd_mb_00">
                        <?php if ($gettrade && ($gettrade->payment_method==2)) { ?>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                                        Status </br>
                                        <span class="sb_m_np2_cpy_txt spd_clr_orange2">
                                        <?php if($gettrade->escrowstatus=='waiting') {
                                            echo 'Waiting for the seller';
                                        } else {
                                            echo 'Released Crypto';
                                        }  ?> 
                                        
                                        </span>
                                    </div>
                                </div>
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
                                        <span class="sb_m_np2_cpy_txt"><?php 

                                            if($f = $this->input->get('f')){
                                                echo $f; 
                                            }else{
                                                echo ($gettrade->price);
                                            }   
                                            
                                             ?> <?php echo strtoupper(getfiatcurrency($gettrade->fiat_currency)); ?> </span><i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 spd_mb_15">
                                        to be confirmed for this transaction
                                        Buyer bears INR sending fee
                                    </div>
                                </div>
                            </div>
                        <?php  }else{ ?>
                          <div class="row ">
                                <div class="col-md-6">
                                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                                        Status </br>
                                        <span class="sb_m_np2_cpy_txt spd_clr_orange2">
                                        <?php if($gettrade->escrowstatus=='waiting') {
                                            echo 'Waiting for the seller';
                                        } else {
                                            echo 'Released Crypto';
                                        }  ?> 
                                        
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                                    Transfer money to account number </br>
                                        <span class="sb_m_np2_cpy_txt"><?php echo strtoupper($gettrade->paytm); ?> </span><i class="fal fa-clipboard sb_m_np2_cpy_btn "></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="spd spd_fs_16 spd_fw_400 spd_clr_op_06 sb_m_np2_cpy_set">
                                    Exactly with the amount </br>
                                    <span class="sb_m_np2_cpy_txt"><?php  echo ($gettrade->fiat_amount);?> <?php echo strtoupper(getfiatcurrency($gettrade->fiat_currency)); ?> </span>
                                    </div>
                                </div>
                                
                            </div>       
                    <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- large modal -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Reason For Cancel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="myform">
                <div class="modal-body">
                    <textarea name="cancelreason" id="cancelreason" style="width:100%" rows="5" placeholder="Cancel to reason"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary cancelled">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$this->load->view('front/common/footer');
?>
<link href="<?php echo base_url('assets/front/js/lightbox2/css/lightbox.css'); ?>"rel="stylesheet" />
<script src="<?php echo base_url('assets/front/js/lightbox2/js/lightbox.js'); ?>" type="text/javascript" charset="utf-8" async defer></script>

<script>
    let baseURL = "<?php echo base_url(); ?>";
    let currentURL = url = window.location.href;
    let payment_release = "<?php echo  base_url('p2p_release/'.$type.'/'.$tradeid.'/'.$id); ?>";

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

    $(document).ready(function() {


        // var gallery = $('.gallery a').simpleLightbox();
        //     gallery.next(); 

        // $('.gallery a').simpleLightbox();

            lightbox.option({
              'resizeDuration': 200,
              'wrapAround': true
            })


        $(document).on('click', '.p2p_order_cancel', function() {
            $("#largeModal").modal("show");
        });


        $(document).on('click', '.cancelled', function(e) {
            e.preventDefault();

            let _this = $(this);
            let cancelreason = $('#cancelreason').val();
            console.log(cancelreason);
            if (cancelreason) {
                $.ajax({
                    type: "POST",
                    url: baseURL + "p2pordercancel",
                    data: {
                        'cancelreason': cancelreason
                    },
                    dataType: "dataType",
                    success: function(response) {

                    }
                });
            }
        });


        $(document).on('change', '.paid_invoice_confirmation', function(e) {
            e.preventDefault();
            let _this = $(this);
            let form = $('#fileForm')[0];
            let fd = new FormData(form);

            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only formats are allowed : "+fileExtension.join(', '));
                return false;
            }

            // console.log('check'); return false;

            $.ajax({
                type: "post",
                url: currentURL,
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    console.log(response);
                    let res = $.parseJSON(response);
                    if(res.status==true){
                        let img = '<img src="'+ res.file +'" height="50" width="50" alt="img">';
                        console.log(img);
                        $('#paid_invoice_confirmation_preview').html(img);
                        tata.success(res.msg);
                    }else{
                        tata.warn(res.msg);
                    }

                }
            });
     
        });

           $(document).on('click', '.sb_m_2_btn_green', function(e) {
            e.preventDefault();
            let _this = $(this);            
            $.ajax({
                type: "post",
                url: payment_release,
                data: {'submit':"<?php echo uniqid(); ?>", c:'<?php echo $c; ?>', f: '<?php echo $f; ?>'},
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    // let res = $.parseJSON(response);
                    if(response.status==true){                        
                        tata.success(response.msg);
                        setTimeout(function(){ window.location.href="<?php echo base_url('wallet'); ?>"; }, 3000);
                    }else{
                        tata.warn(response.msg);
                    }

                }
            });
     
        });


        $(document).on('change', '.sent_proof_confitmation', function(e) {
            e.preventDefault();
            let _this = $(this);
            let form = $('#fileForm1')[0];
            let fds = new FormData(form);
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only formats are allowed : "+fileExtension.join(', '));
                return false;
            }
            $.ajax({
                type: "post",
                url: currentURL,
                data: fds,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    console.log(response);                    
                    let res = $.parseJSON(response);
                    if(res.status==true){
                        let img = '<img src="'+ res.file +'" height="50" width="50" alt="img">';
                        console.log(img);
                        $('#sent_proof_confitmation_preview').html(img);
                        tata.success(res.msg);
                    }else{
                        tata.warn(res.msg);
                    }
                }
            });            
        });


        $(document).on('click', '.dispute_link', function(event) {
            event.preventDefault();
            /* Act on the event */
            let link = "<?php echo $dispute_link; ?>";
            $.ajax({
                type: "post",
                url: currentURL,
                data: {'dispute_submit': "<?php echo uniqid(); ?>", order_id : "<?php echo $id; ?>" },
                type: 'POST',
                success: function(response) {
                    // console.log(response); return false;                   
                    let res = $.parseJSON(response);
                    if(res.status==true){                        
                        tata.success(res.msg);
                    }else{
                        tata.warn(res.msg);
                    }

                    setTimeout(function(){ 
                        // window.location.href=res.redirect; 
                        window.open(res.redirect, '_blank');
                    }, 3000);
                }
            }); 

        });


    });
</script>
</body>

</html>