<?php 
$this->load->view('front/common/header');
?>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css" />

<div class="sb_main_content sb_oth_main">
            <div class="container">
            
         

<div class="sb_m_o_h1">Reports</div>


<div class="sb_m_rept_tab_headset">
<div class="sb_m_rept_tab_headset_scrl">
    <div class="sb_m_rept_tab_li sb_m_rept_tab_li_act" data-nam="Deposit">Open Order</div>
    <div class="sb_m_rept_tab_li" data-nam="Withdraw">Cancel Order</div>
    <div class="sb_m_rept_tab_li" data-nam="Spot Trading">Complete order </div>
    <!-- <div class="sb_m_rept_tab_li" data-nam="Margin Trading">Margin Trading</div> -->
    <!-- <div class="sb_m_rept_tab_li" data-nam="P2P">P2P</div> -->
    <!-- <div class="sb_m_rept_tab_li" data-nam="Future Trading">Future Trading</div> -->
    <!-- <div class="sb_m_rept_tab_li" data-nam="ETF Trading">ETF Trading</div> -->

</div>
</div>
<div class="sb_m_rept_tab_pane_li sb_m_rept_tab_pane_li_act" data-nam="Deposit">
    <div class="sb_m_common_pnl">

         <div class="sb_m_rept_tabl_filter">
        <div class="row">
            <div class="col">
             <div class="row ">
                
                <!-- <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Coin</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="coin" onchange="dep_filter()">
                            <option value="0"></option>
                            <?php if ($dig_currency) {
                                foreach($dig_currency as $dcurrency){
                                    if($dcurrency->etf_status!=1){

                        ?>
                          
                          <option value="<?php echo $dcurrency->currency_symbol;?>"><?php echo $dcurrency->currency_symbol;?></option>
                          
                          <?php 
                             }
                            }
                            }
                          ?>
                        </select>
                      </div>
                </div> -->
                <!-- <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Status</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="status" onchange="dep_filter()">
                          <option value="0"></option>
                          <option value="Completed">Completed</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Pending">Pending</option>
                        </select>
                      </div>
                </div> -->
              <!--   <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Format</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="format">
                          <option value="0"></option>
                          <option value="PDF">PDF</option>
                          <option value="Excel">Excel</option>
                          <option value="CSV">CSV</option>
                        </select>
                      </div>
                </div> -->
             </div>
            </div>
            <!-- <div class="col-md-auto">
              <a href="#" class="sb_m_1_btn" onclick="getreport()"><i class="far fa-file-arrow-down"></i></a>
            </div> -->
        </div></div>
        <div class="table-responsive">
            <table class="table table-hover sb_m_tbl_total"  id="deposit_tbl">
                <thead>
                    <tr>
                                            
                                <th>S.No</th>
                                 <th>Crypto</th>
                                 <th>Amount</th>
                                 <th>Price</th>
                                 <th>Type</th>
                                 <th>Datetime</th>
                                 <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                           <?php if(!empty($p2p_openorders)) {
                              $i=1;
                              foreach ($p2p_openorders as $key => $c) { 

                                 if(($c->tradestatus=='open')&&($c->paid_status=='open'))
                                 {

                                 

                              $fiat_currencies=$this->common_model->getTableData('fiat_currency',array('id'=>$c->fiat_currency))->row();   
                           ?>
                                 
                              <tr>
                                 <td><?=$i;?> </td>
                                 <td>
                                    <div class="sb_m_tbl_coin_set">
                                       <img src="<?=$c->image?>" class="sb_m_tbl_coin_ico">
                                       <?=$c->currency_symbol?>
                                    </div>
                                 </td>
                                 <td><?=$c->trade_amount?> <?=$c->currency_symbol?></td>
                                 <td><?=$c->price?> <?=$fiat_currencies->currency_symbol?></td>
                                 <td><?=$c->actualtradebuy?></td>
                                 <td class="sb_m_tbl_date spd_clr_op_06"><?=$c->datetime?></td>
                                 <td>
                                    <?php if(($c->tradestatus=='open')&&($c->paid_status=='open')){ ?>
                                       <a href="<?php echo base_url('p2p_cancel/'.encryptIt($c->id)); ?>"><div class="sb_m_tbl_stat">Open order</div>
                                    <?php }   ?>
                                      
                                    
                                 </td>
                              </tr>


                              <?php $i++; } } }?>   

                              
                              
                              
                           </tbody>
            </table>
        </div>

       
    </div>
