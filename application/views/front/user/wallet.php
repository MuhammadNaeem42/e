<?php 
  $this->load->view('front/common/header');
  ?>
<div class="jb_middle_content jb_wallet_page">
  <div class="container">
    <div class="row ">
      <div class="col-md-7">
        <div class="jb_h1">Overview Wallet</div>
        <div class="jb_comn_card">
          <div class="jb_font_s_16 jb_font_w_400 jb_mar_b_50 jb_opac_p_50">Wallet Balance</div>
          <div class="row align-items-center">
            <div class="col-6">
              <div class="jb_font_s_24 jb_font_w_500 "> $495797</div>
            </div>
          </div>
          <hr class="jb_opac_p_25  structured_box" style="opacity: 0.07; margin-bottom: 30px;">
          <div class="jb_h2 jb_mar_t_30 ">My Assets</div>
          <div class="jb_walt_tran_out ">
          <?php
            if(count($dig_currency) >0)
            {
            
                foreach ($dig_currency as $digital) 
              {
            if($digital->type=="fiat")
            {
                $format = 2;
            }
            elseif($digital->currency_symbol=="USDT")
            {
                $format = 6;
            }
            else
            {
                $format = 6;
            }
            $coin_price_val = to_decimal($wallet['Exchange AND Trading'][$digital->id], $format);
            $coin_price = $coin_price_val * $digital->online_usdprice;
            $user_id=$this->session->userdata('user_id');
            $userbalance = getBalance($user_id,$digital->id);
            $USDT_Balance = $userbalance * $digital->online_usdprice;
            
            $pairing = $this->common_model->getTableData('trade_pairs',array('from_symbol_id'=>$digital->id,'status'=>1))->row();
              if(!empty($pairing))
              {
                $fromid = $pairing->from_symbol_id;
                $fromcurr = $this->common_model->getTableData('currency',array('id'=>$fromid,'status'=>1))->row();
                $fromSYM = $fromcurr->currency_symbol;
                $toid = $pairing->to_symbol_id;
                $tocurr = $this->common_model->getTableData('currency',array('id'=>$toid,'status'=>1))->row();
                $toSYM = $tocurr->currency_symbol;

                $traDepair = $fromSYM."_".$toSYM; 
  
              }
              else
              {
                $pairing = $this->common_model->getTableData('trade_pairs',array('to_symbol_id'=>$digital->id,'status'=>1))->row();
                if(!empty($pairing))
                {
                  $fromid = $pairing->to_symbol_id;
                  $fromcurr = $this->common_model->getTableData('currency',array('id'=>$fromid,'status'=>1))->row();
                  $fromSYM = $fromcurr->currency_symbol;
  
                  $toid = $pairing->from_symbol_id;
                  $tocurr = $this->common_model->getTableData('currency',array('id'=>$toid,'status'=>1))->row();
                  $toSYM = $tocurr->currency_symbol;
  
                  $traDepair = $toSYM."_".$fromSYM;
                }
  
              }
            ?>
            <div class="jb_walt_tran_li ">
              <div class="jb_walt_tran_li_in jbwtli1"><img src="<?php echo $digital->image;?>"><?php echo $digital->currency_symbol;?> 
                <!-- <span>USDT</span> -->
              </div>
              <div class="jb_walt_tran_li_in jbwtli2">$ <?php echo $USDT_Balance; ?></div>
              <div class="jb_walt_tran_li_in jbwtli3"><?php echo  ($userbalance > 0  ) ? $userbalance : "0"; ?> <?php echo $digital->currency_symbol;?></div>
              <div class="jb_walt_tran_li_in jbwtli4">
                <div class="jb_walt_tran_btn_set">
                  <div class="jb_walt_tran_btn_dummy">Action<i class="fal fa-arrow-down"></i></div>
                  <div class="jb_walt_tran_btn_bdy">
                    <a href="<?php echo base_url(); ?>trade/<?=$traDepair;?>" class="jb_form_btn">Trade</a>
                    <a href="<?php echo base_url(); ?>withdraw/<?=$digital->currency_symbol;?>" class="jb_form_btn jb_form_btn_red">Send</a>
                    <a href="<?php echo base_url(); ?>deposit/<?=$digital->currency_symbol;?>" class="jb_form_btn jb_form_btn_blue">Receive</a>
                  </div>
                </div>
              </div>
            </div>
            <?php
              }      
            }
            ?>
          </div>
        </div>
      </div>
      <div class="col-md-5 ">
        <div class="jb_h1">Fund Your Wallet</div>
        <div class="jb_comn_card">
          <div class="row">
            <div class="col-6">
              <div class="jb_walt_tran_li_a"><img src="<?php echo front_img();?>wal-ico-2.png" class="jb_walt_tran_li_a_img">Buy Crypto</div>
            </div>
            <div class="col-6">
              <a href="#" class="jb_walt_tran_li_a"><img src="<?php echo front_img();?>wal-ico-1.png" class="jb_walt_tran_li_a_img">Send</a>
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