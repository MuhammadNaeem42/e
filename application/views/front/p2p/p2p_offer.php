<?php 
// echo "<pre>";print_r($buy_cryptocurrency);exit;
$user_id = $this->session->userdata('user_id');
$type = $this->input->get('type');
$country_code = $this->input->get('fiat_currency');
$payment_code = $this->input->get('payment');

?>
<?php
$this->load->view('front/common/header');
?>
<script>
function pairchart(from,to,unique,clr){

  // setInterval(function() {
    // console.log(from+'--'+to+'--'+unique+'--'+clr)
    if(from == 'bitcoin cash') {
      from = 'bitcoin-cash';
    }
    // var api = "d5c55e1bb049ace5dd9188f2e128875eeeb36b740071e28fb3d06dfe2a7f521d";
    
    // let ajaxUrl = "https://min-api.cryptocompare.com/data/histoday?fsym="+from+"&tsym="+to+"&limit=10&api="+api;
    let ajaxUrl = "https://api.coingecko.com/api/v3/coins/"+from+"/market_chart?vs_currency="+to+"&days=7&interval=daily";
    ajax_request(ajaxUrl);
    // console.log(ajaxUrl)
    let dataSet = [];

    function ajax_request(url) {
      let xhttp;
      xhttp= new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          handle_chart(this);
        }
      }
      xhttp.open("GET", url, true);
      xhttp.send();
    }

    function handle_chart(data) {
      // console.log(data);
      // return;
      let parsed_data = JSON.parse(data.responseText);
      dataSet = parsed_data.prices;
      // console.log(parsed_data);
      //  return;
      // $.each(parsed_data, function(index, value) {
      //     dataSet.push(value.high);
      // });
      // console.log( dataSet ) 

      var options1 = {
          series: [
            {
              data: dataSet,
            },
          ],
          colors: [clr],
          chart: {
            type: "area",
            width: 100,
            height: 40,
            sparkline: { enabled: !0 },
            events: {
              mouseMove: function(event, chartContext, config) {
                  var tooltip = chartContext.el.querySelector('.apexcharts-tooltip');
                  var pointsArray = config.globals.pointsArray;
                  var seriesIndex = config.seriesIndex;
                  var dataPointIndex = config.dataPointIndex === -1 ? 0 : config.dataPointIndex;

                  if (seriesIndex !== -1) {
                      var position = pointsArray[seriesIndex][dataPointIndex];

                      tooltip.style.top = position[1] + 'px';
                      tooltip.style.left = position[0] + 'px';
                  }
              }
            },
          },
          plotOptions: { bar: { columnWidth: "50%" } },
          // labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
          xaxis: { crosshairs: { width: 1 } },
          yaxis: {
            decimalsInFloat: 2,
          },
          stroke: {
            show: true,
            curve: "smooth",
            lineCap: "butt",
            colors: undefined,
            width: 2,
            dashArray: 0,
          },

          tooltip: {
            fixed: { enabled: !1 },
            // x: { show: !1 },
            x: {
              show: true,
              format: "MMM yyyy",
              formatter: function (value,{ series, seriesIndex, dataPointIndex, w }) {
                return new Date(value).toDateString();
              },
            },
            y: {
              title: {
                formatter: function (e) {
                  return to.toUpperCase() +":"  ;
                },
              },
            },
            marker: { show: !1 },
          },
          states: {
            hover: {
              filter: {
                type: "none",
                value: 0,
              },
            },
          },
        },
        chart1 = new ApexCharts(
          document.querySelector("#timeline-chart-"+unique),
          options1
        );
      chart1.render();

    }
  // },10000);

}    
</script>


