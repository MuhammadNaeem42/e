<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods", "GET, POST, DELETE, PUT");

defined('BASEPATH') OR exit('No direct script access allowed');
class Common extends CI_Controller {
	public function __construct()
	{	
		parent::__construct();		
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->library(array('form_validation'));
		$this->load->library('session');
		$this->site_api = new Tradelib();
		$this->load->helper(array('url', 'language'));
		$lang_id = $this->session->userdata('site_lang');
		if($lang_id == '')
		{
			$this->lang->load('content','english');
			$this->session->set_userdata('site_lang','english');
		}
		else
		{
			$this->lang->load('content',$lang_id);	
			$this->session->set_userdata('site_lang',$lang_id);
		}
		$this->load->library('session');
		$sitelan = $this->session->userdata('site_lang'); 
	}
	function switchLang($language = "") 
    {
       $language = ($language != "") ? $language : "english";
       $this->session->set_userdata('site_lang', $language);
       redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
	
	public function index()
	{
		// echo encryptIt('admin@gmail.com');
		// echo "<br>";
		// echo encryptIt('Admin@123');
		// echo decryptIt('R3B4UDF0ZS8vTjR2amk5TEVJS2NsS3FTZFRuakh2eXJ3SlN0ejBnNGllMD0=');
		// echo "<br>";				
		// echo decryptIt('V3hkckdaVEM4MGw0UDJuRWI1RTFRZz09');
		// die;
		// $this->common_model->sitevisits();
		$data['site_common'] = site_common();
		$this->session->set_userdata('site_home','home');
		$data['home_section'] = $this->common_model->getTableData('static_content',array('slug'=>'home_sec'))->row();
		$data['feature'] = $this->common_model->getTableData('static_content',array('slug'=>'features_cont'))->row();
		$data['features'] = $this->common_model->getTableData('static_content',array('slug'=>'features'))->result();
		$data['overview'] = $this->common_model->getTableData('static_content',array('slug'=>'overview'))->row();
		$data['about'] = $this->common_model->getTableData('static_content',array('slug'=>'about'))->row();
		$data['solutions'] = $this->common_model->getTableData('static_content',array('slug'=>'solutions'))->row();
		$data['progress'] = $this->common_model->getTableData('static_content',array('slug'=>'progress'))->result();
		$data['pairs'] = $this->common_model->getTableData('trade_pairs',array('status'=>'1'),'','','','','','', array('id', 'ASC'))->result();
		$this->load->view('front/common/home',$data);
	}

	public function home_two()
	{
		$this->session->set_userdata('site_home','home-two');	
		$data['site_common'] = site_common();
		$data['home_title'] = $this->common_model->getTableData('static_content',array('slug'=>'home-page-title'))->row();
		$data['news_update'] = $this->common_model->getTableData('static_content',array('slug'=>'news_update'))->row();
		$data['segment_1'] = $this->common_model->getTableData('static_content',array('slug'=>'segment_1'))->row();
		$data['segment_2'] = $this->common_model->getTableData('static_content',array('slug'=>'segment_2'))->row();
		$limit = 5;
		$data['faq_category'] = $this->common_model->getTableData('faq_category')->result();
		$data['faq'] = $this->common_model->getTableData('faq', array('status' => 1),'','','','','',$limit)->result();
		$data['howtostart'] = $this->common_model->getTableData('static_content',array('slug'=>'how-to-start'))->row();
		$data['chooseus'] = $this->common_model->getTableData('static_content',array('slug'=>'why-choose-us'))->row();
		$data['homesection'] = $this->common_model->getTableData('static_content',array('slug'=>'home-section'))->row();

		$data['ourfeatures'] = $this->common_model->getTableData('static_content',array('slug'=>'Our_Features'))->row();

		
		$data['allcurrency'] = $this->common_model->getTableData('currency',array('status'=>'1'),'','','','','','', array('sort_order', 'ASC'))->result();

		$data['digital_currency_1'] = $this->common_model->getTableData('currency',array('status'=>'1','type'=>'digital'),'','','','','','', array('sort_order', 'DESC'))->result();
		$data['digital_currency_2'] = $this->common_model->getTableData('currency',array('status'=>'1','type'=>'digital'),'','','','','','', array('sort_order', 'ASC'))->result();

		$data['common_pairs'] = $this->common_model->customQuery("select * from blackcube_currency where status='1' and currency_symbol in ('BTC','LTC','USDT','USD') ")->result();

		$data['pairs'] = $this->common_model->getTableData('trade_pairs',array('status'=>'1'),'','','','','','', array('id', 'ASC'))->result();
				
		$this->load->view('front/common/home_two',$data);
	}



public function coinbase_redirect()
{


	echo "Response";

}





	public function currency_calculation()
{
$data['site_common'] = site_common();
$data['digital_currency_1'] = $this->common_model->getTableData('currency',array('status'=>'1','type'=>'digital'),'','','','','','', array('sort_order', 'DESC'))->result();
$data['digital_currency_2'] = $this->common_model->getTableData('currency',array('status'=>'1','type'=>'digital'),'','','','','','', array('sort_order', 'ASC'))->result();
$this->load->view('front/common/currency_calculation',$data);
}
public function price()
{
    $data['site_common'] = site_common();
	$data['pairs'] = $this->common_model->getTableData('trade_pairs',array('status'=>'1'),'','','','','','', array('id', 'ASC'))->result();
    $this->load->view('front/common/price',$data);
}

	public function coin()
	{
		$data['site_common'] = site_common();
		$data['allcurrency'] = $this->common_model->getTableData('currency',array('status'=>'1'),'','','','','','', array('sort_order', 'ASC'))->result();
		$this->load->view('front/common/coin',$data);
	}
	public function about_us()
	{
		$data['site_common'] = site_common();
		 $data['about'] = $this->common_model->getTableData('static_content',array('slug'=>'about'))->row();
        $data['abouts'] = $this->common_model->getTableData('static_content',array('slug'=>'abouts'))->row();
        $data['aboutus'] = $this->common_model->getTableData('static_content',array('slug'=>'aboutus'))->row();
		if($this->session->userdata('site_home')=='home' || $this->session->userdata('site_home')=='home_two'){
			$this->load->view('front/common/about_us',$data);
		}else{
			$this->load->view('front/common/about_us_two',$data);	
		}
		
	}

	public function block()
	{
		$cip = get_client_ip();
		$match_ip = $this->common_model->getTableData('page_handling',array('ip'=>$cip))->row();
		if($match_ip > 0)
		{
		return 1;
		}
		else
		{
		return 0;
		}
	}
	public function block_ip()
    {
        $this->load->view('front/common/blockips');
    }
    public function blockips()
    {
        $this->load->view('front/common/blockips');  
    }
	function reg_subscribe()
	{
	$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
	if ($this->input->post())
	{
	$email = $this->input->post('email');
	$check1=$this->common_model->getTableData('reg_subscribe',array('email'=>$email,'status'=>1));
	if ($check1->num_rows()!=0)
	{
	$this->session->set_flashdata('error', 'You already subscribed');
	front_redirect('home', 'refresh');
	}
	$user_data = array('email'=> $email);
			$id=$this->common_model->insertTableData('reg_subscribe', $user_data);
			$email_template = 'subscribers';
			$site_common      =   site_common();
			$activation_code = base64_encode($id);
			$special_vars = array(
			'###LINK###' => front_url().'unsubscribe/'.$activation_code
			);            
			$this->email_model->sendMail($email, '', '', $email_template, $special_vars);
			$this->session->set_flashdata('success','Your Subscription submitted successfully');
			front_redirect('home', 'refresh');
		}        
	}
	function unsubscribe($code)
	{
		$id = base64_decode($code);
		$check1=$this->common_model->getTableData('reg_subscribe',array('id'=>$id));
	    if ($check1->num_rows()>0)
	    {
	    	$updateTableData = array('status'=>'0');
	    	$this->common_model->updateTableData('reg_subscribe', array('id' => $id), $updateTableData);
	    	$this->session->set_flashdata('success',' Your Subscription cancelled successfully');
			front_redirect('', 'refresh');
	    }
	    else
	    {
	    	$this->session->set_flashdata('error Something went wrong');
			front_redirect('', 'refresh');
	    }
	}





function assets(){

header('Content-Type: application/json');

$symbol = $_GET['symbol'];

if(isset($symbol) && !empty($symbol)){
$currency_list = $this->common_model->getTableData('currency',array("currency_symbol"=>$symbol,"status"=>1))->result();
}
else{
$currency_list = $this->common_model->getTableData('currency',array("status"=>1))->result();
}

if(count($currency_list) >0 )
{
foreach($currency_list as $curr){
  $check_currency = $this->common_model->customQuery("SELECT * from blackcube_trade_pairs where status = 1 AND from_symbol_id = ".$curr->id." OR to_symbol_id = ".$curr->id."")->row();
  if(count($check_currency)>0)
  {
    if($curr->type=="digital")
    {
      $deposit_status = ($curr->deposit_status==1)?"true":"false";
      $withdraw_status = ($curr->withdraw_status==1)?"true":"false";
    }
    else
    {
      $deposit_status = ($curr->fiatdeposit_status==1)?"true":"false";
      $withdraw_status = ($curr->fiatwithdraw_status==1)?"true":"false";
    }
    $Insert_data['name']    = strtolower($curr->currency_name);
    $Insert_data['unified_cryptoasset_id'] = $curr->id;
    $Insert_data['can_withdraw']    = $withdraw_status;
    $Insert_data['can_deposit']     = $deposit_status;
    $Insert_data['min_withdraw']    = trailingZeroes(numberFormatPrecision($curr->min_withdraw_limit));
    $Insert_data['max_withdraw']    = trailingZeroes(numberFormatPrecision($curr->max_withdraw_limit));
    $Insert_data['maker_fee']    = trailingZeroes(numberFormatPrecision($curr->maker_fee));
    $Insert_data['taker_fee']    = trailingZeroes(numberFormatPrecision($curr->taker_fee));
    $newDataArray[$curr->currency_symbol] = $Insert_data;
  
  }

}
$post_data_assets = array('code' => '200', 'msg'=>'success', 'data' => ($newDataArray));
}
else
{
$post_data_assets = array ('status' => false,'error' => 'Incorrect symbol',);

}

echo json_encode($post_data_assets,true);

}


function market_api_depth($pair_symbol){
$pair_id = getpair($pair_symbol)->id;
$checkapi = checkapi($pair_id);
$limit = ($_GET['limit']!='')?$_GET['limit']:0;
header('Content-Type: application/json');
$data = array();
if($checkapi==1)
{
if($limit==0)
{
  $Api = $this->common_model->getTableData('api_orders',array("pair_symbol"=>$pair_symbol,'type'=>'buy'),'','','','','','',array('price','desc'))->result();
}
else
{
  $Api = $this->common_model->getTableData('api_orders',array("pair_symbol"=>$pair_symbol,'type'=>'buy'),'','','','','',$limit,array('price','desc'))->result();
}

if(count($Api)>0)
{            
    $bids = array();
    foreach($Api as $row)
    {
        array_push($bids, array(trailingZeroes(numberFormatPrecision($row->price)),trailingZeroes(numberFormatPrecision($row->quantity))));
    }
    $data['bids'] = $bids;           
}
if($limit==0)
{
   $Apis = $this->common_model->getTableData('api_orders',array("pair_symbol"=>$pair_symbol,'type'=>'sell'),'','','','','','',array('price','asc'))->result(); 
}
else
{
  $Apis = $this->common_model->getTableData('api_orders',array("pair_symbol"=>$pair_symbol,'type'=>'sell'),'','','','','',$limit,array('price','asc'))->result(); 
}

 if(count($Apis)>0)
 {
    $sells = array();
    foreach($Apis as $row)
    {
        array_push($sells, array(trailingZeroes(numberFormatPrecision($row->price)),trailingZeroes(numberFormatPrecision($row->quantity))));
    }
    
    $data['asks'] = $sells;           
}
}
else
{
if($limit==0)
{
  $Api = $this->common_model->getTableData('coin_order',array("pair"=>$pair_id,'Type'=>'buy',"status"=>'active'),'','','','','','',array('price','desc'))->result();
}
else
{
  $Api = $this->common_model->getTableData('coin_order',array("pair"=>$pair_id,'Type'=>'buy',"status"=>'active'),'','','','','',$limit,array('price','desc'))->result();
}

if(count($Api)>0)
{            
    $bids = array();
    foreach($Api as $row)
    {
        array_push($bids, array(trailingZeroes(numberFormatPrecision($row->Price)),trailingZeroes(numberFormatPrecision($row->Amount))));
    }
    $data['bids'] = $bids;           
}
if($limit==0)
{
   $Apis = $this->common_model->getTableData('coin_order',array("pair"=>$pair_id,'Type'=>'sell',"status"=>'active'),'','','','','','',array('price','asc'))->result(); 
}
else
{
  $Apis = $this->common_model->getTableData('coin_order',array("pair"=>$pair_id,'Type'=>'sell',"status"=>'active'),'','','','','',$limit,array('price','asc'))->result(); 
}

 if(count($Apis)>0)
 {
    $sells = array();
    foreach($Apis as $row)
    {
        array_push($sells, array(trailingZeroes(numberFormatPrecision($row->Price)),trailingZeroes(numberFormatPrecision($row->Amount))));
    }
    
    $data['asks'] = $sells;           
}
}



if(count($Api)>0 || count($Apis)>0)
{
$lastUpdateId = strtotime(date("Y-m-d H:i:s"));
$data['timestamp'] = $lastUpdateId;

$post_data_orderbook = array('code' => '200', 'msg'=>'success', 'data' => ($data));

echo json_encode($post_data_orderbook,true);
}
else
{
$data['response'] = "No orders found";

echo json_encode($data,true);
}


}



function market_api_list(){
header('Content-Type: application/json');

$symbol = $_GET['pair'];
if(isset($symbol) && !empty($symbol)){

$Api_List = $this->common_model->getTableData('market_api',array('symbol'=>$symbol))->result();
}
else{
$Api_List = $this->common_model->getTableData('trade_pairs')->result();
}

 // foreach($Api_List as $Api){


// foreach($Api_List as $Api){
// $symbol = explode("_",$Api->symbol);
// $usd_price = getcoindetail($symbol[0])->online_usdprice;
// $volume_usd = $Api->volume * $usd_price;
// $Insert_data['trading_pairs']     = $Api->symbol;
// $Insert_data['last_price']    = trailingZeroes(numberFormatPrecision($Api->last_price));
// $Insert_data['lowest_ask']    = trailingZeroes(numberFormatPrecision($Api->ask_price));
// $Insert_data['highest_bid']     = trailingZeroes(numberFormatPrecision($Api->bid_price));
// $Insert_data['base_volume']     = trailingZeroes(numberFormatPrecision($Api->volume));
// $Insert_data['quote_volume']    = trailingZeroes(numberFormatPrecision($Api->last_price)) * trailingZeroes(numberFormatPrecision($Api->volume));

// $Insert_data['price_change_percent_24h']  = trailingZeroes(numberFormatPrecision($Api->price_change_percent));
// $Insert_data['highest_price_24h']   = trailingZeroes(numberFormatPrecision($Api->high_price));
// $Insert_data['lowest_price_24h']  = trailingZeroes(numberFormatPrecision($Api->low_price));

// $newDataArray[] = $Insert_data;
// $post_data_allticker = array('code' => '200', 'msg'=>'success', 'data' => ($newDataArray));

// }
$post_data_allticker = array('code' => '200', 'msg'=>'success', 'data' => ($Api_List));


echo json_encode($post_data_allticker,true);


}




function ticker(){
header('Content-Type: application/json');

$symbol = $_GET['pair'];
if(isset($symbol) && !empty($symbol)){
$Exp = explode('_', $symbol);
$from_symbol = getcoindetail($Exp[0])->id;
$to_symbol = getcoindetail($Exp[1])->id;

$pair_list = $this->common_model->getTableData('trade_pairs',array("status"=>1,'from_symbol_id'=>$from_symbol,'to_symbol_id'=>$to_symbol))->result();
}
else{
$pair_list = $this->common_model->getTableData('trade_pairs',array("status"=>1))->result();
}


if(count($pair_list)>0)
{
foreach($pair_list as $pair){
$from_symbol = getcryptocurrency($pair->from_symbol_id);
$to_symbol = getcryptocurrency($pair->to_symbol_id);

$market_data = $this->common_model->getTableData("market_api",array("symbol"=>$from_symbol."_".$to_symbol))->row();

$Insert_data['base_id']    = $pair->from_symbol_id;
$Insert_data['quote_id']    = $pair->to_symbol_id;
$Insert_data['last_price']    =  trailingZeroes(numberFormatPrecision($market_data->last_price));
$Insert_data['base_volume']    = trailingZeroes(numberFormatPrecision($market_data->volume));
$Insert_data['quote_volume']     = trailingZeroes(numberFormatPrecision($market_data->volume)) * trailingZeroes(numberFormatPrecision($market_data->last_price));

if($pair->status=='1'){
    $Status = 0;
}
else{
    $Status = 1;
}
$Insert_data['isFrozen']    = $Status;
$newDataArray[$market_data->symbol] = $Insert_data;
}
$post_data_ticker = array('code' => '200', 'msg'=>'success', 'data' => ($newDataArray));
}
else
{
$post_data_ticker = array ('status' => false,'error' => 'Incorrect pair',);

}

echo json_encode($post_data_ticker,true);

}

function trades($pair_symbol){
header('Content-Type: application/json');
$sym_array = explode("_",$pair_symbol);
$symbol = $sym_array[0]."/".$sym_array[1];  

$order_list = $this->common_model->gettrades($symbol);
if(count($order_list)>0)
{
foreach($order_list as $list){
   $quote_volume = $list['Amount'] * $list['Price'];
   $Insert_data['trade_id']    = $list['trade_id'];
   $Insert_data['price']    = trailingZeroes(numberFormatPrecision($list['Price']));
   $Insert_data['base_volume']    =  trailingZeroes(numberFormatPrecision($list['Amount']));
   $Insert_data['quote_volume']     = trailingZeroes(numberFormatPrecision($quote_volume));
   $Insert_data['timestamp']    = strtotime($list['datetime']);
   $Insert_data['type']     = $list['Type'];
   $newDataArray[] = $Insert_data;
}
$post_data_trades = array('code' => '200', 'msg'=>'success', 'data' => ($newDataArray));
}
else
{
$post_data_trades = array('code' => '200', 'msg'=>'success', 'data' => ($newDataArray));
}

echo json_encode($post_data_trades,true);

}




public function public_api()
{
	$data['site_common'] = site_common();
	$this->load->view('front/common/public_api',$data);
}










    function cms($link='')
	{
		if($this->block() == 1)
		{
		front_redirect('block_ip');
		}
		$data['cms'] = $this->common_model->getTableData('cms', array('status' => 1, 'link'=>$link))->row();
		$data['meta_content'] = $this->common_model->getTableData('cms', array('status' => 1, 'link'=>$link))->row();
		$data['home_footer'] = $this->common_model->getTableData('static_content',array('slug'=>'home_footer'))->row();
		if(empty($data['cms']))
		{
			front_redirect('', 'refresh');
		}
		
		$data['js_link'] = '';
		$data['site_common'] = site_common();
		
		$data['user_id'] = $this->session->userdata('user_id');
		$static_content  = $this->common_model->getTableData('static_content',array('english_page'=>'home'))->result();
		$Static_Content = array();
		foreach ($static_content as $static) {
			$Static_Content[$static->english_title]['title'] = $static->english_name;
			$Static_Content[$static->english_title]['description'] = $static->english_content;
		}
		$data['meta_content'] = $this->common_model->getTableData('meta_content', array('link' => $link))->row();
		$data['footer'] = $this->common_model->getTableData('static_content',array('slug'=>'footer'))->row();


		$this->load->view('front/common/cms', $data);
		
	}
function faq($id='')
{
if($this->block() == 1)
{
front_redirect('block_ip');
}
$data['faq_id']= $id;

$data['faqs'] = $this->common_model->getTableData('faq')->result();

$data['faq_category'] = $this->common_model->getTableData('faq_category')->result();

$data['site_common'] = site_common();
$data['meta_content'] = $this->common_model->getTableData('meta_content', array('link' => 'faq'))->row();
$this->load->view('front/common/faq', $data);

}
	function fee()
	{
		if($this->block() == 1)
		{
		front_redirect('block_ip');
		}
		$data['allcurrency'] = $this->common_model->getTableData('currency',array('status'=>'1'),'','','','','','', array('currency_name', 'ASC'))->result();
        $data['site_common'] = site_common();
        $data['meta_content'] = $this->common_model->getTableData('meta_content', array('link' => 'fee'))->row();
        
        $this->load->view('front/common/fee', $data);
	}
    
    function execute_order($amount,$price,$limit_price,$total,$fee,$ordertype,$pair,$type,$loan_rate,$pagetype,$user_id)
	{		
		$response = array('status'=>'','msg'=>'');
		if($user_id !="")
		{			
			$response 	= $this->site_api->createOrder($user_id,$amount,$price,$limit_price,$total,$fee,$pair,$ordertype,$type,$loan_rate,$pagetype);
		}
		else
		{
			$response['status'] = "login";
		}
		$result=json_encode($response);
		return  $result;
	}
	function api_click_function($type,$user_id,$price,$amount)
	{
		$type   = $type;//$this->input->post('type');
		$price  = $price;//$this->input->post('price');
		$amount = $amount;//$this->input->post('amount');
		
		$query = $this->common_model->getTableData('coin_order',array('status'=>'pending'));
		if($query->num_rows() > 0)
		{
			$result = $this->common_model->updateTableData('coin_order',array('Type'=>$type,'Price'=>$price,'Amount'=>$amount),array('click_status'=>1));
			$result_id = $this->common_model->getTableData('coin_order',array('Type'=>$type,'Price'=>$price,'Amount'=>$amount,'Amount'=>$amount))->row();
			$res_id 		= $result_id->trade_id;
			$table_name     = 'coin_order';
		}
		else
		{
			$result = $this->common_model->updateTableData('trade_paircoins',array('type'=>$type,'price'=>$price,'quantity'=>$amount),array('click_status'=>1));
			$result_id = $this->common_model->getTableData('trade_paircoins',array('type'=>$type,'price'=>$price,'quantity'=>$amount))->row();
			$res_id 		= $result_id->id;
			$table_name     = 'api_coin_order';
		}	
		
		$data['res_id'] 	= $res_id;
		$data['table_name'] = $table_name;
		$result 		= json_encode($data);
		return $result;
		
	}
	function home_integration()
	{
		$today = date("Y-m-d");
		$data['currency'] = $this->common_model->getTableData('currency',array('status'=>'1','type'=>'digital','expiry_date>='=>$today),'','','','','','', array('sort_order', 'ASC'))->result();
		$result = json_encode($data);
		return  $result;
	}
	function trade_integration($pair_id,$user_id,$type='',$pair)
	{
		$data['pairs'] = trade_pairs($type);
		$this->newtrade_prices($pair_id,$type,$user_id);
		$data['transactionhistory'] = $this->transactionhistory($pair_id,$user_id);
		$data['markettrendings'] = $this->markettrendings($pair_id);
		$data['liquidity']=$this->liquiditydata($pair_id);
		$data['sellResult'] = $this->gettradeopenOrders('Sell',$pair_id);
		$data['buyResult'] = $this->gettradeopenOrders('Buy',$pair_id);
		$data['api_sellResult'] = $this->gettradeapisellOrders($pair);
		$data['api_buyResult'] = $this->gettradeapibuyOrders($pair);
		$data['market_trades'] = $this->market_trades($pair_id);
		$data['market_api_trades'] = $this->market_api_trades($pair);
		$data['current_trade'] = $this->current_trade_pair($pair_id);
		$pair_details = $this->common_model->getTableData('trade_pairs',array('id'=>$pair_id),'from_symbol_id,to_symbol_id')->row();
		$fromID = $pair_details->from_symbol_id;
        $toID = $pair_details->to_symbol_id;
        $getfrom_symbols= $this->common_model->getTableData('currency',array('id'=>$fromID),'','',array())->row();
        $getto_symbols= $this->common_model->getTableData('currency',array('id'=>$toID),'','',array())->row();
        if($getfrom_symbols->currency_symbol =='USD')
         $format = 2;
        else if($getfrom_symbols->currency_symbol =='USDT')  
         $format = 6; 
        else
          $format = 8; 
        if($getto_symbols->currency_symbol =='USD')
         $format1 = 2;
        else if($getto_symbols->currency_symbol =='USDT')  
         $format1 = 6; 
        else
         $format1 = 8; 
		if($type!='home')
		{
			if($user_id&&$user_id!=0)
			{
				$data['open_orders']=$this->get_active_order($user_id);
				$data['open_orders_limit']=$this->get_active_limitorder($user_id);
				$data['open_orders_market']=$this->get_active_marketorder($user_id);
				$data['open_orders_stop']=$this->get_active_stoporder($user_id);
				$data['cancel_orders']=$this->get_cancel_order($pair_id,$user_id);
				$data['stop_orders']=$this->get_stop_order($pair_id,$user_id);
				$data['active_orders'] = $this->get_active_userorder($pair_id,$user_id);
			}
			else
			{
				$data['open_orders']=0;
				$data['cancel_orders']=0;
				$data['stop_orders']=0;
				$data['active_orders'] = 0;
			}
		}
		
		if($this->user_balance!=0)
		{
			$balance=$this->user_balance;
			$data['from_currency'] = to_decimal($balance[$pair_details->from_symbol_id], $format);
            $data['to_currency'] = to_decimal($balance[$pair_details->to_symbol_id], $format1);
			$data['from_symbol'] = $getfrom_symbols->currency_symbol;
            $data['to_symbol'] = $getto_symbols->currency_symbol;			
		}
		else
		{
			$data['from_currency']=0;
			$data['to_currency']=0;	
			$data['from_symbol'] = 0;
            $data['to_symbol'] = 0;
		}
		$data['blackcube_userid']=$this->user_id;
		$data['current_buy_price']=to_decimal($this->marketprice,8);
		$data['current_sell_price']=to_decimal($this->marketprice,8);
		$data['lastmarketprice']=to_decimal($this->lastmarketprice,8);

		$pair_details1 = $this->common_model->getTableData('trade_pairs',array('id'=>$pair_id))->row();

		$data['change']=to_decimal($pair_details1->priceChangePercent,2);
		$data['high']=to_decimal($pair_details1->change_high,8);
		$data['low']=to_decimal($pair_details1->change_low,8);
		$data['volume']=to_decimal($pair_details1->volume,2);

		$data['web_trade'] = '1';
		$result = json_encode($data);
		return  $result;
	}
 
    	function gettradeapisellOrders($pair)
{
	$orderBy=array('price','desc');
  $sellresult = $this->common_model->getTableData("api_orders",array("pair_symbol"=>$pair,'type'=>'sell'),'price,quantity','','','','',20,$orderBy)->result();
 
        if(isset($sellresult)>0 && !empty($sellresult))
        { 
          $sell_res = array();
          $i=1;
          foreach($sellresult as $sell)
          {
            $sellData['id'] = $i;
            $sellData['price'] = $sell->price;
            $sellData['quantity'] = $sell->quantity;
              $sell_res[] = $sellData;
              $i++;
          }
          return $sell_res;
      }
      else
      {
        return $sell_res = [];
      }
}


	function gettradeapibuyOrders($pair)
{
  $buyresult = $this->common_model->getTableData("api_orders",array("pair_symbol"=>$pair,'type'=>'buy'),'price,quantity','','','','',20)->result();
        
        if(count($buyresult)>0 && !empty($buyresult))
        { 
          $buy_res = array();
          $i=1;
          foreach($buyresult as $buy)
          {
            $buyData['id'] = $i;
            $buyData['price'] = $buy->price;
            $buyData['quantity'] = $buy->quantity;
              $buy_res[] = $buyData;
              $i++;
          }
          return $buy_res;
      }
      else
      {
        return $buy_res = [];
      }
}
	function gettradeapiactiveOrders($pair){
		$tradehistory_via_api = $this->common_model->getTableData('site_settings',array('tradehistory_via_api'=>1))->row('tradehistory_via_api');
		if($tradehistory_via_api ==1){
		$pair_value=explode('_',$pair);
		$this->db->order_by("id", "desc");
		$this->db->limit('50');	
	    $this->db->where('type = "buy" or type = "sell"');
		
	  	$this->db->where('first_currency',$pair_value[0]);
		$this->db->where('second_currency',$pair_value[1]);
		$activeorder_trade_result_value = $this->db->get('trade_paircoins')->result_array();
		return $activeorder_trade_result_value;
		}
	}
	function gettradeapicalcelOrders($pair){
		$tradehistory_via_api = $this->common_model->getTableData('site_settings',array('tradehistory_via_api'=>1))->row('tradehistory_via_api');
		if($tradehistory_via_api ==1){
		$pair_value=explode('_',$pair);
		$this->db->order_by("id", "asc");
		$this->db->limit('50');
		$this->db->where('type = "buy" or type = "sell"');
		$this->db->where('first_currency',$pair_value[0]);
		$this->db->where('second_currency',$pair_value[1]);
		$cancelorder_trade_result_value = $this->db->get('trade_paircoins')->result_array();
		return $cancelorder_trade_result_value;
		}
	}
	function gettradeapihistoryOrders($pair){
		$tradehistory_via_api = $this->common_model->getTableData('site_settings',array('tradehistory_via_api'=>1))->row('tradehistory_via_api');
		if($tradehistory_via_api ==1){
		$pair_value=explode('_',$pair);
		$this->db->order_by("id", "desc");
		$this->db->limit('100');
		$this->db->where('first_currency',$pair_value[0]);
		$this->db->where('second_currency',$pair_value[1]);
		$historyorder_trade_result_value = $this->db->get('trade_recent_api')->result_array();
		return $historyorder_trade_result_value;
		}
	}
	function gettradeapistopOrders($pair){
		$pair_value=explode('_',$pair);
		$this->db->order_by("id", "asc");
		$this->db->limit('14');
		$this->db->where('first_currency',$pair_value[0]);
		$this->db->where('second_currency',$pair_value[1]);
		
		$stoporder_trade_result_value = $this->db->get('trade_paircoins')->result_array();
		return $stoporder_trade_result_value;
	}

	function trade_pairs($type='')
	{
		$ci =& get_instance();
		$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where = array('a.status'=>1,'b.status'=>1,'c.status'=>1);
		
		$orderprice = $ci->common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
		$i=0;
		foreach($orderprice as $pair)
		{
			$volume=getTradeVolume($pair->id);
			if($volume->price!=0)
			{
				$orderprice[$i]->price = to_decimal($volume->price,8);
			}
			else
			{
				$orderprice[$i]->price = to_decimal($pair->buy_rate_value,8);
			}
			$orderprice[$i]->change = $volume->change;
			$orderprice[$i]->volume = to_decimal($volume->volume,2);
			$i++;
		}
		return $orderprice;
	}

	function newtrade_prices($pair,$pagetype='',$user_id)
	{
		$this->marketprice = marketprice($pair);
		$this->lowestaskprice = lowestaskprice($pair);
		$this->highestbidprice = lowestaskprice($pair);
		$this->lastmarketprice = lastmarketprice($pair);
		$this->minimum_trade_amount = get_min_trade_amt($pair);
		$this->maker=getfeedetails_buy($pair);
		$this->taker=getfeedetails_sell($pair);
		$this->myfrmt = get_decimalpairs($pair);
		if($user_id)
		{
			$this->user_id = $user_id;
			$this->user_balance = getBalance($user_id);
		}
		else
		{
			$this->user_id = 0;
			$this->user_balance = 0;
		}
	}


	
	public function transactionhistory($pair_id,$user_id)
	{
		$user_id = $user_id;
		$joins = array('coin_order as b'=>'a.sellorderId = b.trade_id','coin_order as c'=>'a.buyorderId = c.trade_id');
		$where = array('a.pair'=>$pair_id,'b.userId'=>$user_id);
		$where_or = array('c.userId'=>$user_id);
		$transactionhistory = $this->common_model->getJoinedTableData('ordertemp as a',$joins,$where,'a.*,
			 date_format(b.datetime,"%d-%m-%Y %H:%i %p") as sellertime,b.trade_id as seller_trade_id,b.pair_symbol,date_format(c.datetime,"%d-%m-%Y %H:%i %p") as buyertime,c.trade_id as buyer_trade_id,a.askPrice as sellaskPrice,c.Price as buyaskPrice,b.Fee as sellerfee,c.Fee as buyerfee,b.Total as sellertotal,c.Total as buyertotal','',$where_or,'','','',array('a.tempId','desc'))->result();
		//print_r($transactionhistory);exit;
        $newquery = $this->common_model->customQuery('select trade_id, Type, Price, Amount, Fee, Total, pair_symbol, status, date_format(datetime,"%d-%m-%Y %H:%i %p") as tradetime from blackcube_coin_order where userId = '.$user_id.' and pair = '.$pair_id.' and status = "cancelled"')->result();
		if(count($transactionhistory)>0 || count($newquery))
		{
		    $transactionhistory_1 = array_merge($transactionhistory,$newquery);
		    $historys = $transactionhistory_1;
		}
		else
		{
		    $historys=0;
		}
		return $historys;
	}



	public function markettrendings($pair_id)
	{
		$joins = array('coin_order as b'=>'a.sellorderId = b.trade_id','coin_order as c'=>'a.buyorderId = c.trade_id');
		$where = array('a.pair'=>$pair_id);
		$transactionhistory = $this->common_model->getJoinedTableData('ordertemp as a',$joins,$where,'a.*,
			 date_format(b.datetime,"%d-%m-%Y %H:%i %p") as sellertime,b.trade_id as seller_trade_id,date_format(c.datetime,"%d-%m-%Y %H:%i %p") as buyertime,c.trade_id as buyer_trade_id,a.askPrice as sellaskPrice,c.Price as buyaskPrice,b.Fee as sellerfee,c.Fee as buyerfee,b.Total as sellertotal,c.Total as buyertotal','',$where_or,'','','',array('a.tempId','desc'))->result();
		if ($transactionhistory)
		{
			$historys=$transactionhistory;
		}
		else
		{
			$historys=0;
		}
		return $historys;
	}
	public function liquiditydata($pair_id)
	{
		$liquidity = $this->common_model->getTableData('site_settings',array('id'=>1),'liquidity_concept')->row('liquidity_concept');
		if($liquidity==1)
		{
			$joins 			= 	array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
			$where 			= 	array('a.id'=>$pair_id);
			$pair_details 	= 	$this->common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,a.to_symbol_id')->row();
			$pair_symbol	=	$pair_details->from_currency_symbol.'_'.$pair_details->to_currency_symbol;
			$datass=$this->api->get_order_book($pair_symbol);
			$data1=$datass;
			//print_r($data1);die;
			if(isset($data1->asks))
			{
				$asks=$data1->asks;
			}
			else if(isset($data1['asks']))
			{
				$asks=$data1['asks'];
			}
			else
			{
				$asks='';
			}
			if(isset($data1->bids))
			{
				$bids=$data1->bids;
			}
			else if(isset($data1['bids']))
			{
				$bids=$data1['bids'];
			}
			else
			{
				$bids='';
			}
			if($asks!='')
			{
				$ask_orders=array();
				foreach($asks as $ask)
				{
					$ask_orders["'".$ask[0]."'"]=$ask[1];
				}
			}
			else
			{
				$ask_orders=0;
			}
			if($bids!='')
			{
				$bids_orders=array();
				foreach($bids as $bid)
				{
					$bids_orders["'".$bid[0]."'"]=$bid[1];
				}
			}
			else
			{
				$bids_orders=0;
			}
			$orders=array();
			$orders['asks']=$ask_orders;
			$orders['bids']=$bids_orders;
		}
		else
		{
			$orders=0;
		}
		return $orders;
	}

	public function current_trade_pair($pair_id)
	{
		$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where = array('a.status'=>1);
		$orderprice = $this->common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol')->result();
		$pair=$this->common_model->getTableData('trade_pairs', array('id' => $pair_id))->row();
		$trade_prices=array();
		$volume=getTradeVolume($pair->id);
		if($volume->price!=0)
		{
			$trade_prices['price'] = to_decimal($volume->price,8);
		}
		else
		{
			$trade_prices['price'] = to_decimal($pair->buy_rate_value,8);
		}
		$trade_prices['volume'] = $volume->volume;
		$trade_prices['high'] = $volume->high;
		$trade_prices['low'] = $volume->low;
		return $trade_prices;
	}
	function get_active_order($user_id)
	{
		$user_id = $user_id;
		$selectFields='CO.*,date_format(CO.datetime,"%d-%m-%Y %H:%i %p") as trade_time,sum(OT.filledAmount) as totalamount';
		$names = array('active', 'partially', 'margin','stoporder');
		$where=array('CO.userId'=>$user_id);
		$orderBy=array('CO.trade_id','desc');
		$groupBy=array('CO.trade_id');
		$where_in=array('CO.status', $names);
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->common_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,$groupBy,$where_in);
		if($query->num_rows() >= 1)
		{
			$open_orders = $query->result();
		}
		else
		{
			$open_orders = 0;
		}
		if($open_orders&&$open_orders!=0)
		{
			$open_orders_text=$open_orders;
		}
		else
		{
			$open_orders_text=0;
		}
		return $open_orders_text;
	}
	function get_active_limitorder($user_id)
	{
		$user_id = $user_id;
		$selectFields='CO.*,date_format(CO.datetime,"%d-%m-%Y %H:%i %p") as trade_time,sum(OT.filledAmount) as totalamount';
		$names = array('active', 'partially', 'margin');
		$where=array('CO.userId'=>$user_id,'CO.ordertype'=>'limit');
		$orderBy=array('CO.trade_id','desc');
		$groupBy=array('CO.trade_id');
		$where_in=array('CO.status', $names);
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->common_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,$groupBy,$where_in);
		if($query->num_rows() >= 1)
		{
			$open_orders = $query->result();
		}
		else
		{
			$open_orders = 0;
		}
		if($open_orders&&$open_orders!=0)
		{
			$open_orders_text=$open_orders;
		}
		else
		{
			$open_orders_text=0;
		}
		return $open_orders_text;
	}
	function get_active_marketorder($user_id)
	{
		$user_id = $user_id;
		$selectFields='CO.*,date_format(CO.datetime,"%d-%m-%Y %H:%i %p") as trade_time,sum(OT.filledAmount) as totalamount';
		$names = array('active', 'partially', 'margin');
		$where=array('CO.userId'=>$user_id,'CO.ordertype'=>'instant');
		$orderBy=array('CO.trade_id','desc');
		$groupBy=array('CO.trade_id');
		$where_in=array('CO.status', $names);
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->common_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,$groupBy,$where_in);
		if($query->num_rows() >= 1)
		{
			$open_orders = $query->result();
		}
		else
		{
			$open_orders = 0;
		}
		if($open_orders&&$open_orders!=0)
		{
			$open_orders_text=$open_orders;
		}
		else
		{
			$open_orders_text=0;
		}
		return $open_orders_text;
	}
	function get_active_stoporder($user_id)
	{
		$user_id = $user_id;
		$selectFields='CO.*,date_format(CO.datetime,"%d-%m-%Y %H:%i %p") as trade_time,sum(OT.filledAmount) as totalamount';
		$names = array('active', 'partially', 'margin');
		$where=array('CO.userId'=>$user_id,'CO.ordertype'=>'stop');
		$orderBy=array('CO.trade_id','desc');
		$groupBy=array('CO.trade_id');
		$where_in=array('CO.status', $names);
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->common_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,$groupBy,$where_in);
		if($query->num_rows() >= 1)
		{
			$open_orders = $query->result();
		}
		else
		{
			$open_orders = 0;
		}
		if($open_orders&&$open_orders!=0)
		{
			$open_orders_text=$open_orders;
		}
		else
		{
			$open_orders_text=0;
		}
		return $open_orders_text;
	}
	function get_active_userorder($pair_id,$user_id)
	{
		$user_id = $user_id;
		$selectFields='CO.*,date_format(CO.datetime,"%d-%m-%Y %H:%i %p") as trade_time,sum(OT.filledAmount) as totalamount';
		$names = array('active', 'partially', 'margin');
		$where=array('CO.pair'=>$pair_id,'CO.userId'=>$user_id);
		$orderBy=array('CO.trade_id','desc');
		$groupBy=array('CO.trade_id');
		$where_in=array('CO.status', $names);
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->common_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,$groupBy,$where_in);
		if($query->num_rows() >= 1)
		{
			$open_orders = $query->result();
		}
		else
		{
			$open_orders = 0;
		}
		if($open_orders&&$open_orders!=0)
		{
			$open_orders_text=$open_orders;
		}
		else
		{
			$open_orders_text=0;
		}
		return $open_orders_text;
	}
	function get_cancel_order($pair_id,$user_id)
	{
		$user_id = $user_id;
		$selectFields='CO.*,OT.filledAmount as totalamount';
		$where=array('CO.pair'=>$pair_id,'CO.userId'=>$user_id,'CO.status'=>'cancelled');
		$orderBy=array('CO.trade_id','desc');
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->common_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy);
		if($query->num_rows() >= 1)
		{
			$cancel_orders = $query->result();
		}
		else
		{
			$cancel_orders = '';
		}
		if($cancel_orders&&$cancel_orders[0]->trade_id!='')
		{
			$cancel_orders_text=$cancel_orders;
		}
		else
		{
			$cancel_orders_text=0;
		}
		return $cancel_orders_text;
	}
	function get_stop_order($pair_id,$user_id)
	{
		$user_id = $user_id;
		$query = $this->common_model->customQuery('select trade_id, Type, Price, Amount, Fee, Total, status, date_format(datetime,"%d-%m-%Y %H:%i %a") as tradetime from blackcube_coin_order where userId = '.$user_id.' and status = "stoporder" and pair = '.$pair_id.'');
		if($query->num_rows() >= 1)
		{
			$stop_orders = $query->result();
		}
		else
		{
			$stop_orders='';
		}
		if($stop_orders)
		{
			$stoporder=$stop_orders;
		}
		else
		{
			$stoporder=0;
		}
		return $stoporder;
	}
	function close_active_order()
	{
		$tradeid = $this->input->post('tradeid');
		$pair_id = $this->input->post('pair_id');
		$user_id = $this->session->userdata('user_id');
		$response=$this->site_api->close_active_order($tradeid,$pair_id,$user_id);
		echo json_encode($response);
	}
    public function coinprice($coin_symbol)
    {
        $url = "https://min-api.cryptocompare.com/data/price?fsym=".$coin_symbol."&tsyms=USD";

		$curres = $coin_symbol;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		//$result = convercurr($coin_symbol,'USD');
		$res = json_decode($result);
		return $res->USD;
    }
    public function update_usd_price()
    {
        $currency_results=$this->common_model->update_usd_price();
        foreach($currency_results as $cvalue){
            $currency_symbol=$cvalue->currency_symbol;
            $equal_usd = $this->coinprice($currency_symbol);
            $currency_arr[$currency_symbol]=$equal_usd;
            
            $updateData = array(
                'online_usdprice' => $equal_usd,
            );
            $this->common_model->updateTableData('currency', array('id' => $cvalue->id), $updateData);
        }
        //print_r($currency_arr);
    }

    public function newget_chart_record($pairs)
	{

	    // EDITED BY MANIMEGS
	    $segment_array = $this->uri->segment_array();
	    $do_add = array_search("newget_chart_record", $segment_array);
	    $symbol_vals = str_replace("_", "", $this->uri->segment($do_add + 1));
	    $symbol_val = $this->uri->segment($do_add + 2);
	    if ($symbol_val != 'config' && $symbol_val != 'time') {
	        if (strpos($symbol_val, 'symbols') !== false) {
	            if ($symbol_val != '') {
	                //$fin_symbol     = $again_split[1];
	                $fin_symbol = strtoupper($symbol_vals);
	                $fin_symbol = str_replace('Blackcube%3A', '', $fin_symbol);
	                $symbol_details = $this->common_model->getTableData('coins_symbols', array('name' => $fin_symbol))->result_array();

	                $chart = '{"name":"' . $symbol_details[0]['name'] . '","exchange-traded":"Blackcube Exchange","exchange-listed":"Blackcube Exchange","timezone":"' . $symbol_details[0]['timezone'] . '","minmov":1,"minmov2":0,"pointvalue":1,"has_intraday":true,"has_no_volume":false,"description":"' . $symbol_details[0]['description'] . '","type":"' . $symbol_details[0]['type'] . '","supported_resolutions":["1","3", "5", "15", "30", "45", "60", "120", "180", "240", "D", "2D","W","3W","M","6M"],"pricescale":1000000,"ticker":"' . $symbol_details[0]['name'] . '","session":"0000-2400|0000-2400:17","intraday_multipliers": ["1","60"]}';
	                echo $chart;exit;
	                $this->newtradechart_check($pairs);
	            }
	        } else {
	            // if($this->input->get('resolution') == 'D')
	            //     $this->newtradechart_check($pairs."_d");
	            // else if($this->input->get('resolution') == '60')
	            //     $this->newtradechart_check($pairs."_1h");
	            // else if($this->input->get('resolution') == '120')
	            //     $this->newtradechart_check($pairs."_2h");
	            // else if($this->input->get('resolution') == '180')
	            //     $this->newtradechart_check($pairs."_3h");
	            // else if($this->input->get('resolution') == '240')
	            //     $this->newtradechart_check($pairs."_4h");
	            // else
	                $this->newtradechart_check($pairs);
	        }
	    } else {
	        if($symbol_val == 'config')
	        {
	            $this->newtradechart_check($symbol_val);
	        } else {
	            echo time();
	        }
	    }
	} 

    public function newget_chart_record_old($pairs)
    {
        // EDITED BY MANIMEGS
        $segment_array = $this->uri->segment_array();
        $do_add = array_search("newget_chart_record", $segment_array);
       //echo $this->uri->segment(2)." -  ".$this->uri->segment(3);
        $symbol_vals = str_replace("_", "", $this->uri->segment($do_add + 1));
        $symbol_val = $this->uri->segment($do_add + 2);
        
        if ($symbol_val != 'config') {
            if (strpos($symbol_val, 'symbols') !== false) {
                if ($symbol_val != '') {
                    //$fin_symbol     = $again_split[1];
                    $fin_symbol = strtoupper($symbol_vals);
                    $fin_symbol = str_replace('JABPaymentexchange%3A', '', $fin_symbol);
                    $symbol_details = $this->common_model->getTableData('coins_symbols', array('name' => $fin_symbol))->result_array();

                    $chart = '{"name":"' . $symbol_details[0]['name'] . '","exchange-traded":"JAB Payment exchange","exchange-listed":"JAB Payment exchange","timezone":"' . $symbol_details[0]['timezone'] . '","minmov2":0,"pointvalue":1,"has_intraday":true,"has_no_volume":false,"description":"' . $symbol_details[0]['description'] . '","type":"' . $symbol_details[0]['type'] . '","supported_resolutions":["1","3", "5", "60", "D", "2D","W","3W","M","6M"],"pricescale":1000000,"ticker":"' . $symbol_details[0]['name'] . '","session":"0000-2400|0000-2400:17","intraday_multipliers": ["1","60"]}';

                    echo $chart;exit;
                    $this->newtradechart_check($pairs);
                }
            } else {
                $this->newtradechart_check($pairs);
            }
        }
    }
    public function newtradechart_check($pair_val)
    {

        $pair_val_file     = strtolower($pair_val);
	    $json_pair         = $pair_val_file.'.json';
	    $str = file_get_contents(FCPATH."chart/".$json_pair);
	    echo $str; exit;
    }
    public function get_chart_record()
    {
        $order = $this->common_model->getTableData('trade_pairs', array('status' => 1))->result_array();
        foreach ($order as $order_value) {
            //echo $order_value['id'];
            $first_symbol_id = $this->common_model->getTableData('trade_pairs', array('id' => $order_value['id']), 'from_symbol_id')->row('from_symbol_id');
            $second_symbol_id = $this->common_model->getTableData('trade_pairs', array('id' => $order_value['id']), 'to_symbol_id')->row('to_symbol_id');
            $first_coin = $this->common_model->getTableData('currency', array('id' => $first_symbol_id), 'currency_symbol')->row('currency_symbol');
            $second_coin = $this->common_model->getTableData('currency', array('id' => $second_symbol_id), 'currency_symbol')->row('currency_symbol');
            $coin_pair = $first_coin . "_" . $second_coin;
            //echo "<br>".$order_value['id'].$coin_pair;
            $this->tradechart_check($order_value['id'], $coin_pair);
        }
    }

    public function tradechart_check_old($pair, $pair_val) 
    {
        $timestamp = strtotime('today midnight');
        $end_date = date("Y-m-d H:i:s", $timestamp);
        $start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 15 days'));
        
        $start = strtotime($start_date);

        $end = time();
        $enddate = date('Y-m-d H:i:s', $end);
        $interval = 1 / 2;
        $int = 1 * 60 * 60 * $interval;
		//echo $int; exit;
        $chart = "";
        $chart1 = "";
        $chart2 = "";
        $chart3 = "";
        $chart4 = "";
        $chart5 = "";
        $chartdata = "";
        $pair_value = explode('_', $pair_val);
        $first_pair = $pair_value[0];
        $second_pair = $pair_value[1];

        $taken = date('Y-m-d H:i:s', strtotime($taken . ' - 15 days'));
                
            $startTime = strtotime($taken) * 1000;

            $destination = date('Y-m-d H:i:s');

            $endTime = strtotime($destination) * 1000;

        $checkapi = checkapi($pair);
        if($checkapi == 0)
        {
            $timestamp = strtotime('today midnight');
            $end_date = date("Y-m-d H:i:s", $timestamp);
            $start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 15 days'));
            $start = strtotime($start_date);
            $end = time();
            $enddate = date('Y-m-d H:i:s', $end);
            $interval = 1 / 2;
            $int = 1 * 60 * 60 * $interval;
            $chart = "";
            $chart1 = "";
            $chart2 = "";
            $chart3 = "";
            $chart4 = "";
            $chart5 = "";
            $chartdata = "";
            $pair_value = explode('_', $pair_val);
            $first_pair = $pair_value[0];
            $second_pair = $pair_value[1];

            $names = array('filled');
            $where_in = array('status', $names);
            //$coinorder_data = $this->common_model->getTableData('coin_order', array('pair' => $pair), '', '', '', '', '', '', '', '', '', $where_in)->result();



            /* if(count($coinorder_data)>0)
            {*/

            $sec_pair = $second_pair;
                if ($sec_pair == "USD") {
                    $sec_pair = "USDC";
                }
                $pairss = $first_pair . $sec_pair;
                $datetimes = "";
                $opens = "";
                $closes = "";
                $highs = "";
                $lows = "";
                $volumes = "";

                $datetimes1 = "";
                $opens1 = "";
                $closes1 = "";
                $highs1 = "";
                $lows1 = "";
                $volumes1 = "";
                $newchart = "";
                $chart_data = array();
                for ($i = $start; $i <= $end; $i += $int) {
                    $taken = date('Y-m-d H:i:s', $i);
                    $exp = explode(' ', $taken);
                    $curdate = $exp[0];
                    $time = $exp[1];
                    $datetime = strtotime($taken);
                    $date_time = strtotime($taken);
                    $destination = date('Y-m-d H:i:s', strtotime($taken . ' +30 minutes'));

                    $api_chartResult = $this->common_model->getTableData('blackcube_coin_order', array('tradetime >= ' => $taken, 'tradetime <= ' => $destination, 'pair' => $pair), 'SUM(Amount) as volume,MIN(Price) as low,MAX(Price) as high,tradetime', '', '', '', '', '', '', '', '', $where_in)->row();
                    
                
                    $api_OpenchartResult = $this->common_model->getTableData('blackcube_coin_order', array('tradetime >= ' => $taken, 'tradetime <= ' => $destination, 'pair' => $pair), 'Price as open,tradetime', '', '', '', '', '', array('trade_id', 'ASC'), '', '', $where_in)->row();
                    
                    $api_ClosechartResult = $this->common_model->getTableData('blackcube_coin_order', array('tradetime >= ' => $taken, 'tradetime <= ' => $destination, 'pair' => $pair), 'Price as close,tradetime', '', '', '', '', '', array('trade_id', 'DESC'), '', '', $where_in)->row();
                    
                    if (isset($api_chartResult)) {
                        $time_t = date('Y-m-d H:i:s', strtotime($api_chartResult->tradetime . ' +5 minutes'));
                        /*echo "time ".strtotime($api_chartResult->tradetime);
                        echo "<br>";
                        echo "time1 ".strtotime($api_chartResult->tradetime) + 300;
                        echo "<br>";*/
                        $time = strtotime($api_chartResult->tradetime);

                        $volume = $api_chartResult->volume;
                        $low = $api_chartResult->low;
                        $high = $api_chartResult->high;
                        if ($time != '') {
                            $time = strtotime($taken) . ',';
                        }

                        if ($high != '') {
                            $high = $high . ',';
                        }

                        if ($low != '') {
                            $low = $low . ',';
                        }

                        if ($volume != '') {$volume = $volume . ',';}
                    $chart .= $time;
                    $chart3 .= $high;
                    $chart4 .= $low;
                    $chart5 .= $volume;
                }
                if (isset($api_OpenchartResult)) {
                    $Open = $api_OpenchartResult->open;
                    if ($Open != '') {$open = $Open . ',';}
                    $chart2 .= $open;
                }
                if (isset($api_ClosechartResult)) {
                    $Close = $api_ClosechartResult->close;
                    if ($Close != '') {$close = $Close . ',';}
                    $chart1 .= $close;
                }
                if($time !=false && $open !='0'&& $high !='0'&& $low !='0' && $close !='0' && $volume != '0') {
                    array_push($chart_data,array('time'=>doubleval($time),'open'=>doubleval($open),'high'=>doubleval($high),'low'=>doubleval($low),'close'=>doubleval($close),'vol'=>doubleval($volume)));
                }
            }
            $pair_val_file = strtolower($pair_val);
            $json_pair = $pair_val_file . '.json';
            $json_pair_mob = $pair_val_file . '_mob.json';
            $newchart = '{"t":[' . trim($chart, ',') . '],"o":[' . trim($chart2, ',') . '],"h":[' . trim($chart3, ',') . '],"l":[' . trim($chart4, ',') . '],"c":[' . trim($chart1, ',') . '],"v":[' . trim($chart5, ',') . '],"s":"ok"}';
            //echo $newchart;
            $fp = fopen(FCPATH . 'chart/' . $json_pair, 'w');
            fwrite($fp, $newchart);
            fclose($fp);

            $fp1 = fopen(FCPATH . 'chart/' . $json_pair_mob, 'w');
            fwrite($fp1, json_encode($chart_data));
            fclose($fp1);

            echo $json_pair . " -- Coin Order success <br>";
        } else {
            $names = array('filled');
            $where_in = array('status', $names);
            $coinorder_data = $this->common_model->getTableData('coin_order', array('pair' => $pair), '', '', '', '', '', '', '', '', '', $where_in)->result();
            if (count($coinorder_data) > 200) 
            {
                //echo $pair;
                $sec_pair = $second_pair;
                if ($sec_pair == "USD") {
                    $sec_pair = "USDC";
                }
                $pairss = $first_pair . $sec_pair;
                $datetimes = "";
                $opens = "";
                $closes = "";
                $highs = "";
                $lows = "";
                $volumes = "";
                $datetimes1 = "";
                $opens1 = "";
                $closes1 = "";
                $highs1 = "";
                $lows1 = "";
                $volumes1 = "";
                $newchart = "";
                // echo "Start".$start;
                // echo "<br/>";
                // echo "End".$end;
                for ($i = $start; $i <= $end; $i += $int) {
                    $taken = date('Y-m-d H:i:s', $i);
                    $exp = explode(' ', $taken);
                    $curdate = $exp[0];
                    $time = $exp[1];
                    $datetime = strtotime($taken);
                    $date_time = strtotime($taken);
                    $destination = date('Y-m-d H:i:s', strtotime($taken . ' +30 minutes'));
                    $groupBy=array('coin_order.trade_id');
                    // echo $taken;
                    // echo "<br/>";
                    // echo $destination;
                    // echo "<br/>";
                    // echo $pair;
                    // exit;
                    $api_chartResult = $this->common_model->getTableData('coin_order', array('datetime >= ' => $taken, 'datetime <= ' => $destination, 'pair' => $pair), 'SUM(Amount) as volume,MIN(Price) as low,MAX(Price) as high,datetime', '', '', '', '', '', '', $groupBy, '', $where_in)->row();
                    $api_OpenchartResult = $this->common_model->getTableData('coin_order', array('datetime >= ' => $taken, 'datetime <= ' => $destination, 'pair' => $pair), 'Price as open,datetime', '', '', '', '', '', array('trade_id', 'ASC'), $groupBy,'', $where_in)->row();
                    $api_ClosechartResult = $this->common_model->getTableData('coin_order', array('datetime >= ' => $taken, 'datetime <= ' => $destination, 'pair' => $pair), 'Price as close,datetime', '', '', '', '', '', array('trade_id', 'DESC'), $groupBy,'',$where_in)->row();
                    
                    // echo "<pre>";
                    // print_r($api_chartResult); exit;
                    if (isset($api_chartResult)) {
                        $time = strtotime($api_chartResult->datetime);
                        $volume = $api_chartResult->volume;
                        $low = $api_chartResult->low;
                        $high = $api_chartResult->high;
                        $volume1 = $api_chartResult->volume;
                        $low1 = $api_chartResult->low;
                        $high1 = $api_chartResult->high;
                        if ($time != '') {
                            $time = $time . ',';
                        }
                        if ($high != '') {
                            $high = $high . ',';
                        }
                        if ($low != '') {
                            $low = $low . ',';
                        }
                        if ($volume != '') {$volume = $volume . ',';}
                        $chart .= $time;
                        $chart3 .= $high;
                        $chart4 .= $low;
                        $chart5 .= $volume;
                    }
                    if (isset($api_OpenchartResult)) {
                        $Open = $api_OpenchartResult->open;
                        $open1 = $api_OpenchartResult->open;
                        if ($Open != '') {$open = $Open;}
                        $chart2 .= $open.',';
                    }
                    if (isset($api_ClosechartResult)) {
                        $Close = $api_ClosechartResult->close;
                        $close1 = $api_ClosechartResult->close;
                        if ($Close != '') {$close = $Close;}
                        $chart1 .= $close.',';
                    }
                    if ($date_time != '' && $open1 != '' && $high1 != '' && $close1 != '' && $low1 != '') {
                        $chartdata .= '[' . $date_time . '000' . ',' . $open1 . ',' . $high1 . ',' . $low1 . ',' . $close1 . '],';
                    }
                    $chart_new = $chartdata;
                }
                $pair_val_file = strtolower($pair_val);
                $json_pair = $pair_val_file . '.json';
                echo $json_pair."<br/>";
                $newchart = '{"t":[' . trim($chart, ',') . '],"o":[' . trim($chart2, ',') . '],"h":[' . trim($chart3, ',') . '],"l":[' . trim($chart4, ',') . '],"c":[' . trim($chart1, ',') . '],"v":[' . trim($chart5, ',') . '],"s":"ok"}';
                $fp = fopen(FCPATH . 'chart/' . $json_pair, 'w');
                fwrite($fp, $newchart);
                fclose($fp);
                echo $json_pair . " -- Coin Order success <br>";
                
            } 
            else 
            { //CALL API BINANCE
                $sec_pair = $second_pair;
                if ($sec_pair == "USD") {
                    $sec_pair = "USDC";
                }
                $pairss = $first_pair . $sec_pair;
                $datetime = "";
                $open = "";
                $close = "";
                $high = "";
                $low = "";
                $volume = "";
                $datetime1 = "";
                $open1 = "";
                $close1 = "";
                $high1 = "";
                $low1 = "";
                $volume1 = "";
                $url = "https://api.binance.com/api/v1/klines?symbol=" . $pairss . "&interval=1m";
            // echo $url;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                $res = json_decode($result, true);
                if ($res['code'] == '-1003') {
                    $pair_val_file = strtolower($pair_val);
                    $json_pair = $pair_val_file . '.json';
                    $json_pair . '-- IP banned from BInance <br>';
                } 
                else if ($res['code'] == '-1121') 
                {
                    $pairss = $sec_pair . $first_pair;
                    $url = "https://api.binance.com/api/v1/klines?symbol=" . $pairss . "&interval=1m";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($ch);
                    $res = json_decode($result, true);
                    if($res['code'] != '-1121')
                    {
                        foreach ($res as $row) {
                            $datetime .= substr($row['0'], 0, -3) . ',';
                            $datetime1 = $datetime;
                            $open .= $row['1'] . ',';
                            $open1 = $open;
                            $high .= $row['2'] . ',';
                            $high1 = $high;
                            $low .= $row['3'] . ',';
                            $low1 = $low;
                            $close .= $row['4'] . ',';
                            $close1 = $close;
                            $volume .= $row['5'] . ',';
                            $volume1 = $volume;
                        }
                        $pair_value = explode('_', $pair_val);
                        $first_pair = $first_pair;
                        $second_pair = $sec_pair;
                        $pairss_name = $first_pair . '_' . $second_pair;
                        $pair_val_file = strtolower($pairss_name);
                        $json_pair = $pair_val_file . '.json';
                        echo $json_pair."<br/>";
                        $newchart = '{"t":[' . trim($datetime1, ',') . '],"o":[' . trim($open1, ',') . '],"h":[' . trim($high1, ',') . '],"l":[' . trim($low1, ',') . '],"c":[' . trim($close1, ',') . '],"v":[' . trim($volume1, ',') . '],"s":"ok"}';
                        $fp = fopen(FCPATH . 'chart/' . $json_pair, 'w');
                        fwrite($fp, $newchart);
                        fclose($fp);
                        echo $pairss_name . " -- Binance success for reverse pair <br>";
                    }
                    else
                    {
                        $datetime = "";
                        $open = "";
                        $close = "";
                        $high = "";
                        $low = "";
                        $volume = "";
                        $datetime1 = "";
                        $open1 = "";
                        $close1 = "";
                        $high1 = "";
                        $low1 = "";
                        $volume1 = "";
                        $url = "https://api.binance.com/api/v1/klines?symbol=" . $pairss . "&interval=1m";
                        //echo $url;
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $result = curl_exec($ch);
                        $res = json_decode($result, true);
                            foreach ($res as $row) {
                                $datetime .= substr($row['0'], 0, -3) . ',';
                                $datetime1 = $datetime;
                                $open .= $row['1'] . ',';
                                $open1 = $open;
                                $high .= $row['2'] . ',';
                                $high1 = $high;
                                $low .= $row['3'] . ',';
                                $low1 = $low;
                                $close .= $row['4'] . ',';
                                $close1 = $close;
                                $volume .= $row['5'] . ',';
                                $volume1 = $volume;
                            }
                            $first_pair = $first_pair;
                            $second_pair = $sec_pair;
                            $pairss_name = $first_pair . '_' . $second_pair;
                            $pair_val_file = strtolower($pairss_name);
                            $json_pair = $pair_val_file . '.json';
                            echo $json_pair."<br/>";
                            $newchart = '{"t":[' . trim($datetime1, ',') . '],"o":[' . trim($open1, ',') . '],"h":[' . trim($high1, ',') . '],"l":[' . trim($low1, ',') . '],"c":[' . trim($close1, ',') . '],"v":[' . trim($volume1, ',') . '],"s":"ok"}';
                            $fp = fopen(FCPATH . 'chart/test.json', 'w');
                            //$fp = fopen(FCPATH . 'chart/'.$json_pair, 'w');
                            fwrite($fp, $newchart);
                            fclose($fp);
                            echo $pairss_name . " -- Dummyt success  <br>";
                            $this->common_model->customQuery("UPDATE blackcube_trade_pairs SET chart_load_status=1 WHERE id='".$pair."'");
                            
                    }
                } 
                else if ($res['code'] != '-1121') 
                {
                    $chart_data = array();
                    foreach ($res as $row) {
                        $datetime .= substr($row['0'], 0, -3) . ',';
                        $datetime1 = $datetime;
                        $open .= $row['1'] . ',';
                        $open1 = $open;
                        $high .= $row['2'] . ',';
                        $high1 = $high;
                        $low .= $row['3'] . ',';
                        $low1 = $low;
                        $close .= $row['4'] . ',';
                        $close1 = $close;
                        $volume .= $row['5'] . ',';
                        $volume1 = $volume;
                        array_push($chart_data,array('time'=>$row['0'],'open'=>floatval($row['1']),'high'=>floatval($row['2']),'low'=>floatval($row['3']),'close'=>floatval($row['4']),'vol'=>floatval($row['5'])));
                    }
                    $first_pair = $first_pair;
                    $second_pair = $sec_pair;
                    if ($second_pair == "USDC") {
                        $second_pair = "USD";
                    }
                    $pairss_name = $first_pair . '_' . $second_pair;
                    $pair_val_file = strtolower($pairss_name);
                    $json_pair = $pair_val_file . '.json';
                    $json_pair_mob = $pair_val_file . '_mob.json';
                    echo $json_pair."<br/>";
                    $newchart = '{"t":[' . trim($datetime1, ',') . '],"o":[' . trim($open1, ',') . '],"h":[' . trim($high1, ',') . '],"l":[' . trim($low1, ',') . '],"c":[' . trim($close1, ',') . '],"v":[' . trim($volume1, ',') . '],"s":"ok"}';
                    $fp = fopen(FCPATH . 'chart/' . $json_pair, 'w');
                    fwrite($fp, $newchart);
                    fclose($fp);

                    $fp1 = fopen(FCPATH . 'chart/' . $json_pair_mob, 'w');
                    fwrite($fp1, json_encode($chart_data));
                    fclose($fp1);

                    echo $pairss_name . " -- Binances success <br>";
                } 
                else 
                {
                    $datetime = "";
                    $open = "";
                    $close = "";
                    $high = "";
                    $low = "";
                    $volume = "";
                    $datetime1 = "";
                    $open1 = "";
                    $close1 = "";
                    $high1 = "";
                    $low1 = "";
                    $volume1 = "";
                    $url = "https://api.binance.com/api/v1/klines?symbol=" . $pairss . "&interval=1m";
                    //echo $url;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($ch);
                    $res = json_decode($result, true);
                    if ($res['code'] == '-1003') {
                        $pair_val_file = strtolower($pair_val);
                        $json_pair = $pair_val_file . '.json';
                        $pair_val_file . '-- IP banned from BInance <br>';
                    } 
                    else if ($res['code'] != '-1121') 
                    {
                        foreach ($res as $row) {
                            $datetime .= substr($row['0'], 0, -3) . ',';
                            $datetime1 = $datetime;
                            $open .= $row['1'] . ',';
                            $open1 = $open;
                            $high .= $row['2'] . ',';
                            $high1 = $high;
                            $low .= $row['3'] . ',';
                            $low1 = $low;
                            $close .= $row['4'] . ',';
                            $close1 = $close;
                            $volume .= $row['5'] . ',';
                            $volume1 = $volume;
                        }
                        $first_pair = $first_pair;
                        $second_pair = $sec_pair;
                        $pairss_name = $first_pair . '_' . $second_pair;
                        $pair_val_file = strtolower($pairss_name);
                        $json_pair = $pair_val_file . '.json';
                        echo $json_pair."<br/>";
                        $newchart = '{"t":[' . trim($datetime1, ',') . '],"o":[' . trim($open1, ',') . '],"h":[' . trim($high1, ',') . '],"l":[' . trim($low1, ',') . '],"c":[' . trim($close1, ',') . '],"v":[' . trim($volume1, ',') . '],"s":"ok"}';
                        $fp = fopen(FCPATH . 'chart/test.json', 'w');
                        //$fp = fopen(FCPATH . 'chart/'.$json_pair, 'w');
                        fwrite($fp, $newchart);
                        fclose($fp);
                        echo $pairss_name . " -- Dummy success  <br>";
                        $this->common_model->customQuery("UPDATE blackcube_trade_pairs SET chart_load_status=1 WHERE id='".$pair."'");
                    }
                }
            }
        }
        //}
    }


    public function tradechart_check($pair, $pair_val)
    {
        $timestamp = strtotime('today midnight');
        $end_date = date("Y-m-d H:i:s", $timestamp);
        $start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 15 days'));

        $pair_recs = getPair($pair_val);
        
        $start = strtotime($start_date);

        $end = time();
        $enddate = date('Y-m-d H:i:s', $end);
        $interval = 1 / 2;
        $int = 1 * 60 * 60 * $interval;
        $chart = "";
        $chart1 = "";
        $chart2 = "";
        $chart3 = "";
        $chart4 = "";
        $chart5 = "";
        $chartdata = "";
        $pair_value = explode('_', $pair_val);

        $first_pair = $pair_value[0];
        $second_pair = $pair_value[1];

        $taken = date('Y-m-d H:i:s', strtotime($taken . ' - 15 days'));
                
            $startTime = strtotime($taken) * 1000;

            $destination = date('Y-m-d H:i:s');

            $endTime = strtotime($destination) * 1000;

        $names = array('filled');
        $where_in = array('status', $names);
		$coinorder_data = $this->common_model->getTableData('coin_order', array('pair' => $pair), '', '', '', '', '', '', '', '', '', $where_in)->result(); 

		// echo $this->db->last_query();
		// echo $pair_recs->api_status.'---';
		// echo "<br>"; 
        if (count($coinorder_data) > 5 && $pair_recs->api_status==0)  
        // if (count($coinorder_data) > 5)  
        {
            $sec_pair = $second_pair;
            if ($sec_pair == "USD") {
                $sec_pair = "USDC";
            }
            $pairss = $first_pair . $sec_pair;
            $datetimes = "";
            $opens = "";
            $closes = "";
            $highs = "";
            $lows = "";
            $volumes = "";
            $datetimes1 = "";
            $opens1 = "";
            $closes1 = "";
            $highs1 = "";
            $lows1 = "";
            $volumes1 = "";
            $newchart = "";

            // print_r($pair_val);
            // echo "<br>"; 

            for ($i = $start; $i <= $end; $i += $int) {
                $taken = date('Y-m-d H:i:s', $i);
                $exp = explode(' ', $taken);
                $curdate = $exp[0];
                $time = $exp[1];
                $datetime = strtotime($taken);
                $date_time = strtotime($taken);
                // echo $taken.'<br>';
                $destination = date('Y-m-d H:i:s', strtotime($taken . ' +30 minutes'));
                $api_chartResult = $this->common_model->getTableData('coin_order', array('datetime >= ' => $taken, 'datetime <= ' => $destination, 'pair' => $pair), 'SUM(Amount) as volume,MIN(Price) as low,MAX(Price) as high,datetime', '', '', '', '', '', '', '', '', $where_in)->row();
                $api_OpenchartResult = $this->common_model->getTableData('coin_order', array('datetime >= ' => $taken, 'datetime <= ' => $destination, 'pair' => $pair), 'Price as open,datetime', '', '', '', '', '', array('trade_id', 'ASC'), '', '', $where_in)->row();
                $api_ClosechartResult = $this->common_model->getTableData('coin_order', array('datetime >= ' => $taken, 'datetime <= ' => $destination, 'pair' => $pair), 'Price as close,datetime', '', '', '', '', '', array('trade_id', 'DESC'), '', '', $where_in)->row();

                if (isset($api_chartResult)) {


                	// print_r($api_chartResult); 

                    $time = strtotime($api_chartResult->datetime);
                    $volume = $api_chartResult->volume;
                    $low = $api_chartResult->low;
                    $high = $api_chartResult->high;
                    $volume1 = $api_chartResult->volume;
                    $low1 = $api_chartResult->low;
                    $high1 = $api_chartResult->high;
                    if ($time != '') {
                        $time = $time . ',';
                    }
                    if ($high != '') {
                        $high = $high . ',';
                    }
                    if ($low != '') {
                        $low = $low . ',';
                    }
                    if ($volume != '') {$volume = $volume . ',';}
                    $chart .= $time;
                    $chart3 .= $high;
                    $chart4 .= $low;
                    $chart5 .= $volume;
                }
                if (isset($api_OpenchartResult)) {
                    $Open = $api_OpenchartResult->open;
                    $open1 = $api_OpenchartResult->open;
                    if ($Open != '') {$open = $Open;}
                    $chart2 .= $open.',';
                }
                if (isset($api_ClosechartResult)) {
                    $Close = $api_ClosechartResult->close;
                    $close1 = $api_ClosechartResult->close;
                    if ($Close != '') {$close = $Close;}
                    $chart1 .= $close.',';
                }
                if ($date_time != '' && $open1 != '' && $high1 != '' && $close1 != '' && $low1 != '') {
                    $chartdata .= '[' . $date_time . '000' . ',' . $open1 . ',' . $high1 . ',' . $low1 . ',' . $close1 . '],';
                }
                $chart_new = $chartdata;
            }
            $pair_val_file = strtolower($pair_val);
            $json_pair = $pair_val_file . '.json';
            $newchart = '{"t":[' . trim($chart, ',') . '],"o":[' . trim($chart2, ',') . '],"h":[' . trim($chart3, ',') . '],"l":[' . trim($chart4, ',') . '],"c":[' . trim($chart1, ',') . '],"v":[' . trim($chart5, ',') . '],"s":"ok"}';
            $fp = fopen(FCPATH . 'chart/' . $json_pair, 'w');
            fwrite($fp, $newchart);
            fclose($fp);

            // echo $newchart.'<br>';
			echo $json_pair . " -- Local Order success <br>";
			
        } 
       
        else 
        { //CALL API COINBASE
        	$this->binacechart_record($first_pair,$second_pair);
        	
  		}
	}

