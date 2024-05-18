<?php 
  $this->load->view('front/common/header');

$p_cnt1 = count($xml1->channel->item);
$coindesk_cnt = count($coindesk->channel->item);
$cointelegraph_cnt = count($cointelegraph->channel->item);
$bitcoinmagazine_cnt = count($bitcoinmagazine->channel->item);
$decrypt_cnt = count($decrypt->channel->item);
// $coinbureau_cnt = count($coinbureau->channel->item);
$coingape_cnt = count($coingape->channel->item);

// echo "<pre>";print_r($coinbureau_cnt);die;

?>
	

<style>
.jb_ln_timer {
	position: relative;
	color: #000;
	font-size: 12px;
	font-weight: 600;
	margin-top: 13px;
	opacity: 0.7;
}	
.jb_ln_list_dejb_ln_p img {
    display: none !important;
}

.jb_ln_list_dejb_ln_p p {
    width: 100%;
    margin: 0px !important;
}

.jb_ln_list_sid_li_txt {
	width: 100% !important;
	padding-left: 0px !important;
}
</style>
<div class="jb_middle_content jb_learn_page">
    <div class="container">
      	<div class="row jb_ln_list_rows">
       		<div class=" col-xl-8">
           		<div class="jb_ln_list_hdng">Learn</div>
           		<?php if(count($coindesk_cnt) > 0){
           			for($i = 0; $i < $coindesk_cnt; $i++) {
           				$title = $coindesk->channel->item[$i]->title;
						$description = $coindesk->channel->item[$i]->description;
						$rssurl = $coindesk->channel->item[$i]->link;
						// $rsscat = $coindesk->channel->item[$i]->category;
						$pubDate = $coindesk->channel->item[$i]->pubDate;
						// $img = json_decode(json_encode($coindesk->channel->item[$i]->enclosure), true);
						$rsscreator = $coindesk->channel->item[$i]->children('http://purl.org/dc/elements/1.1/');
						// $rsscreator = strstr($rsscreator, 'By');

						$url = end(explode('/', $rssurl));
						$img = json_decode(json_encode($coindesk->channel->item[$i]->children('media', True)->content->attributes()), true);

           		?>
           		<div class="jb_ln_list_out">
           		<div class="jb_ln_list_img_out"> <img src="<?=$img['@attributes']['url']?>" class="jb_ln_list_img">
           		</div>
	               <div class="jb_ln_list_dejb_ln_out">
	                   <!-- <div class="jb_ln_list_dejb_ln_h1_cat">Android</div> -->
	                   <a target="_blank" href="<?=$rssurl?>" class="jb_ln_list_dejb_ln_h1"><?=$title?></a>
	                   <!-- <a href="<?=base_url().'news/'.$url?>" class="jb_ln_list_dejb_ln_h1"><?=$title?></a> -->
	                   <div class="jb_ln_list_dejb_ln_p"><?=$description?> </div>
	                   <div class="row">
	                   	<div class="col-md"> <div class="jb_ln_timer">By <?=$rsscreator?> </div></div>
	                   	<div class="col-md-auto"><div class="jb_ln_timer"> <?=get_time_ago( strtotime($pubDate) )?> </div></div>
	                   </div>
	                  
	               </div>
           		</div>

           		<?php }}
           		if(count($cointelegraph_cnt) > 0){
           			for($i = 0; $i < $cointelegraph_cnt; $i++) {  
	           			$title = $cointelegraph->channel->item[$i]->title;
						$description = $cointelegraph->channel->item[$i]->description;
						$rssurl = $cointelegraph->channel->item[$i]->link;
						$pubDate = $cointelegraph->channel->item[$i]->pubDate;
						$img = json_decode(json_encode($cointelegraph->channel->item[$i]->enclosure), true);;
						$rsscreator = $cointelegraph->channel->item[$i]->children('http://purl.org/dc/elements/1.1/');
						$rsscreator = strstr($rsscreator, 'By');

						$url = end(explode('/', $rssurl));
           			?>
           		<div class="jb_ln_list_out">
           		<div class="jb_ln_list_img_out"> <img src="<?=$img['@attributes']['url']?>" class="jb_ln_list_img">
           		</div>
	               <div class="jb_ln_list_dejb_ln_out">
	                   <a target="_blank" href="<?=$rssurl?>" class="jb_ln_list_dejb_ln_h1"><?=$title?></a>
	                   <div class="jb_ln_list_dejb_ln_p"><?=$description?> </div>
	                   <div class="row">
	                   	<div class="col-md"> <div class="jb_ln_timer"> <?=$rsscreator?> </div></div>
	                   	<div class="col-md-auto"><div class="jb_ln_timer"> <?=get_time_ago( strtotime($pubDate) )?> </div></div>
	                   </div>
	               </div>
           		</div>
           		<?php }}
           		if(count($bitcoinmagazine_cnt) > 0){
           			for($i = 0; $i < $bitcoinmagazine_cnt; $i++) { 
           				$title = $bitcoinmagazine->channel->item[$i]->title;
						$description = $bitcoinmagazine->channel->item[$i]->description;
						$rssurl = $bitcoinmagazine->channel->item[$i]->link;
						$pubDate = $bitcoinmagazine->channel->item[$i]->pubDate;
						$img = json_decode(json_encode($bitcoinmagazine->channel->item[$i]->enclosure), true);;
						$rsscreator = $bitcoinmagazine->channel->item[$i]->children('http://purl.org/dc/elements/1.1/');
						// $rsscreator = strstr($rsscreator, 'By');

						$url = end(explode('/', $rssurl));
           				?>
           		<div class="jb_ln_list_out">
           		<div class="jb_ln_list_img_out"> <img src="<?=$img['@attributes']['url']?>" class="jb_ln_list_img">
           		</div>
	               <div class="jb_ln_list_dejb_ln_out">
	                   <!-- <div class="jb_ln_list_dejb_ln_h1_cat">Android</div> -->
	                   <a target="_blank" href="<?=$rssurl?>" class="jb_ln_list_dejb_ln_h1"><?=$title?></a>
	                   <div class="jb_ln_list_dejb_ln_p"><?=$description?> </div>
	                   <div class="row">
	                   	<div class="col-md"> <div class="jb_ln_timer">By <?=$rsscreator?> </div></div>
	                   	<div class="col-md-auto"><div class="jb_ln_timer"> <?=get_time_ago( strtotime($pubDate) )?> </div></div>
	                   </div>
	               </div>
           		</div>		

           		<?php }}
           		if(count($decrypt_cnt) > 0){
           			for($i = 0; $i < $decrypt_cnt; $i++) { 
           				$title = $decrypt->channel->item[$i]->title;
						$description = $decrypt->channel->item[$i]->description;
						$rssurl = $decrypt->channel->item[$i]->link;
						$pubDate = $decrypt->channel->item[$i]->pubDate;
						$img = json_decode(json_encode($decrypt->channel->item[$i]->enclosure), true);;
						$rsscreator = $decrypt->channel->item[$i]->children('http://purl.org/dc/elements/1.1/');
						// $rsscreator = strstr($rsscreator, 'By');
						$url = end(explode('/', $rssurl));
           		?>
           		<div class="jb_ln_list_out">
           		<div class="jb_ln_list_img_out"> <img src="<?=$img['@attributes']['url']?>" class="jb_ln_list_img">
           		</div>
	               <div class="jb_ln_list_dejb_ln_out">
	                   <!-- <div class="jb_ln_list_dejb_ln_h1_cat">Android</div> -->
	                   <a target="_blank" href="<?=$rssurl?>" class="jb_ln_list_dejb_ln_h1"><?=$title?></a>
	                   <div class="jb_ln_list_dejb_ln_p"><?=$description?> </div>
	                   <div class="row">
	                   	<div class="col-md"> <div class="jb_ln_timer">By <?=$rsscreator?> </div></div>
	                   	<div class="col-md-auto"><div class="jb_ln_timer"> <?=get_time_ago( strtotime($pubDate) )?> </div></div>
	                   </div>
	               </div>
           		</div>		

           		<?php }}
           		if(count($coingape_cnt) > 0){
           			for($i = 0; $i < $coingape_cnt; $i++) { 
           				$title = $coingape->channel->item[$i]->title;
						$description = $coingape->channel->item[$i]->description;
						$rssurl = $coingape->channel->item[$i]->link;
						$pubDate = $coingape->channel->item[$i]->pubDate;
						// $img = json_decode(json_encode($coingape->channel->item[$i]->enclosure), true);
						$rsscreator = $coingape->channel->item[$i]->children('http://purl.org/dc/elements/1.1/');
						// $rsscreator = strstr($rsscreator, 'By');
						$url = end(explode('/', $rssurl));

						$img = json_decode(json_encode($coingape->channel->item[$i]->children('media', True)->content->attributes()), true);

           		?>
           		<div class="jb_ln_list_out">
           		<div class="jb_ln_list_img_out"> <img src="<?=$img['@attributes']['url']?>" class="jb_ln_list_img">
           		</div>
	               <div class="jb_ln_list_dejb_ln_out">
	                   <!-- <div class="jb_ln_list_dejb_ln_h1_cat">Android-0</div> -->
	                   <a target="_blank" href="<?=$rssurl?>" class="jb_ln_list_dejb_ln_h1"><?=$title?></a>
	                   <div class="jb_ln_list_dejb_ln_p"><?=$description?> </div>
	                   <div class="row">
	                   	<div class="col-md"> <div class="jb_ln_timer">By <?=$rsscreator?> </div></div>
	                   	<div class="col-md-auto"><div class="jb_ln_timer"> <?=get_time_ago( strtotime($pubDate) )?> </div></div>
	                   </div>
	               </div>
           		</div>	

           	<?php }} ?>
           </div>


 <div class=" col-xl-4">
    <div class="jb_ln_list_hdng">Categories</div>
    <div class="jb_ln_list_ul">
	    <a target="_blank" href="https://cointelegraph.com/tags/blockchain" class="jb_ln_list_li">Blockchain</a>
	    <a target="_blank" href="https://cointelegraph.com/tags/defi" class="jb_ln_list_li">DeFi</a>
	    <a target="_blank" href="https://cointelegraph.com/tags/nft" class="jb_ln_list_li">NFT</a>
	    <a target="_blank" href="https://cointelegraph.com/tags/cryptocurrencies" class="jb_ln_list_li">Cryptocurrency</a>
	    <a target="_blank" href="https://cointelegraph.com/tags/bitcoin" class="jb_ln_list_li">Bitcoin</a>
	    <a target="_blank" href="https://cointelegraph.com/tags/ethereum" class="jb_ln_list_li">Ethereum</a>
	    <a target="_blank" href="https://cointelegraph.com/tags/staking" class="jb_ln_list_li">Staking</a>
	    <a target="_blank" href="https://cointelegraph.com/tags/p2p" class="jb_ln_list_li">P2P</a>
    </div>

    <div class="jb_ln_list_hdng">Recommended</div>
	    <div class="jb_ln_list_sid_out">
	    <?php if(count($p_cnt1) > 0){
   			for($i = 0; $i < $p_cnt1; $i++) {  
       			$title = $xml1->channel->item[$i]->title;
				$rssurl = $xml1->channel->item[$i]->link;
				
   			?>	

		    <a target="_blank" href="<?=$rssurl?>" class="jb_ln_list_sid_li">
		       <!-- <img src="assets/images/learn-img.jpg" class="jb_ln_list_sid_li_img"> -->
		       <div class="jb_ln_list_sid_li_txt"><?=$title?></div>
		    </a>
	    <?php }}?>
	 


	    </div>
     </div>
      </div>
    </div>

  </div>




  <?php 
  $this->load->view('front/common/footer');
  ?>