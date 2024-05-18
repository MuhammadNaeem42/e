<?php
$this->load->view('front/common/header');

$cryptocurrency = ($p2p_tradearr->cryptocurrency!='')?$p2p_tradearr->cryptocurrency:'1';

$checkTrade = ($p2p_tradearr)?'1':'0';

// echo "<pre>";print_r($p2p_tradearr);

?>

<style>
.order-btn { pointer-events:none; }    
</style>

<div class="sb_main_content sb_oth_main">
<div class="container">

    <form id="create_offer" action="<?php echo current_url(); ?>" method="POST">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="sb_m_o_h1">Create Offer</div>
                <div class="sb_m_common_pnl">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="sb_m_o_log_in_set sb_m_o_log_in_open">
                                <div class="sb_m_o_log_in_lbl">Choose </div>

                            <?php if($p2p_tradearr->id) {?>
                                <div class="sb_m_p2p_co_by_set">
                                    <div class="sb_m_p2p_co_by_li <?php echo $p2p_tradearr->actualtradebuy=='buy' ? 'sb_m_p2p_co_by_li_act':'order-btn'; ?>" data-nam="buy">Buy</div>
                                    <div class="sb_m_p2p_co_by_li <?php echo $p2p_tradearr->actualtradebuy=='sell' ? 'sb_m_p2p_co_by_li_act':'order-btn'; ?>" data-nam="sell">Sell</div>
                                </div>
                            <?php } else {?>
                                <div class="sb_m_p2p_co_by_set">
                                    <div class="sb_m_p2p_co_by_li <?php echo $p2p_tradearr->actualtradebuy=='buy' ? 'sb_m_p2p_co_by_li_act':''; ?>" data-nam="buy">Buy</div>
                                    <div class="sb_m_p2p_co_by_li <?php echo $p2p_tradearr->actualtradebuy=='sell' ? 'sb_m_p2p_co_by_li_act':''; ?>" data-nam="sell">Sell</div>
                                </div>
                            <?php }?>    
                                

                                <input type="text" class="sb_m_o_log_in_input mycustomtypecls" name="type" value="">
                            </div>
                        </div>
                        <div class="col-md-4 col">
                            <div class="sb_m_o_log_in_set ">
                                <div class="sb_m_o_log_in_lbl">Coin</div>
                                <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                <select class="sb_m_o_log_in_input" onChange="change_coin(this.value)" name="cryptocurrency" id="cryptocurrency">
                                    <?php if ($currency) {
                                        foreach ($currency as $cur) { 
                                            if($cur->etf_status !=1)
                                            {

                                            ?>
                                            <option <?php echo $p2p_tradearr->cryptocurrency==$cur->id ? 'selected' : ''; ?> value="<?php echo $cur->id; ?>">
                                                <?php echo $cur->currency_symbol; ?>
                                            </option>
                                    <?php }} }?>
                                </select>
                            </div>
                            <strong id="user_balance" style="color: #32b46b;"></strong>
                        </div>

                        <!-- <div class="col-md-4 col-6">
                            <div class="sb_m_o_log_in_set ">
                                <div class="sb_m_o_log_in_lbl">Country</div>
                                <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                <input type="text" class="sb_m_o_log_in_input" readonly name="country" id="country" value="<?=$country_name?>" >
                            </div>
                        </div> -->

                        <div class="col-md-4 col-6">
                            <div class="sb_m_o_log_in_set ">
                                <div class="sb_m_o_log_in_lbl">Country</div>
                                <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                <select class="sb_m_o_log_in_input" onChange="change_country(this.value)" name="country" id="country">
                                    <?php if ($country) {
                                        foreach ($country as $co) {
                                    ?>
                                            <option <?php echo $p2p_tradearr->country==$co->id ? 'selected' : ''; ?> value="<?php echo $co->id; ?>"><?php echo $co->country_name; ?></option>
                                    <?php
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-6">
                            <div class="sb_m_o_log_in_set ">
                                <div class="sb_m_o_log_in_lbl">Fiat</div>
                                <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                <select class="sb_m_o_log_in_input" name="fiat_currency" id="fiat_currency">
                                    <?php if ($fiatcurrency) {
                                        foreach ($fiatcurrency as $fiat) {
                                    ?> <option <?php echo $p2p_tradearr->fiat_currency ==$fiat->id ? 'selected' : ''; ?>  value="<?php echo $fiat->id; ?>"><?php echo $fiat->currency_symbol; ?></option>
                                    <?php
                                        }
                                    } ?> 
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="sb_m_o_log_in_set ">
                                <div class="sb_m_o_log_in_lbl">Payment Method</div>
                                <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                <select class="sb_m_o_log_in_input payment_method" name="payment_method" id="payment_method">
                                    <?php
                                    if ($payment_method) {
                                        foreach ($payment_method as $payment) {
                                    ?>
                                            <option <?php echo $p2p_tradearr->payment_method == $payment->id ? 'selected' : ''; ?> value="<?php echo $payment->id; ?>">
                                                <?php echo ucfirst($payment->payment_name); ?></option>
                                    <?php
                                        }
                                    } ?>
                                </select>


                                <!-- <select class="sb_m_o_log_in_input payment_method" name="payment_method" id="payment_method">
                                    <option <?php echo $p2p_tradearr->payment_method ==1 ? 'selected' : ''; ?> value="1">Paytm</option>
                                    <option <?php echo $p2p_tradearr->payment_method ==2 ? 'selected' : ''; ?> value="2">Bank</option>
                                </select> -->
                            </div>
                        </div>


                        <div class="col-md-4 paytm" style="display:none;">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">Transfer money to account number</div>
                                <input type="text" class="sb_m_o_log_in_input" name="paytm" id="paytm" value="<?=$p2p_tradearr->paytm?>" >
                            </div>
                        </div>

                        <div class="col-md-4 bank_details bnk-name" style="display:none;">
                            <div class="sb_m_o_log_in_set ">
                                <div class="sb_m_o_log_in_lbl">Bank Name</div>
                                <input type="text" class="sb_m_o_log_in_input" name="bank" id="bank" value="<?=$p2p_tradearr->bank?>" >

                                <!-- <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                <select class="sb_m_o_log_in_input" name="bank" id="bank">
                                    <option value=""></option>
                                    <?php if ($services) {
                                        foreach ($services as $service) {
                                    ?>
                                            <option <?php echo $p2p_tradearr->bank == $service->id ? 'selected' : ''; ?> value="<?php echo $service->id; ?>">
                                                <?php echo ucfirst($service->service_name); ?></option>
                                    <?php }} ?>
                                </select> -->
                            </div>
                        </div>

                        <!-- <div class="col-md-4 col-6 bank_details" style="display:none;">
                            <div class="sb_m_o_log_in_set ">
                                <div class="sb_m_o_log_in_lbl">Bank name</div>
                                <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                <select class="sb_m_o_log_in_input" name="fiat_currency" id="fiat_currency">
                                    <?php if ($userBankInfo) {
                                        foreach ($fiatcurrency as $fiat) {
                                    ?> <option value="<?php echo $fiat->id; ?>">
                                                <?php echo $fiat->currency_symbol; ?></option>
                                    <?php
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div> -->



                        <div class="col-md-4 bank_details" style="display:none;">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">Transfer money to account number
                                </div>
                                <input type="text" class="sb_m_o_log_in_input" name="bank_acc_number" id="bank_acc_number" onkeypress="return isNumber(event)" value="<?php echo $p2p_tradearr->bank_acc_number; ?>" >
                            </div>
                        </div>


                        <div class="col-md-4 bank_details_rem bank_details" style="display:none;">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">Bank account name
                                </div>
                                <input type="text" class="sb_m_o_log_in_input" name="bank_acc_name" id="bank_acc_name" value="<?php echo $p2p_tradearr->bank_acc_name; ?>">
                            </div>
                        </div>

                        <div class="col-md-4 bank_details_rem bank_details" style="display:none;">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">IFSC code
                                </div>
                                <input type="text" class="sb_m_o_log_in_input" name="bank_ifsc" id="bank_ifsc" value="<?php echo $p2p_tradearr->bank_ifsc; ?>">
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">Price</div>
                                <input type="text" class="sb_m_o_log_in_input" name="price" id="price" onkeypress="return isNumber(event)" value="<?php echo $p2p_tradearr->price; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">Minimum Trade Limit
                                </div>
                                <input type="text" class="sb_m_o_log_in_input" name="minimum_limit" id="minimum_limit" onkeypress="return isNumber(event)" value="<?php echo $p2p_tradearr->minimumtrade; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">Maximum Trade Limit</div>
                                <input value="<?php echo $p2p_tradearr->maximumtrade; ?>" type="text" class="sb_m_o_log_in_input" name="maximum_limit" id="maximum_limit" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">Trade Amount</div>
                                <input value="<?php echo $p2p_tradearr->trade_amount; ?>"  type="text" class="sb_m_o_log_in_input" name="trade_amount" id="trade_amount" onkeypress="return isNumber(event)">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="sb_m_o_log_in_set ">
                                <div class="sb_m_o_log_in_lbl">Payment window</div>
                                <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                                <select class="sb_m_o_log_in_input" name="payment_window" id="payment_window">
                                    <option <?=($p2p_tradearr->payment_window==15)?'selected':''?> value="15">15 Minutes</option>
                                    <option <?=($p2p_tradearr->payment_window==30)?'selected':''?> value="30">30 Minutes</option>
                                    <option <?=($p2p_tradearr->payment_window==45)?'selected':''?> value="45">45 Minutes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="sb_m_o_log_in_set">
                                <div class="sb_m_o_log_in_lbl">Instruction</div>
                                <textarea class="sb_m_o_log_in_input" style="height:100px" name="instraction" id="instraction"><?php echo $p2p_tradearr->terms_conditions; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- <a href="#" class="sb_m_o_log_btn">Make Offer</a> -->
                    <input type="submit" value="Make Offer" name="submit_create" class="sb_m_o_log_btn">
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php
$this->load->view('front/common/footer');
?>

<script type="text/javascript">
$(document).ready(function() {
    $.validator.addMethod("greaterThan",
        function(value, element, param) {
            var $otherElement = $(param);
            return parseFloat(value, 10) > parseFloat($otherElement.val(), 10);
        });


    $('#create_offer').validate({
        rules: {
            type: {
                required: true
            },
            crypto: {
                required: true
            },
            payment: {
                required: true
            },
            currency: {
                required: true
            },
            country: {
                required: true
            },
            price: {
                required: true,
                number: true,
                min: 0
            },
            minimum_limit: {
                required: true,
                number: true,
                min: 0
            },
            maximum_limit: {
                required: true,
                number: true,
                min: 0,
                greaterThan: "#minimum_limit"
            },
            trade_amount: {
                required: true,
                number: true,
                min: 0
            },
            instraction: {
                required: true
            },
            bank: {
                required: true
            },
            bank_acc_number: {
                required: true
            },
            bank_acc_name: {
                required: true
            },
            bank_ifsc: {
                required: true
            },
            paytm: {
                required: true
            },
            fiat_currency: {
                required: true
            }

        },
        messages: {
            type: {
                required: "Please Choose Type"
            },
            crypto: {
                required: "Please Choose Coin"
            },
            payment: {
                required: " Please Choose Payment",
            },
            currency: {
                required: " Please Choose Currency",
            },
            country: {
                required: " Please Choose Country",
            },
            price: {
                required: " Please Enter Price",
                number: 'Please Enter Numbers Only'
            },
            minimum_limit: {
                required: " Please Enter Minimum Price",
                number: 'Please Enter Numbers Only'
            },
            maximum_limit: {
                required: " Please Enter Maximum Price",
                number: 'Please Enter Numbers Only'
            },
            trade_amount: {
                required: " Please Enter Trade Amount",
                number: 'Please Enter Numbers Only'
            },
            instraction: {
                required: " Please Enter Instruction",
            },
            bank: {
                required: 'Please enter Bank name'
            },
            bank_acc_number: {
                required: 'Please Enter Account number'
            },
            bank_acc_name: {
                required: 'Please Enter Account name'
            },
            bank_ifsc: {
                required: 'Please Enter ifsc code'
            },
            paytm: {
                required: 'Please Enter field'
            },
            fiat_currency: {
                required: 'Please select Fiat currency'
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
        highlight: function(element) {
            $(element).parent().addClass('fail_vldr')
        },
        unhighlight: function(element) {
            $(element).parent().removeClass('error');
            $(element).parent().removeClass('fail_vldr');
        },
        submitHandler: function(form) {
            var $form = $(form);
            form.submit();
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


// echo $this->uri->segment(1).'------';

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

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    // if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    if (charCode > 31 && (charCode != 46 && (charCode < 48 || charCode > 57))) {
        return false;
    }
    return true;
}

function change_coin(currency) {

    $.ajax({
        url: base_url + "change_address",
        type: "POST",
        data: "currency_id=" + currency,
        success: function(data) {
            var rest = jQuery.parseJSON(data);
            var text = "Balance : " + rest.coin_balance + rest.coin_symbol;
            $('#user_balance').html(text);
        }
    });

};

change_coin('<?=$cryptocurrency?>');


function change_country(country) {
    $.ajax({
        url: base_url + "change_country",
        type: "POST",
        data: {country_id: country},
        success: function(data) {
            // console.log(data)
            $('#fiat_currency').html(data);
        }
    });
};

var country = document.getElementById('country').value;
change_country(country);




$(document).ready(function() {

    if (success != '') {
        tata.success('Stormbit! ' + success);

    }
    if (error != '') {
        tata.warn('Stormbit!', error);
    }


$(document).on('click', '.sb_m_p2p_co_by_li, .payment_method', function(e) {

// atr = $(this).attr('data-nam');
pmType = $('#payment_method').val();
atr = $('.sb_m_p2p_co_by_li.sb_m_p2p_co_by_li_act').text();
// console.log(atr, '---', pmType)

if(atr=='Sell') {

    if (pmType == 2) {
        $('.bank_details').show();                
        $('.paytm').hide();
    } else {
        $('.paytm').show();
        $('.bank_details').hide();
    }
} else {
    if (pmType == 2) {
        $('.bank_details').hide();
        $('.bnk-name').show();
        $('.paytm').hide();
    } else {
        $('.paytm, .bank_details').hide();
    }
}
});

checkTrade = '<?=$checkTrade?>';

if(checkTrade=='0') {
    $('.sb_m_p2p_co_by_li').trigger('click');    
} else {
    $('.sb_m_p2p_co_by_li.sb_m_p2p_co_by_li_act').trigger('click'); 
}


});




</script>
<?php
$this->session->unset_userdata('success');
$this->session->unset_userdata('error');
?>
</body>

</html>