public function binacechart_record($first_pair,$sec_pair)
{
            
            $pairss = $first_pair . $sec_pair;
            $datetime = "";
            $open = "";
            $close = "";
            $high = "";
            $low = "";
            $volume = "";
            $datetime1 = "";
            $open1 = "";
            $close1 = "";
            $high1 = "";
            $low1 = "";
            $volume1 = "";
            $url = "https://api.binance.com/api/v1/klines?symbol=" . $pairss . "&interval=1m";
           // echo $url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $res = json_decode($result, true);
            if ($res['code'] == '-1003') {
                $pair_val_file = strtolower($pair_val);
                $json_pair = $pair_val_file . '.json';
                $json_pair . '-- IP banned from BInance <br>';
            } 
            
            // echo "<pre>";
            // print_r($res);
            // echo "<pre>";
            // exit();
            else if (isset($res['code']) && !empty($res['code']) && $res['code'] == '-1121') 
            {

            	$pairss = $sec_pair . $first_pair;
                $url = "https://api.binance.com/api/v1/klines?symbol=" . $pairss . "&interval=1m";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                $res = json_decode($result, true);
                if($res['code'] != '-1121')
                {
                  foreach ($res as $row) {
                     $Close = $row['4'];
                      $datetime .= substr($row['0'], 0, -3) . ',';
                      $datetime1 = $datetime;
                      $open .= $row['1'] . ',';
                      $open1 = $open;
                      $high .= $row['2'] . ',';
                      $high1 = $high;
                      $low .= $row['3'] . ',';
                      $low1 = $low;
                      $close .= $row['4'] . ',';
                      $close1 = $close;
                      $volume .= ($row['5'] *(0.03/100)) . ',';
                      $volume1 = $volume;
                  }
                  $pair_value = explode('_', $pair_val);
                  $first_pair = $first_pair;
                  $second_pair = $sec_pair;
                  $pairss_name = $first_pair . '_' . $second_pair;
                  $pair_val_file = strtolower($pairss_name);
                  $json_pair = $pair_val_file . '.json';
                  $newchart = '{"t":[' . trim($datetime1, ',') . '],"o":[' . trim($open1, ',') . '],"h":[' . trim($high1, ',') . '],"l":[' . trim($low1, ',') . '],"c":[' . trim($close1, ',') . '],"v":[' . trim($volume1, ',') . '],"s":"ok"}';
                  $fp = fopen(FCPATH . 'chart/' . $json_pair, 'w');
                  fwrite($fp, $newchart);
                  fclose($fp);
                  echo $pairss_name . " -- Binance success for reverse pair <br>";
              }

            }	

            if ($res['code'] != '-1121') 
            {
                foreach ($res as $row) {
                    $datetime .= substr($row['0'], 0, -3) . ',';
                    $datetime1 = $datetime;
                    $open .= $row['1'] . ',';
                    $open1 = $open;
                    $high .= $row['2'] . ',';
                    $high1 = $high;
                    $low .= $row['3'] . ',';
                    $low1 = $low;
                    $close .= $row['4'] . ',';
                    $close1 = $close;
                    $volume .= $row['5'] . ',';
                    $volume1 = $volume;
                }
                $first_pair = $first_pair;
                $second_pair = $sec_pair;
                if ($second_pair == "USDC") {
                    $second_pair = "USD";
                }
                $pairss_name = $first_pair . '_' . $second_pair;
                $pair_val_file = strtolower($pairss_name);
                $json_pair = $pair_val_file . '.json';
                echo $json_pair."<br/>";
                $newchart = '{"t":[' . trim($datetime1, ',') . '],"o":[' . trim($open1, ',') . '],"h":[' . trim($high1, ',') . '],"l":[' . trim($low1, ',') . '],"c":[' . trim($close1, ',') . '],"v":[' . trim($volume1, ',') . '],"s":"ok"}';

                // echo $newchart;
                $fp = fopen(FCPATH . 'chart/' . $json_pair, 'w');
                fwrite($fp, $newchart);
                fclose($fp);

                echo $pairss_name . " -- Binance success <br>";
            } 
            
}




    public function get_depthchart()
    {
        $order = $this->common_model->getTableData('trade_pairs', array('status' => 1))->result_array();
        foreach ($order as $order_value) {
            $first_symbol_id = $this->common_model->getTableData('trade_pairs', array('id' => $order_value['id']), 'from_symbol_id')->row('from_symbol_id');
            $second_symbol_id = $this->common_model->getTableData('trade_pairs', array('id' => $order_value['id']), 'to_symbol_id')->row('to_symbol_id');
            $first_coin = $this->common_model->getTableData('currency', array('id' => $first_symbol_id), 'currency_symbol')->row('currency_symbol');
            $second_coin = $this->common_model->getTableData('currency', array('id' => $second_symbol_id), 'currency_symbol')->row('currency_symbol');
            $coin_pair = $first_coin . "_" . $second_coin;
            $this->depthchart_check($order_value['id'], $coin_pair);
        }
    }
    public function depthchart_check($pair, $pair_val)
    {
        $timestamp = strtotime('today midnight');
        $end_date = date("Y-m-d H:i:s", $timestamp);
        $start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 0 days'));
        $start = strtotime($start_date);
        $end = time();
        $enddate = date('Y-m-d H:i:s', $end);
        $interval = 1 / 2;
        $int = 1 * 60 * 60 * $interval;
        $chart = "";
        $chart1 = "";
        $pair_value = explode('_', $pair_val);
        $first_pair = $pair_value[0];
        $second_pair = $pair_value[1];
        $names = array('active');
        $where_in = array('status', $names);
        $coinorder_data = $this->common_model->getTableData('coin_order', array('orderDate' => date('Y-m-d')), '', '', '', '', '', '', '', '', '', $where_in)->result();
        if (count($coinorder_data) > 20) {
            $sec_pair = $second_pair;
            if ($sec_pair == "USD") {
                $sec_pair = "USDC";
            }
            $pairss = $first_pair . $sec_pair;
            $price = "";
            $volume = "";
            $newchart = "";
            for ($i = $start; $i <= $end; $i += $int) {
                $taken = date('Y-m-d H:i:s', $i);
                $exp = explode(' ', $taken);
                $curdate = $exp[0];
                $time = $exp[1];
                $datetime = strtotime($taken);
                $date_time = strtotime($taken);
                $destination = date('Y-m-d H:i:s', strtotime($taken . ' +30 minutes'));
                $apibuy_chartResult = $this->common_model->getTableData('coin_order', array('datetime >= ' => $taken, 'datetime <= ' => $destination, 'pair' => $pair, 'Type' => 'buy'), 'SUM(Amount) as volume,Price as price', '', '', '', '', '', '', '', '', $where_in)->row();
                $apisell_chartResult = $this->common_model->getTableData('coin_order', array('datetime >= ' => $taken, 'datetime <= ' => $destination, 'pair' => $pair, 'Type' => 'sell'), 'SUM(Amount) as volume,Price as price', '', '', '', '', '', '', '', '', $where_in)->row();
                if (isset($apibuy_chartResult)) {
                    $volume_buy = $apibuy_chartResult->volume;
                    $price_buy = $apibuy_chartResult->price;
                    if ($volume_buy != "" && $price_buy != "") {
                        $askdet_buy .= '[' . $price_buy . ',' . $volume_buy . ']' . ',';
                    }
                    $ask_buy = $askdet_buy;
                }
                if (isset($apisell_chartResult)) {
                    $volume_sell = $apisell_chartResult->volume;
                    $price_sell = $apisell_chartResult->price;
                    if ($volume_sell != "" && $price_sell != "") {
                        $biddet_sell .= '[' . $price_sell . ',' . $volume_sell . ']' . ',';
                    }
                    $bid_sell = $biddet_sell;
                }
                /*$chart = '"[' . rtrim($bid_sell, ",") . ']",';
                $chart1 = '"[' . rtrim($ask_buy, ",") . ']"';*/
                 $chart = '"bids":['.rtrim($bid_sell,",").'],';
                 $chart1 = '"asks":['.rtrim($ask_buy,",").'],';
                

            }
            $pair_val_file = strtolower($pair_val);
            $json_pair = $pair_val_file . '.json';
            $curr_date = date("Y-m-d H:i:s");
            $timestamp = strtotime($curr_date);
            //$newchart = $chart . $chart1;
            $newchart = '{'.$chart.$chart1.'"isFrozen":"0","seq":'.$timestamp.'}';
            $fp = fopen(FCPATH . 'depthchart/' . $json_pair, 'w');
            fwrite($fp, $newchart);
            fclose($fp);
            echo $json_pair . " -- COIN ORDER SUCCESS<br>";
        }else{
            // API BINANCE
            $sec_pair = $second_pair;
            if ($second_pair == "USD") {
                $second_pair = "USDC";
            }
            $pairss = $first_pair . $second_pair;
            $price = "";
            $volume = "";
            $newchart = "";
            $url = 'https://api.binance.com/api/v1/depth?symbol=' . $pairss . '&limit=20';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $newresult = json_decode($result, true);
            if ($newresult['bids'] != '') // NORMAL PAIRS
            {
                $bids = $newresult['bids'];
                $asks = $newresult['asks'];
                foreach ($bids as $k) {
                    $price = $k[0];
                    $volume = $k[1];
                    $biddet .= '[' . $price . ',' . $volume . ']' . ',';
                    $bid = '"[' . rtrim($biddet, ",") . ']",';
                }
                foreach ($asks as $k1) {
                    $price1 = $k1[0];
                    $volume1 = $k1[1];
                    $askdet1 .= '[' . $price1 . ',' . $volume1 . ']' . ',';
                    $ask = '"[' . rtrim($askdet1, ",") . ']"';
                }
                $pair_val_file = strtolower($pair_val);
                $json_pair = $pair_val_file . '.json';
                $curr_date = date("Y-m-d H:i:s");
                $timestamp = strtotime($curr_date);
                //$newchart = $bid . $ask;
                $bid = '"bids":['.rtrim($biddet,",").'],';
                 $ask = '"asks":['.rtrim($askdet1,",").'],';
                $newchart = '{'.$bid.$ask.'"isFrozen":"0","seq":'.$timestamp.'}';
                $fp = fopen(FCPATH . 'depthchart/' . $json_pair, 'w');
                fwrite($fp, $newchart);
                fclose($fp);
                echo $json_pair . " -- NORMAL PAIR SUCCESS<br>";
            }
            else if ($newresult['code'] == '-1003') {
                $pair_val_file = strtolower($pair_val);
                $json_pair = $pair_val_file . '.json';
                echo $json_pair . '-- IP banned from Binance <br>'; 
                $curr_date = date("Y-m-d H:i:s");
                $timestamp = strtotime($curr_date);
                for ($mm = 1; $mm <= 15; $mm++) {
                    $dummy_array = '"[[3,1.934500000],[3.4,1.334500000],[1.6,1.834500000],[4.1,1.234500000],[2.3,1.534500000]]","[[1,1.00000000],[1.5,1.03200000],[2,1.230000000],[2.5,1.76000000],[2.7,1.03255000]]"';
                    $newchart = $dummy_array;
                }
                $pair_val_file = strtolower($pair_val);
                $json_pair = $pair_val_file . '.json';
                $fp = fopen(FCPATH . '/depthchart/' . $json_pair, 'w');
                fwrite($fp, $newchart);
                fclose($fp);
                echo $json_pair . " -- success<br>";
            } else if ($newresult['code'] == '-1121') // ONLY FOR REVERSE PAIRS
            {
                $coin_pair = $second_pair . $first_pair;
                $url = 'https://api.binance.com/api/v1/depth?symbol=' . $coin_pair . '&limit=20';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                $newresult = json_decode($result, true);
                if($newresult['bids'] !="")
                {
                $asks = $newresult['bids'];
                $bids = $newresult['asks'];
                foreach ($bids as $k) {
                    $price = $k[0];
                    $volume = $k[1];
                    $biddet .= '[' . $price . ',' . $volume . ']' . ',';
                    $bid = '"[' . rtrim($biddet, ",") . ']",';
                }
                foreach ($asks as $k1) {
                    $price1 = $k1[0];
                    $volume1 = $k1[1];
                    $askdet1 .= '[' . $price1 . ',' . $volume1 . ']' . ',';
                    $ask = '"[' . rtrim($askdet1, ",") . ']"';
                }
               }
               else 
               {
               	$url = 'https://api.binance.com/api/v1/depth?symbol=ETHBTC&limit=20';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                $newresult = json_decode($result, true);
                $asks = $newresult['bids'];
                $bids = $newresult['asks'];
                foreach ($bids as $k) {
                    $price = $k[0];
                    $volume = $k[1];
                    $biddet .= '[' . $price . ',' . $volume . ']' . ',';
                     $bid = '"[' . rtrim($biddet, ",") . ']",';
                }
                 
                foreach ($asks as $k1) {
                    $price1 = $k1[0];
                    $volume1 = $k1[1];
                    $askdet1 .= '[' . $price1 . ',' . $volume1 . ']' . ',';
                    $ask = '"[' . rtrim($askdet1, ",") . ']"';
                }
                  
               }
                $pair_val_file = strtolower($pair_val);
                $json_pair = $pair_val_file . '.json';
                $curr_date = date("Y-m-d H:i:s");
                $timestamp = strtotime($curr_date);
                 $bid = '"bids":['.rtrim($biddet,",").'],';
                 $ask = '"asks":['.rtrim($askdet1,",").'],';
                $newchart = '{'.$bid.$ask.'"isFrozen":"0","seq":'.$timestamp.'}';
               // $newchart = $bid . $ask;
                $fp = fopen(FCPATH . 'depthchart/' . $json_pair, 'w');
                fwrite($fp, $newchart);
                fclose($fp);
                echo $json_pair . " -- REVERSE PAIR SUCCESS<br>";
            } else {
               
                $curr_date = date("Y-m-d H:i:s");
                $timestamp = strtotime($curr_date);
                for ($mm = 1; $mm <= 15; $mm++) {
                    $dummy_array = '"[[3,1.934500000],[3.4,1.334500000],[1.6,1.834500000],[4.1,1.234500000],[2.3,1.534500000]]","[[1,1.00000000],[1.5,1.03200000],[2,1.230000000],[2.5,1.76000000],[2.7,1.03255000]]"';
                    $newchart = $dummy_array;
                }
                $pair_val_file = strtolower($pair_val);
                $json_pair = $pair_val_file . '.json';
                $fp = fopen(FCPATH . '/depthchart/' . $json_pair, 'w');
                fwrite($fp, $newchart);
                fclose($fp);
                echo $json_pair . " -- dummy pair success<br>";
            }
        }
    }


    public function add_newtoken_adminwallet()
	{
		$currency_details = $this->common_model->getTableData('currency',array('status' => 1,'type'=>'digital','coin_type'=>'token'))->result();
    	if(count($currency_details)>0)
    	{
    		foreach($currency_details as $row)
    		{

    			echo "Admin Add Tokens" ;

				
			}
		}
	} 

	function update_adminaddress()
    {
    	$ids = array('3');
    	$where_not = array('id', $ids);
    	$Fetch_coin_list = $this->common_model->getTableData('currency',array('type'=>'digital','status'=>'1'),'','','','','','','','',$where_not)->result();

        // $Fetch_coin_list = $this->common_model->getTableData('currency',array('type'=>'digital','status'=>'1'))->result();
        $whers_con = "id='1'";
        // $get_admin  =   $this->common_model->getrow("blackcube_admin", $whers_con);
        // echo "<pre>"; print_r($Fetch_coin_list); exit();
        $admin_id = "1";
        $enc_email = getAdminDetails($admin_id, 'email_id');
		$email = decryptIt($enc_email); 		
        $get_admin = $this->common_model->getTableData('admin_wallet',array('id'=>'1'))->row();

        if(!empty($get_admin)) 
        {
            $get_admin_det = json_decode($get_admin->addresses, true);
            /*echo "<pre>";
            print_r($get_admin_det);
            exit();*/
			foreach($Fetch_coin_list as $coin_address)
			{			
				//$currency_exit =  array_key_exists($coin_address->currency_symbol, $get_admin_det)?true:false;
				if(array_key_exists($coin_address->currency_symbol, $get_admin_det))
				{
					//$currency_address_checker = (!empty($get_admin_det[$coin_address->currency_symbol]))?true:false;
					// echo "<pre>";
		   //          print_r($get_admin_det[$coin_address->currency_symbol]);
		            // exit();

		    		if(empty($get_admin_det[$coin_address->currency_symbol]))
		    		{
						$parameter = '';
						switch ($coin_address->coin_type) {
							case 'coin':
								switch ($coin_address->currency_symbol) {
									case 'ETH':
										$data = ethers('createaddress',$coin_address->currency_symbol);
										$address = strtolower($data['address']);
						        		$mnemonic = encryption($data['mnemonic']);
						        		$privatekey = encryption($data['privatekey']);

						        		$get_admin_det[$coin_address->currency_symbol] = $address;

						        		// Update BNB Address
						        		$get_admin_det['BNB'] = $address;
										$update['addresses'] = json_encode($get_admin_det);
										$update['mnemonic'] = $mnemonic;
										$update['privatekey'] = $privatekey;

										$updateAddress = $this->common_model->updateTableData("admin_wallet",array('user_id'=>$admin_id),$update);
										break;

									case 'TRX':
	                                    $parameter='create_tron_account';
	                                    $Get_First_address = $this->local_model->access_wallet($coin_address->id,'create_tron_account',$trx_id);
	                                    $tron_private_key = $Get_First_address['privateKey'];
	                                    $tron_public_key = $Get_First_address['publicKey'];
	                                    $tron_address = $Get_First_address['address']['base58'];
	                                    $tron_hex = $Get_First_address['address']['hex'];

	                                    $get_admin_det[$coin_address->currency_symbol] = $tron_address;

	                                    $update['addresses'] = json_encode($get_admin_det);
	                                    $update['TRX_hexaddress'] = $tron_hex;
	                                    $update['TRX_skey'] = $tron_private_key;
	                                    $update['TRX_pkey'] = $tron_public_key;
	                                    $this->common_model->updateTableData("admin_wallet",array('user_id' => $admin_id),$update);
	                                    break;	
									
									default:
										$parameter='getaccountaddress';
									// echo $coin_address->currency_symbol."--".$email;die;	
										$Get_First_address = $this->local_model->access_wallet($coin_address->id,'getaccountaddress', $email);

										if(!empty($Get_First_address) || $Get_First_address!=0)
										{
											$get_admin_det[$coin_address->currency_symbol] = $Get_First_address;
											$update['addresses'] = json_encode($get_admin_det);
											
				        					$this->common_model->updateTableData("admin_wallet",array('user_id'=>$admin_id),$update);
										}
										else{
											if($Get_First_address)
											{
												$Get_First_address = $this->common_model->update_address_again($admin_id, $coin_address->id,$parameter);
												$get_admin_det[$coin_address->currency_symbol] = $Get_First_address;
												$update['addresses'] = json_encode($get_admin_det);
				        						$this->common_model->updateTableData("admin_wallet",array('user_id'=>$admin_id),$update);
											}
										}
										break;
								}
								break;
							case 'token':
								$get_admin_det[$coin_address->currency_symbol] = $get_admin_det['ETH'];
								$update['addresses'] = json_encode($get_admin_det);
								$this->common_model->updateTableData("admin_wallet",array('user_id'=>$admin_id),$update);
								break;
							default:
								break;
						}	               
					}
				}
			}
		}
    }

    public function admin_wallet_balance()
    {
    	$Fetch_coin_list = $this->common_model->getTableData('currency',array('type'=>'digital','status'=>'1'))->result();

        $whers_con = "id='1'";

        $admin_id = "1";

        $enc_email = getAdminDetails($admin_id, 'email_id');

        $email = decryptIt($enc_email);         

        $get_admin = $this->common_model->getrow("admin_wallet", $whers_con);


        if(!empty($get_admin)) 
        {
            $get_admin_det = json_decode($get_admin->wallet_balance, true);
            $get_admin_dets = json_decode($get_admin->addresses, true);
           

            foreach($Fetch_coin_list as $coin_address)
            {           
                
                $admin_address   =   $get_admin_dets[$coin_address->currency_symbol];
                
                if(array_key_exists($coin_address->currency_symbol, $get_admin_det))
                {   
                	



                	$Crypto_type = getcoindetail($coin_address->currency_symbol)->crypto_type;
                	if($Crypto_type=='tron')
                 	{
                		$private_key = getadmintronPrivate(1);
                		$wallet_balance = $this->local_model->wallet_balance($coin_address->currency_name, $admin_address,$private_key);
					}
                	else if($coin_address->coinbase_status==1)
                	{
                		$coinbasedatas = coinbase('getAccount',$coin_address->currency_symbol);  
                		$wallet_balance = $coinbasedatas['balance'];

                	}

                	else if($coin_address->coin_type=='token')
                	{

                		$crypto_type_other = array('crypto'=>$coin_address->crypto_type);
                		 // echo " CURRENCY => ".$coin_address->currency_name." --- Addr ".$admin_address;echo '<br/>';
                		 // echo "Type -- ".$coin_address->crypto_type;echo '<br/>';

                		$wallet_balance = $this->local_model->wallet_balance($coin_address->currency_name, $admin_address,$crypto_type_other);
                	}

                	else
                    { 
                		$wallet_balance = $this->local_model->wallet_balance($coin_address->currency_name, $admin_address);
                		
                	}  

                    // echo $coin_address->currency_name.'=>'.$wallet_balance;
                    // echo "<br>"; 

                    
                    $old_balance = $get_admin_det[$coin_address->currency_symbol];
                    if($old_balance != $wallet_balance )
                    {
                        $get_admin_det[$coin_address->currency_symbol] = number_format($wallet_balance,8,'.', '');
                        //print_r($get_admin_det);
                        $update['wallet_balance'] = json_encode($get_admin_det);

                      // print_r($update);

                        

                      $update_qry = $this->common_model->updateTableData("admin_wallet",array('user_id' => $admin_id),$update); 
                    }
                    
                }
            }
            if($update_qry)
            {
                echo "updated success";
            }
            else
            {
                echo "updated failed";
            }
        }
    }
    function cancel_order($tradeid,$pair_id,$userid)
	{
		$tradeid = $tradeid;
		$pair_id = $pair_id;
		$user_id = $userid;
		$response = array('status'=>'','msg'=>'');
		$response=$this->site_api->close_active_order($tradeid,$pair_id,$user_id);
		$result=json_encode($response);
		return  $result;
	}
	function make_chart_points($obj_response){
		if(count($obj_response) > 0){
			foreach ($obj_response as $cpkey => $cpvalue) {
				$t_arr[]=strtotime($cpvalue->startsAt);
				$o_arr[]=$cpvalue->open;
				$h_arr[]=$cpvalue->high;
				$l_arr[]=$cpvalue->low;
				$c_arr[]=$cpvalue->close;
				$v_arr[]=$cpvalue->volume;
			}
			$res_arr=array(
				't'=>$t_arr,
				'o'=>$o_arr,
				'h'=>$h_arr,
				'l'=>$l_arr,
				'c'=>$c_arr,
				'v'=>$v_arr,
				's'=>"ok",
			);
			return json_encode($res_arr);
		}
	}
    function make_depth_chart_points($obj_response){
        if($obj_response->success){
            $buy_orders=$obj_response->result->buy;
            $sell_orders=$obj_response->result->sell;
            foreach ($buy_orders as $bkey => $bvalue) {
                $buy_arr[]=array($bvalue->Quantity,$bvalue->Rate);
            }
            foreach ($sell_orders as $skey => $svalue) {
                $sell_arr[]=array($svalue->Quantity,$svalue->Rate);
            }
            $res_arr=array(
                'asks'=>$buy_arr,
                'bids'=>$sell_arr,
                'isFrozen'=>0,
                'seq'=>strtotime('now'),
            );
            return json_encode($res_arr);
        }
    }
    public function newdepthchart($pair_val)
    { 
        $pair_val_file = strtolower($pair_val);
        $json_pair = $pair_val_file . '.json';
        $path = base_url();
        $str = file_get_contents(FCPATH . 'depthchart/' . $json_pair);
        echo $str;exit;
    }

    function localpair_details()
    {
      error_reporting(0);
      $pair_details = $this->common_model->getTableData('trade_pairs',array('status' => 1))->result();
      // echo "<pre>";print_r($pair_details);die;
      if(count($pair_details)>0)
      {
        foreach($pair_details as $pair_detail)
        { 
          if($pair_detail->api_status==1){
          $from_currency = $this->common_model->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
        $to_currency = $this->common_model->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();

        if($from_currency->currency_symbol=="BTC")
          $from_currency_symbol1 = "BTC";
        elseif($from_currency->currency_symbol=='USD')
          $from_currency_symbol1 ='USDC';
        else
          $from_currency_symbol1 = $from_currency->currency_symbol;
        
        if($to_currency->currency_symbol=="LTC")
          $to_currency_symbol1 = "LTC";
        elseif($to_currency->currency_symbol=='USD')
          $to_currency_symbol1 ='USDC';
        else
          $to_currency_symbol1 = $to_currency->currency_symbol;

      if($to_currency->currency_symbol=="LTC")
          $to_currency_symbol1 = "LTC";
        elseif($to_currency->currency_symbol=='USD')
          $to_currency_symbol1 ='USDC';
        else
          $to_currency_symbol1 = $to_currency->currency_symbol;

        

        $pair_symbol = $from_currency_symbol1.$to_currency_symbol1;
        $url = file_get_contents("https://api.binance.com/api/v1/ticker/24hr?symbol=".$pair_symbol);
        $res = json_decode($url,true); 
        // echo "<pre>";print_r($res);

          if ($res['symbol'] == '' || $res['code']=='-1121') 
          {

            $pair_symbols = $to_currency_symbol1.$from_currency_symbol1;
            $urls = file_get_contents("https://api.binance.com/api/v1/ticker/24hr?symbol=".$pair_symbols);
            $ress = json_decode($urls,true);
            if ($ress['symbol'] != '') 
              {
                $priceChangePercent = $ress['priceChangePercent'];
                $lastPrice =  $ress['lastPrice'];
                $volume =  $ress['volume'];
                $change_highs = $ress['highPrice'];
                $change_lows = $ress['lowPrice'];
                $updateTableData = array('priceChangePercent'=>$priceChangePercent,
                  'lastPrice'=>$lastPrice,
                  'volume'=>$volume,
                  'change_high'=>$change_highs,
                  'change_low'=>$change_lows,
                  'buy_rate_value'=>$lastPrice,
                  'sell_rate_value'=>$lastPrice
                );
              $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
              echo $pair_symbol." reverse Updated <br/>";
              }
              else
              {
                $dbrsymbol = $to_currency_symbol1."/".$from_currency_symbol1;
                $dbsymbol = $from_currency_symbol1."/".$to_currency_symbol1;

                $dbrsymbol1 = $to_currency_symbol1."_".$from_currency_symbol1;
                $dbsymbol1 = $from_currency_symbol1."_".$to_currency_symbol1;

                $dbrQuery = $this->db->query("SELECT * FROM `blackcube_coin_order` WHERE `pair_symbol`='".$dbrsymbol1."' AND status='filled' ORDER BY `trade_id` DESC LIMIT 1")->row();
                $dbQuery = $this->db->query("SELECT * FROM `blackcube_coin_order` WHERE `pair_symbol`='".$dbsymbol1."' AND status='filled' ORDER BY `trade_id` DESC LIMIT 1")->row();
				// print_r($dbrQuery);die;
                if($dbrQuery && count($dbrQuery)>0)
                { 
                  $priceChangePercent = pricechangepercent($pair_detail->id);
                  $url = "https://api.binance.com/api/v1/ticker/24hr?symbol=".str_replace('/', '', $dbrsymbol);
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              $result = curl_exec($ch);
              $ress = json_decode($result,true);
                      $priceChangePercent_new = $ress['priceChangePercent'];

                  $priceChangePercent = ($priceChangePercent=='')?$priceChangePercent_new:$priceChangePercent;

                  $lastPrice =  $dbrQuery->Price;
                  $volume = volume($pair_detail->id);
                  $change_highs = change_high($pair_detail->id);
                $change_lows = change_low($pair_detail->id);
                  $updateTableData = array('priceChangePercent'=>$priceChangePercent,
                    'lastPrice'=>$lastPrice,
                    'volume'=>$volume,
                  'change_high'=>$change_highs,
                  'change_low'=>$change_lows,
                  'buy_rate_value'=>$lastPrice,
                  'sell_rate_value'=>$lastPrice
              );
                $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
                echo $pair_symbol." DB REV Updated <br/>";
                }
                elseif($dbrQuery && count($dbQuery)>0)
                {
                  
                  $priceChangePercent = pricechangepercent($pair_detail->id);
                  $url = "https://api.binance.com/api/v1/ticker/24hr?symbol=".str_replace('/', '', $dbsymbol);
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              $result = curl_exec($ch);
              $ress = json_decode($result,true);
                      $priceChangePercent_new = $ress['priceChangePercent'];

                  $priceChangePercent = ($priceChangePercent=='')?$priceChangePercent_new:$priceChangePercent;
                  $lastPrice =  $dbQuery->Price;
                  $volume =  volume($pair_detail->id);

                  $change_highs = change_high($pair_detail->id);
                $change_lows = change_low($pair_detail->id);

                  $updateTableData = array('priceChangePercent'=>$priceChangePercent,
                    'lastPrice'=>$lastPrice,
                    'volume'=>$volume,
                  'change_high'=>$change_highs,
                  'change_low'=>$change_lows,
                  'buy_rate_value'=>$lastPrice,
                  'sell_rate_value'=>$lastPrice
              	);
                $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
                echo $pair_symbol." DB Updated <br/>";
                }
                else
                {
                  $url = "https://api.binance.com/api/v1/ticker/24hr?symbol=ETHBTC";
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              $result = curl_exec($ch);
              $ress = json_decode($result,true);
                      $priceChangePercent = $ress['priceChangePercent'];
                  $lastPrice =  $ress['lastPrice'];
                  $volume =  $ress['volume'];
                  $change_highs = $ress['highPrice'];
                $change_lows = $ress['lowPrice'];
                  $updateTableData = array('priceChangePercent'=>$priceChangePercent,
                    'lastPrice'=>$lastPrice,
                    'volume'=>$volume,
                  'change_high'=>$change_highs,
                  'change_low'=>$change_lows,
                  'buy_rate_value'=>$lastPrice,
                  'sell_rate_value'=>$lastPrice
                );
                $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
                  echo $pair_symbol." DUMMY <br/>";
                }
                //echo $pair_symbol." Not Updated <br/>";
              }
          }
          else
          {
            $priceChangePercent = $res['priceChangePercent'];
              $lastPrice =  $res['lastPrice'];
              $volume =  $res['volume'];
              $change_highs = $res['highPrice'];
                $change_lows = $res['lowPrice'];
              $updateTableData = array('priceChangePercent'=>$priceChangePercent,
                  'lastPrice'=>$lastPrice,
                  'volume'=>$volume,
                'change_high'=>$change_highs,
                  'change_low'=>$change_lows,
                  'buy_rate_value'=>$lastPrice,
                  'sell_rate_value'=>$lastPrice
                );
            $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
            echo $pair_symbol." Updated <br/>";
          }
        }
        else{
          //database
          $from_currency = $this->common_model->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
        $to_currency = $this->common_model->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();

        $pair_symbol = $from_currency->currency_symbol.'/'.$to_currency->currency_symbol;
        $pair_symbol1 = $from_currency->currency_symbol.'_'.$to_currency->currency_symbol;
      	
        $coin_order = $this->db->query("SELECT * FROM `blackcube_coin_order` WHERE `pair_symbol`='".$pair_symbol1."' AND status='filled' ORDER BY `trade_id` DESC")->result();
          // echo $this->db->last_query() .'-----<br>';
          // echo "<pre>";print_r($coin_order);
          if(isset($coin_order) && !empty($coin_order)){
          $lastPrice = lastmarketprice($pair_detail->id);
          $volume = volume($pair_detail->id);
          $change_highs = change_high($pair_detail->id);
          $change_lows = change_low($pair_detail->id);
           
          /* $Price_change = $lastPrice - $change_lows;
              $Per = $change_lows/100 ;
              $priceChangePercent = $Price_change/$Per;*/

              $priceChangePercent = pricechangepercent($pair_detail->id);
              $priceChangePercent = ($priceChangePercent=='')?'0':$priceChangePercent;

              $updateTableData = array('priceChangePercent'=>$priceChangePercent,
                  'lastPrice'=>$lastPrice,
                  'volume'=>$volume,
                'change_high'=>$change_highs,
                  'change_low'=>$change_lows
                );

              $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
              echo $pair_symbol." Database<br/>";
          }
          else{

          	$updateTableData = array('priceChangePercent'=>0,
                  'lastPrice'=>0,
                  'volume'=>0,
                'change_high'=>0,
                  'change_low'=>0,
                  'buy_rate_value'=>0,
                  'sell_rate_value'=>0
                );

              $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
          	echo $pair_symbol." DB Empty<br/>";
          }
          
        
        }
      }
      }
    }

    function localpair_details_old()
    {
    	// $pair_id=2;
    	// $user_id=4;
    	// print_r($this->transactionhistory($pair_id,$user_id));exit();
      error_reporting(0);
      $pair_details = $this->common_model->getTableData('trade_pairs',array('status' => 1))->result();
      if(count($pair_details)>0)
      {
        foreach($pair_details as $pair_detail)
        { 

        $from_currency = $this->common_model->getTableData('currency',array('id' => $pair_detail->from_symbol_id))->row();
        $to_currency = $this->common_model->getTableData('currency',array('id' => $pair_detail->to_symbol_id))->row();
		  if($pair_detail->api_status==1){
	
         	 $binancepairsym = $from_currency->currency_symbol.$to_currency->currency_symbol;
        	 $url = file_get_contents("https://api.binance.com/api/v1/ticker/24hr?symbol=".$binancepairsym);
              $ress = json_decode($url,true); 

              // print_r($ress);

          if ($ress['symbol'] != '') 
          {
           
                $priceChangePercent = $ress['priceChangePercent'];
                $lastPrice =  $ress['lastPrice'];
                $volume =  ($ress['volume'] * (0.03/100));
                $change_highs = $ress['highPrice'];
                $change_lows = $ress['lowPrice'];
                $updateTableData = array('priceChangePercent'=>$priceChangePercent,
                  'lastPrice'=>$lastPrice,
                  'volume'=>$volume,
                  'change_high'=>$change_highs,
                  'change_low'=>$change_lows
                );
              $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
              echo $binancepairsym." Binance Updated <br/>";
         }    
        }
        else{
          //database
       	$pair_symbol = $from_currency->currency_symbol.'/'.$to_currency->currency_symbol;
        $coin_order = $this->db->query("SELECT * FROM `blackcube_coin_order` WHERE `pair_symbol`='".$pair_symbol."' AND status='filled' ORDER BY `trade_id` DESC")->result();
        	
        // echo " Symbol --> ".$pair_symbol;
        // echo "<br>";	  
          // echo "<br>";
          // print_r($coin_order);
          // echo "<br>";

          if(isset($coin_order) && !empty($coin_order)){
          $lastPrice = lastmarketprice($pair_detail->id);
          $volume = volume($pair_detail->id);
          $change_highs = change_high($pair_detail->id);
          $change_lows = change_low($pair_detail->id);
           
          /* $Price_change = $lastPrice - $change_lows;
              $Per = $change_lows/100 ;
              $priceChangePercent = $Price_change/$Per;*/

              $priceChangePercent = pricechangepercent($pair_detail->id);
              $priceChangePercent = ($priceChangePercent=='')?'0':$priceChangePercent;

              $updateTableData = array('priceChangePercent'=>$priceChangePercent,
                  'lastPrice'=>$lastPrice,
                  'volume'=>$volume,
                'change_high'=>$change_highs,
                  'change_low'=>$change_lows
                );

              $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
              echo $pair_symbol." Database<br/>";
          }
          else{

          	$updateTableData = array('priceChangePercent'=>0,
                  'lastPrice'=>0,
                  'volume'=>0,
                'change_high'=>0,
                  'change_low'=>0,
                  'buy_rate_value'=>0,
                  'sell_rate_value'=>0
                );

              $this->common_model->updateTableData('trade_pairs', array('id' => $pair_detail->id), $updateTableData);
          	echo $pair_symbol." DB Empty<br/>";
          }
          
        
        }
      }
      }
    }





    function getcurrency_localdetails()
    {
    	$currency_details = $this->common_model->getTableData('currency',array('status' => 1),"id, currency_name, currency_symbol")->result();
    	if(count($currency_details)>0)
    	{
    		foreach($currency_details as $row)
    		{
    			$currency_name = strtolower($row->currency_name);
    			$url = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=".$currency_name;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($ch);
				$res = json_decode($result,true); 
				$market_cap =  $res[0]['market_cap_change_percentage_24h'];
				$coin_symbol = $row->currency_symbol;
				/*$urls = "https://min-api.cryptocompare.com/data/price?fsym=".$coin_symbol."&tsyms=USD&api_key=86b5e03cde761b72e73d89e11b9bbb4c50c2bbe2576fb1904d1e2afeaab9323a";
				$chs = curl_init();
				curl_setopt($chs, CURLOPT_URL, $urls);
				curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1);
				$result1 = curl_exec($chs);
				$errorMessage = curl_error($chs);*/

				//$result1 = convercurr($coin_symbol,'USD');
				$result1 = $this->coinprice($coin_symbol);
				$res1 = json_decode($result1);
				$usd_cap = $res1->USD;
				$updateTableData = array(
					'market_cap_change_percentage_24h' =>$market_cap,
					'usd_cap' =>$usd_cap
				);
				$this->common_model->updateTableData('currency', array('id' => $row->id), $updateTableData);
    		}
    	}
    }
    public function contact_us()
    {
        if($this->block() == 1)
		{ 
		front_redirect('block_ip');
		}
        $this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');
        if (!empty($_POST)) 
        {
            if ($this->form_validation->run()) 
            {
                $name = validateTextBox($this->db->escape_str($this->input->post('name')));
                $email = validateEmail($this->db->escape_str($this->input->post('email')));
                $subject = validateTextBox($this->db->escape_str($this->input->post('subject')));
                $comments = validateTextBox($this->input->post('comments'));

                // $comments =  strip_tags(mysql_real_escape_string(trim($comments)));


              //  $phone = $this->db->escape_str($this->input->post('phone'));
                $status = 0;
                $contact_data = array(
                    'username' => $name,
                    'email' => $email,
                    'subject' => $subject,
                    'message' => $comments,
                    //'phone' => $phone,
                    'status' => $status,
                    'created_on' => date("Y-m-d h:i:s")
                );
                $id = $this->common_model->insertTableData('contact_us', $contact_data);
                $email_template = 'Contact_user';
                $email_template1 = 'Contact_admin';
				$username=$this->input->post('name');
				$message = strip_tags(trim($this->input->post('comments')));
				$link = base_url().'blackcube_admin/contact';

				// $enc_email = getAdminDetails('1','email_id');
                // $admin_admin = decryptIt($enc_email);
				
				$site_common      =   site_common();
				$admin_admin = site_common()['site_settings']->site_email;

				$special_vars = array(					
				'###USERNAME###' => $username,
				'###MESSAGE###' => $message
				);
				$special_vars1 = array(					
				'###USERNAME###' => $username,
				'###MESSAGE###' => $message,
				'###LINK###' => $link
				);
				// echo $admin_admin;
				$this->email_model->sendMail($email, '', '', $email_template, $special_vars);
				$this->email_model->sendMail($admin_admin, '', '', $email_template1, $special_vars1);
                

                if ($id) 
                {
                    $this->session->set_flashdata('success', $this->lang->line('Your message successfully sent to our team'));
                    front_redirect('contact_us', 'refresh');
                } 
                else 
                {
                    $this->session->set_flashdata('error', $this->lang->line('Error occur!! Please try again'));
                    front_redirect('contact_us', 'refresh');
                }
            } 
            else 
            {
                $this->session->set_flashdata('error', validation_errors());
                front_redirect('contact_us', 'refresh');
            }
        }
        $data['site_common'] = site_common();
        $data['action'] = front_url() . 'contact_us';
        $data['contact_content'] = $this->common_model->getTableData('static_content',array('english_page'=>'Contact'))->result();
        $data['site_details'] = $this->common_model->getTableData('site_settings', array('id' => '1'))->row();
        $data['meta_content'] = $this->common_model->getTableData('meta_content', array('link' => 'contact-us'))->row();
        $data['footer'] = $this->common_model->getTableData('static_content',array('slug'=>'footer'))->row();

        /*$data['heading'] = $meta->heading;
        $data['title'] = $meta->title;
        $data['meta_keywords'] = $meta->meta_keywords;
        $data['meta_description'] = $meta->meta_description;*/
        $data['js_link'] = 'contact_us';
        $this->load->view('front/common/contact_us', $data);
    }

    public function common_test_details(){


    	$coinpayments = coinpayments_api_call('get_tx_ids');
    	echo "<pre>";
    	print_r($coinpayments);
    	echo "<pre>";
	 
    	
    }
    public function market_trades($pair_id)
	{
		/*$tradehistory_via_api = $this->common_model->getTableData('site_settings',array('tradehistory_via_api'=>1))->row('tradehistory_via_api');
		if($tradehistory_via_api ==0){*/
		$selectFields='CO.*,date_format(CO.datetime,"%H:%i:%s") as trade_time,sum(OT.filledAmount) as totalamount,CO.Type as ordertype,CO.Price as price';
		$names = array('active', 'partially', 'margin');
		$where=array('CO.pair'=>$pair_id);
		$orderBy=array('CO.trade_id','desc');
		$groupBy=array('CO.trade_id');
		$where_in=array('CO.status', $names);
		$joins = array('ordertemp as OT'=>'CO.trade_id = OT.sellorderId OR CO.trade_id = OT.buyorderId');
		$query = $this->common_model->getleftJoinedTableData('coin_order as CO',$joins,$where,$selectFields,'','','','','',$orderBy,$groupBy,$where_in);
		if($query->num_rows() >= 1)
		{
			$result = $query->result();
		}
		else
		{
			$result = 0;
		}
		if($result&&$result!=0)
		{
			$orders=$result;
		}
		else
		{
			$orders=0;
		}
		return $orders;
	}