</div>
<div class="sb_m_rept_tab_pane_li" data-nam="Withdraw">
    <div class="sb_m_common_pnl">
         <div class="sb_m_rept_tabl_filter">
        <div class="row">
            <div class="col">
             <div class="row ">
               
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <!-- <div class="sb_m_o_log_in_lbl">Coin</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i> -->
                        <!-- <select class="sb_m_o_log_in_input" id="with_coin" onchange="with_filter()">
                            <option value="0"></option> -->
                            <?php if ($dig_currency) {
                                foreach($dig_currency as $dcurrency){
                                    if($dcurrency->etf_status!=1){

                        ?>
                          
                          <option value="<?php echo $dcurrency->currency_symbol;?>"><?php echo $dcurrency->currency_symbol;?></option>
                          
                          <?php 
                             }
                            }
                            }
                          ?>
                        </select>
                      </div>
                </div>
             
               <!--  <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Format</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="with_format">
                          <option value="0"></option>
                          <option value="PDF">PDF</option>
                          <option value="Excel">Excel</option>
                          <option value="CSV">CSV</option>
                        </select>
                      </div>
                </div> -->
             </div>
            </div>
            <!-- <div class="col-md-auto">
              <a href="#" class="sb_m_1_btn" onclick="getreport_with()"><i class="far fa-file-arrow-down"></i></a>
            </div> -->
        </div></div>
        <div class="table-responsive">
            <table class="table table-hover sb_m_tbl_total" id="withdraw_tbl">
                <thead>
                    <tr>
                                            
                        <th>S.No</th>
                                 <th>Crypto</th>
                                 <th>Amount</th>
                                 <th>Price</th>
                                 <th>Type</th>
                                 <th>Datetime</th>
                                 <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                           <?php if(!empty($p2p_openorders)) {
                              $i=1;
                              foreach ($p2p_openorders as $key => $c) { 

                                 if($c->tradestatus=='cancelled')
                                 {

                                 

                              $fiat_currencies=$this->common_model->getTableData('fiat_currency',array('id'=>$c->fiat_currency))->row();   
                           ?>
                                 
                              <tr>
                                 <td><?=$i;?> </td>
                                 <td>
                                    <div class="sb_m_tbl_coin_set">
                                       <img src="<?=$c->image?>" class="sb_m_tbl_coin_ico">
                                       <?=$c->currency_symbol?>
                                    </div>
                                 </td>
                                 <td><?=$c->trade_amount?> <?=$c->currency_symbol?></td>
                                 <td><?=$c->price?> <?=$fiat_currencies->currency_symbol?></td>
                                 <td><?=$c->actualtradebuy?></td>
                                 <td class="sb_m_tbl_date spd_clr_op_06"><?=$c->datetime?></td>
                                 <td>
                                    <?php if($c->tradestatus=='cancelled'){ ?>
                                       <div class="sb_m_tbl_stat sb_m_tbl_stat_red">Cancelled</div>   
                                    <?php }   ?>
                                      
                                    
                                 </td>
                              </tr>


                              <?php $i++; } } }?>   

                              
                              
                              
                           </tbody>
            </table>
        </div>

      

    </div>
