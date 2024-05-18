<?php
$this->load->view('front/common/header');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css" />


         <div class="sb_main_content sb_oth_main">
            <div class="container">
               <div class="sb_m_o_h1">P2P Reports</div>
               <div class="sb_m_rept_tab_headset">
                
               </div>
             
                  
               <div class="sb_m_rept_tab_pane_li sb_m_rept_tab_pane_li_act" data-nam="P2P">
                  <div class="sb_m_common_pnl">
                  
                     <div class="table-responsive">
                        <table class="table table-hover sb_m_tbl_total" id="p2pexample">
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
                                    <?php if(($c->tradestatus=='filled')&&($c->paid_status=='open')) { ?>
                                       <div class="sb_m_tbl_stat">In progress</div>
                                    <?php } else if(($c->tradestatus=='open')&&($c->paid_status=='open')) { ?>  
                                       <a href="<?php echo base_url('p2p_cancel/'.encryptIt($c->id)); ?>"><div class="sb_m_tbl_stat">Open X</div></a>
                                    <?php } else if(($c->tradestatus=='filled')&&($c->paid_status=='Completed')) { ?>
                                       <div class="sb_m_tbl_stat sb_m_tbl_stat_grn">Completed</div>
                                    <?php } else if($c->tradestatus=='cancelled') { ?>
                                       <div class="sb_m_tbl_stat sb_m_tbl_stat_red">Cancelled</div>   
                                    <?php }?>
                                    
                                 </td>
                              </tr>


                              <?php $i++; }  }?>   

                              
                              
                              
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
 <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
 <script>
$(document).ready( function () {
    $('#p2pexample').DataTable({
      buttons: [ 'csv', 'excel', 'pdf', 'print' ]
    });
});
 </script>  
</body>
</html>