function market_api_trades($pair){
	$pair_value=explode('_',$pair);
  if(count($pair_value) > 0) 
  {
    $first_pair  = strtoupper($pair_value[0]);
    $second_pair1 = strtoupper($pair_value[1]);
    if($second_pair1=='USD'){
    	$second_pair = 'USDC';
    }
    else{
    	$second_pair = $second_pair1;
    }
    $coin_pair = $first_pair.$second_pair;
	$json  		= file_get_contents('http://api.binance.com/api/v1/depth?symbol='.$coin_pair.'&limit=20');
	$newresult = json_decode($json,true);
    if(count($newresult)>0 && !empty($newresult))
    {
    	$buy_orders = $newresult['bids'];
        $sell_orders = $newresult['asks'];
        $res_data = array();
        $i=1;
        foreach($sell_orders as $sell)
        {
        	$sellData['id'] = $i;
	        $sellData['price'] = $sell[0];
	        $sellData['quantity'] = $sell[1];
	        $sellData['ordertype'] = 'Sell';
	        $res_data[] = $sellData;
            $i++;
        }
        foreach($buy_orders as $buy)
        {
        	$buyData['id'] = $i;
	        $buyData['price'] = $buy[0];
	        $buyData['quantity'] = $buy[1];
	        $buyData['ordertype'] = 'Buy';
	        $res_data[] = $buyData;
            $i++;
        }
    }
    else
    {
    	$coin_pairrev = $second_pair.$first_pair;
    	$json_rev  		= file_get_contents('http://api.binance.com/api/v1/depth?symbol='.$coin_pairrev.'&limit=20');
	    $newresult_rev = json_decode($json_rev,true);
	    if(count($newresult_rev)>0 && !empty($newresult_rev))
        {
        	$buy_orders = $newresult_rev['bids'];
	        $sell_orders = $newresult_rev['asks'];
	        $res_data = array();
	        $i=1;
        foreach($sell_orders as $sell)
        {
        	$sellData['id'] = $i;
	        $sellData['price'] = $sell[0];
	        $sellData['quantity'] = $sell[1];
	        $sellData['ordertype'] = 'Sell';
	        $res_data[] = $sellData;
            $i++;
        }
        foreach($buy_orders as $buy)
        {
        	$buyData['id'] = $i;
	        $buyData['price'] = $buy[0];
	        $buyData['quantity'] = $buy[1];
	        $buyData['ordertype'] = 'Buy';
	        $res_data[] = $buyData;
            $i++;
        }
        } 
    }
    
	
    if($res_data&&$res_data!=0)
    {
    	//$res_data = shuffle_assoc($res_data);
    	$res_data = $res_data;
    }
    else
    {
         $res_data = 0;
    }
    
   return $res_data;
}
}