</div>
<div class="sb_m_rept_tab_pane_li" data-nam="Spot Trading">
    <div class="sb_m_common_pnl">
         <div class="sb_m_rept_tabl_filter">
        <div class="row">
            <div class="col">
             <div class="row ">
              
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                <!--         <div class="sb_m_o_log_in_lbl">Coin</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="spot_coin" onchange="dash_filter()">
                            <option value="0"></option> -->
                            <?php if ($dig_currency) {
                                foreach($dig_currency as $dcurrency){
                                    if($dcurrency->etf_status!=1){

                        ?>
                          
                          <option value="<?php echo $dcurrency->currency_symbol;?>"><?php echo $dcurrency->currency_symbol;?></option>
                          
                          <?php 
                             }
                            }
                            }
                          ?>
                        </select>
                      </div>
                </div>
                <div class="col-md-3 col-6">
                    <!-- <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Status</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="spot_status" onchange="dash_filter()">
                          <option value="0"></option>
                          <option value="Completed">Completed</option>
                          <option value="Partially">Partially</option>
                          <option value="Active">Active</option>
                          <option value="Filled">Filled</option>
                          <option value="Pending">Pending</option>
                          <option value="Cancelled">Cancelled</option>
                        </select>
                      </div> -->
                </div>
               <!--  <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Format</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="spot_format">
                          <option value="0"></option>
                          <option value="PDF">PDF</option>
                          <option value="Excel">Excel</option>
                          <option value="CSV">CSV</option>
                        </select>
                      </div>
                </div> -->
             </div>
            </div>
           <!--  <div class="col-md-auto">
              <a href="#" class="sb_m_1_btn" onclick="getreport_spot()"><i class="far fa-file-arrow-down"></i></a>
            </div> -->
        </div></div>
        <div class="table-responsive">
            <table class="table table-hover sb_m_tbl_total" id="spot_trade_tbl">
                <thead>
                    <tr>
                                            
                                  <th>S.No</th>
                                 <th>Crypto</th>
                                 <th>Amount</th>
                                 <th>Price</th>
                                 <th>Type</th>
                                 <th>Datetime</th>
                                 <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                           <?php if(!empty($p2p_openorders)) {
                              $i=1;
                              foreach ($p2p_openorders as $key => $c) { 

                                 if(($c->tradestatus=='filled')&&($c->paid_status=='Completed'))
                                 {

                                 

                              $fiat_currencies=$this->common_model->getTableData('fiat_currency',array('id'=>$c->fiat_currency))->row();   
                           ?>
                                 
                              <tr>
                                 <td><?=$i;?> </td>
                                 <td>
                                    <div class="sb_m_tbl_coin_set">
                                       <img src="<?=$c->image?>" class="sb_m_tbl_coin_ico">
                                       <?=$c->currency_symbol?>
                                    </div>
                                 </td>
                                 <td><?=$c->trade_amount?> <?=$c->currency_symbol?></td>
                                 <td><?=$c->price?> <?=$fiat_currencies->currency_symbol?></td>
                                 <td><?=$c->actualtradebuy?></td>
                                 <td class="sb_m_tbl_date spd_clr_op_06"><?=$c->datetime?></td>
                                 <td>
                                    <?php if(($c->tradestatus=='filled')&&($c->paid_status=='Completed')){ ?>
                                       <div class="sb_m_tbl_stat sb_m_tbl_stat_red">Completed</div>   
                                    <?php }   ?>
                                      
                                    
                                 </td>
                              </tr>


                              <?php $i++; } } }?>   

                              
                              
                              
                           </tbody>
            </table>
        </div>

       

    </div>
</div>
<div class="sb_m_rept_tab_pane_li" data-nam="Margin Trading">
    <div class="sb_m_common_pnl">
         <div class="sb_m_rept_tabl_filter">
        <div class="row">
            <div class="col">
             <div class="row ">
               
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Coin</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="marg_coin" onchange="marg_filter()">
                            <option value="0"></option>
                            <?php if ($dig_currency) {
                                foreach($dig_currency as $dcurrency){
                                    if($dcurrency->etf_status!=1){

                        ?>
                          
                          <option value="<?php echo $dcurrency->currency_symbol;?>"><?php echo $dcurrency->currency_symbol;?></option>
                          
                          <?php 
                             }
                            }
                            }
                          ?>
                        </select>
                      </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Status</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="marg_status" onchange="marg_filter()">
                          <option value="0"></option>
                          <option value="Completed">Completed</option>
                          <option value="Partially">Partially</option>
                          <option value="Active">Active</option>
                          <option value="Filled">Filled</option>
                          <option value="Pending">Pending</option>
                          <option value="Cancelled">Cancelled</option>
                        </select>
                      </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Format</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="marg_format">
                          <option value="0"></option>
                          <option value="PDF">PDF</option>
                          <option value="Excel">Excel</option>
                          <option value="CSV">CSV</option>
                        </select>
                      </div>
                </div>
             </div>
            </div>
            <div class="col-md-auto">
              <a href="#" class="sb_m_1_btn" onclick="getreport_marg()"><i class="far fa-file-arrow-down"></i></a>
            </div>
        </div></div>
        <div class="table-responsive">
            <table class="table table-hover sb_m_tbl_total" id="marg_trade_tbl">
                <thead>
                     <tr>
                                            
                        <th>S.No</th>
                        <th>Pairs</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Time</th>
                        <th>Order Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($exchange_history)){
                     $k=1;
                                 foreach($exchange_history as $exchange){
                                                $cur_details = getcryptocurrencydetail($exchange->from_symbol_id);
                                                $to_cur_details = getcryptocurrencydetail($exchange->to_symbol_id);
                                    if($exchange->borrow_status==1 && $exchange->etf_status!=1) {
                                    ?>
                    <tr>               
                        <td><?=$k;?></td>
                        <td>
                            <div class="sb_m_tbl_coin_set">
                                    <!-- <img src="<?php echo front_img();?>aico-5.png" class="sb_m_tbl_coin_ico"> -->
                                   <?php echo  $exchange->pair_symbol;?> 
                            </div>
                        </td>
                        <td><?php echo $exchange->Amount." ".$cur_details->currency_symbol;?></td>
                     
                        <td><?php echo $exchange->Price." ".$to_cur_details->currency_symbol;?></td>
                        <td><?php echo $exchange->trade_time;?></td>
                        <td>( <?php echo ucfirst($exchange->ordertype);?> )</td>
                        <?php if($exchange->status=="filled")
                              $cls = 'sb_m_tbl_stat_grn';
                              else if($exchange->status=="active")
                                 $cls = 'sb_m_tbl_stat';
                                 else
                                    $cls = 'sb_m_tbl_stat_red';

                           ?>

                        <td><div class="sb_m_tbl_stat <?=$cls?>"><?=ucfirst($exchange->status);?></div></td>
                       
                    </tr>



                    <?php $k++; } } } ?>



                   

                </tbody>
            </table>
        </div>

       

    </div>
