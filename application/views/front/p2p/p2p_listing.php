<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome To Stormbit</title>
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/front/img/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/owl.carousel.min.css">
</head>

<body>
    <div class="sb_loader">
        <div id="sb_loader_ico"></div>
    </div>
    <form>
        <header class="sb_hdr_tot">
            <div class="container-fluid sb_hdr_container">
                <div class="sb_hdr_inrset">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <a href="index.html" class="sb_hdr_logo">
                                <img src="<?php echo base_url() ?>assets/front/img/logo.png" alt="Image">
                            </a>
                        </div>
                        <div class="col-auto sb_hdr_ul_col">
                            <ul class="sb_hdr_ul">
                                <i class="sb_hdr_mbl_menu_cls fa fa-times"></i>
                                <li class="sb_hdr_li"><a href="#">Home</a></li>
                                <li class="sb_hdr_li"><a href="#">Markets</a></li>
                                <li class="sb_hdr_li"><a href="#">NFT</a></li>
                                <li class="sb_hdr_li"><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="sb_hdr_right_signing_btn_set">

                                <a href="#" class="sb_hdr_right_btn">Sign Up</a>
                                <a href="#" class="sb_hdr_right_btn sb_hdr_right_btn_act">Sign In</a>
                            </div>
                        </div>
                    </div>

                    <i class="sb_hdr_mbl_menu_btn far fa-bars"></i>
                </div>
            </div>
        </header>
    </form>


    <div class="sb_main_content sb_oth_main">
        <div class="container">
            <form method='get' action="" id="formofferlist">
                <div class="sb_m_o_h1 text-center spd_mb_40"> Easiest way to Buy & Sell instantly</div>
                <div class="sb_mp2_p2p_headset">
                    <div class="row">
                        <div class="col-12 col-md-3 col-lg-2">
                            <div class="sb_mp2_p2p_headset_inp sb_mp2_log_frm_s">

                                <div class=" sb_mp2_p2p_bs_li_out">
                                    <label class="sb_mp2_p2p_bs_li sb_mp2_inptchk">
                                        <input type="radio" name="bs" class="sb_mp2_p2p_bs_inp myFormLinkTrigger" value="Buy" <?php
                                                                                                                                if (!$this->input->get('bs')) {
                                                                                                                                    echo 'checked';
                                                                                                                                } else {
                                                                                                                                    echo $this->input->get('bs') && $this->input->get('bs') == 'Buy' ? 'checked' : '';
                                                                                                                                }
                                                                                                                                ?>>Buy</label>
                                    <label class="sb_mp2_p2p_bs_li sb_mp2_bg_dang">
                                        <input type="radio" name="bs" class="sb_mp2_p2p_bs_inp myFormLinkTrigger" value="Sell" <?php echo $this->input->get('bs') && $this->input->get('bs') == 'Sell' ? 'checked' : '' ?>> Sell</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-9 col-lg-10">
                            <div class="row sb_mp2_p2p_inp_set">
                                <div class="col-md-3 col-12 col-lg-2">
                                    <div class="sb_m_o_log_in_set">
                                        <div class="sb_m_o_log_in_lbl">Coin</div>

                                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                        <select class="sb_m_o_log_in_input myFormLinkTrigger" name="cryptocurrency" id="cryptocurrency">
                                            <option value=""></option>
                                            <?php if ($currency) {
                                                foreach ($currency as $cur) {
                                            ?>
                    <option <?php echo $this->input->get('cryptocurrency') == $cur->id ? 'selected' : '' ?> value="<?php echo $cur->id; ?>">
                        <?php echo $cur->currency_symbol; ?>
                    </option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-12 col-md-3 col-lg-3">
                                    <div class="sb_m_o_log_in_set sb_m_o_log_in_vldr_fail">
                                        <div class="sb_m_o_log_in_lbl">Amount</div>
                                        <!-- <div class="sb_mp2_p2p_inp_s_lbl">BTC</div> -->
                                        <a href="#" class="sb_mp2_p2p_inp_s_a"><i class="fal fa-search"></i></a>
                                        <input type="text" value="<?php echo $this->input->get('price') ?>" class="sb_m_o_log_in_input myFormAmountTrigger" name="price" id="price">
                                    </div>
                                </div>

                                <div class="col-md-3 col-6 col-lg-3">
                                    <div class="sb_m_o_log_in_set">
                                        <div class="sb_m_o_log_in_lbl">Payment</div>

                                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                        <select class="sb_m_o_log_in_input myFormLinkTrigger" id="payment" name="payment">
                                            <option value=""></option>
                                            <?php if ($services) {
                                                foreach ($services as $service) {
                                            ?>
                                                    <option <?php echo $this->input->get('payment') == $service->id ? 'selected' : '' ?> value="<?php echo $service->id; ?>">
                                                        <?php echo ucfirst($service->service_name); ?></option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3 col-12 col-lg-2">
                                    <div class="sb_m_o_log_in_set">
                                        <div class="sb_m_o_log_in_lbl">Religions</div>

                                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                        <select class="sb_m_o_log_in_input myFormLinkTrigger" name="country" id="country">
                                            <option value=""></option>
                                            <?php if ($country) {
                                                foreach ($country as $co) {
                                            ?>
                                                    <option <?php echo $this->input->get('country') == $co->id ? 'selected' : '' ?> value="<?php echo $co->id; ?>"><?php echo $co->country_name; ?></option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>

                                </div>

                            </div>

                        </div>


                    </div>
                </div>

                <div class="sb_mp2_p2p_tabl sb_mp2_p2p_buy_set">
                    <div class="sb_mp2_p2p_tabl_hd">
                        <div class="sb_mp2_p2p_tabl_li">
                            <div class="sb_mp2_p2p_tabl_li_in cpmp2p_1">Advertisers</div>
                            <div class="sb_mp2_p2p_tabl_li_in cpmp2p_2">Price<i class="fal fa-chevron-down"></i></div>
                            <div class="sb_mp2_p2p_tabl_li_in cpmp2p_3">Limit/Available</div>
                            <div class="sb_mp2_p2p_tabl_li_in cpmp2p_4">Payment</div>
                            <div class="sb_mp2_p2p_tabl_li_in cpmp2p_5">Trade</div>
                        </div>
                    </div>
                    <div class="sb_mp2_p2p_tabl_body">
                        <div class="sb_mp2_p2p_tbll_scrll sbr">

                            <?php
                            if (!empty($p2p_trade)) {
                                foreach ($p2p_trade as $p2p) {

                                    $user_name = UserName($p2p->user_id);
                                    $Payment = get_servicename($p2p->payment_method);
                                    $crypto = getcurrency_name($p2p->cryptocurrency);
                                    $fiats = getfiatcurrencydetail($p2p->fiat_currency);
                                    $fiatcurrency = $fiats->currency_symbol;
                                    // echo "Fiat --- ".$firstcurrency;

                                    if ($p2p->type == 'Buy') {
                                        $class = '';
                                        $block_class = "Buyclass";
                                    } else {
                                        $class = 'cpm_bg_dang_a';
                                        $block_class = "Sellclass";
                                    }
                            ?>
                                    <div class="sb_mp2_p2p_tabl_li <?= $block_class; ?>">
                                        <div class="sb_mp2_p2p_tabl_li_in cpmp2p_1">
                                            <div class="sb_mp2_p2p_h1_tx1"><?= $user_name; ?></div>
                                            <div class="sb_mp2_p2p_h1_tx2_out">
                                                <span class="sb_mp2_p2p_h1_tx2"><?= $p2p->datetime ?></span>
                                                <span class="sb_mp2_p2p_h1_tx2"><?= ucfirst($p2p->terms_conditions) ?></span>
                                            </div>
                                        </div>
                                        <div class="sb_mp2_p2p_tabl_li_in cpmp2p_2">
                                            <div class="sb_mp2_p2p_h2_tx1"><?= $p2p->price ?> <span> <?= $fiatcurrency; ?></span></div>
                                        </div>
                                        <div class="sb_mp2_p2p_tabl_li_in cpmp2p_3">
                                            <div class="sb_mp2_p2p_h3_tx1">Available<span><?= $p2p->trade_amount; ?> <?= $crypto; ?></span></div>
                                            <div class="sb_mp2_p2p_h3_tx1 mb-0">Limit<span><?= $p2p->minimumtrade; ?> - <?= $p2p->maximumtrade; ?> (<?= $fiatcurrency; ?>)</span></div>
                                        </div>
                                        <div class="sb_mp2_p2p_tabl_li_in cpmp2p_4">
                                            <div class="sb_mp2_p2p_h4_tx1"><?= ucfirst($Payment); ?></div>
                                        </div>
                                        <div class="sb_mp2_p2p_tabl_li_in cpmp2p_5">
                                            <!-- <a href="#" class="sb_mp2_p2p_h5_tx1_a">Buy USDT</a> -->
                                            <?php

                                            if ($user_id == $p2p->user_id) {
                                            ?>
                                                <a style="cursor: pointer;color: #fff;" class="btn btn-primary">My Order</a>
                                            <?php } else { ?>
                                                <a onclick="tradeClick('<?= $p2p->price ?>','<?= $crypto . '_' . $fiatcurrency . '_' . $p2p->minimumtrade . '_' . $p2p->maximumtrade . '_' . $p2p->tradeid; ?>')" style="cursor: pointer;" data-toggle="modal" data-target="#submit_modal" data-dismiss="modal" aria-label="Close" class="cpm_p2p_h5_tx1_a <?= $class ?>"><?= ucfirst($p2p->type); ?> <?= $crypto; ?></a>
                                            <?php } ?>

                                        </div>
                                    </div>

                            <?php  }
                            } ?>
                        </div>
                        <div class="sb_mp2_depo_tabl_s_pagi">
                            <!-- <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="example_previous"><a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="8" tabindex="0" class="page-link">Next</a></li>
                            </ul> -->
                            <!-- Paginate -->
                            <div style='margin-top: 10px;'>
                                <?php echo $paginetionlinks; ?>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <footer class="sb_ftr">
        <div class="container-fluid sb_body_container">
            <div class="sb_ftr_top">
                <div class="row align-items-end align-items-lg-center">
                    <div class="col-lg-2 col-md-4 ">
                        <img src="<?php echo base_url() ?>assets/front/img/big-logo.png" alt="Image" class="sb_ftr_top_lgo">
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="sb_ftr_top_hdr">Links</div>
                        <ul class="sb_ftr_top_ul">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="sb_ftr_top_hdr spd_op_00">&nbsp;</div>
                        <ul class="sb_ftr_top_ul">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Crypto Deposit</a></li>
                            <li><a href="#">Spot Trading</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="sb_ftr_top_hdr spd_op_00">&nbsp;</div>
                        <ul class="sb_ftr_top_ul">
                            <li><a href="#">Withdraw</a></li>
                            <li><a href="#">NFT</a></li>
                            <li><a href="#">Faq</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="sb_ftr_top_hdr spd_op_00">&nbsp;</div>
                        <ul class="sb_ftr_top_ul">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">KYC</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="sb_ftr_top_hdr spd_op_00">&nbsp;</div>
                        <ul class="sb_ftr_top_ul">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sb_ftr_bottom">Copyright 2023 All Right Reserved</div>
        </div>
    </footer>


    <div class="modal fade right" id="submit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
        <div class="modal-dialog modal-full-height modal-right iks-popup" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">P2P</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 cpm_p2p_inp_set">
                                <?php $action = base_url() . "p2porder";
                                $attributes = array('id' => 'p2p_trade', 'autocomplete' => "off");
                                echo form_open($action, $attributes);
                                ?>
                                <div class="form-row">
                                    <div class="col-5 col-md-5">
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <label for="basic-url"><?php if ($p2p->type == 'Buy') echo "I Want to Pay ";
                                                                        else echo "I Want To Receive"; ?><span style="color: red;"> *</span></label>
                                                <div class="mb-3">
                                                    <input type="number" onkeyup="price_calculation(this.value)" class="cpm_log_frm_s_input" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="fiat_currency" id="fiat_currency" >
                                                    <br>
                                                    <span class="currency_sym" id="secondcurrency"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="acPrice" id="acPrice" />
                                    <input type="hidden" name="minimum" id="minimum" />
                                    <input type="hidden" name="maximum" id="maximum" />
                                    <input type="hidden" name="trade_id" id="trade_id" />

                                    <div class="col-5 col-md-5 offset-2">
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <label for="basic-url">
                                                    <?php if ($p2p->type == 'Buy') echo "I Will to Receive ";
                                                          else echo "I Will Sell"; ?>
                                                    <span style="color: red;"> *</span></label>
                                                <div class="mb-3">
                                                    <input type="number" class="cpm_log_frm_s_input" readonly="" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="cryptocurrency_popup" id="cryptocurrency_popup" >
                                                    <br>
                                                    <span class="currency_sym" id="firstcurrency"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-12">
                                        <div class="row">
                                            <div class="col-12 col-md-12">
                                                <div class="profile-flex border-0 pt-4 pull-left">
                                                    <div class="text-center">
                                                        <button name="trade_btn" id="trade_btn" value="trade_btn" class="btn btn-success waves-effect waves-light button" type="submit"> Trade </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/front/js/jquery-3.6.4.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/custom.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/jquery.validate.min.js"></script>
    <script src="<?php echo front_js(); ?>tata.js"></script>
    <script>
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


        $.fn.inital = (_this) => {
            let key, value;
            let tagName = _this.prop("tagName").toLowerCase();
            if (tagName == 'select') {
                value = $.trim(_this.find(":selected").val());
                key = _this.attr('name');
            } else if (tagName == 'input') {
                key = _this.attr('name');
                value = $.trim(_this.val());
            }
            console.log('key', key, 'Value', value);
            if (value) insertParam(key, value);
            else insertParam(key, value);
        }


        $(document).ready(function() {
            $(".myFormLinkTrigger").click(function(e) {
                e.preventDefault();
                let _this = $(this);
                $.fn.inital(_this);
            });

            $(".myFormAmountTrigger").blur(function(e) {
                e.preventDefault();
                let _this = $(this);
                $.fn.inital(_this);
            });
        });
    </script>


    <script type="text/javascript">
        function tradeClick(price, currencys) {

            var currency = currencys.split('_');
            var firstcurrency = currency[0];
            var secondcurrency = currency[1];
            var minimum = currency[2];
            var maximum = currency[3];
            var trade_id = currency[4];
            $('#firstcurrency').html(firstcurrency);
            $('#secondcurrency').html(secondcurrency);
            $('#minimum').val(minimum);
            $('#maximum').val(maximum);
            $('#acPrice').val(price);
            $('#trade_id').val(trade_id);
            $('#submit_modal').modal('show');
        }

        // function price_calculation(val) {

        //     var acPrice = $('#acPrice').val();
        //     var minimum = $('#minimum').val();
        //     var maximum = $('#maximum').val();

        //     var final_value = val / acPrice;
        //     $('#fiat_currency').val(final_value.toFixed(2));
        // }

        function price_calculation(val) {

            var acPrice = $('#acPrice').val();
            var minimum = $('#minimum').val();
            var maximum = $('#maximum').val();

            var final_value = val / acPrice;
            $('#cryptocurrency_popup').val(final_value.toFixed(6));


        }


        $(document).ready(function() {
            $('#p2p_trade').validate({



                rules: {
                    cryptocurrency_popup: {
                        required: true,
                        number: true,
                        min: function() {
                            return $('#minimum').val()
                        }
                        // max: function(){ return $('#maximum').val() }

                    }
                },
                messages: {
                    cryptocurrency_popup: {
                        required: "Please Enter Price",
                        number: " Please Enter Numbers ",
                        min: " Please Enter Minimum Amount"
                        // max: " Please Enter Maximum Amount"
                    }
                },
                invalidHandler: function(form, validator) {
                    if (!validator.numberOfInvalids()) {
                        return;
                    } else {
                        var error_element = validator.errorList[0].element;
                        error_element.focus();
                    }
                },
                submitHandler: function(form) {

                    var $form = $(form);
                    form.submit();
                    $('#trade_btn').prop('disabled', true);

                }

            });
        });
    </script>



    <?php
    $error      = $this->session->flashdata('error');
    $success    = $this->session->flashdata('success');
    $user_id    = $this->session->userdata('user_id');

    $ip_address = $_SERVER['REMOTE_ADDR'];
    $get_os     = $_SERVER['HTTP_USER_AGENT'];
    ?>

    <script>
        var base_url = '<?php echo base_url(); ?>';
        var front_url = '<?php echo front_url(); ?>';
        var user_id = '<?php echo $user_id; ?>';
        var ip_address = '<?php echo $ip_address; ?>';
        var get_os = '<?php echo $get_os; ?>';
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var success = "<?php echo $this->session->flashdata('success') ?>";
        var error = "<?php echo $this->session->flashdata('error') ?>";

        $(document).ready(function() {
            if (success != '') {
                tata.success('CPM! ' + success);

            }
            if (error != '') {
                tata.warn('CPM!', error);
            }
        });
    </script>
    <?php
    $this->session->unset_userdata('success');
    $this->session->unset_userdata('error');
    ?>
</body>

</html>