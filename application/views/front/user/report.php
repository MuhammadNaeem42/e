<?php 
  $this->load->view('front/common/header');
  ?>
<style>
  div.dt-datetime div.dt-datetime-title {
    color: black !important;
  }
</style>
<div class="jb_middle_content jb_report_page">
  <div class="container">
    <div class="jb_comn_card">
      <div class="jb_h1 jb_marg_b_25">Reports</div>
      <div class="row jb_marg_b_15">
        <div class="col-md">
          <?php 
            // $action = '';
            // $attributes = array('id'=>'report','autocomplete'=>"off",'class'=>'deposit_form'); 
            // echo form_open($action,$attributes); ?>
            <div class="row">
              <div class="col-md-3">
                <div class="jb_log_in_set ">
                  <div class="jb_log_in_lbl">Type</div>
                  <i class="fal fa-arrow-down jb_log_in_input_sel_ico"></i>
                  <select class="jb_log_in_input jb_report_typ_select" id="type">
                    <option value="0"></option>
                    <option value="Spot">Spot Trading</option>
                    <option value="Send">Send</option>
                    <option value="Receive">Receive</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="jb_log_in_set ">
                  <div class="jb_log_in_lbl">From</div>
                  <i class="fal fa-calendar jb_log_in_input_sel_ico "></i>
                  <input class="jb_log_in_input date_pick_btn" id="min" name="min">
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="jb_log_in_set fc-datepicker">
                  <div class="jb_log_in_lbl">To</div>
                  <i class="fal fa-calendar jb_log_in_input_sel_ico  "></i>
                  <input class="jb_log_in_input date_pick_btn" id="max" name="max" >
                </div>
              </div>
              <div class="col-md-3">
                <div class="jb_log_in_set ">
                  <div class="jb_log_in_lbl">Download Format</div>
                  <i class="fal fa-arrow-down jb_log_in_input_sel_ico"></i>
                  <select class="jb_log_in_input" id="format">
                    <option value="0"></option>
                    <option value="PDF">PDF</option>
                    <option value="EXCEL">EXCEL</option>
                  </select>
                </div>
              </div>
            </div>
          <?php
            // echo form_close();
          ?>
        </div>
        <div class="col-md-auto col-auto jb_marg_l_auto">
          <a href="#" onclick="getreport()" class="jb_form_btn jb_report_down_btn"><i class="fal fa-file-download"></i></a>
        </div>
      </div>
      <div class="jb_report_pane">
        <div class="jb_report_pane_li jb_report_pane_li_act"  data-nam="Spot">
          <div class="table-responsive  jb_repo_table_out">
            <table class="table table-borderless table-hover" id="trade_tbl">
              <thead>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Pairs</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Volume</th>
                  <th scope="col">Price</th>
                  <th scope="col">Transaction Id</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($exchange_history)){
                  // echo "<pre>";print_r($exchange_history);
                  $a = 0;
                  foreach($exchange_history as $exchange){
                    // echo "<pre>";print_r($exchange);
                    $a++;?>
                  <tr>
                    <th scope="row"><?= $a; ?></th>
                    <td class="jb_repo_coin_set_td"><img src="<?php echo front_img();?>aico-4.png" class="jb_repo_coin_set_td_ico">
                      <span><?= $exchange->pair_symbol;?></span>
                    </td>
                    <td class="jb_repo_coin_set_td_date"><?php echo date("Y-m-d",strtotime($exchange->trade_time));?></td>
                    <td class="jb_repo_coin_set_td_date"><?php echo date("H:i:s",strtotime($exchange->trade_time));?></td>
                    <?php if($exchange->status=="partially"){?>
                      <td><?php echo $exchange->Amount;?>(<?php echo $exchange->totalamount;?>)</td><?php } ?>
                    <?php if($exchange->status!="partially"){?>
                      <td><?php echo $exchange->Amount;?></td><?php }?>
                    <td>$ <?php echo $exchange->Price;?></td>
                    <td>DJFH8DFJHD89G9</td>
                    <td>
                    <?php if($exchange->status=="filled"){?>
                      <div class="jb_repo_stat_lbl jb_bg_green"> <?php echo $exchange->status;?></div><?php } elseif($exchange->status=="partially") {?>
                      <div class="jb_repo_stat_lbl"> <?php echo $exchange->status;?></div><?php } else {?>
                      <div class="jb_repo_stat_lbl jb_bg_red"> <?php echo $exchange->status;?></div><?php }?>
                    </td>
                  </tr>
                <?php } }?>
                <!-- <tr>
                  <th scope="row">2</th>
                  <td class="jb_repo_coin_set_td"><img src="assets/images/aico-3.png" class="jb_repo_coin_set_td_ico">
                    BTC<span>/ USDT</span>
                  </td>
                  <td class="jb_repo_coin_set_td_date">09-06-2022 10.38</td>
                  <td>1000 BTC</td>
                  <td>$ 34.666</td>
                  <td>DJFH8DFJHD89G9</td>
                  <td>
                    <div class="jb_repo_stat_lbl jb_bg_green"> Success</div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td class="jb_repo_coin_set_td"><img src="assets/images/aico-3.png" class="jb_repo_coin_set_td_ico">
                    BTC<span>/ USDT</span>
                  </td>
                  <td class="jb_repo_coin_set_td_date">09-06-2022 10.38</td>
                  <td>1000 BTC</td>
                  <td>$ 34.666</td>
                  <td>DJFH8DFJHD89G9</td>
                  <td>
                    <div class="jb_repo_stat_lbl "> Pending</div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td class="jb_repo_coin_set_td"><img src="assets/images/aico-3.png" class="jb_repo_coin_set_td_ico">
                    BTC<span>/ USDT</span>
                  </td>
                  <td class="jb_repo_coin_set_td_date">09-06-2022 10.38</td>
                  <td>1000 BTC</td>
                  <td>$ 34.666</td>
                  <td>DJFH8DFJHD89G9</td>
                  <td>
                    <div class="jb_repo_stat_lbl jb_bg_red"> Failure</div>
                  </td>
                </tr> -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="jb_report_pane_li "  data-nam="Send">
          <div class="table-responsive  jb_repo_table_out">
            <table class="table table-borderless table-hover display" id="deposit_tbl">
              <thead>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Coin</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Transaction Id</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($deposit_history)){
                  $a= 0;
                  foreach($deposit_history as $deposit){
                    $cur_details = getcryptocurrencydetail($deposit->currency_id);
                    $a++;?>
                  <tr>
                    <th scope="row"><?= $a; ?></th>
                    <td class="jb_repo_coin_set_td"><img src="<?php echo $cur_details->image;?>" class="jb_repo_coin_set_td_ico">
                    <?php getcurrencySymbol($deposit->currency_id);?><span>USD</span>
                    </td>
                    <td class="jb_repo_coin_set_td_date"><?php echo date("Y-m-d",strtotime($deposit->datetime));?></td>
                    <td class="jb_repo_coin_set_td_date"><?php echo date("H:i:s",strtotime($deposit->datetime));?></td>
                    <td><?php echo $deposit->amount.''.getcurrencySymbol($deposit->currency_id);?></td>
                    <td><?php echo $deposit->transaction_id;?><i class="fal fa-clipboard jab_repo_tbl_copy"></i></td>
                    <td>
                      <?php if($deposit->status=="Completed"){?>
                        <div class="jb_repo_stat_lbl jb_bg_green"><?php echo $deposit->status;?> </div><?php } ?>
                      <?php if($deposit->status=="Pending"){?>
                        <div class="jb_repo_stat_lbl"> <?php echo $deposit->status;?></div><?php } ?>
                      <?php if($deposit->status=="Cancelled"){?>
                        <div class="jb_repo_stat_lbl jb_bg_red"> <?php echo $deposit->status;?></div><?php } ?>
                    </td>
                  </tr>
                <?php } }  ?>	
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
                </tr>
                <tr>
                  <th scope="row">3</th>
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
        <div class="jb_report_pane_li "  data-nam="Receive">
          <div class="table-responsive  jb_repo_table_out">
            <table class="table table-borderless table-hover" id="withdraw_tbl">
              <thead>
                <tr>
                  <th scope="col">S.No</th>
                  <th scope="col">Coin</th>
                  <th scope="col">Date</th>
                  <th scope="col">Time</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Transaction Id</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($withdraw_history)){
                  $a = 0;
                  foreach($withdraw_history as $withdraw){
                    $cur_details = getcryptocurrencydetail($withdraw->currency_id);
                    $a++;?>
                  <tr>
                    <th scope="row"><?= $a; ?></th>
                    <td class="jb_repo_coin_set_td"><img src="<?php echo $cur_details->image;?>" class="jb_repo_coin_set_td_ico">
                      <?php getcurrencySymbol($withdraw->currency_id);?><span>USD</span>
                    </td>
                    <td class="jb_repo_coin_set_td_date"><?php echo date("Y-m-d",strtotime($withdraw->datetime));?></td>
                    <td class="jb_repo_coin_set_td_date"><?php echo date("H:i:s",strtotime($withdraw->datetime));?></td>
                    <td><?php echo $withdraw->amount.''.getcurrencySymbol($withdraw->currency_id);?></td>
                    <td><?php echo $withdraw->transaction_id;?><i class="fal fa-clipboard jab_repo_tbl_copy"></i></td>
                    <td>
                      <?php if($withdraw->status=="Completed"){?>
                        <div class="jb_repo_stat_lbl jb_bg_green"><?php echo $withdraw->status;?> </div><?php } ?>
                      <?php if($withdraw->status=="Pending"){?>
                        <div class="jb_repo_stat_lbl"> <?php echo $withdraw->status;?></div><?php } ?>
                      <?php if($withdraw->status=="Cancelled"){?>
                        <div class="jb_repo_stat_lbl jb_bg_red"> <?php echo $withdraw->status;?></div><?php } ?>
                    </td>
                  </tr>
                <?php } }  ?>	
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
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<!-- <script type="text/javascript" src=""></script> -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<script>
var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
  function( settings, data, dataIndex ) {
    var min = minDate.val();
    var max = maxDate.val();
    var date = new Date( data[2] );

    if (
        ( min === null && max === null ) ||
        ( min === null && date <= max ) ||
        ( min <= date   && max === null ) ||
        ( min <= date   && date <= max )
    ) {
        return true;
    }
    return false;
    }
 );
  
 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'MMMM Do YYYY'
     });
     maxDate = new DateTime($('#max'), {
         format: 'MMMM Do YYYY'
     });
  
     // DataTables initialisation
     var table = $('#trade_tbl').DataTable();
     var deposit_table = $('#deposit_tbl').DataTable();
     var withdraw_table = $('#withdraw_tbl').DataTable();
  
     // Refilter the table
     $('#min, #max').on('change', function () {
         table.draw();
         deposit_table.draw();
         withdraw_table.draw();
     });
 });