</div>


<div class="sb_m_rept_tab_pane_li" data-nam="Future Trading">
    <div class="sb_m_common_pnl">
         <div class="sb_m_rept_tabl_filter">
        <div class="row">
            <div class="col">
             <div class="row ">
               
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Coin</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="fut_coin" onchange="fut_filter()">
                            <option value="0"></option>
                            <?php if ($dig_currency) {
                                foreach($dig_currency as $dcurrency){

                                    if($dcurrency->etf_status!=1){
                        ?>
                          
                          <option value="<?php echo $dcurrency->currency_symbol;?>"><?php echo $dcurrency->currency_symbol;?></option>
                          
                          <?php 
                             }
                            }
                            }
                          ?>
                        </select>
                      </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Status</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="fut_status" onchange="fut_filter()">
                          <option value="0"></option>
                          <option value="Normal">Normal</option>
                          <option value="Profit">Profit</option>
                          <option value="Loss">Loss</option>
                          <!-- <option value="Cancelled">Cancelled</option> -->
                        </select>
                      </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Format</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="fut_format">
                          <option value="0"></option>
                          <option value="PDF">PDF</option>
                          <option value="Excel">Excel</option>
                          <option value="CSV">CSV</option>
                        </select>
                      </div>
                </div>
             </div>
            </div>
            <div class="col-md-auto">
              <a href="#" class="sb_m_1_btn" onclick="getreport_fut()"><i class="far fa-file-arrow-down"></i></a>
            </div>
        </div></div>
        <div class="table-responsive">
            <table class="table table-hover sb_m_tbl_total" id="fut_table">
                <thead>
                    <tr>
                                            
                        <th>S.No</th>
                        <th>Pairs</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Order Type</th>
                        <th>Order Method</th>
                        <th>Type</th>
                        <th>Time</th>
                        <th>PNL</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($future_history)){
                        $m=1;
                        foreach($future_history as $exchange){
                        $cur_details = getcryptocurrencydetail($exchange->from_symbol_id);
                        $to_cur_details = getcryptocurrencydetail($exchange->to_symbol_id);
                            if($exchange->type=='buy') {
                                $type = 'Long';
                            }else{
                                $type = 'Short';
                            }

                    ?>
                    <tr>                    
                        <td><?=$m;?></td>
                        <td>
                            <div class="sb_m_tbl_coin_set">
                                    <!-- <img src="<?php echo front_img();?>aico-5.png" class="sb_m_tbl_coin_ico"> -->
                                   <?php echo  $exchange->pair_symbol;?> 
                            </div>
                        </td>
                        <td><?php echo $exchange->amount." ".$cur_details->currency_symbol;?></td>
                     
                        <td><?php echo $exchange->price." ".$to_cur_details->currency_symbol;?></td>
                        <td><?php echo ucfirst($exchange->ordertype);?></td>
                        <td><?php echo ucfirst($exchange->order_method);?></td>
                        
                        <td><?php echo ucfirst($exchange->type);?>(<?php echo $type;?> )</td>
                        <td><?php echo $exchange->datetime;?></td>
                        <td><?php echo $exchange->PNL;?></td>
                        <?php if($exchange->close_status=="profit")
                                $cls = 'sb_m_tbl_stat_grn';
                                else if($exchange->close_status=="normal")
                                    $cls = 'sb_m_tbl_stat';
                                    else
                                        $cls = 'sb_m_tbl_stat_red';

                            ?>

                        <td><div class="sb_m_tbl_stat <?=$cls?>"><?=ucfirst($exchange->close_status);?></div></td>
                       
                    </tr>



                    <?php $m++; } }  ?>


                </tbody>
            </table>
        </div>

     

    </div>
