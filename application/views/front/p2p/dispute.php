<?php
$this->load->view('front/common/header');
$user_id = $this->session->userdata('user_id');
$seller_detail = $this->common_model->getTableData('users', array('id' => $gettrade->sellerid))->row();
$buyerid_detail = $this->common_model->getTableData('users', array('id' => $gettrade->buyerid))->row();
$seller_detail->profile_picture;
// print_r($seller_detail);exit;
$seller_profile_image = getUserProfile($gettrade->sellerid);
$buyer_profile_image = getUserProfile($gettrade->buyerid);

if($gettradeorder->buyerid==$user_id) {
    $name = ucfirst(UserName($user_id));
} else if($gettradeorder->sellerid==$user_id) {
    $name = ucfirst(UserName($user_id));
} else {
    $name = 'Admin';
}



?>
<div class="sb_main_content sb_oth_main">
    <div class="container">
        <div class="row ">
            <!-- <div class="col-md-4">
                <div class="sb_msup_supo_suppo_list_out">
                    <a href="#" class="d-block">
                        <div class="sb_msup_supo_suppo_list sb_msup_supo_suppo_list_act">
                            <div class="sb_msup_supo_suppo_list_h1">
                                <img class="sb_msup_supo_exp_ch_top_ico sb_msup_supo_exp_ch_top_ico_p2p" src="assets/img/avt.png">
                                <div class="sb_msup_supo_exp_ch_top_h1 spd spd_fs_16 spd_fw_600 spd_mb_05">Raja</div>
                                <div class="sb_msup_supo_exp_ch_top_h1 spd spd_fs_12 spd_op_05">100BTC to 130ETH</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="d-block">
                        <div class="sb_msup_supo_suppo_list">
                            <div class="sb_msup_supo_suppo_list_h1">
                                <img class="sb_msup_supo_exp_ch_top_ico sb_msup_supo_exp_ch_top_ico_p2p" src="assets/img/avt2.png">
                                <div class="sb_msup_supo_exp_ch_top_h1 spd spd_fs_16 spd_fw_600 spd_mb_05">Kumar</div>
                                <div class="sb_msup_supo_exp_ch_top_h1 spd spd_fs_12 spd_op_05">100BTC to 130ETH</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div> -->
            <div class="col-md-8">
                <div class="sb_msup_supo_chat_set">
                    <div class="sb_msup_supo_exp_ch_top">
                        <img class="sb_msup_supo_exp_ch_top_ico sb_msup_supo_exp_ch_top_ico_p2p" src="<?php echo $seller_profile_image; ?>">
                        <div class="sb_msup_supo_exp_ch_top_h1 spd spd_fs_16 spd_fw_600 spd_mb_05"><?php echo $name; ?></div>
                        <!-- <div class="sb_msup_supo_exp_ch_top_h1 spd spd_fs_12 spd_op_05"><?php echo ($gettrade->crypto_amount); ?> <?php echo ($gettrade->fiatcurrency_symbol); ?> to <?php echo ($gettrade->fiat_amount); ?> <?php echo ($gettrade->price_symbol); ?></div> -->
                    </div>
                    <div class="sb_msup_supo_exp_ch_bdy_out sb_msup_supo_exp_pag_scroll">

                        <div class="sb_msup_supo_exp_ch_bdy" id="chat-body-content">
                        </div>
                        <div id='focust-test' class="focust-test" tabindex='1'></div>
                    </div>
                    <div class="sb_msup_supo_exp_ch_btm">
                        <form action="" id="myForm" enctype="multipart/form-data">

                            <input type="hidden" name="admin_status" id="admin_status" value="<?php echo ($user_type=='Admin')?'1':'0' ?>">
                            <input type="hidden" name="tradeorderid" id="tradeorderid" value="<?php echo $trade_order_id; ?>">
                            <input type="text" class="sb_msup_supo_exp_ch_text chat_message" placeholder="Type Message" name="chat_message" id="chat_message">
                            <i class="fal fa-file sb_msup_supo_exp_ch_text_fil"></i>
                            <input type="file" class="sb_msup_supo_exp_ch_text_fil_in image" name="image" id="image">
                            <a href="javascript:;" class="d-block a-form-submit"><i class=" sb_msup_supo_exp_ch_text_i fal fa-arrow-right"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('front/common/footer');
?>
<!-- <script src="https://www.jqueryscript.net/demo/Set-Focus-On-Multiple-Input-Fields-jQuery-MultiFocus/multifocus.js"></script> -->

<script>
    let baseURL = "<?php echo base_url(); ?>";
    let id = "<?php echo $trade_id_enc; ?>";
    let tradeorderid = "<?php echo $trade_order_id; ?>";
    let prime_user_id = "<?php echo $user_id; ?>";

    // console.log(prime_user_id, '----')
    $(document).ready(function() {

        $('#myForm').bind("keypress", function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });

        $.fn.chatWrapper = (data) => {
            let i;
            let L = data.length;
            let finalData = '',
                html = '';

            // console.log( data )    

            for (const obj of data) {

                if (obj.user_id == prime_user_id) {
                    html += '<div class="sb_msup_supo_exp_ch_li_blk">\
                    <div class="sb_msup_supo_exp_ch_li cht_me">\
                        <img src="' + obj.user_id_userimage + '" class="sb_msup_supo_exp_ch_li_img">';
                    html += '<img src="' + obj.image + '" class="img-fluid">';
                    html += obj.comment;
                    html += '</div></div>';
                } else {
                    html += '<div class="sb_msup_supo_exp_ch_li_blk">\
                    <div class="sb_msup_supo_exp_ch_li">\
                        <img src="' + obj.left_userimage + '" class="sb_msup_supo_exp_ch_li_img">';
                    html += '<img src="' + obj.image + '" class="img-fluid">';    
                    html += obj.comment;
                    html += '</div></div>';
                }
            }
            return html;
        }

        $.fn.getData = () => {
            $.ajax({
                type: "get",
                url: baseURL + "p2p_chat/" + id + '/' + tradeorderid,
                dataType: "json",
                success: function(response) {

                    // console.log(response); 
                    // return false;
                    if (response.status == true) {
                        $('#chat-body-content').html($.fn.chatWrapper(response.chats));
                        $('.chat_message,.focust-test').focus();
                    }
                }
            });
        }

        // $.fn.getData();
        setInterval(function() {
            $.fn.getData();
        }, 3000); // where X is your every X minutes


        $(document).on('click', '.a-form-submit', function(e) {
            e.preventDefault();
            let _this = $(this);
            let form = $('#myForm')[0];
            // console.log(form);
            var fd = new FormData(form);
            // fd.append('file', input.files[0]);
            // console.log(fd); 
            // return false;
            $.ajax({
                type: "post",
                url: baseURL + "p2psend_message",
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(response) {
                    // console.log(response); return false;
                    $.fn.getData();
                    $('.chat_message').val('');
                }
            });
        });

    });
</script>