function news()
	{
		if($_POST)
		{
			$limit = $this->input->post('limit');
		}
		else
		{
			$limit = 30;
		}
		$this->session->set_userdata(array('limit'  => $limit));
		$data['news'] = $this->common_model->getTableData('news', array('status' => 1),'','','','','',$limit,array('id', 'DESC'))->result();
		
		$data['no_news'] = $this->common_model->getTableData('news', array('status' => 1))->num_rows();
		$data['js_link'] = '';
		$data['site_common'] = site_common();
		$data['action'] = front_url() . 'news';
		$meta = $this->common_model->getTableData('meta_content', array('link' => 'news'))->row();
		$data['heading'] = $meta->heading;
		$data['title'] = $meta->title;
		$data['meta_keywords'] = $meta->meta_keywords;
		$data['meta_description'] = $meta->meta_description;
		$this->load->view('front/common/news', $data);
	}

	function rss_feed()
	{ 
		$feeds = array(
            "https://cointelegraph.com/rss/tag/bitcoin"
        );
        
        //Read each feed's items
        $entries = array();
        foreach($feeds as $feed) {
            $xml = simplexml_load_file($feed);
            $entries = array_merge($entries, $xml->xpath("//item"));
        }
        
        //Sort feed entries by pubDate
        usort($entries, function ($feed1, $feed2) {
            return strtotime($feed2->pubDate) - strtotime($feed1->pubDate);
        });
        foreach ($entries as $entry) {
        	$Title =  $entry->title;
        	$Image = $entry->enclosure['url'];
        	$Link = $entry->link;
        	$num_rows = $this->common_model->getTableData('news', array('link' => $Link))->num_rows();
        	if($num_rows==0){
        	$contact_data = array(
					'english_title' => $Title,
					'link'       =>$Link,
					'image'     =>str_replace('http://', 'https://', $Image),
					'status'	=>'1'
					);
				$contact_dataclean = $this->security->xss_clean($contact_data);
				$id=$this->common_model->insertTableData('news', $contact_dataclean);
				echo "success<br/>";
			}
        }
        
	}

	function blog()
	{

		$data['blogs'] = $this->common_model->getTableData('news',array('news_slug'=>'Blog','status'=>'1'))->result();
		$this->load->view('front/common/blog',$data);

	}
	function blog_details()
	
	{

		$data['blogs'] = $this->common_model->getTableData('news',array('news_slug'=>'Blog','status'=>'1'))->result();
		$data['action'] = front_url() . 'blog_details';

		        if (!empty($_POST)) 
        {
            if ($this->form_validation->run()) 
            {
                $name = $this->db->escape_str($this->input->post('name'));
                $email = $this->db->escape_str($this->input->post('email'));
                $comments = $this->db->escape_str($this->input->post('comments'));

                $email_template = 'Contact_user';
                $email_template1 = 'Contact_admin';
				$username=$this->input->post('name');
				$message = $this->input->post('comments');
				$link = base_url().'blackcube_admin/contact';
				$site_common      =   site_common();
				$admin_admin = site_common()['site_settings']->site_email;
				$special_vars = array(					
				'###USERNAME###' => $username,
				'###MESSAGE###' => $message
				);
				$special_vars1 = array(					
				'###USERNAME###' => $username,
				'###MESSAGE###' => $message,
				'###LINK###' => $link
				);
				$this->email_model->sendMail($email, '', '', $email_template, $special_vars);
				$sus = $this->email_model->sendMail($admin_admin, '', '', $email_template1, $special_vars1);
                

                if ($sus) 
                {
                    $this->session->set_flashdata('success', $this->lang->line('Your message successfully sent to our team'));
                    front_redirect('blog_details', 'refresh');
                } 
                else 
                {
                    $this->session->set_flashdata('error', $this->lang->line('Error occur!! Please try again'));
                    front_redirect('blog_details', 'refresh');
                }
            } 
            else 
            {
                $this->session->set_flashdata('error', validation_errors());
                front_redirect('blog_details', 'refresh');
            }
        }



		$this->load->view('front/common/blog-details',$data);

	}


	function api_call_list(){

	$joins = array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
	$coin_pairs = $this->common_model->getJoinedTableData('trade_pairs as a',$joins,'','a.*,b.currency_name as from_currency,b.currency_symbol as from_currency_symbol,c.currency_name as to_currency,c.currency_symbol as to_currency_symbol,b.image as image')->result();


		$end_date = date("Y-m-d H:i:s");
		$start_date = date('Y-m-d H:i:s', strtotime($end_date . '- 1 day'));

		$names  = array('filled', 'partially');
		$where_in=array('status',$names);
	
		$newDataArray = [];
		$this->db->truncate('api');
		foreach($coin_pairs as $pairs){
			$volume = 0;
				$low = 0;
				$high = 0;

	if($pairs->data_fetch==0){

		$chartResult = $this->common_model->getTableData('coin_order',array('datetime >= '=>$start_date,'datetime <= '=>$end_date,'pair'=>$pairs->id),'SUM(Amount) as volume,MIN(Price) as low,MAX(Price) as high','','','','','','','','',$where_in)->row();

		if(isset($chartResult) && !empty($chartResult)){
				$volume 	= $chartResult->volume;
				$low 		= $chartResult->low; 
				$high	 	= $chartResult->high;
			}
			
				
			

		$lowestaskprice = lowestaskprice($pairs->id);
		$highestbidprice = highestbidprice($pairs->id);
		$lastmarketprice = lastmarketprice($pairs->id);

			$Insert_data['cur'] 		= $pairs->from_currency_symbol;
			$Insert_data['symbol'] 		= $pairs->from_currency_symbol.'_'.$pairs->to_currency_symbol;
			$Insert_data['last']		= (float)number_format((float)$lastmarketprice, 8, '.', '');
			$Insert_data['high'] 		= (float)number_format((float)$high, 8, '.', '');
			$Insert_data['low'] 		= (float)number_format((float)$low, 8, '.', '');
			$Insert_data['volume'] 		= (float)number_format((float)$volume, 8, '.', '');
			$Insert_data['vwap'] 		= $thisDataArray['last'];
			$Insert_data['max_bid'] 	= (float)number_format((float)$highestbidprice, 8, '.', '');
			$Insert_data['min_ask'] 	= (float)number_format((float)$lowestaskprice, 8, '.', '');
			$Insert_data['best_bid'] 	= (float)number_format((float)$highestbidprice, 8, '.', '');
			$Insert_data['best_ask'] 	= (float)number_format((float)$lowestaskprice, 8, '.', '');
			$Insert_data['updated_on']	= date('Y-m-d H:i:s');
			$Insert_data['db']			= 'db';

			$id=$this->common_model->insertTableData('api', $Insert_data);
		}
		else{
		$Trade_Pairs = $pairs->from_currency_symbol.'/'.$pairs->to_currency_symbol;
		

		if($Trade_Pairs=='ETC/BTC'){
				$thisData  		= file_get_contents('https://poloniex.com/public?command=returnTicker');
    			
    			
    			if(isset($thisData) && !empty($thisData)){
					$thisDataArray = json_decode($thisData,true);
					unset($thisDataArray['BTC_ETC']['id']);
					$last = $thisDataArray['BTC_ETC']['last'];
					unset($thisDataArray['BTC_ETC']['last']);
					$high = $thisDataArray['BTC_ETC']['high24hr'];
					unset($thisDataArray['BTC_ETC']['high24hr']);
					$low = $thisDataArray['BTC_ETC']['low24hr'];
					unset($thisDataArray['BTC_ETC']['low24hr']);
					$volume1 = $thisDataArray['BTC_ETC']['quoteVolume'];
					unset($thisDataArray['BTC_ETC']['quoteVolume']);
					unset($thisDataArray['BTC_ETC']['baseVolume']);
					$max_bid = $thisDataArray['BTC_ETC']['highestBid'];
					unset($thisDataArray['BTC_ETC']['highestBid']);
					$min_ask = $thisDataArray['BTC_ETC']['lowestAsk'];
					unset($thisDataArray['BTC_ETC']['lowestAsk']);
					unset($thisDataArray['BTC_ETC']['percentChange']);
					unset($thisDataArray['BTC_ETC']['isFrozen']);

					$Insert_data['cur'] 		= $thisDataArray['BTC_ETC']['cur'] = 'ETC';
					$Insert_data['symbol'] 		= $thisDataArray['BTC_ETC']['symbol'] = 'ETC_BTC';
					$Insert_data['last']		= $thisDataArray['BTC_ETC']['last'] = $last;
					$Insert_data['high'] 		= $thisDataArray['BTC_ETC']['high'] = $high;
					$Insert_data['low'] 		= $thisDataArray['BTC_ETC']['low'] = $low;
					$Insert_data['volume'] 		= $thisDataArray['BTC_ETC']['volume'] = $volume1 + $volume;
					$Insert_data['vwap'] 		= $thisDataArray['BTC_ETC']['last'] = $last;
					$Insert_data['max_bid'] 	= $thisDataArray['BTC_ETC']['max_bid'] = $max_bid;
					$Insert_data['min_ask'] 	= $thisDataArray['BTC_ETC']['min_ask'] = $min_ask;
					$Insert_data['best_ask'] 	= $thisDataArray['BTC_ETC']['best_ask'] = $best_ask;
					$Insert_data['best_bid'] 	= $thisDataArray['BTC_ETC']['best_bid'] = $max_bid;
					$Insert_data['updated_on']	= date('Y-m-d H:i:s');
					$Insert_data['db']			= 'poloniex';

					$id=$this->common_model->insertTableData('api', $Insert_data);
				}
    			
			}
			else{

	
		
		$thisData= file_get_contents('https://api.livecoin.net/exchange/ticker?currencyPair='.$Trade_Pairs);


		if(isset($thisData) && !empty($thisData)){
		$thisDataArray = json_decode($thisData,true);
		

				
				if(!isset($thisDataArray['success'])){
					
					/*echo "<pre>";
		print_r($thisDataArray);*/

					$Insert_data['cur'] 		= $thisDataArray['cur'];
					$Insert_data['symbol'] 		= $thisDataArray['symbol'];
					$Insert_data['last']		= $thisDataArray['last'];
					$Insert_data['high'] 		= $thisDataArray['high'];
					$Insert_data['low'] 		= $thisDataArray['low'];
						if(isset($thisDataArray['volume']) && !empty($thisDataArray['volume'])){
							$Insert_data['volume'] = $thisDataArray['volume'] + $volume;
								}
					$Insert_data['vwap'] 		= $thisDataArray['vwap'];
					$Insert_data['max_bid'] 	= $thisDataArray['max_bid'];
					$Insert_data['min_ask'] 	= $thisDataArray['min_ask'];
					$Insert_data['best_bid'] 	= $thisDataArray['best_bid'];
					$Insert_data['best_ask'] 	= $thisDataArray['best_ask'];
					$Insert_data['updated_on']	= date('Y-m-d H:i:s');
					$Insert_data['db']			= 'livecoin';

					$id=$this->common_model->insertTableData('api', $Insert_data);
				}
	}
		

}
	}	
	}

}