</div>

<div class="sb_m_rept_tab_pane_li" data-nam="ETF Trading">
    <div class="sb_m_common_pnl">
         <div class="sb_m_rept_tabl_filter">
        <div class="row">
            <div class="col">
             <div class="row ">
             
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Coin</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="etf_coin" onchange="etf_filter()">
                            <option value="0"></option>
                            <?php if ($dig_currency) {
                                foreach($dig_currency as $dcurrency){
                                    if($dcurrency->etf_status!=1){
                        ?>
                          
                          <option value="<?php echo $dcurrency->currency_symbol;?>"><?php echo $dcurrency->currency_symbol;?></option>
                          
                          <?php 
                             }
                            }
                            }
                          ?>
                        </select>
                      </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Status</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="etf_status" onchange="etf_filter()">
                          <option value="0"></option>
                          <option value="Active">Active</option>
                          <option value="Filled">Filled</option>
                          <option value="Partially">Partially</option>
                          <option value="Cancelled">Cancelled</option>
                        </select>
                      </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="sb_m_o_log_in_set">
                        <div class="sb_m_o_log_in_lbl">Format</div>
                      
                        <i class="fal fa-arrow-down sb_m_o_log_in_input_sel_ico"></i>
                        <select class="sb_m_o_log_in_input" id="etf_format">
                          <option value="0"></option>
                          <option value="PDF">PDF</option>
                          <option value="Excel">Excel</option>
                          <option value="CSV">CSV</option>
                        </select>
                      </div>
                </div>
             </div>
            </div>
            <div class="col-md-auto">
              <a href="#" class="sb_m_1_btn" onclick="getreport_etf()"><i class="far fa-file-arrow-down"></i></a>
            </div>
        </div></div>
        <div class="table-responsive">
            <table class="table table-hover sb_m_tbl_total" id="etf_table">
                <thead>
                    <tr>
                                            
                        <th>S.No</th>
                        <th>Pairs</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Time</th>
                        <th>Order Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($exchange_history)){
                        $b=1;
                        foreach($exchange_history as $exchange){
                        $cur_details = getcryptocurrencydetail($exchange->from_symbol_id);
                        $to_cur_details = getcryptocurrencydetail($exchange->to_symbol_id);
                            if($exchange->etf_status==1) {


                    ?>
                    <tr>                    
                        <td><?=$b;?></td>
                        <td>
                            <div class="sb_m_tbl_coin_set">
                                    <!-- <img src="<?php echo front_img();?>aico-5.png" class="sb_m_tbl_coin_ico"> -->
                                   <?php echo  $exchange->pair_symbol;?> 
                            </div>
                        </td>
                        <td><?php echo $exchange->Amount." ".$cur_details->currency_symbol;?></td>
                     
                        <td><?php echo $exchange->Price." ".$to_cur_details->currency_symbol;?></td>
                        <td><?php echo $exchange->trade_time;?></td>
                        <td>( <?php echo ucfirst($exchange->ordertype);?> )</td>
                        <?php if($exchange->status=="filled")
                                $cls = 'sb_m_tbl_stat_grn';
                                else if($exchange->status=="active")
                                    $cls = 'sb_m_tbl_stat';
                                    else
                                        $cls = 'sb_m_tbl_stat_red';

                            ?>

                        <td><div class="sb_m_tbl_stat <?=$cls?>"><?=ucfirst($exchange->status);?></div></td>
                       
                    </tr>



                    <?php $b++; } } }?>


                </tbody>
            </table>
        </div>

   
    </div>
</div>




            </div>
        </div>


