<?php 
$this->load->view('front/common/header');
?>


<div class=" jab_mdl_cnt  jab_mkts_page">

						<div class="container jab_mkts_container">
							
							
							<div class="jab_mkts_h1">
								Browse
							</div>
							<div class="jab_mkts_tabs_sets">
								<div class="jab_mkts_tabs_hd_set">
							<div class="jab_mkts_tabs_hd jab_mkts_tabs_hd_act" data-tabn="Trending"> Trending </div>
							<!-- <div class="jab_mkts_tabs_hd" data-tabn="Tokenized"> Tokenized Stocks </div> -->

						</div>
							<div class="jab_mkts_tabs_pane jab_mkts_tabs_pane_act" data-tabname="Trending">
								
								<div class="jab_mkts_top_scrl">
								<div class="jab_mkts_top_set">
									
									<?php
										if(!empty($allcurrencies))
										{
											foreach ($allcurrencies as $cur) {
											
											$pair_details = checkpair_currency($cur->id);
											
										
									?>

								<div class="jab_mkts_top_inst">
									<a href="#">
								<div class="jab_mkts_top_set_in">
								<div class="jab_mkts_top_set_t1">
									<img src="<?php echo $cur->image;?>" class="jab_mkts_top_set_t1_img">
									<div class="jab_mkts_top_set_t1_in1"><?=$cur->currency_symbol;?></div>
									<div class="jab_mkts_top_set_t1_in2">Top Volume</div>
								</div>
								<div class="jab_mkts_top_set_t2"><?php echo TrimTrailingZeroes($pair_details->lastPrice);?></div>
								<div class="jab_mkts_top_set_t3">
									<div class="row">
										<div class="col-6">
											<div class="jab_mkts_top_set_t3_in1 <?php echo($pair_details->priceChangePercent>0)?'jab_clr_success':'jab_clr_danger';?>"><?php echo number_format($pair_details->priceChangePercent,2);   ?></div>
											<div class="jab_mkts_top_set_t3_in2">24h Change</div>
										</div>
										<div class="col-6">
											<div class="jab_mkts_top_set_t3_in1"><?php echo TrimTrailingZeroes($pair_details->volume);?></div>
											<div class="jab_mkts_top_set_t3_in2">24h Volume</div>
										</div>
									</div>

								</div>
								</div>
							</a>
								</div><?php } } ?>

							
											

								</div>
							</div>
							</div>

						
							</div>





							<div class="jab_mkts_h1">
								Markets
							</div>
							<div class="jab_mkts_tabs_sets">
								<div class="jab_mkts_tabs_hd_set">
							<div class="jab_mkts_tabs_hd jab_mkts_tabs_hd_act" data-tabn="Markets"> All Markets </div>
							<!-- <div class="jab_mkts_tabs_hd" data-tabn="Favorites"> Favorites </div> -->
							 <?php if(count($currencies)>0) {
				               
				                foreach($currencies as $currency){
				          ?>
				          <div class="jab_mkts_tabs_hd" data-tabn="<?php echo $currency->currency_symbol;?>"> <?php echo $currency->currency_symbol;?> </div>
				          <?php } } ?>

							<!-- <div class="jab_mkts_tabs_hd" data-tabn="BTC"> BTC </div> -->


							<div class="jab_mkts_tab_serch_set">
								<input type="text" class="jab_mkts_tab_serch_input" placeholder="Search Market">
								<a href="#" class="jab_mkts_tab_serch_i"><i class="fal fa-search"></i></a>
							</div>
						</div>
						<div class="jab_mkts_main_li jab_mkts_main_li_hd">
										<div class="jab_mkts_main_li_in cpmmkm1"> Market<i class="fal fa-arrow-down"></i></div>
										<div class="jab_mkts_main_li_in cpmmkm2">Last Price<i class="fal fa-arrow-up"></i></div>
										<div class="jab_mkts_main_li_in cpmmkm3">Est. USD Value<i class="fal fa-arrow-up"></i></div>
										<div class="jab_mkts_main_li_in cpmmkm4">24h Change<i class="fal fa-arrow-up"></i></div>
										<div class="jab_mkts_main_li_in cpmmkm5">24h High<i class="fal fa-arrow-up"></i></div>
										<div class="jab_mkts_main_li_in cpmmkm6">24h Low<i class="fal fa-arrow-up"></i></div>
										<div class="jab_mkts_main_li_in cpmmkm7">24h Volume<i class="fal fa-arrow-up"></i></div>
										<div class="jab_mkts_main_li_in cpmmkm8"></div>
		
										</div>
							<div class="jab_mkts_tabs_pane jab_mkts_tabs_pane_act" data-tabname="Markets">


								<div class="jab_mkts_main_set">
									
								<?php 
								if(count($pairs)>0) {
				               
				                foreach($pairs as $allpairs){
				               	$from_curr = $this->common_model->getTableData('currency',array('id' => $allpairs->from_symbol_id))->row();
                  				$to_curr = $this->common_model->getTableData('currency',array('id' => $allpairs->to_symbol_id))->row();
                  				$pair_url = $from_curr->currency_symbol.'-'.$to_curr->currency_symbol; 	
                  				$conver = $this->common_model->conveter($to_curr->currency_symbol);
                  				$conver_amt = $conver;

                  				$usd_convert = $allpairs->lastPrice * $conver_amt;

								?>

								<a href="<?php echo base_url().'exchange/'.$pair_url;?>">
								<div class="jab_mkts_main_li">
									<div class="jab_mkts_main_li_in cpmmkm1">
										<img src="<?=$from_curr->image?>" class="jab_mkts_main_li_in_ico">
										<div class="jab_mkts_main_li_in1_txt1"><?=$from_curr->currency_symbol;?><span><?=$to_curr->currency_symbol;?></span></div>
										<div class="jab_mkts_main_li_in1_txt2"><?=$to_curr->currency_name;?></div>
									</div>
									<div class="jab_mkts_main_li_in cpmmkm2"><?php echo TrimTrailingZeroes($allpairs->lastPrice);?></div>
									<div class="jab_mkts_main_li_in cpmmkm3">$ <?=$usd_convert;?></div>
									<div class="jab_mkts_main_li_in cpmmkm4 <?php echo($allpairs->priceChangePercent>0)?'jab_clr_success':'jab_clr_danger';?>"><?php echo number_format($allpairs->priceChangePercent,2);   ?> %</div>
									<div class="jab_mkts_main_li_in cpmmkm5"><?php echo TrimTrailingZeroes($allpairs->change_high);?></div>
									<div class="jab_mkts_main_li_in cpmmkm6"><?php echo TrimTrailingZeroes($allpairs->change_low);?></div>
									<div class="jab_mkts_main_li_in cpmmkm7"><?php echo TrimTrailingZeroes($allpairs->volume);?></div>
									<div class="jab_mkts_main_li_in cpmmkm8"><div class="jab_mkts_main_li_in_a">Trade <?=$pair_url;?> <i class="fal fa-chevron-right"></i></div></div>
	
									</div>
								</a><?php } } ?>
								

								</div>


							</div>
							
							<?php 
								if(count($pairs)>0) {
				               
				                foreach($pairs as $pair_details){
				               	$from_currency = $this->common_model->getTableData('currency',array('id' => $pair_details->from_symbol_id))->row();
                  				$to_currency = $this->common_model->getTableData('currency',array('id' => $pair_details->to_symbol_id))->row();
                  				$pair_url = $from_currency->currency_symbol.'-'.$to_currency->currency_symbol; 	

                  				$conver = $this->common_model->conveter($to_curr->currency_symbol);
                  				$conver_amt = $conver;

                  				$usd_converts = $allpairs->lastPrice * $conver_amt;

							?>

							<div class="jab_mkts_tabs_pane " data-tabname="<?php echo $to_currency->currency_symbol;?>">
								<div class="jab_mkts_main_set">
									
							

								<a href="<?php echo base_url().'exchange/'.$pair_url;?>">
								<div class="jab_mkts_main_li">
									<div class="jab_mkts_main_li_in cpmmkm1">
										<img src="<?=$from_currency->image?>" class="jab_mkts_main_li_in_ico">
										<div class="jab_mkts_main_li_in1_txt1"><?=$from_currency->currency_symbol;?><span><?=$to_currency->currency_symbol;?></span></div>
										<div class="jab_mkts_main_li_in1_txt2"><?=$to_currency->currency_name;?></div>
									</div>
									<div class="jab_mkts_main_li_in cpmmkm2"><?php echo TrimTrailingZeroes($pair_details->lastPrice);?></div>
									<div class="jab_mkts_main_li_in cpmmkm3"><?=$usd_converts;?></div>
									<div class="jab_mkts_main_li_in cpmmkm4 <?php echo($pair_details->priceChangePercent>0)?'jab_clr_success':'jab_clr_danger';?>"><?php echo number_format($pair_details->priceChangePercent,2);   ?> %</div>
									<div class="jab_mkts_main_li_in cpmmkm5"><?php echo TrimTrailingZeroes($pair_details->change_high);?></div>
									<div class="jab_mkts_main_li_in cpmmkm6"><?php echo TrimTrailingZeroes($pair_details->change_low);?></div>
									<div class="jab_mkts_main_li_in cpmmkm7"><?php echo TrimTrailingZeroes($pair_details->volume);?></div>
									<div class="jab_mkts_main_li_in cpmmkm8"><div class="jab_mkts_main_li_in_a"> Trade <?=$pair_url;?> <i class="fal fa-chevron-right"></i></div></div>
	
									</div>
								</a>
										</div>
								</div><?php } } ?>
							</div>

						</div>
	
	<div class="jab_mkts_bg_cont"></div>
					</div>

<?php 
$this->load->view('front/common/footer');
?>