function apicall(){
	header('Content-Type: application/json');

	$Api_List = $this->common_model->getTableData('api')->result();

				foreach($Api_List as $Api){
					$Insert_data['cur'] 		= $Api->cur;
					$Insert_data['symbol'] 		= $Api->symbol;
					$Insert_data['last']		= $Api->last;
					$Insert_data['high'] 		= $Api->high;
					$Insert_data['low'] 		= $Api->low;
					$Insert_data['volume'] 		= $Api->volume;
					$Insert_data['vwap'] 		= $Api->last;
					$Insert_data['max_bid'] 	= $Api->max_bid;
					$Insert_data['min_ask'] 	= $Api->min_ask;
					$Insert_data['best_bid'] 	= $Api->best_bid;
					$Insert_data['best_ask'] 	= $Api->best_ask;

					$newDataArray[] = $Insert_data;
				}
	
echo json_encode($newDataArray,true);


}

function fav_add(){
		$this->load->library('session');

		$user_id=$this->session->userdata('user_id');
		$currency_id=$this->input->get('currency_id');
		$status=$this->input->get('status');
		$Ip_Address = get_client_ip();
		if($status=='mark'){
		if($user_id!="")
		{	
			$Table = $this->common_model->getTableData('favourite_currency', array('user_id' => $user_id,'currency_id'=>$currency_id));
			if($Table->num_rows()==0){
				$insertData = array(
	    	'currency_id'=> $currency_id,
	    	'user_id'=> $user_id,
	    	'ip' => $Ip_Address
	        );
	        $insert = $this->common_model->insertTableData('favourite_currency', $insertData);
	        if($insert){
	        	$data['msg'] = 'added';
	        }
			}
		}
		else{
			$Table = $this->common_model->getTableData('favourite_currency', array('ip' => $Ip_Address,'currency_id'=>$currency_id));
			if($Table->num_rows()==0){
				$insertData = array(
	    	'currency_id'=> $currency_id,
	    	'user_id'=> 0,
	    	'ip' => $Ip_Address
	        );
	        $insert = $this->common_model->insertTableData('favourite_currency', $insertData);

	        if($insert){
	        	$data['msg'] = 'added';
	        }

			}
		}
	}
	if($status=='unmark'){
		if($user_id!="")
		{	
		$Table = $this->common_model->getTableData('favourite_currency', array('user_id' => $user_id,'currency_id'=>$currency_id));
			if($Table->num_rows()>0){
				$Condition = array(
	    	'id'=> $Table->row('id')
	        );
	        $delete = $this->common_model->deleteTableData('favourite_currency', $Condition);

	        if($delete){
	        	$data['msg'] = 'deleted';
	        }
			}
		}
		else{
			$Table = $this->common_model->getTableData('favourite_currency', array('ip' => $Ip_Address,'currency_id'=>$currency_id));
			if($Table->num_rows()>0){
				$Condition = array(
	    	'id'=> $Table->row('id')
	        );
	        $delete = $this->common_model->deleteTableData('favourite_currency', $Condition);
	        if($delete){
	        	$data['msg'] = 'deleted';
	        }
			}
		}
	
}
echo json_encode($data);
}