<?php 
$this->load->view('front/common/footer');
?>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

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
     var table = $('#spot_trade_tbl').DataTable();
     var deposit_table = $('#deposit_tbl').DataTable();
     var withdraw_table = $('#withdraw_tbl').DataTable();
     var margin_trade_table = $('#marg_trade_tbl').DataTable();
     var p2p_table = $('#p2p_table').DataTable();
     var fut_table = $('#fut_table').DataTable();
     var etf_table = $('#etf_table').DataTable();
  
     // Refilter the table
     $('#min, #max').on('change', function () {
         table.draw();
         deposit_table.draw();
         withdraw_table.draw();
         margin_trade_table.draw();
         p2p_table.draw();
         fut_table.draw();
         etf_table.draw();
     });
 });
</script>

<script type="text/javascript">

    function getreport() {
    var coin_des= $("#coin option:selected").val();
//console.log(coin_des)
    var status_desp= $("#status option:selected").val();
//console.log(status_desp)
    var format= $("#format option:selected").val();
//console.log(format)

    if(coin_des == 0 || format == 0 || status_desp == 0) {
      tata.error('Stormbit! ','Select Type & Download format');
    } 
    else {
      
      if(coin_des) {
        if(status_desp){
            if(format == 'PDF') {
              ExportPDF('deposit_tbl') 
            }
            else if(format == 'Excel') {
              ExportToExcel('xlsx','deposit_tbl')
            }
            else if(format == 'CSV') {
              ExportToCsv('csv','deposit_tbl')
            } 
            else {
              tata.error('Stormbit! ','Select Download format');
            }
        }            
      }
      
      else {
        tata.error('Stormbit! ','Select Type');
      }
    }
  }

  function getreport_with() {

    //withdraw

    var coin_with= $("#with_coin option:selected").val();

    var status_with= $("#with_status option:selected").val();

    var format_with= $("#with_format option:selected").val();
    
    if(coin_with == 0 || format_with == 0 || status_with == 0) {
      tata.error('Stormbit! ','Select Type & Download format');
    } 
    else {


      if(coin_with) {
        if(status_with){
            if(format_with == 'PDF') {
              ExportPDF('withdraw_tbl') 
            }
            else if(format_with == 'Excel') {
              ExportToExcel('xlsx','withdraw_tbl')
            }
            else if(format_with == 'CSV') {
              ExportToCsv('csv','withdraw_tbl')
            }  
            else {
              tata.error('Stormbit! ','Select Download format');
            }
        }    
      }
      else {
        tata.error('Stormbit! ','Select Type');
      }
    }
  }

  function getreport_spot() {


// //spot
    var coin_rep= $("#spot_coin option:selected").val();

    var status_repo= $("#spot_status option:selected").val();

    var format_spot= $("#spot_format option:selected").val();

    if(coin_rep == 0 || format_spot == 0 || status_repo == 0) {
      tata.error('Stormbit! ','Select Type & Download format');
    } 
    else {
      if(coin_rep) {
        if(status_repo){
            if(format_spot == 'PDF') {
              ExportPDF('spot_trade_tbl') 
            }
            else if(format_spot == 'Excel') {
              ExportToExcel('xlsx','spot_trade_tbl')
            } 
            else if(format_spot == 'CSV') {
              ExportToCsv('csv','spot_trade_tbl')
            }
            else {
              tata.error('Stormbit! ','Select Download format');
            }
        }
      }
      else {
        tata.error('Stormbit! ','Select Type');
      }
    }
  }

  function getreport_marg() {
//margin

    var coin_marg= $("#marg_coin option:selected").val();

    var status_marg= $("#marg_status option:selected").val();

    var format_marg= $("#marg_format option:selected").val();



    if(coin_marg == 0 || format_marg == 0 || status_marg == 0) {
      tata.error('Stormbit! ','Select Type & Download format');
    } 
    else {
      if(coin_marg) {
        if(status_marg){
            if(format_marg == 'PDF') {
              ExportPDF('marg_trade_tbl') 
            }
            else if(format_marg == 'Excel') {
              ExportToExcel('xlsx','marg_trade_tbl')
            }
            else if(format_marg == 'CSV') {
              ExportToCsv('csv','marg_trade_tbl')
            } 
            else {
              tata.error('Stormbit! ','Select Download format');
            }
        }    
      }
      
      else {
        tata.error('Stormbit! ','Select Type');
      }
    }
  }

//   function getreport_p2p() {
// //p2p

//     var coin_p2p= $("#p2p_coin option:selected").val();

//     var status_p2p= $("#p2p_status option:selected").val();

//     var format_p2p= $("#p2p_format option:selected").val();