<div class="sb_main_content sb_oth_main">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-10 col-xxl-8">
                <div class="sb_m_o_h1 text-center spd_mb_40"> Easiest way to Buy & Sell instantly</div>
                <div class="sb_m_common_pnl">
                    <div class="row align-items-center g-md-3 g-2">
                        <div class="col-md-4">
                            <div class="sb_m_np2_coin_set">
                            <?php $cur = getcurrencydetail(1); ?>    
                                <img src="<?=$cur->image?>" class="sb_m_np2_coin_img">
                                <input type="text" class="sb_m_np2_coin_input sb_m_pop_trigger" data-nam="markets" value="<?=$cur->currency_name?>" readonly>
                                <i class="far fa-chevron-down sb_m_pop_trigger" data-nam="markets"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="sb_m_np2_rgh_1" style="display:<?php echo ($type) ? 'none' : 'block'; ?>;">
                                <div class="row g-md-3 g-2">
                                    <div class="col-md-6 col-6">
                                        <div class="sb_m_np2_coin_sid sb_m_np2_coin_sid_green">
                                            <div class="spd spd_fs_16 spd_fw_400 spd_op_06 spd_mb_05">Buying price</div>
                                            <div class="spd spd_fs_24 spd_fw_700  "><span class="spd_clr_green">
                                                <?php if (!empty($p2p_trade)) {
                                                    print($buy_price);
                                                } ?></span> <?php if (!empty($p2p_trade)) {                                                                
                                                    print(getfiatcurrency(($buy_cryptocurrency)));
                                                } ?>
                                            </div>
                                            <div class="sb_m_np2_coin_btn sb_m_np2_coin_btn_grn">Buy</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="sb_m_np2_coin_sid sb_m_np2_coin_sid_red">
                                            <div class="spd spd_fs_16 spd_fw_400 spd_op_06 spd_mb_05">Selling price</div>
                                            <div class="spd spd_fs_24 spd_fw_700 "><span class="spd_clr_red">
                                                <?php if (!empty($p2p_trade)) {
                                                    print($sell_price);
                                                } ?></span>
                                                <?php if (!empty($p2p_trade)) {
                                                    print(getfiatcurrency($sell_cryptocurrency));
                                                } ?></div>
                                                <div class="sb_m_np2_coin_btn sb_m_np2_coin_btn_red">Sell</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sb_m_np2_rgh_2" style="display:<?php echo ($type) ? 'block' : 'none'; ?>;">
                                    <div class="row ">
                                        <div class="col">
                                            <div class="sb_m_o_log_in_set spd_mb_00">
                                                <div class="sb_m_o_log_in_lbl">Amount</div>
                                                <?php if(!empty($country_code)) {
                                                    if($country_code==1) $fiatTxt = 'INR';
                                                    else if($country_code==2) $fiatTxt = 'USD';
                                                } ?>

                                                <i class="sb_m_np2_coin_search_sid_lbl"><?=$fiatTxt?></i>
                                                <input type="text" class="sb_m_o_log_in_input " onkeyup="onchange_amount()" id="amount_search">
                                                <!-- <div class="sb_m_np2_coin_search_sid_lbl_btm">≈ 2,534.81 USD</div> -->
                                            </div>
                                            <!-- <div class="spd spd_fs_16 spd_fw_500 spd_op_05">25 Buyers Available</div> -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="far fa-filter sb_m_np2_coin_filt_ico sb_m_pop_trigger" data-nam="filter"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($type == 'buy') {
                        $offerType = 'sell';
                        $display = 'block';
                        $cls = 'sb_m_np2_buy_pnl';
                    } else if ($type == 'sell') {
                        $offerType = 'buy';
                        $display = 'block';
                        $cls = 'sb_m_np2_sell_pnl';
                    } else {
                        $display = 'none';
                    }
                    ?>
                    <div class="sb_m_np2_pnl <?php echo $cls; ?>" style="display:<?php echo $display; ?>;">
                        <?php
                        if (!empty($p2p_trade)) {
                            foreach ($p2p_trade as $p2p) {
                                $user_name = UserName($p2p->user_id);
                                if($p2p->payment_method==2){
                                    // $Payment = get_servicename($p2p->bank);
                                  $Payment = $p2p->bank;
                                }else {
                                    $Payment = get_paymentname($p2p->payment_method);
                                }
                                
                                $crypto = getcurrency_name($p2p->cryptocurrency);
                                $fiats = getfiatcurrencydetail($p2p->fiat_currency);
                                $fiatcurrency = $fiats->currency_symbol;


                                if ($p2p->type == 'Buy') {
                                    $class = '';
                                    $block_class = "Buyclass";
                                } else {
                                    $class = 'cpm_bg_dang_a';
                                    $block_class = "Sellclass";
                                }
                                ?>
                                <div class="sb_m_np2_pnl_li sb_m_np2_pnl_li-order filter-<?=$crypto?>" >
                                    <div class="row align-items-md-center g-md-2 g-0">
                                        <div class="col-md-4 col-6 sb_m_np2_pnl_li_lft">
                                            <div class="spd spd_fs_16 ">
                                                <span class="sb_m_np2_stat spd_clr_green">⬤</span>
                                                <?= $user_name; ?>
                                            </div>
                                            <div class="spd spd_fs_18 spd_op_08  spd_mb_10 spd_mt_10">
                                                <?= $p2p->trade_amount; ?> <?= $crypto; ?> 
                                            </div>
                                            <div class="spd spd_fs_12 spd_op_04">Time : ~<?php echo $p2p->datetime; ?></div>
                                        </div>
                                        <div class="col-md text-end col sb_m_np2_pnl_li_rht">
                                            <div class="spd spd_fs_24 spd_fw_600 amount_filter">
                                                <span class="spd_clr_green"><?= $p2p->price ?></span> <?= $fiatcurrency; ?>
                                            </div>
                                            <div class="spd  ">
                                                <div class="sb_m_np2_via_sq"><?php echo ucfirst($Payment); ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-auto">

                                            <?php
                                            if ($user_id == $p2p->user_id) {
                                                ?>
                                                <a style="cursor: pointer;color: #fff;" class="btn btn-primary">My Order</a>
                                            <?php } else {
                                                if ($type == 'buy') {
                                                    ?>
                                                    <a href="javascript:;" data-trade_id="<?php echo $p2p->tradeid; ?>" data-price="<?php echo $p2p->price; ?>" data-price_symbol="<?php echo $fiatcurrency; ?>" data-fiatcurrency="<?php echo $p2p->trade_amount; ?>" data-fiatcurrency_symbol="<?php echo $crypto; ?>" class="sb_m_2_btn sb_m_2_btn_green"><span>Buy Now</span></a>
                                                <?php } else { ?>
                                                    <a href="javascript:;" data-trade_id="<?php echo $p2p->tradeid; ?>" data-price="<?php echo $p2p->price; ?>" data-price_symbol="<?php echo $fiatcurrency; ?>" data-fiatcurrency="<?php echo $p2p->trade_amount; ?>" data-fiatcurrency_symbol="<?php echo $crypto; ?>" class="sb_m_2_btn sb_m_2_btn_red"><span>Sell Now</span></a>
                                                
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>

                            <?php  }
                        } ?>
                        <div class="sb_m_np2_pnl_out_txt sb_m_np2_pnl_out_txt_sell">
                            <a href="<?=base_url().'offer?type='.$offerType?>"> Looking For <?=ucwords($offerType)?> </a>
                        </div>
                    </div>
                    <!-- <div class="">
                        Create Advertisment For &nbsp;
                        <a href="<?=base_url().'create_offer'?>" class="anchor_buy_cls">
                            <span class="spd_fw_600 spd_clr_op_10 ">Buy</span>
                            <span class="spd_op_02 spd_ml_10 spd_mr_10">/</span>
                        </a>

                        <a href="<?=base_url().'create_offer'?>" class="anchor_sell_cls">
                            <span class="spd_fw_600 spd_mr_10 spd_clr_op_10 ">Sell</span>
                            &nbsp;<i class="fal fa-chevron-right spd_fs_12"></i>
                        </a>
                    </div> -->


                </div>
            </div>
        </div>
    </div>
    <div class="sb_m_pop_out" data-nam="markets">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-md-9 col-xxl-7">
                <div class="sb_m_pop_in">
                    <div class="sb_m_pop_hd">Crypto Coins <i class="far fa-times sb_m_pop_hd_cls"></i></div>
                    <div class="sb_m_pop_bdy">
                        <div class="sb_m_pop_bdy_in">
                            <div class="sb_m_np2_mark sb_m_np2_mark_hd">
                                <div class="sb_m_np2_mark_li sb_m_np2_mli_1">
                                    Coin
                                </div>
                                <div class="sb_m_np2_mark_li sb_m_np2_mli_2 ">24h Change</div>
                                <div class="sb_m_np2_mark_li sb_m_np2_mli_3 sb_m_np2_mark_li_h_btn"> Price In Usd</div>
                                <div class="sb_m_np2_mark_li sb_m_np2_mli_4 ">24h Volume</div>
                                <div class="sb_m_np2_mark_li sb_m_np2_mli_5">
                                    7 Days Chart
                                </div>
                            </div>
                            <?php
                            if ($currency) {
                                foreach ($currency as $key => $cur) {

                                    if($cur->etf_status!=1) {

                                    $usd_price = $cur->online_usdprice;
                                    $price_change_24h =  number_format($cur->priceChangePercent_USD,2);

                                    $ChartClr = ($price_change_24h>0)?'#58BD7D':'#D33535';
                                    
                                        ?>
                                        <div class="sb_m_np2_mark" onclick="filterOrder('<?=$cur->currency_symbol?>')" data-nam="<?php echo $cur->currency_name; ?>">
                                            <div class="sb_m_np2_mark_li sb_m_np2_mli_1">
                                                <div class="sb_m_np2_mark_li_coin_set">
                                                    <img src="<?php echo $cur->image; ?>" class="sb_m_np2_mark_li_coin_ico">
                                                    <?php echo $cur->currency_name; ?>
                                                </div>
                                            </div>
                                            <div class="sb_m_np2_mark_li sb_m_np2_mli_2 <?php echo($price_change_24h>0)?'spd_clr_green':'spd_clr_red';?>"><?=$price_change_24h?>%</div>
                                            <div class="sb_m_np2_mark_li sb_m_np2_mli_3">$ <?=$usd_price?></div>
                                            <div class="sb_m_np2_mark_li sb_m_np2_mli_4 spd_op_06"><?=$cur->volume_USD?></div>
                                            <div class="sb_m_np2_mark_li sb_m_np2_mli_5">
                                                <script type="text/javascript">
                                                    pairchart('<?=strtolower($cur->currency_name)?>','usd','<?=strtotime('now').$key;?>',"<?=$ChartClr?>");
                                                </script>
                                                <div class="sb_m_mar_center_chart" id="timeline-chart-<?=strtotime('now').$key;?>"></div>
                                            </div>

                                        </div>
                                    
                                <?php } } }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sb_m_pop_out" data-nam="filter">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-md-6 col-xxl-6">
                <div class="sb_m_pop_in">
                    <div class="sb_m_pop_hd">Filter <i class="far fa-times sb_m_pop_hd_cls"></i></div>
                    <div class="sb_m_pop_bdy">
                        <div class="sb_m_pop_bdy_in">
                            <div class="spd spd_fs_16 spd_fw_500 spd_mb_15">Spend</div>
                            <div class="row g-3">
                                <?php if ($fiatcurrency_arr) {
                                    foreach ($fiatcurrency_arr as $fiat) {
                                        ?>
                                        <div class="col-auto">
                                            <label class="sb_m_np2_filt_box">
                                                <input type="checkbox" class="sb_m_np2_filt_input spend_code" name="spend" <?php echo ($fiat->id == $country_code) ? 'checked' : ''; ?> value="<?php echo $fiat->currency_symbol; ?>">
                                                <span><?php echo $fiat->currency_symbol; ?></span>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                } ?>
                            </div>
                            <div class="spd spd_fs_16 spd_fw_500 spd_mb_15">Via</div>
                            <div class="row g-3">
                            <?php //$paymentType = array('UPI', 'Bank');
                            foreach ($payment_method as $key => $ty) {
                             $key = $key+1;
                            ?>
                                
                            
                                <div class="col-auto">
                                    <label class="sb_m_np2_filt_box">
                                        <input type="checkbox" class="sb_m_np2_filt_input payment_code" name="via" <?php echo ($key == $payment_code) ? 'checked' : ''; ?> value="<?php echo $key; ?>">
                                        <span><?php echo $ty->payment_name; ?></span>
                                    </label>
                                </div>
                            <?php } ?>        

                                
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

// function insertParam(search, key, value) {
//     key = encodeURIComponent(key);
//     value = encodeURIComponent(value);        

//     // kvp looks like ['key1=value1', 'key2=value2', ...]
//     var kvp = search.substr(1).split('&');
//     let i = 0;
//     for (; i < kvp.length; i++) {
//         if (kvp[i].startsWith(key + '=')) {
//             let pair = kvp[i].split('=');
//             pair[1] = value;
//             kvp[i] = pair.join('=');
//             break;
//         }
//     }

//     if (i >= kvp.length) {
//         kvp[kvp.length] = [key, value].join('=');
//     }

//     // can return this or...
//     let params = kvp.join('&');

//     let removePage = params.split('&').map(function(v) {
//         return v.includes('page') ? "page=1" : v;
//     }).filter(n => n).join('&');

//     document.location.search = removePage;
// }


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
// Buy
    $('.sb_m_np2_coin_btn_grn, .anchor_buy_cls').click((e) => {
        e.preventDefault();
        return insertParam('type', 'buy');
    });

// Sell
    $('.sb_m_np2_coin_btn_red, .anchor_sell_cls').click((e) => {
        e.preventDefault();
        return insertParam('type', 'sell');
    });

// Spend
    $(document).on("click", ".spend_code", function(e) {
        e.preventDefault();
        let country_code = $(this).val();
        return insertParam('fiat_currency', country_code);
    });

// Payemnt
    $(document).on("click", ".payment_code", function(e) {
        e.preventDefault();
        let pay_code = $(this).val();
        return insertParam('payment', pay_code);
    });
});

function onchange_amount() {
    var input = document.getElementById("amount_search");
    var filter = input.value.toLowerCase();
    var nodes = document.getElementsByClassName('sb_m_np2_pnl_li');

    for (i = 0; i < nodes.length; i++) {
        if (nodes[i].innerText.toLowerCase().includes(filter)) {
            nodes[i].style.display = "block";
        } else {
            nodes[i].style.display = "none";
        }
    }
}

$(document).ready(function() {

    filterOrder('BTC');


    $(document).on("click", ".sb_m_2_btn_green, .sb_m_2_btn_red", function(e) {
        e.preventDefault();
        let url = '';
        let _this = $(this);
        let trade_id = _this.data('trade_id');
        let _type = "<?php echo $this->input->get('type'); ?>";
        let price = _this.data('price');
        let price_symbol = _this.data('price_symbol');
        let fiatcurrency = _this.data('fiatcurrency');
        let fiatcurrency_symbol = _this.data('fiatcurrency_symbol');
        let data = {
            'trade_id': trade_id,
            price: price,
            price_symbol: price_symbol,
            fiatcurrency: fiatcurrency,
            fiatcurrency_symbol: fiatcurrency_symbol,
            type:_type,
            trade_btn: 'submit'
        };
        // console.log(data); return false;  
        $.ajax({
            type: "POST",
            url: baseURL + "p2p_pay_seller",
            data: data,
            dataType: "json",
            success: function(response, textStatus, jXHR) { 

            // console.log(response, _type); return false;               
                if (response.status == false && response.code == '401') {
                    let removeRedirects = removeURLParameter(document.location.search, 'offer');
                    let here = "<?php echo base_url('signin') ?>" + removeRedirects + '&redirect=offer';
                    window.location.href = here;

                } else if (response.status == false) {

                    tata.warn('Stormbit!', response.msg);
                    // window.location.reload(1);
                } else if (response.status == true) {
                    if(_type == 'sell'){
                        url = baseURL + 'p2p_split_pay/sell/';
                    }else if(_type == 'buy'){
                        url = baseURL + 'p2p_split_pay/buy/';
                    }

                    window.location.href =  url + response.redirect;    
                }
            }
        });
    });

});


function filterOrder(coin) {

    $('.sb_m_np2_pnl_li-order').css('display','none');
    $('.filter-'+coin).css('display','block');
    

}




</script>
</body>

</html>