function showApiList()
{
	$data['js_link'] = '';
	$data['site_common'] = site_common();
	$data['action'] = front_url() . 'api';
	$meta = $this->common_model->getTableData('meta_content', array('link' => 'news'))->row();
	$data['heading'] = $meta->heading;
	$data['title'] = $meta->title;
	$data['meta_keywords'] = $meta->meta_keywords;
	$data['meta_description'] = $meta->meta_description;
	$this->load->view('front/common/show_api', $data);
}


function market_api_orders()
{
  $this->db->truncate('api_orders');
  $this->db->truncate('coinbase_api_orders');	
  $trade_pairs = $this->common_model->getTableData("trade_pairs", array("status"=>1))->result();
  if(count($trade_pairs) > 0)
  {
    foreach($trade_pairs as $pair)
    {
        
        $from_symbol = getcryptocurrency($pair->from_symbol_id);
        $to_symbol = getcryptocurrency($pair->to_symbol_id);

    $pair_value=$from_symbol.$to_symbol;
    /*echo "pair";
    echo $from_symbol.'_'.$to_symbol;
    echo "<br>";*/
        if($pair_value != "") 
        {


       	$first_pair  = strtoupper($from_symbol);
        $second_pair1 = strtoupper($to_symbol);

        if($pair->execution=='binance') {

        if($second_pair1=='USD'){
        	$second_pair='USDC';
        	$insert_pair = 'USD';
        }else{
        	$second_pair = $second_pair1;
        	$insert_pair = $second_pair1;
        }
          $coin_pair = $first_pair.$second_pair;
          $coin_pair_rev = $second_pair.$first_pair;
      
          $json= file_get_contents('https://api.binance.com/api/v1/depth?symbol='.$coin_pair.'&limit=20');
          $newresult = json_decode($json,true);echo $newresult['code'];
          //if(!empty($newresult) 
            if (empty($newresult))
            { 
              $json= file_get_contents('https://api.binance.com/api/v1/depth?symbol='.$coin_pair_rev.'&limit=20');
              $newresult = json_decode($json,true);
              if (empty($newresult))
                {
                  $json= file_get_contents('https://api.binance.com/api/v1/depth?symbol=ETHBTC&limit=20');
                  $newresult = json_decode($json,true);
                  $buy_orders = $newresult['asks'];
                $sell_orders = $newresult['bids'];
                $buy_res = array();
                $i=1;
                foreach($buy_orders as $buy)
                {
                  $buyData['trade_id'] = $i;
                  $buyData['price'] = $buy[0];
                  $buyData['quantity'] = $buy[1];
                  $buyData['pair_id'] = $pair->id;
                  $buyData['pair_symbol'] = $first_pair.'_'.$insert_pair;
                  $buyData['type'] = 'buy';
                  $buyData['updated_at'] = date("Y-m-d H:i:s");
                    $insert = $this->common_model->insertTableData("api_orders",$buyData);
              if($insert)
              {
                /*echo $coin_pair_rev." api buy orders updated success";
                echo "<br>";*/
              }
              else
              {
                /*echo $coin_pair_rev." api buy orders updated failed";
                echo "<br>";*/
              }
                    $i++;
                }

                  $j=1;
                foreach($sell_orders as $sell)
                {
                  $sellData['trade_id'] = $j;
                  $sellData['price'] = $sell[0];
                  $sellData['quantity'] = $sell[1];
                  $sellData['pair_id'] = $pair->id;
                    $sellData['pair_symbol'] = $first_pair.'_'.$insert_pair;
                    $sellData['type'] = 'sell';
                  $sellData['updated_at'] = date("Y-m-d H:i:s");
                    $insert = $this->common_model->insertTableData("api_orders",$sellData);
              if($insert)
              {
                /*echo "api sell orders updated success";
                echo "<br>";*/
              }
              else
              {
                /*echo "api sell orders updated failed";
                echo "<br>";*/
              }
              $j++;
                }
                echo $coin_pair_rev."DUMMY api buy orders updated success<br/>";
                }
                else
                {
                $buy_orders = $newresult['asks'];
                $sell_orders = $newresult['bids'];
                $buy_res = array();
                $i=1;
                foreach($buy_orders as $buy)
                {
                  $buyData['trade_id'] = $i;
                  $buyData['price'] = $buy[0];
                  $buyData['quantity'] = $buy[1];
                  $buyData['pair_id'] = $pair->id;
                  $buyData['pair_symbol'] = $first_pair.'_'.$insert_pair;
                  $buyData['type'] = 'buy';
                  $buyData['updated_at'] = date("Y-m-d H:i:s");
                    $insert = $this->common_model->insertTableData("api_orders",$buyData);
              if($insert)
              {
                /*echo $coin_pair_rev." api buy orders updated success";
                echo "<br>";*/
              }
              else
              {
                /*echo $coin_pair_rev." api buy orders updated failed";
                echo "<br>";*/
              }
                    $i++;
                }

                  $j=1;
                foreach($sell_orders as $sell)
                {
                  $sellData['trade_id'] = $j;
                  $sellData['price'] = $sell[0];
                  $sellData['quantity'] = $sell[1];
                  $sellData['pair_id'] = $pair->id;
                    $sellData['pair_symbol'] = $first_pair.'_'.$insert_pair;
                    $sellData['type'] = 'sell';
                  $sellData['updated_at'] = date("Y-m-d H:i:s");
                    $insert = $this->common_model->insertTableData("api_orders",$sellData);
              if($insert)
              {
                /*echo "api sell orders updated success";
                echo "<br>";*/
              }
              else
              {
                /*echo "api sell orders updated failed";
                echo "<br>";*/
              }
              $j++;
                }
                echo $coin_pair_rev." REV api buy orders updated success<br/>";
            }
            }
            else
            {
              $buy_orders = $newresult['bids'];
              $sell_orders = $newresult['asks'];
              $buy_res = array();
              $i=1;
              foreach($buy_orders as $buy)
              {
                $buyData['trade_id'] = $i;
                $buyData['price'] = $buy[0];
                $buyData['quantity'] = $buy[1];
                $buyData['pair_id'] = $pair->id;
                $buyData['pair_symbol'] = $first_pair.'_'.$insert_pair;
                $buyData['type'] = 'buy';
                $buyData['updated_at'] = date("Y-m-d H:i:s");
                  $insert = $this->common_model->insertTableData("api_orders",$buyData);
            if($insert)
            {
              /*echo "api buy orders updated success";
              echo "<br>";*/
            }
            else
            {
              /*echo "api buy orders updated failed";
              echo "<br>";*/
            }
                  $i++;
              }

                $j=1;
              foreach($sell_orders as $sell)
              {
                $sellData['trade_id'] = $j;
                $sellData['price'] = $sell[0];
                $sellData['quantity'] = $sell[1];
                $sellData['pair_id'] = $pair->id;
                  $sellData['pair_symbol'] = $first_pair.'_'.$insert_pair;
                  $sellData['type'] = 'sell';
                $sellData['updated_at'] = date("Y-m-d H:i:s");
                  $insert = $this->common_model->insertTableData("api_orders",$sellData);
            if($insert)
            {
              /*echo "api sell orders updated success";
              echo "<br>";*/
            }
            else
            {
              /*echo "api sell orders updated failed";
              echo "<br>";*/
            }
            $j++;
              }
              echo $coin_pair." api buy orders updated success<br/>";
          }
         
         }
          else if($pair->execution=='coinbase')
          {
          	 
 
          	 $coinbase_pair = $first_pair.'-'.$second_pair1;
			 $newresult = coinbase_curl('trades',$coinbase_pair);



			  if(count($newresult)>0 && !empty($newresult))
			  {


			  		foreach($newresult as $newres){
					$market_trades['trade_id']= $newres['trade_id'];
					$market_trades['price']= $newres['price'];
					$market_trades['quantity']= $newres['size'];
					$market_trades['pair_id']= $pair->id;
					$market_trades['pair_symbol']= $coinbase_pair;
					$market_trades['type'] = $newres['side'];
					$market_trades['updated_at'] = date("Y-m-d H:i:s");

					 // echo "<pre>";
					 // print_r($market_trades);
					 // echo "<pre>";
					$insert = $this->common_model->insertTableData("coinbase_api_orders",$market_trades);
					echo $coinbase_pair."Coinbase Api Orders success<br/>";

				}


			  }


          }


        }
        }
      }
    
}

function market()
{
	$data['site_common'] = site_common();
	$data['pairs'] = $this->common_model->getTableData('trade_pairs',array('status'=>'1'),'','','','','','', array('id', 'ASC'))->result();
	$limit = 6;
	$data['chartpairs'] = $this->common_model->getTableData('trade_pairs',array('status'=>'1'),'','','','','',$limit,array('id','ASC'))->result();
	$data['currencies'] = $this->common_model->customQuery("select * from blackcube_currency where status='1' and currency_symbol in ('BTC','ETH','TRX','BNB')")->result();
	$data['allcurrencies'] = $this->common_model->customQuery("select * from blackcube_currency where status='1' ")->result();
		$data['footer'] = $this->common_model->getTableData('static_content',array('slug'=>'footer'))->row();
	
	$this->load->view('front/trade/market', $data);
}
function marketcap()
{
	$data['site_common'] = site_common();
	$data['pairs'] = $this->common_model->getTableData('trade_pairs',array('status'=>'1'),'','','','','','', array('id', 'ASC'))->result();
	$data['currencies'] = $this->common_model->customQuery("select * from blackcube_currency where status='1'")->result();
	$this->load->view('front/trade/marketcap', $data);
}
    
function test_wallet()
{

	$this->load->view('front/common/test_wallet');
}
public function mollie_webhook()
{
	echo " Mollie.. "; 
} 



// Stop-Limit CRON
function check_stop_limit()
{
	$coin_order = $this->common_model->getTableData('coin_order',array('status'=>'stoporder'))->result();
	if($coin_order) {
		foreach ($coin_order as $key => $co) {
			
			$pair_sym = str_replace("_", "", $co->pair_symbol);
			// $buy_rate = marketprice($co->pair);
			$url = file_get_contents("https://api.binance.com/api/v1/ticker/24hr?symbol=".$pair_sym);
            $ress = json_decode($url,true); 
            $lastPrice = $ress['lastPrice'];
            // $lastPrice = '0.173300';

			// echo "<pre>"; print_r($ress['lastPrice']);
			if($co->Type == 'buy')
			{
				$trade_id       = $co->trade_id;
				$stoporderprice = $co->stoporderprice;
				$stoporderlimit = $co->limit_price;

				// echo $stoporderprice.'>='.$lastPrice.'<br>';
				// echo $stoporderlimit.'>='.$lastPrice.'<br>';

				if($stoporderprice>=$lastPrice || $stoporderlimit>=$lastPrice)
                {
                	// echo 'TRUE-- '.$trade_id;
                	$this->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),array('Price'=>$stoporderlimit,'status'=>'active'));
                	$this->initialize_mapping($trade_id);
                } 
			} else {

				$trade_id       = $co->trade_id;
				$stoporderprice = $co->stoporderprice;
				$stoporderlimit = $co->limit_price;

				// echo $stoporderprice.'<='.$lastPrice.'<br>';
				// echo $stoporderlimit.'<='.$lastPrice.'<br>';
				if($stoporderprice<=$lastPrice || $stoporderlimit<=$lastPrice)
                {
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),array('Price'=>$stoporderlimit,'status'=>'active'));
					$this->initialize_mapping($trade_id);
			    } 
			}
		}
	}
}