//     if(coin_p2p == 0 || format_p2p == 0 || status_p2p == 0) {
//       tata.error('Stormbit! ','Select Type & Download format');
//     } 
//     else {
//       if(coin_p2p) {
//         if(status_p2p){
//             if(format_p2p == 'PDF') {
//               ExportPDF('p2p_table') 
//             }
//             else if(format_p2p == 'Excel') {
//               ExportToExcel('xlsx','p2p_table')
//             }
//             else if(format_p2p == 'CSV') {
//               ExportToCsv('csv','p2p_table')
//             } 
//             else {
//               tata.error('Stormbit! ','Select Download format');
//             }
//         }    
//       }
//       else {
//         tata.error('Stormbit! ','Select Type');
//       }
//     }
//   }

  function getreport_fut() {
//fut

    var coin_fut= $("#fut_coin option:selected").val();

    var status_fut= $("#fut_status option:selected").val();

    var format_fut= $("#fut_format option:selected").val();


    if(coin_fut == 0 || format_fut == 0 || status_fut == 0) {
      tata.error('Stormbit! ','Select Type & Download format');
    } 
    else {
      if(coin_fut) {
        if(status_fut){
            if(format_fut == 'PDF') {
              ExportPDF('fut_table') 
            }
            else if(format_fut == 'Excel') {
              ExportToExcel('xlsx','fut_table')
            }
            else if(format_fut == 'CSV') {
              ExportToCsv('csv','fut_table')
            } 
            else {
              tata.error('Stormbit! ','Select Download format');
            }
        }    
      }
      else {
        tata.error('Stormbit! ','Select Type');
      }
    }
  }

  function getreport_etf() {
//etf

    var coin_etf= $("#etf_coin option:selected").val();

    var status_etf= $("#etf_status option:selected").val();

    var format_etf= $("#etf_format option:selected").val();


    if(coin_etf == 0 || format_etf == 0 || status_etf == 0) {
      tata.error('Stormbit! ','Select Type & Download format');
    } 
    else {
      if(coin_etf) {
        if(status_etf){
            if(format_etf == 'PDF') {
              ExportPDF('etf_table') 
            }
            else if(format_etf == 'Excel') {
              ExportToExcel('xlsx','etf_table')
            }
            else if(format_etf == 'CSV') {
              ExportToCsv('csv','etf_table')
            } 
            else {
              tata.error('Stormbit! ','Select Download format');
            }
        }    
      }
      else {
        tata.error('Stormbit! ','Select Type');
      }
    }
  }

function ExportToExcel(type,tbl, fn, dl) {

      console.log(type);
      console.log(tbl);
       var elt = document.getElementById(tbl);
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
    }

    function ExportToCsv(type,tbl, fn, dl) {
   // debugger;

        console.log(type);
        console.log(tbl);
       var elt = document.getElementById(tbl);
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('exptable.' + (type || 'csv')));
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

function dash_filter() {
  var input,input_coin, filter,filter_coin, table, tr, td, i, txtValue,txtValue2;
  input = document.getElementById("spot_coin");
  //console.log(input);
  input_status = document.getElementById("spot_status");
  //console.log(input_status);

  filter = input.value.toUpperCase();
  filter_status = input_status.value.toUpperCase();
  // console.log(filter_status);
  table = document.getElementById("spot_trade_tbl");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];

    td6 = tr[i].getElementsByTagName("td")[6];
    if (td || td6) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td6.textContent || td6.innerText;
      // txtValue3 = td3.textContent || td3.innerText;
      // console.log(txtValue2);
      if(input != "" && input_status != ""){
        //console.log("a")
        if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter_status) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
       }
      }
    }       
}

function dep_filter() {
  var input,input_coin, filter,filter_coin, table, tr, td, i, txtValue,txtValue2;
  input = document.getElementById("coin");
  //console.log(input);
  input_status = document.getElementById("status");
  //console.log(input_status);

  filter = input.value.toUpperCase();
  filter_status = input_status.value.toUpperCase();
  // console.log(filter_status);
  table = document.getElementById("deposit_tbl");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];

    td6 = tr[i].getElementsByTagName("td")[5];
    if (td || td6) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td6.textContent || td6.innerText;
      // txtValue3 = td3.textContent || td3.innerText;
      // console.log(txtValue2);
      if(input != "" && input_status != ""){
        //console.log("a")
        if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter_status) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
       }

      }
    }       
}