</script>
<script type="text/javascript">
  function getreport() {
    var type= $("#type option:selected").val();
    var format= $("#format option:selected").val();
    console.log(type);
    console.log(format);
    if(type == 0 || format == 0) {
      tata.error('JAB! ','Select Type & Download format');
    } 
    else {
      if(type == 'Spot') {
        if(format == 'PDF') {
          ExportPDF('trade_tbl') 
        }
        else if(format == 'EXCEL') {
          ExportToExcel('xlsx','trade_tbl')
        } 
        else {
          tata.error('JAB! ','Select Download format');
        }
      }
      else if(type == 'Send') {
        if(format == 'PDF') {
          ExportPDF('deposit_tbl') 
        }
        else if(format == 'EXCEL') {
          ExportToExcel('xlsx','deposit_tbl')
        } 
        else {
          tata.error('JAB! ','Select Download format');
        }
      }
      else if(type == 'Receive') {
        if(format == 'PDF') {
          ExportPDF('withdraw_tbl') 
        }
        else if(format == 'EXCEL') {
          ExportToExcel('xlsx','withdraw_tbl')
        } 
        else {
          tata.error('JAB! ','Select Download format');
        }
      }
      else {
        tata.error('JAB! ','Select Type');
      }
    }
  }

  // function getdatereport() {
  //   var type= $("#type option:selected").val();
  //   // console.log($("#from").val());
  //   // return;
  //   $.ajax({
  //     url: front_url+"report", // json datasource
  //     type: "post", // method  , by default get
  //     data: {from: $("#from").val(), to: $("#to").val(), type: t},
  //     success: function(data) {
  //       console.log(data);
  //     }
  //     // error: function () {  // error handling
  //     //     // $(".employee-grid-error").html("");
  //     //     // $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
  //     //     // $("#employee-grid_processing").css("display", "none");

  //     // }

  //   });

  // }
  
  $(document).ready(function() {
    // $('#trade_tbl').DataTable( {
    //     // dom: 'Bfrtip',
    //     // buttons: [
    //     //     'excel', 'pdf'
    //     // ]
    // } );
} );
  function ExportToExcel(type,tbl, fn, dl) {
  
    console.log(type);
    console.log(tbl);
    var elt = document.getElementById(tbl);
    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
      XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
      XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
  }	
  
  
  function ExportPDF(tbl) {
    html2canvas(document.getElementById(tbl), {
      onrendered: function (canvas) {
        var data = canvas.toDataURL();
        var docDefinition = {
          content: [{
            image: data,
            width: 500,
            background: 'rgba(0,0,0,0)'
          }]
        };
        pdfMake.createPdf(docDefinition).download("Table.pdf");
      }
    });
  }
</script>