function initialize_mapping($res)
{
	$names = array('active', 'partially');
	$where_in=array('status', $names);
	$buy = $this->common_model->getTableData('coin_order',array('trade_id'=>$res),'','','','','','','','','',$where_in)->row();
	if($buy)
	{
		$pair_id=$buy->pair;
		if($buy->Type=='buy')
		{
			//echo "BUY";
			$final="";
			$buyorderId         = 	$buy->trade_id; 
			$buyuserId          = 	$buy->userId;
			$buyPrice           = 	$buy->Price;
			$buyOrertype        = 	$buy->ordertype;
			$buyPrice           = 	(float)$buyPrice;
			$buyAmount          = 	(float)$buy->Amount;
			$pair   			= 	$buy->pair;
			$buyWallet 			=	$buy->wallet;
			$Total				=	$buy->Total;
			$Fee				=	$buy->Fee;
			$Pair_Symbol = str_replace('/', '', $buy->pair_symbol);

			$pair_details = $this->common_model->getTableData('trade_pairs',array('id'=>$pair),'from_symbol_id,to_symbol_id,api_status')->row();

			$fetchsellRecords 	= 	$this->getParticularsellorders($buyPrice,$buyuserId,$pair,$buyOrertype);

			if($fetchsellRecords)
			{
				$k=0;
				foreach($fetchsellRecords as $sell)
				{
					$k++;
					$sellorderId        = $sell->trade_id;
					$selluserId         = $sell->userId;
					$sellPrice          = $sell->Price;
					$sellOrdertype      = $sell->ordertype;
					$sellAmount         = $sell->Amount;
					$sellWallet        	= $sell->wallet;
					$pair   			= $sell->pair;
					$sellstatus  		= $sell->status;
					$Total1				= $sell->Total;
					$Fee1				= $sell->Fee;
					$sellSumamount 		= $this->checkOrdertemp($sellorderId,'sellorderId');
					if($sellSumamount)
					{
						$approxiAmount = $sellAmount-$sellSumamount;
						$approxiAmount=number_format($approxiAmount,8,'.','');
					}
					else
					{
						$approxiAmount = $sellAmount;
					}
					$buySumamount      = $this->checkOrdertemp($buyorderId,'buyorderId');
					if($buySumamount)
					{
						$buySumamount = $buyAmount-$buySumamount;
						$buySumamount=number_format($buySumamount,8,'.','');
					}
					else
					{
						$buySumamount = $buyAmount;
					}
					if($approxiAmount >= $buySumamount)
					{
						$amount = $buySumamount;
					}
					else
					{
						$amount = $approxiAmount;
					}
					if($approxiAmount!=0&&$buySumamount!=0)
					{
						$date               =   date('Y-m-d');
						$time               =   date("H:i:s");
						$datetime           =   date("Y-m-d H:i:s");
						$data               =   array(
												'sellorderId'       =>  $sellorderId,
												'sellerUserid'      =>  $selluserId,
												'askAmount'         =>  $sellAmount,
												'askPrice'          =>  $sellPrice,
												'filledAmount'      =>  $amount,
												'buyorderId'        =>  $buyorderId,
												'buyerUserid'       =>  $buyuserId,
												'sellerStatus'      =>  "inactive",
												'buyerStatus'       =>  "inactive",
												"pair"              =>  $pair,
												"datetime"          =>  $datetime,
												"ac_price"          =>  $sellPrice,
												"wantPrice"         => $buyPrice,
 												"ac_type"           => 'buy',
 												"ac_amount"           => $buyAmount
												);
						$inserted=$this->common_model->insertTableData('ordertemp', $data);
						$theftprice=0;
						if($inserted)
						{
							if($buyPrice>$sellPrice)
							{
								
								$price1=$buyPrice-$sellPrice;
								$Fee_Theft = ($amount*$price1) * ($buy->fee_per/100);
								//$theftprice=($buyAmount*$price1)-$Fee_Theft;
								$theftprice=($amount*$price1)+$Fee_Theft;
								
								//echo "Seller ID - ".$selluserId."<br/> Buy Amount - ".$amount;

								// $user_buy_bal  = getTradingBalance($buyuserId,$pair_details->to_symbol_id);
								$user_buy_bal  = getBalance($buyuserId,$pair_details->to_symbol_id);
								$buy_bal = $user_buy_bal+$theftprice;
								// $buy_bal = 1;
								// updateBalance($buyuserId,$pair_details->to_symbol_id, $buy_bal);
							}
							
							if(trim($approxiAmount)==trim($amount))
							{ 
								//echo "1st if";
								//echo "Order Complete Sell Order ID :".$sellorderId;
								$this->ordercompletetype($sellorderId,"sell",$inserted);
								$trans_data = array(
								'userId'=>$selluserId,
								'type'=>'Sell',
								'currency'=>$pair_details->from_symbol_id,
								'amount'=>$Total1+$Fee1,
								'profit_amount'=>$Fee1,
								'comment'=>'Trade Sell order #'.$sellorderId,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto'
								);
								$update_trans = $this->common_model->insertTableData('transaction_history',$trans_data);
							}
							else
							{
								//echo "1st else"; 
								//echo "Sell Order ID - ".$sellorderId;
								$this->orderpartialtype($sellorderId,"sell",$inserted);
								$this->common_model->updateTableData('coin_order',array('trade_id'=>$sellorderId),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
							}
							// $this->integrate_remarket($sellorderId);
							if((trim($approxiAmount)==trim($buySumamount))||($approxiAmount>$buySumamount))
							{
								//echo "2nd if ".$buyorderId;
								$this->ordercompletetype($buyorderId,"buy",$inserted);
								$trans_data = array(
								'userId'=>$buyuserId,
								'type'=>'Buy',
								'currency'=>$pair_details->to_symbol_id,
								'amount'=>$Total,
								'profit_amount'=>$Fee,
								'comment'=>'Trade Buy order #'.$buyorderId,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto',
								//'bonus_amount'=>$theftprice
								);
								$update_trans = $this->common_model->insertTableData('transaction_history',$trans_data);
							}
							else
							{
								//echo "2nd else FOR BUY";
								//echo "Buy Order ID - ".$buyorderId;
								$this->orderpartialtype($buyorderId,"buy",$inserted);
								$this->common_model->updateTableData('coin_order',array('trade_id'=>$buyorderId),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
							}
						}
					}
					else
					{
						break;
					}
				} 
			}
			// else // call liquidity binance API
			// {
			// 	if($buyOrertype=='instant' || $buyOrertype=='limit'){
			// 		if($pair_details->api_status==1){
			// 			if($buyOrertype=='instant'){
			// 				$Order_Type = 'MARKET';
			// 				$Binance['status']  = 'Completed';
			// 			}
			// 			else{
			// 				$Order_Type = 'LIMIT';
			// 				$Binance['status']  = 'Pending';
			// 			}

			// 			$date               =   date('Y-m-d');
			// 			$time               =   date("H:i:s");
			// 			$datetime           =   date("Y-m-d H:i:s");
 
						
			// 			$data               =   array(
			// 									'sellorderId'       =>  $buyorderId,
			// 									'sellerUserid'      =>  $buyuserId,
			// 									'askAmount'         =>  $buyAmount,
			// 									'askPrice'          =>  $buyPrice,
			// 									'filledAmount'      =>  0,
			// 									'buyorderId'        =>  $buyorderId,
			// 									'buyerUserid'       =>  $buyuserId,
			// 									'sellerStatus'      =>  "inactive",
			// 									'buyerStatus'       =>  "inactive",
			// 									"pair"              =>  $pair,
			// 									"datetime"          =>  $datetime
			// 									);
			// 			$inserted=$this->common_model->insertTableData('ordertemp', $data);

			// 	$Binance_Response = create_binance_order($Pair_Symbol,'BUY',$Order_Type,$buyAmount,$buyPrice);
			// 	print_r($Binance_Response);
			// 	if(isset($Binance_Response['status']) && !empty($Binance_Response['status']) && ($Binance_Response['status']=='FILLED' || $Binance_Response['status']=='NEW')){
			// 		//echo "success";

			// 		$Binance = array();
			// 		$Binance['arth_trade_id'] 			= $buyorderId;
			// 		$Binance['order_type'] 			= $buyOrertype;
			// 		$Binance['pair_id'] 			= $pair_id;
			// 		$Binance['symbol'] 			= $Pair_Symbol;
			// 		$Binance['orderId'] 				= $Binance_Response['orderId'];
			// 		$Binance['clientOrderId'] 			= $Binance_Response['clientOrderId'];
			// 		$Binance['transactTime'] 			= $Binance_Response['transactTime'];
			// 		$Binance['executedQty'] 			= $Binance_Response['executedQty'];
			// 		$Binance['cummulativeQuoteQty'] 	= $Binance_Response['cummulativeQuoteQty'];
			// 		if($Binance_Response['status']=='FILLED'){
			// 		$Binance['price'] 					= $Binance_Response['fills'][0]['price'];
			// 		$Binance['tradeId'] 				= $Binance_Response['fills'][0]['tradeId'];
			// 		$Binance['status'] 				= 'Completed';
			// 	}
			// 	else{
			// 		$Binance['price'] = 0;
			// 		$Binance['tradeId'] = 0;
			// 		$Binance['status'] 				= 'Pending';
			// 	}

			// 		$update_binance = $this->common_model->insertTableData('binance_order',$Binance);


					

			// 			/*$updateTableData = array(
			// 		'Price' =>$Binance['price']
			// 		);
			// 		$this->common_model->updateTableData('coin_order', array('trade_id' => $buyorderId), $updateTableData);*/

						
			// 			if($Binance_Response['status']=='FILLED'){
			// 				$this->ordercompletetype($buyorderId,"buy",$inserted);
			// 					$trans_data = array(
			// 					'userId'=>$buyuserId,
			// 					'type'=>'Buy',
			// 					'currency'=>$pair_details->to_symbol_id,
			// 					'amount'=>$Total+$Fee,
			// 					'profit_amount'=>$Fee,
			// 					'comment'=>'Trade Buy order #'.$buyorderId,
			// 					'datetime'=>date('Y-m-d h:i:s'),
			// 					'currency_type'=>'crypto',
			// 					'bonus_amount'=>0
			// 					);
			// 					$update_trans = $this->common_model->insertTableData('transaction_history',$trans_data);
			// 				}

			// 			}
			// 		}
			// 	}
			// }
			
		}
		else if($buy->Type=='sell')
		{
			//echo "SELL";
			$sell=$buy;
			$final="";
			$sellorderId         = 	$sell->trade_id; 
			$selluserId          = 	$sell->userId;
			$sellPrice           = 	$sell->Price;
			$sellOrertype        = 	$sell->ordertype;
			$sellPrice           = 	(float)$sellPrice;
			$sellAmount          = 	(float)$sell->Amount;
			$pair   			= 	$sell->pair;
			$sellWallet 			=	$sell->wallet;
			$Total1				=	$sell->Total;
			$Fee1				=	$sell->Fee;
			$Pair_Symbol = str_replace('/', '', $sell->pair_symbol);

			$pair_details = $this->common_model->getTableData('trade_pairs',array('id'=>$pair),'from_symbol_id,to_symbol_id,api_status')->row();

			$fetchbuyRecords 	= 	$this->getParticularbuyorders($sellPrice,$selluserId,$pair);
			//echo " RECS -> SELL PRICE-> ".$sellPrice." USER ID -> ".$selluserId;
			
			if($fetchbuyRecords)
			{
				$k=0;
				foreach($fetchbuyRecords as $buy)
				{
					$k++;
					$buyorderId        = $buy->trade_id;
					$buyuserId         = $buy->userId;
					$buyPrice          = $buy->Price;
					$buyOrdertype      = $buy->ordertype;
					$buyAmount         = $buy->Amount;
					$buyWallet        	= $buy->wallet;
					$pair   			= $buy->pair;
					$buystatus  		= $buy->status;
					$Total				=	$buy->Total;
					$Fee				=	$buy->Fee;
					$buySumamount 		= $this->checkOrdertemp($buyorderId,'buyorderId');
					if($buySumamount)
					{
						$approxiAmount = $buyAmount-$buySumamount;
						$approxiAmount=number_format($approxiAmount,8,'.','');
					}
					else
					{
						$approxiAmount = $buyAmount;
					}
					$sellSumamount      = $this->checkOrdertemp($sellorderId,'sellorderId');
					if($sellSumamount)
					{
						$sellSumamount = $sellAmount-$sellSumamount;
						$sellSumamount=number_format($sellSumamount,8,'.','');
					}
					else
					{
						$sellSumamount = $sellAmount;
					}
					if($approxiAmount >= $sellSumamount)
					{
						$amount = $sellSumamount;
					}
					else
					{
						$amount = $approxiAmount;
					} 

					if($approxiAmount!=0&&$sellSumamount!=0)
					{
						$date               =   date('Y-m-d');
						$time               =   date("H:i:s");
						$datetime           =   date("Y-m-d H:i:s");
						$data               =   array(
												'sellorderId'       =>  $sellorderId,
												'sellerUserid'      =>  $selluserId,
												'askAmount'         =>  $sellAmount,
												'askPrice'          =>  $sellPrice,
												'filledAmount'      =>  $amount,
												'buyorderId'        =>  $buyorderId,
												'buyerUserid'       =>  $buyuserId,
												'sellerStatus'      =>  "inactive",
												'buyerStatus'       =>  "inactive",
												"pair"              =>  $pair,
												"datetime"          =>  $datetime,
												"ac_price"          => $buyPrice,
												"wantPrice"         => $buyPrice, 
												"ac_type"           => 'sell' 
												);
						$inserted=$this->common_model->insertTableData('ordertemp', $data);
						$theftprice=0;
						if($inserted)
						{
							//echo " SEll PRICE ".$sellPrice." <br> ";
							//print_r($buy);

							if($sellPrice<$buyPrice)
							{


								$price1=$buyPrice-$sellPrice;
								$theftprice=$amount*$price1;
									
								//$theftprice=$amount - $Fee1;	


								//$this->common_model->updateTableData('coin_order',array('trade_id'=>$buyorderId),array('Price'=>$sellPrice));

				                // $user_sell_bal  = getTradingBalance($buyuserId,$pair_details->to_symbol_id);
				                $user_sell_bal  = getBalance($buyuserId,$pair_details->to_symbol_id);
								$sell_bal = $user_sell_bal+$theftprice;
								// $sell_bal = 2;
								// updateBalance($buyuserId,$pair_details->to_symbol_id,$sell_bal);

							} 

							//echo " APPROXI AMT -> ".$approxiAmount." NOR AMT ->  ".$amount."  ";   
							
							if(trim($approxiAmount)==trim($amount))
							{
								//echo " Sell 1st if";
								$this->ordercompletetype($buyorderId,"buy",$inserted);
								$trans_data = array(
								'userId'=>$buyuserId,
								'type'=>'Buy',
								'currency'=>$pair_details->to_symbol_id,
								'amount'=>$Total,
								'profit_amount'=>$Fee,
								'comment'=>'Trade Buy order #'.$buyorderId,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto',
								'bonus_amount'=>$theftprice
								);
								$update_trans = $this->common_model->insertTableData('transaction_history',$trans_data);
							}
							else 
							{    
								//echo "  sell 1 st else ";
								$this->orderpartialtype($buyorderId,"buy",$inserted);
								$this->common_model->updateTableData('coin_order',array('trade_id'=>$buyorderId),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
							}
							// $this->integrate_remarket($buyorderId);

							//echo " APR - AMT  ".$approxiAmount." SELL SUM AMT ".$sellSumamount;
   
							if((trim($approxiAmount)>=trim($sellSumamount)))
							{
								//echo "sell 2nd if";
								$this->ordercompletetype($sellorderId,"sell",$inserted);
								$trans_data = array(
								'userId'=>$selluserId,
								'type'=>'Sell',
								'currency'=>$pair_details->from_symbol_id,
								'amount'=>$Total1+$Fee1,
								'profit_amount'=>$Fee1, 
								'comment'=>'Trade Sell order #'.$sellorderId,
								'datetime'=>date('Y-m-d h:i:s'),
								'currency_type'=>'crypto'
								);
								$update_trans = $this->common_model->insertTableData('transaction_history',$trans_data);
							}
							else
							{ 
								//echo "sell 2nd else";
								$this->orderpartialtype($sellorderId,"sell",$inserted);
								$this->common_model->updateTableData('coin_order',array('trade_id'=>$sellorderId),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
							} 
						} 
					}
					else
					{
						break;
					}
				} 
			}
			// else // call liquidity binance API
			// {
			// 	if($sellOrertype=='instant' || $sellOrertype=='limit'){
			// 		if($pair_details->api_status==1){
			// 			if($sellOrertype=='instant'){
			// 				$Order_Type = 'MARKET';
			// 				$Binance['status']  = 'Completed';
			// 			}
			// 			else{
			// 				$Order_Type = 'LIMIT';
			// 				$Binance['status']  = 'Pending';
			// 			}

			// 			$date               =   date('Y-m-d');
			// 			$time               =   date("H:i:s");
			// 			$datetime           =   date("Y-m-d H:i:s");
			// 			$data               =   array(
			// 									'sellorderId'       =>  $sellorderId,
			// 									'sellerUserid'      =>  $selluserId,
			// 									'askAmount'         =>  $sellAmount,
			// 									'askPrice'          =>  $sellPrice,
			// 									'filledAmount'      =>  0,
			// 									'buyorderId'        =>  $sellorderId,
			// 									'buyerUserid'       =>  $selluserId,
			// 									'sellerStatus'      =>  "inactive",
			// 									'buyerStatus'       =>  "inactive",
			// 									"pair"              =>  $pair,
			// 									"datetime"          =>  $datetime
			// 									);
			// 			$inserted=$this->common_model->insertTableData('ordertemp', $data);

			// 	$Binance_Response = create_binance_order($Pair_Symbol,'SELL',$Order_Type,$sellAmount,$sellPrice);
				
			// 	print_r($Binance_Response);
			// 	if(isset($Binance_Response['status']) && !empty($Binance_Response['status']) && ($Binance_Response['status']=='FILLED' || $Binance_Response['status']=='NEW')){
			// 		//echo "Sell Success";
			// 		$Binance = array();
			// 		$Binance['arth_trade_id'] 			= $sellorderId;
			// 		$Binance['order_type'] 			= $sellOrertype;
			// 		$Binance['pair_id'] 			= $pair_id;
			// 		$Binance['symbol'] 			= $Pair_Symbol;
			// 		$Binance['orderId'] 				= $Binance_Response['orderId'];
			// 		$Binance['clientOrderId'] 			= $Binance_Response['clientOrderId'];
			// 		$Binance['transactTime'] 			= $Binance_Response['transactTime'];
			// 		$Binance['executedQty'] 			= $Binance_Response['executedQty'];
			// 		$Binance['cummulativeQuoteQty'] 	= $Binance_Response['cummulativeQuoteQty'];
			// 		if($Binance_Response['status']=='FILLED'){
			// 		$Binance['price'] 					= $Binance_Response['fills'][0]['price'];
			// 		$Binance['tradeId'] 				= $Binance_Response['fills'][0]['tradeId'];
			// 		$Binance['status'] 				= 'Completed';
			// 	}
			// 	else{
			// 		$Binance['price'] 					= 0;
			// 		$Binance['tradeId'] 				= 0;
			// 		$Binance['status'] 				= 'Pending';
			// 	}

			// 		$update_binance = $this->common_model->insertTableData('binance_order',$Binance);


					

			// 	/*		$updateTableData = array(
            //   'Price' =>$Binance['price']
            // );
            // $this->common_model->updateTableData('coin_order', array('trade_id' => $sellorderId), $updateTableData);*/


						

			// 			if($Binance_Response['status']=='FILLED'){
			// 				$this->ordercompletetype($sellorderId,"sell",$inserted);
			// 					$trans_data = array(
			// 					'userId'=>$selluserId,
			// 					'type'=>'Sell',
			// 					'currency'=>$pair_details->to_symbol_id,
			// 					'amount'=>$Total1+$Fee1,
			// 					'profit_amount'=>$Fee1,
			// 					'comment'=>'Trade Buy order #'.$sellorderId,
			// 					'datetime'=>date('Y-m-d h:i:s'),
			// 					'currency_type'=>'crypto',
			// 					'bonus_amount'=>0
			// 					);
			// 					$update_trans = $this->common_model->insertTableData('transaction_history',$trans_data);
			// 				}

			// 	}
			// }
			// }
			// }
			
		
	}
}



}

function getParticularsellorders($buyPrice,$buyuserId,$pair)
{
	$names = array('active', 'partially');
	$where_in=array('status', $names);
	$order_by = array('Price','asc');
	$query = $this->common_model->getTableData('coin_order',array('pair'=>$pair,'Type'=>'Sell','Price <='=>$buyPrice),'','','','','','',$order_by,'','',$where_in);
	
	if($query->num_rows() >= 1)
	{
		return $query->result();
	}
	else
	{
		return false;
	}
} 

function getParticularbuyorders($sellPrice,$selluserId,$pair)
{
	$names = array('active', 'partially');
	$where_in=array('status', $names);
	$order_by = array('Price','desc');
	$query = $this->common_model->getTableData('coin_order',array('pair'=>$pair,'Type'=>'Buy','Price >='=>$sellPrice),'','','','','','',$order_by,'','',$where_in);
	if($query->num_rows() >= 1)
	{
		return $query->result();
	}
	else
	{
		return false;
	}
} 

function checkOrdertemp($id,$type)
{
	$query = $this->common_model->getTableData('ordertemp',array($type=>$id),'SUM(filledAmount) as totalamount');
	if($query->num_rows() >= 1)
	{
		$row = $query->row();
		return $row->totalamount;
	}
	else
	{
		return false;
	}
}

function ordercompletetype($orderId,$type,$inserted)
{
	$trade_execution_type = $this->common_model->getTableData('site_settings',array('id'=>1),'trade_execution_type')->row('trade_execution_type');
	if($trade_execution_type==1)
	{
		//echo "qwerty".$orderId;
		$this->removeOrder($orderId,$inserted);
	}
	else
	{
		//echo "touch".$orderId;
		$this->partial_balanceupdate($orderId,$inserted,$type);
	}
	$current_time = date("Y-m-d H:i:s");
	$query  =   $this->common_model->updateTableData('coin_order',array('trade_id'=>$orderId),array('status'=>"filled",'datetime'=>$current_time));

	$order_res = $this->common_model->getTableData('coin_order',array('trade_id'=>$orderId))->row();
	$user_id = $order_res->userId;
	//echo "USERID".$user_id;
	
	//  if($order_res->Type=='buy'){

	// 	$Commission_Amt = $order_res->Total * $order_res->fee_per;
	// 	$Commission_Amount = $Commission_Amt / 100; 
	// }
	$Commission_Amount = $order_res->Fee; 

	//echo " Comssion Amt ".$Commission_Amount.' Type '.$order_res->Type; 


	$Refer_ID = getUserDetails($user_id,'parent_referralid');
	//echo "REFERID".$Refer_ID;
	$Pair = $order_res->pair;

	$pair_details = $this->common_model->getTableData('trade_pairs',array('id'=>$Pair),'from_symbol_id,to_symbol_id')->row();
	
	if($type=="buy")
	{
		$data = array('buyerStatus'=>"active");
		$where = array('tempId'=>$inserted,'buyorderId'=>$orderId);
		//$Currency_Id = $pair_details->from_symbol_id;
		$Currency_Id = $pair_details->to_symbol_id;
		$Currency_Symbol = getcryptocurrency($Currency_Id);
	}
	else
	{
		$data = array('sellerStatus'=>"active");
		$where = array('tempId'=>$inserted,'sellorderId'=>$orderId);
		$Currency_Id = $pair_details->to_symbol_id;
		$Currency_Symbol = getcryptocurrency($Currency_Id);
	}

	// Credit 1 SMD for every successful Trade
	// $user_data = $this->common_model->getTableData('users',array('id'=>$user_id))->row();
	// if($user_data->smd_balance > 0)
	// {
	// 	// Update the balance only if the user have any balance in referrals
	// 	$balance = getBalance($user_id,8,'crypto'); // get user bal
	// 	$finalbalance = $balance+1; // bal + dep amount
	// 	updateBalance($user_id,'8',$finalbalance,'crypto'); // Update balance

	// 	// Reduce the referral in user table
	// 	$new_smd_balance = $user_data->smd_balance - 1;
	// 	$updateTableData = array('smd_balance'=>$new_smd_balance);
	// 	$this->common_model->updateTableData('users', array('id' => $user_id), $updateTableData);
	// }

	// if($Refer_ID != '0'){
	// 	$Sent_Level_Commission = $this->common_model->sentLevelCommission($user_id, $Refer_ID, $Commission_Amount,'1','8');  //Currency_id = 3 USDT 
	// }

	$this->common_model->updateTableData('ordertemp',$where,$data);
	return true;
}

function orderpartialtype($orderId,$type,$inserted)
{
	//echo "partial";
	//echo "<br>";
	$trade_execution_type = $this->common_model->getTableData('site_settings',array('id'=>1),'trade_execution_type')->row('trade_execution_type');
	if($trade_execution_type==2)
	{
		$this->partialorder_balanceupdate($orderId,$inserted,$type);
	}
	return true;
}

function partialorder_balanceupdate($id,$inserted,$type) // sell
{	
	// $trade = $this->common_model->getTableData('coin_order',array('trade_id'=>$id),'userId,fee_per,Price,Type,pair,wallet,Fee,Total')->row();
	// $ordertemp = $this->common_model->getTableData('ordertemp',array('tempId'=>$inserted),'filledAmount,buyerUserid,sellerUserid,buyorderId,sellorderId')->row();

	$trade = $this->common_model->getTableData('coin_order',array('trade_id'=>$id))->row();
	$ordertemp = $this->common_model->getTableData('ordertemp',array('tempId'=>$inserted))->row();

	$tradeuserId            = $trade->userId;
	$fee_per               	= $trade->fee_per;
	$Price               	= $trade->Price;
	$tradeType              = $trade->Type;
	$tradepair			    = $trade->pair;
	$wallet 				= $trade->wallet;
	$tradeAmount			= $ordertemp->filledAmount;
	//echo "<br>";
	
	$pair_details = $this->common_model->getTableData('trade_pairs',array('id'=>$tradepair),'from_symbol_id,to_symbol_id')->row();
	if($wallet!="Margin Trading")
	{
		if($ordertemp->buyerUserid == $ordertemp->sellerUserid)
		{
			/*echo "same user";
			echo "<br>";*/
			if($type=="sell")
			{
				$trade_sell = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->sellorderId),'Fee,Total,Price,fee_per')->row();

				
				// $userbalance            = getTradingBalance($tradeuserId,$pair_details->from_symbol_id);
				$userbalance            = getBalance($tradeuserId,$pair_details->from_symbol_id);
                $sell_fee = $tradeAmount * ($trade_sell->fee_per/100);
				if(checkMarketingUser($tradeuserId) == '1')
				{
					$finalAmount = $tradeAmount;
				} else {
					$finalAmount = $tradeAmount - $sell_fee;
				}
				$updatebuyBalance       =   $userbalance+$finalAmount;

				//echo " Same User (SELL COND PAR-ORD) Tradeamt -> ".$tradeAmount." Sell Fee -> ".$sell_fee." Final AMt ->  ".$finalAmount." User ID ->  ";

				if(!empty($ordertemp->ac_price)){
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$id),array('Price'=>$ordertemp->ac_price));
				}


				if(!empty($ordertemp->ac_price) && !empty($ordertemp->wantPrice) && $ordertemp->wantPrice > $ordertemp->askPrice && $ordertemp->ac_type="buy"){ 
 
				$act_amt = 	$tradeAmount * $ordertemp->ac_price;
				$extra_amt = $tradeAmount * $ordertemp->wantPrice;
				$ac_buy_price = $extra_amt - $act_amt;
				// $userbalance_new            = getTradingBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				$userbalance_new = getBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				$updatebal = $userbalance_new+$ac_buy_price;
				// $updatebal = 3;

				//Margin check starts
				// $check_margin_balance = getmarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebal)
				// 	{
				// 		$updatebal = $updatebal - $check_margin_balance;
				// 		updatemarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebal;
				// 		updatemarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$rem_margin);
				// 		$updatebal = 0;
				// 	}
				// }
				// updateTradingBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$updatebal);
				
				// updateBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$updatebal);
				// Margin check ends
				} 

				//Margin check starts
				// $check_margin_balance = getmarginBalance($tradeuserId,$pair_details->from_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($tradeuserId,$pair_details->from_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($tradeuserId,$pair_details->from_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($tradeuserId,$pair_details->from_symbol_id,$updatebuyBalance);

				updateBalance($tradeuserId,$pair_details->from_symbol_id, $updatebuyBalance);
				// updateBalance($tradeuserId,$pair_details->from_symbol_id, 1);
				// Margin check ends

				
				$adminbalance        = getadminBalance(1,$pair_details->from_symbol_id); 
                $finaladmin_balance   = $adminbalance+$sell_fee; 
                $updateadmin_balance  = updateadminBalance(1,$pair_details->from_symbol_id,$finaladmin_balance);
			}
			else if($type=="buy")
			{
				$trade_buy = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->buyorderId),'Fee,Total,Price,fee_per')->row();
				
				
				$buytot = $tradeAmount * $trade_buy->Price;
				
				$buy_fee = $buytot * ($trade_buy->fee_per/100);

				if(checkMarketingUser($tradeuserId) == '1')
				{
					$finalTotal	=	$buytot;
				} else {
					$finalTotal	=	$buytot - $buy_fee;
				}
				
				
				// $userbalance            = getTradingBalance($tradeuserId,$pair_details->to_symbol_id);
				$userbalance            = getBalance($tradeuserId,$pair_details->to_symbol_id);
				$updatebuyBalance       =   $userbalance+$finalTotal;
 

				//echo " Same User (BUY COND PAR-ORD) Tradeamt -> ".$tradeAmount." Trade(Price) ".$trade_buy->Price."  Buy Fee -> ".$buy_fee." Final AMt ->  ".$finalTotal." Currency ID ->  ".$pair_details->to_symbol_id." Pre Balance ".$userbalance; 
				
				//Margin check starts
				// $check_margin_balance = getmarginBalance($tradeuserId,$pair_details->to_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($tradeuserId,$pair_details->to_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($tradeuserId,$pair_details->to_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($tradeuserId,$pair_details->to_symbol_id,$updatebuyBalance);
				
				updateBalance($tradeuserId,$pair_details->to_symbol_id,$updatebuyBalance);
				// updateBalance($tradeuserId,$pair_details->to_symbol_id, 2);

				// Margin check ends


				$adminbalance        = getadminBalance(1,$pair_details->to_symbol_id); // get admin bal
				
                $finaladmin_balance   = $adminbalance+$buy_fee; // bal + fee
                
                $updateadmin_balance  = updateadminBalance(1,$pair_details->to_symbol_id,$finaladmin_balance);
			}
		}
		else{
			
			if($type=="buy")
			{
				//echo " Partial  Buy Order";

			   $trade_sell = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->sellorderId),'Fee,fee_per')->row();
				// $userbalance            = getTradingBalance($tradeuserId,$pair_details->from_symbol_id);
			   $userbalance            = getBalance($tradeuserId,$pair_details->from_symbol_id);
                $sell_fee = $tradeAmount * ($trade_sell->fee_per/100);

				if(checkMarketingUser($tradeuserId) == '1')
				{
					$finalAmount = $tradeAmount;
				} else {
					$finalAmount = $tradeAmount - $sell_fee;
				}
                
				//$finalAmount = $tradeAmount;
				$updatebuyBalance = $userbalance+$finalAmount;

				//echo " PARTIAL ORDER BAL BUY IF -> user ID ->".$tradeuserId." CUR -> ".$pair_details->from_symbol_id." BE BAL -> ".$userbalance." FIN AMT -> ".$finalAmount." TRADEAMOUNT ".$tradeAmount;

				//Margin check starts
				// $check_margin_balance = getmarginBalance($tradeuserId,$pair_details->from_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($tradeuserId,$pair_details->from_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($tradeuserId,$pair_details->from_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($tradeuserId,$pair_details->from_symbol_id,$updatebuyBalance);
				
				updateBalance($tradeuserId,$pair_details->from_symbol_id,$updatebuyBalance);
				// updateBalance($tradeuserId,$pair_details->from_symbol_id, 3);
				// Margin check ends
				
                
                $admin_sell = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->sellorderId),'Fee,fee_per')->row();
                $admin_fee = $tradeAmount * ($admin_sell->fee_per/100);

				$adminbalance        = getadminBalance(1,$pair_details->from_symbol_id); // get admin bal
                $finaladmin_balance   = $adminbalance+$admin_fee; // bal + fee
                
                $updateadmin_balance  = updateadminBalance(1,$pair_details->from_symbol_id,$finaladmin_balance);
			}
			else if($type=="sell")
			{

				  

				//$trade_buy = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->buyorderId),'Fee,fee_per,Price')->row();

 

				$trade_buy = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->buyorderId))->row();
				
				$Order_Price = $ordertemp->ac_price;
				$buytot = $tradeAmount * $Order_Price;
				$buy_fee = $buytot * ($trade_buy->fee_per/100);
				if(checkMarketingUser($tradeuserId) == '1')
				{
					$finalTotal	=	$buytot;
				} else {
					$finalTotal	=	$buytot - $buy_fee;
				}
				
				//$finalTotal	=	$trade_buy->fin_total;

				if(!empty($ordertemp->ac_price)) {
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$id),array('Price'=>$ordertemp->ac_price));
				}


				if(!empty($ordertemp->ac_price) && !empty($ordertemp->wantPrice) && $ordertemp->wantPrice > $ordertemp->askPrice && $ordertemp->ac_type="buy"){ 
 
				$act_amt = 	$tradeAmount * $ordertemp->ac_price;
				$extra_amt = $tradeAmount * $ordertemp->wantPrice;
				$ac_buy_price = $extra_amt - $act_amt;
				// $userbalance_new            = getTradingBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				$userbalance_new            = getBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				$updatebal = $userbalance_new+$ac_buy_price;
				// $updatebal = 7;

				//Margin check starts
				// $check_margin_balance = getmarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebal)
				// 	{
				// 		$updatebal = $updatebal - $check_margin_balance;
				// 		updatemarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebal;
				// 		updatemarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$rem_margin);
				// 		$updatebal = 0;
				// 	}
				// }
				// updateTradingBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$updatebal);
				// updateBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$updatebal);
				// Margin check ends
				}  
 
				// $userbalance            = getTradingBalance($tradeuserId,$pair_details->to_symbol_id);
				$userbalance            = getBalance($tradeuserId,$pair_details->to_symbol_id);
				$updatebuyBalance       =   $userbalance+$finalTotal;
				// $updatebuyBalance       =   8; 

				 
				//echo " PARTIAL ORDER BAL SELL IF -> user ID ->".$tradeuserId." CUR -> ".$pair_details->to_symbol_id." BE BAL -> ".$userbalance." FIN AMT -> ".$finalTotal;
				//Margin check starts
				// $check_margin_balance = getmarginBalance($tradeuserId,$pair_details->to_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($tradeuserId,$pair_details->to_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($tradeuserId,$pair_details->to_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($tradeuserId,$pair_details->to_symbol_id,$updatebuyBalance);
				
				updateBalance($tradeuserId,$pair_details->to_symbol_id,$updatebuyBalance);
				// updateBalance($tradeuserId,$pair_details->to_symbol_id, 4);
				// Margin check ends
 

				$admin_buy = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->buyorderId),'Fee,fee_per,Price')->row();
                $admin_fee = ($tradeAmount * $admin_buy->Price) * ($admin_buy->fee_per/100);

				$adminbalance        = getadminBalance(1,$pair_details->to_symbol_id); // get admin bal
                $finaladmin_balance   = $adminbalance+$admin_fee; // bal + fee
                //echo "admin fee update";
               // echo "<br>";
                $updateadmin_balance  = updateadminBalance(1,$pair_details->to_symbol_id,$finaladmin_balance);
			}
		}
		
	}
	return true;
}