function with_filter() {
  var input,input_coin, filter,filter_coin, table, tr, td, i, txtValue,txtValue2;
  input = document.getElementById("with_coin");
  //console.log(input);
  input_status = document.getElementById("with_status");
 // console.log(input_status);

  filter = input.value.toUpperCase();
  filter_status = input_status.value.toUpperCase();
  // console.log(filter_status);
  table = document.getElementById("withdraw_tbl");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];

    td6 = tr[i].getElementsByTagName("td")[5];
    if (td || td6) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td6.textContent || td6.innerText;
      // txtValue3 = td3.textContent || td3.innerText;
      // console.log(txtValue2);
      if(input != "" && input_status != ""){
       // console.log("a")
        if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter_status) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
       }

      }
    }       
}

function marg_filter() {
  var input,input_coin, filter,filter_coin, table, tr, td, i, txtValue,txtValue2;
  input = document.getElementById("marg_coin");
  //console.log(input);
  input_status = document.getElementById("marg_status");
 // console.log(input_status);

  filter = input.value.toUpperCase();
  filter_status = input_status.value.toUpperCase();
  // console.log(filter_status);
  table = document.getElementById("marg_trade_tbl");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];

    td6 = tr[i].getElementsByTagName("td")[6];
    if (td || td6) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td6.textContent || td6.innerText;
      // txtValue3 = td3.textContent || td3.innerText;
      // console.log(txtValue2);
      if(input != "" && input_status != ""){
       // console.log("a")
        if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter_status) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
       }

      }
    }       
}

// function p2p_filter() {
//   var input,input_coin, filter,filter_coin, table, tr, td, i, txtValue,txtValue2;
//   input = document.getElementById("p2p_coin");
//   //console.log(input);
//   input_status = document.getElementById("p2p_status");
//   //console.log(input_status);

//   filter = input.value.toUpperCase();
//   filter_status = input_status.value.toUpperCase();
//   // console.log(filter_status);
//   table = document.getElementById("p2p_table");
//   tr = table.getElementsByTagName("tr");
//   for (i = 0; i < tr.length; i++) {
//     td = tr[i].getElementsByTagName("td")[1];

//     td6 = tr[i].getElementsByTagName("td")[7];
//     if (td || td6) {
//       txtValue = td.textContent || td.innerText;
//       txtValue2 = td6.textContent || td6.innerText;
//       // txtValue3 = td3.textContent || td3.innerText;
//       // console.log(txtValue2);
//       if(input != "" && input_status != ""){
//         //console.log("a")
//         if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter_status) > -1) {
//             tr[i].style.display = "";
//           } else {
//             tr[i].style.display = "none";
//           }
//        }

//       }
//     }       
// }

function fut_filter() {
  var input,input_coin, filter,filter_coin, table, tr, td, i, txtValue,txtValue2;
  input = document.getElementById("fut_coin");
  //console.log(input);
  input_status = document.getElementById("fut_status");
  //console.log(input_status);

  filter = input.value.toUpperCase();
  filter_status = input_status.value.toUpperCase();
  // console.log(filter_status);
  table = document.getElementById("fut_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];

    td6 = tr[i].getElementsByTagName("td")[9];
    if (td || td6) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td6.textContent || td6.innerText;
      // txtValue3 = td3.textContent || td3.innerText;
      // console.log(txtValue2);
      if(input != "" && input_status != ""){
        //console.log("a")
        if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter_status) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
       }

      }
    }       
}

function etf_filter() {
  var input,input_coin, filter,filter_coin, table, tr, td, i, txtValue,txtValue2;
  input = document.getElementById("etf_coin");
  //console.log(input);
  input_status = document.getElementById("etf_status");
  //console.log(input_status);

  filter = input.value.toUpperCase();
  filter_status = input_status.value.toUpperCase();
  // console.log(filter_status);
  table = document.getElementById("etf_table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];

    td6 = tr[i].getElementsByTagName("td")[6];
    if (td || td6) {
      txtValue = td.textContent || td.innerText;
      txtValue2 = td6.textContent || td6.innerText;
      // txtValue3 = td3.textContent || td3.innerText;
      // console.log(txtValue2);
      if(input != "" && input_status != ""){
        //console.log("a")
        if (txtValue.toUpperCase().indexOf(filter) > -1 && txtValue2.toUpperCase().indexOf(filter_status) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
       }

      }
    }       
}

</script>