function integrate_remarket($insid)
{
	//echo "integrate market";
	$order = $this->common_model->getTableData('coin_order',array('trade_id'=>$insid))->row();
	$remarket_order_id	= 	$order->remarket_order_id;
	$old_remarket_id	=	$order->old_remarket_id;
	if($remarket_order_id&&$remarket_order_id!=0)
	{
		$pair			=	$order->pair;
		$joins 			= 	array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
		$where 			= 	array('a.id'=>$pair);
		$pair_details 	= 	$this->common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,a.to_symbol_id')->row();
		$pair_symbol	=	$pair_details->from_currency_symbol.'_'.$pair_details->to_currency_symbol;
		$cancel_order = $this->api->cancel_order($pair_symbol,$remarket_order_id);
		if($cancel_order&&isset($cancel_order['success'])&&$cancel_order['success']==1)
		{
			if($old_remarket_id!='')
			{
				$old_remarket_id=$old_remarket_id.','.$remarket_order_id;
			}
			else
			{
				$old_remarket_id=$remarket_order_id;
			}
			$this->common_model->updateTableData('coin_order',array('trade_id'=>$insid),array('old_remarket_id'=>$old_remarket_id));
		}
	}
	$remarket=getSiteSettings('remarket_concept');
	if($remarket==1)
	{
		if($order&&$order->status!='filled')
		{
			$pair			=	$order->pair;
			$Type			=	$order->Type;
			$activePrice	=	$order->Price;
			$activeAmount	= 	$order->Amount;
			$joins 			= 	array('currency as b'=>'a.from_symbol_id = b.id','currency as c'=>'a.to_symbol_id = c.id');
			$where 			= 	array('a.id'=>$pair);
			$pair_details 	= 	$this->common_model->getJoinedTableData('trade_pairs as a',$joins,$where,'b.currency_symbol as from_currency_symbol,c.currency_symbol as to_currency_symbol,a.to_symbol_id')->row();
			$pair_symbol	=	$pair_details->from_currency_symbol.'_'.$pair_details->to_currency_symbol;
			$activefilledAmount = $this->checkOrdertemp($insid,$Type.'orderId');
			if($activefilledAmount)
			{
				$activefilledAmount = $activeAmount-$activefilledAmount;
			}
			else
			{
				$activefilledAmount = $activeAmount;
			}
			$price=$activefilledAmount*$activePrice;
			if($price>=0.0001)
			{
				if($Type=='buy')
				{
					$order_detail = $this->api->buy($pair_symbol,$activePrice,$activefilledAmount);
				}
				else
				{
					$order_detail = $this->api->sell($pair_symbol,$activePrice,$activefilledAmount);
				}
				if($order_detail&&isset($order_detail['orderNumber'])&&$order_detail['orderNumber']!='')
				{
					$orderNumber=$order_detail['orderNumber'];
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$insid),array('remarket_order_id'=>$orderNumber));
					$resultingTrades=$order_detail['resultingTrades'];
					if(isset($resultingTrades)&&count($resultingTrades)>0)
					{
						foreach($resultingTrades as $trades)
						{
							$trades['order_id']		=	$orderNumber;
							$trades['created_on']	=	time();
							$total	=	$trades['total'];
							$this->common_model->insertTableData('remarket_trades', $trades);
							$orderid       	= $order->trade_id;
							$userId         = $order->userId;
							$Price          = $order->Price;
							$Amount         = $order->Amount;
							$Wallet        	= $order->wallet;
							$Total1			= $order->Total;
							$Fee1			= $order->Fee;
							$datetime       = date("Y-m-d H:i:s");
							$data           = array(											
												'askAmount'         =>  $Amount,
												'askPrice'          =>  $Price,
												'filledAmount'      =>  $total,
												'sellerStatus'      =>  "inactive",
												'buyerStatus'       =>  "inactive",
												"pair"              =>  $pair,
												"datetime"          =>  $datetime
												);
							if($Type=='buy')
							{
								$data['buyorderId']=$orderid;
								$data['buyerUserid']=$userId;
								$data['sellorderId']=0;
								$data['sellerUserid']=0;
							}
							else
							{
								$data['sellorderId']=$orderid;
								$data['sellerUserid']=$userId;
								$data['buyorderId']=0;
								$data['buyerUserid']=0;
							}
							$inserted=$this->common_model->insertTableData('ordertemp', $data);
							if($inserted)
							{
								$activefilledAmount = $this->checkOrdertemp($insid,$Type.'orderId');
								if($activefilledAmount)
								{
									$activefilledAmount = $activeAmount-$activefilledAmount;
								}
								else
								{
									$activefilledAmount = $activeAmount;
								}
								if(trim($total)==trim($activefilledAmount))
								{
									$this->ordercompletetype($orderid,$Type,$inserted);
									$trans_data = array(
									'userId'=>$userId,
									'type'=>ucfirst($Type),
									'currency'=>$pair_details->to_symbol_id,
									'amount'=>$Total1+$Fee1,
									'profit_amount'=>$Fee1,
									'comment'=>'Trade '.ucfirst($Type).' order #'.$orderid,
									'datetime'=>date('Y-m-d h:i:s'),
									'currency_type'=>'crypto'
									);
									$update_trans = $this->common_model->insertTableData('transaction_history',$trans_data);
								}
								else
								{
									$this->orderpartialtype($orderid,$Type,$inserted);
									$this->common_model->updateTableData('coin_order',array('trade_id'=>$orderid),array('status'=>"partially",'tradetime'=>date('Y-m-d H:i:s')));
								}
							}
						}
					}
				}
				else
				{
					$balance_alert=getSiteSettings('balance_alert');
					if($balance_alert==1)
					{
						$dst=getSiteSettings('contactno');
						$text='Error Occured while place '.$pair_symbol.' order using api on your poloniex acount. ';
						if(isset($order_detail['error']))
						{
							$text=$text.$order_detail['error'];
						}
						else
						{
							$text=$text.'Not enough balance in your account';
						}
						send_otp_msg($dst,$text);
					}
				}
			}
		}
	}


}

function partial_balanceupdate($id,$inserted,$type) // sell
{
	$trade = $this->common_model->getTableData('coin_order',array('trade_id'=>$id))->row();
	$ordertemp = $this->common_model->getTableData('ordertemp',array('tempId'=>$inserted))->row();
	
	$tradeuserId            = $trade->userId;
 
	$fee_per               	= $trade->fee_per;
	$Price               	= $trade->Price;
	$tradeType              = $trade->Type;
	$tradepair			    = $trade->pair;
	$wallet 				= $trade->wallet;
	$tradeAmount			= $ordertemp->filledAmount;
	
	$tradeFee			= $trade->Fee;
	//echo "<br>";
	$tradeTot = $trade->Total;

	$pair_details = $this->common_model->getTableData('trade_pairs',array('id'=>$tradepair),'from_symbol_id,to_symbol_id')->row();
	if($wallet!="Margin Trading")
	{	   
		if($ordertemp->buyerUserid == $ordertemp->sellerUserid)
		{
			if($type=="sell")
			{
				$trade_sell = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->sellorderId),'Fee,Total,Price,fee_per')->row();
               
				// $userbalance            = getTradingBalance($tradeuserId,$pair_details->from_symbol_id);
				$userbalance            = getBalance($tradeuserId,$pair_details->from_symbol_id);
                $sell_fee = $tradeAmount * ($trade_sell->fee_per/100);
				// if(checkMarketingUser($tradeuserId) == '1')
				// {
				// 	$finalAmount = $tradeAmount;
				// } else {
				// 	$finalAmount = $tradeAmount - $sell_fee;
				// }
				$finalAmount = $tradeAmount - $sell_fee;
				//$finalAmount = $tradeAmount;
				$updatebuyBalance       =   $userbalance+$finalAmount;
				// $updatebuyBalance       =   9;
				

				 //echo " SELL CU ".$pair_details->from_symbol_id." PRE BAL ".$userbalance." fin AMT ".$finalAmount." Trade Amount  ".$tradeAmount."  ";

				//Margin check starts
				// $check_margin_balance = getmarginBalance($tradeuserId,$pair_details->from_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($tradeuserId,$pair_details->from_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($tradeuserId,$pair_details->from_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($tradeuserId,$pair_details->from_symbol_id,$updatebuyBalance); 
				
				updateBalance($tradeuserId,$pair_details->from_symbol_id, $updatebuyBalance); 
				// updateBalance($tradeuserId,$pair_details->from_symbol_id, 5); 
				// Margin check ends
				
				$adminbalance        = getadminBalance(1,$pair_details->from_symbol_id);
                $finaladmin_balance   = $adminbalance+$sell_fee;
                $updateadmin_balance  = updateadminBalance(1,$pair_details->from_symbol_id,$finaladmin_balance);
			}
			else if($type=="buy")
			{

				//print_r($ordertemp);

				$trade_buy = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->buyorderId),'Fee,Total,Price,fee_per')->row();

				$trade_buy_up = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->sellorderId),'Fee,Total,Price,fee_per')->row();

				// if($trade_buy->Price>$trade_buy_up->Price){
				// 	$Order_Price = $trade_buy_up->Price;
				// }
				// else{
				// 	$Order_Price = $trade_buy->Price;
				// }   
 
				$Order_Price = $ordertemp->askPrice; 
				 
				//$buy_fee = ($tradeAmount * $Order_Price) * ($trade_buy->fee_per/100);
				

				$buy_tot = $tradeAmount * $Order_Price;
				$buy_fee = $buy_tot * ($trade_buy->fee_per/100);
				// if(checkMarketingUser($tradeuserId) == '1')
				// {
				// 	$finalTotal	=	$buy_tot;
				// } else {
				// 	$finalTotal	=	$buy_tot - $buy_fee;
				// }
				$finalTotal	=	$buy_tot - $buy_fee;
  
				// $userbalance            = getTradingBalance($tradeuserId,$pair_details->to_symbol_id);
				$userbalance            = getBalance($tradeuserId,$pair_details->to_symbol_id);
				$updatebuyBalance       =   $userbalance+$finalTotal;

				if(!empty($ordertemp->ac_price)){
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$id),array('Price'=>$ordertemp->ac_price));
				}


				if(!empty($ordertemp->ac_price) && !empty($ordertemp->wantPrice) && $ordertemp->wantPrice > $ordertemp->askPrice && $ordertemp->ac_type="buy" ){ 
 
				$act_amt = 	$tradeAmount * $ordertemp->ac_price;
				$extra_amt = $tradeAmount * $ordertemp->wantPrice;
				$ac_buy_price = $extra_amt - $act_amt;
				// $userbalance_new            = getTradingBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				$userbalance_new            = getBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				$updatebal  =   $userbalance_new+$ac_buy_price;

				//Margin check starts
				// $check_margin_balance = getmarginBalance($ordertemp->buyerUserid,$pair_details->from_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($ordertemp->buyerUserid,$pair_details->from_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($ordertemp->buyerUserid,$pair_details->from_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($ordertemp->buyerUserid,$pair_details->from_symbol_id,$updatebuyBalance); 
				// updateBalance($ordertemp->buyerUserid,$pair_details->from_symbol_id,$updatebuyBalance); 
				// Margin check ends

				}     

				
				//echo " BUY CU ".$pair_details->to_symbol_id." PRE BAL ".$userbalance." fin AMT ".$finalTotal." Trade Amount  ".$tradeAmount." ORDER  ".$Order_Price;

				//Margin check starts
				// $check_margin_balance = getmarginBalance($tradeuserId,$pair_details->to_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($tradeuserId,$pair_details->to_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($tradeuserId,$pair_details->to_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($tradeuserId,$pair_details->to_symbol_id,$updatebuyBalance); 
				
				updateBalance($tradeuserId,$pair_details->to_symbol_id, $updatebuyBalance); 
				// updateBalance($tradeuserId,$pair_details->to_symbol_id, 6); 
				// Margin check ends


				$adminbalance        = getadminBalance(1,$pair_details->to_symbol_id);
                $finaladmin_balance   = $adminbalance+$buy_fee;
                $updateadmin_balance  = updateadminBalance(1,$pair_details->to_symbol_id,$finaladmin_balance);
			}
		}
		else { 
			// echo "differ user  -> ";
			// echo "<br>";
			if($type=="buy")
			{
			   $trade_sell = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->sellorderId),'Amount,Total,Price,fee_per,Fee')->row();

				$fees2 = $tradeAmount * ($trade_sell->fee_per/100);
				$userbalance            = getBalance($tradeuserId,$pair_details->from_symbol_id);
				
				$finalAmount = $tradeAmount - $fees2;

				// First Currency Update//
				$updatebuyBalance       =   $userbalance+$finalAmount;

				// echo $tradeAmount.'---'.$trade_sell->fee_per.'---'.$fees2.'---'.$finalAmount;
				// echo "<br>";
				if(!empty($ordertemp->ac_price)){
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$id),array('Price'=>$ordertemp->ac_price));  
				}
             
				//echo " Want Price ".$ordertemp->wantPrice." ASK Price ".$ordertemp->askPrice." TYPE ".$ordertemp->ac_type; 

				//echo $finalAmount."Final TestGHS";
 
				//echo " PARTIAL BAL BUY IF -> user ID ->".$tradeuserId." CUR -> ".$pair_details->from_symbol_id." BE BAL -> ".$userbalance." FIN AMT -> ".$finalAmount;

				//Margin check starts
				// $check_margin_balance = getmarginBalance($tradeuserId,$pair_details->from_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($tradeuserId,$pair_details->from_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($tradeuserId,$pair_details->from_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($tradeuserId,$pair_details->from_symbol_id,$updatebuyBalance); 
				
				updateBalance($tradeuserId,$pair_details->from_symbol_id, $updatebuyBalance); 
				// updateBalance($tradeuserId,$pair_details->from_symbol_id, 7); 
				// Margin check ends

				
 
				$admin_sell = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->sellorderId),'Fee,fee_per')->row();
                $admin_fee = $tradeAmount * ($admin_sell->fee_per/100);
				$adminbalance        = getadminBalance(1,$pair_details->from_symbol_id);
                $finaladmin_balance   = $adminbalance+$admin_fee; 
                $updateadmin_balance  = updateadminBalance(1,$pair_details->from_symbol_id,$finaladmin_balance);
			} 
			else if($type=="sell")
			{
				$trade_buy = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->buyorderId),'Amount,Total,Price,fee_per,Fee')->row();

				$trade_buy_up = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->sellorderId),'Amount,Total,Price,fee_per, Fee')->row();

				// echo "<pre>";print_r($trade_buy);
				// echo "<pre>";print_r($trade_buy_up);
				// echo "<pre>";print_r($ordertemp);
				
				$Order_Price = $ordertemp->askPrice; 
				$Order_Amt = $ordertemp->filledAmount; 

				$trade_tot = $Order_Amt * $Order_Price;
                $buy_fee = $trade_tot * ($trade_buy->fee_per/100);

                $tTot = $trade_tot - $buy_fee;

				$userbalance            = getBalance($tradeuserId,$pair_details->to_symbol_id);
				$updatebuyBalance       =   $userbalance+$tTot;

				// echo $userbalance.'---'.$Order_Amt.'---'.$Order_Price.'---'.$trade_tot.'---'.$trade_buy->fee_per.'--'.$buy_fee.'--'.$tTot;
    //             echo "<br>";


				if(!empty($ordertemp->ac_price)){  
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$id),array('Price'=>$ordertemp->ac_price));
				}  
 
				//echo " ORDER PRICE SELL ->  ".$trade_buy_up->Price." ORDER PRICE BUY -> ".$trade_buy->Price." TYPE -> ".$trade->Type." USER ID -> ".$tradeuserId." ORDER PRICE -> ".$Order_Price." ORDER TEMP USER ID ".$ordertemp->sellerUserid." INSERTED ID ".$inserted." ACT PRICE ->".$Price; 

				if(!empty($ordertemp->ac_price) && !empty($ordertemp->wantPrice) && $ordertemp->wantPrice > $ordertemp->askPrice && $ordertemp->ac_type="buy"){ 
 
				$act_amt = 	$tradeAmount * $ordertemp->ac_price;
				$extra_amt = $tradeAmount * $ordertemp->wantPrice;
				$ac_buy_price = $extra_amt - $act_amt;
				// $userbalance_new            = getTradingBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				$userbalance_new = getBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				$updatebal  =   $userbalance_new+$ac_buy_price;
				// $updatebal  =   12;

				//Margin check starts
				// $check_margin_balance = getmarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebal)
				// 	{
				// 		$updatebal = $updatebal - $check_margin_balance;
				// 		updatemarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebal;
				// 		updatemarginBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$rem_margin);
				// 		$updatebal = 0;
				// 	}
				// }
				// updateTradingBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$updatebal); 
				// updateBalance($ordertemp->buyerUserid,$pair_details->to_symbol_id,$updatebal); 
				// Margin check ends

				
				} 

				 
				//Margin check starts
				// $check_margin_balance = getmarginBalance($tradeuserId,$pair_details->to_symbol_id);
				// if($check_margin_balance > 0)
				// {
				// 	if($check_margin_balance <= $updatebuyBalance)
				// 	{
				// 		$updatebuyBalance = $updatebuyBalance - $check_margin_balance;
				// 		updatemarginBalance($tradeuserId,$pair_details->to_symbol_id,0);
				// 	} else {
				// 		$rem_margin = $check_margin_balance - $updatebuyBalance;
				// 		updatemarginBalance($tradeuserId,$pair_details->to_symbol_id,$rem_margin);
				// 		$updatebuyBalance = 0;
				// 	}
				// }
				// updateTradingBalance($tradeuserId,$pair_details->to_symbol_id,$updatebuyBalance); 
				
				updateBalance($tradeuserId,$pair_details->to_symbol_id, $updatebuyBalance); 
				// updateBalance($tradeuserId,$pair_details->to_symbol_id, 8); 
				// Margin check ends
                
                $admin_buy = $this->common_model->getTableData('coin_order',array('trade_id'=>$ordertemp->buyorderId),'Fee,fee_per,Price')->row();
                $admin_fee = ($tradeAmount * $admin_buy->Price) * ($admin_buy->fee_per/100);

				$adminbalance        = getadminBalance(1,$pair_details->to_symbol_id);
                $finaladmin_balance   = $adminbalance+$admin_fee;
                $updateadmin_balance  = updateadminBalance(1,$pair_details->to_symbol_id,$finaladmin_balance);
			}
		}
		
	}
	return true;
}



// Trailing-Stop CRON
function check_ActivationTrailStop()
{
	$coin_order = $this->common_model->getTableData('coin_order',array('status'=>'stoptrailorder'))->result();
	// echo "<pre>";print_r($coin_order);die;
	if($coin_order) {
		foreach ($coin_order as $key => $co) {
			
			$pair_sym = str_replace("_", "", $co->pair_symbol);
			// $buy_rate = marketprice($co->pair);
			$url = file_get_contents("https://api.binance.com/api/v1/ticker/24hr?symbol=".$pair_sym);
            $ress = json_decode($url,true); 
            $lastPrice = $ress['lastPrice'];
            // $lastPrice = '9600';
            // echo '<br>'.$lastPrice.'<br>';
			if($co->Type == 'buy')
			{
				$trade_id = $co->trade_id;
				$act_type = $co->act_price;

				echo $act_type.'<='.$lastPrice.'<br>';
				if($lastPrice<=$act_type)
                {
                	echo 'TRUE--Buy-- '.$trade_id;
                	$this->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),array('status'=>'activationtrailorder'));
                } 
			} else {

				$trade_id = $co->trade_id;
				$act_type = $co->act_price;

				echo $lastPrice.'>='.$act_type.'<br>';
				if($lastPrice>=$act_type)
                {
                	echo 'TRUE--Sell-- '.$trade_id;
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$trade_id),array('status'=>'activationtrailorder'));
			    } 
			}
		}
	}
}

function check_ActiveTrailStop()
{
	$coin_order = $this->common_model->getTableData('coin_order',array('status'=>'activationtrailorder'))->result();
	// echo "<pre>";print_r($coin_order);die;
	if($coin_order) {
		foreach ($coin_order as $key => $co) {
			
			$trade_id = $co->trade_id;
			$pair_sym = str_replace("_", "", $co->pair_symbol);
			// $buy_rate = marketprice($co->pair);
			$url = file_get_contents("https://api.binance.com/api/v1/ticker/24hr?symbol=".$pair_sym);
            $ress = json_decode($url,true); 
            $lastPrice = $ress['lastPrice'];
            // $lastPrice = '9780';

            echo $co->Type.' --- lastPrice - '.$lastPrice. ' -----> Price Start - '.$co->price_start. ' ----- Price Stop - '.$co->price_stop. '<br>';
			
			if($co->Type=='sell') {
				// echo "SELL";
				$actPrice = $co->act_price;
	            $Price = $co->Price;
	            $d = $co->delta;
	            $c1 = ($d / 100) * $lastPrice;
	            $updatePE = $lastPrice - $c1;

	            if($co->price_start < $lastPrice) {

	            	echo 'SELL TYPE ---> Updated START PRICE -----> '.$co->price_start.'<br>';
					$updateData = array( 'price_start'=>$lastPrice );
	            	$this->common_model->updateTableData('coin_order',array('trade_id'=>$co->trade_id), $updateData);
	            } else if(($co->price_start > $lastPrice) && ($co->price_stop < $updatePE) && ($co->Price <= $updatePE)) {

					echo 'BUY TYPE ---> Updated STOP PRICE -----> '.$updatePE;
					$updateData = array( 'price_stop'=>$updatePE );
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$co->trade_id), $updateData);

				} else if($co->price_stop >= $lastPrice) {

					echo 'BUY TYPE ---> STOP PRICE - '. $lastPrice.'--'.$co->price_stop;
	            	$this->common_model->updateTableData('coin_order',array('trade_id'=>$co->trade_id),array('status'=>'active'));
	            	$this->initialize_mapping($trade_id);
				}

			} else {
				// echo "BUY";
				$actPrice = $co->act_price;
	            $Price = $co->Price;
	            $d = $co->delta;
	            $c1 = ($d / 100) * $lastPrice;
	            $updatePE = $lastPrice + $c1;

				if($co->price_start > $lastPrice) {

					echo 'BUY TYPE ---> Updated START PRICE -----> '.$co->price_start.'<br>';
					$updateData = array( 'price_start'=>$lastPrice );
	            	$this->common_model->updateTableData('coin_order',array('trade_id'=>$co->trade_id), $updateData);

				} else if(($co->price_start < $lastPrice) && ($co->price_stop > $updatePE) && ($co->Price >= $updatePE)) {

					echo 'BUY TYPE ---> Updated STOP PRICE -----> '.$updatePE;
					$updateData = array( 'price_stop'=>$updatePE );
					$this->common_model->updateTableData('coin_order',array('trade_id'=>$co->trade_id), $updateData);

				} else if($co->price_stop <= $lastPrice) {

					echo 'BUY TYPE ---> STOP PRICE - '. $lastPrice.'--'.$co->price_stop;
	            	$this->common_model->updateTableData('coin_order',array('trade_id'=>$co->trade_id),array('status'=>'active'));
	            	$this->initialize_mapping($trade_id);
				}
			}
        }
    }
}




}
