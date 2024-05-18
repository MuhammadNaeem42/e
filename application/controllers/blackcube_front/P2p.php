<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: PUT, GET, POST, FILES");
if(isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
  $_POST = array_merge($_POST, (array) json_decode(trim(file_get_contents('php://input')), true));
}


class P2p extends CI_Controller {
 public function __construct()
  { 
    parent::__construct();    
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
    $this->load->library(array('form_validation'));
    $this->load->library('session');
    $this->load->helper(array('url', 'language'));
    $this->load->library('pagination');
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
    $sitelan = $this->session->userdata('site_lang'); 
  }
 public function index(){
 $data['currency']=$this->common_model->getTableData('currency')->result();
 $data['country'] = $this->common_model->getTableData('countries')->result();
 $data['service'] = $this->common_model->getTableData('service')->result();
 $this->load->view('front/p2p/post-ad',$data);
  }
public function postnext(){
 $data['currency']=$this->common_model->getTableData('currency')->result();
 $data['country'] = $this->common_model->getTableData('countries')->result();
 $data['service'] = $this->common_model->getTableData('service')->result();
 $this->load->view('front/p2p/post-ad-next',$data);
}

 function chat($type,$trade_id,$tradeorderid){

    $user_id=$this->session->userdata('user_id');
    if($user_id=="")
    { 
      $this->session->set_flashdata('success', $this->lang->line('you are not logged in'));
      redirect(base_url().'home');
    }

    $data['site_common'] = site_common();
    $data['tradeorder']  = $this->common_model->getTableData('p2ptradeorder', array('id' => $tradeorderid))->row();
    $data['gettrade']    = $this->common_model->getTableData('p2p_trade', array('tradeid' => $trade_id))->row();
    
    $data['payment'] = get_servicename($data['gettrade']->payment_method);

    // print_r($data['tradeorder']);

    // echo $this->db->last_query();
    // exit();

    $get_status=$this->common_model->getTableData('p2ptradeorder',array('id'=>$tradeordid))->row();
    $data['dispute_status']=$get_status->dispute_status;
    $this->load->view('front/p2p/p2p_chart',$data);


    }
  
public function offer(){
 

  $user_id=$this->session->userdata('user_id');
  if($user_id=="")
  { 
    $this->session->set_flashdata('success', $this->lang->line('you are not logged in'));
    redirect(base_url().'home');
  }
 $data['user_id'] = $user_id; 
 $data['site_common'] = site_common(); 
 $data['currency']=$this->common_model->getTableData('currency',array('status'=>'1'))->result();
 $data['country'] = $this->common_model->getTableData('countries')->result();
 $data['service'] = $this->common_model->getTableData('service',array('status'=>1))->result();
 $data['p2p_trade'] = $this->common_model->getTableData('p2p_trade')->result();


 $this->load->view('front/p2p/offer',$data);
}
public function create_offer(){
  $user_id=$this->session->userdata('user_id'); 
  $data['site_common'] = site_common(); 
  $data['action'] = front_url() . 'create_offer';

$kyc = getUserDetails($user_id);
$kyc_status=$kyc->verify_level2_status;
  if($kyc_status != 'Completed'){

    $this->session->set_flashdata('error','KYC is Not Completed');
    front_redirect('offer','refresh');

  }

if($user_id=='') redirect('login');   

  
  

if($this->input->post('submit_create')){
  
  // echo "<pre>";
  // print_r($this->input->post());
  // echo "<pre>";
  // exit();


  $user_id=$this->session->userdata('user_id');
  $crypto = $this->db->escape_str($this->input->post('cryptocurrency'));
  $currency = $this->db->escape_str($this->input->post('fiat_currency'));
  $commission = $this->db->escape_str($this->input->post('commission'));
  $trade_amount = $this->db->escape_str($this->input->post('trade_amount'));
  $minimum_limit = $this->db->escape_str($this->input->post('minimum_limit'));
  $maximum_limit = $this->db->escape_str($this->input->post('maximum_limit'));
  $instraction = $this->db->escape_str($this->input->post('instraction'));
  $price = $this->db->escape_str($this->input->post('price'));
  $actualtrade = $this->db->escape_str($this->input->post('type'));
  $payment = $this->db->escape_str($this->input->post('payment'));
  $country = $this->db->escape_str($this->input->post('country'));
  $traderandom = mt_rand(10000000,99999999);




if($actualtrade=='buy'){
  $type="Sell";
}else{
  $type="Buy";
}

  $insert_offer=array(
    'cryptocurrency'=>$crypto,
    'country'=>$country,
    'price'=>$price,
    'trade_amount'=>$trade_amount,
    'payment_method'=>$payment,
    'minimumtrade'=>$minimum_limit,
    'maximumtrade'=>$maximum_limit,
    'fiat_currency'=>$currency,
    'comission'=>$commission,
    'addtional_info'=>$addinstraction,
    'terms_conditions'=>$instraction,
    'type'=>$type,
    'actualtradebuy'=>$actualtrade,
    'user_id'=>$user_id,
    'tradeid'=>$traderandom,
    'datetime'=>date("Y-m-d h:i:s"),
  );
   // print_r($insert_offer);
   //  exit();
   $user_data_clean = $this->security->xss_clean($insert_offer);
   $id=$this->common_model->insertTableData('p2p_trade', $user_data_clean);

   if($actualtrade=='sell')
   {
    // Seller Get Balance 
    $userbalance = getBalance($user_id,$crypto);
    if($userbalance >= $trade_amount)
    {
          $finalbalance=$userbalance-$trade_amount;
          // Update user balance  
          $updatebalance = updateBalance($user_id,$crypto,$finalbalance);
    }
    else
    {
        $this->session->set_flashdata('error', 'Amount you have entered is more than your current balance');
        front_redirect('offer','refresh');
     }

   }


  $this->session->set_flashdata('success','Order Created successfully');
  front_redirect('offer','refresh');

  }

$data['currency']=$this->common_model->getTableData('currency')->result();
$data['fiatcurrency']=$this->common_model->getTableData('fiat_currency',array('status' => 1))->result();
$data['country'] = $this->common_model->getTableData('countries')->result(); 
$data['services'] = $this->common_model->getTableData('service')->result();
$data['userInfo'] = $this->common_model->getTableData('users', array('id' => $user_id))->row();

$this->load->view('front/p2p/create_offer',$data);



}

public function create_two(){
if($this->input->post('submit_one')){
$data['create_offer']=array(
      'type'=>$this->input->post('type'),
      'cypto_coin'=>$this->input->post('crypto_coin'),
      'fiat'=>$this->input->post('fiat_currency'),
      'offer_price'=>$this->input->post('offer_price'),
      'lowest_price'=>$this->input->post('lowest_price'),
      'price_type'=>$this->input->post('price_type'),
      'cypto_id'=>getCoinId($this->input->post('crypto_coin')),
    );
$data['service'] = $this->common_model->getTableData('service')->result();
$this->load->view('front/p2p/create_two',$data);  
  }

}

   public function dispute(){
    // echo "test";
    // exit();

      if($this->input->post())
      {


      
        $traderandom = mt_rand(10000000,99999999);

        $updateadmin = array('rand_code'=>$traderandom);

        $this->common_model->updateTableData('admin',array('id'=>1),$updateadmin);  
        
        $message=$this->input->post('reason');
        $tradeid=$this->input->post('tradeid');
        $tradeorderid=$this->input->post('tradeorderid');
        $type=$this->input->post('type');
        $user_id = $this->input->post('user_id');
        // $username=$this->db->escape_str($this->input->post('username'));

        $gettradeorder = $this->common_model->getTableData('p2ptradeorder', array('id' => $tradeorderid))->row();

        $buyer = UserName($gettradeorder->buyerid);
        $seller = UserName($gettradeorder->sellerid);

        $username = $this->common_model->getTableData('users', array('id' => $user_id))->row('blackcube_username');

        $admin='admin';
        $url=front_url() . 'p2ptrade/'.$tradeorderid.'/'.$tradeid.'/'.$admin;

        $dispute=array(
        'tradeorderid'=>$tradeorderid,
        'tradeid'=>$tradeid,
        'type'=>$type,
        'link'=>$url,
        'status'=>'0',
        'message'=>$message,
        'username'=>$username

       );

        


       $insert = $this->common_model->insertTableData('dispute', $dispute);
     if($insert){

        $condition=array(
            'id'=>$tradeid,
        );

        $updateData=array(
            'dispute_status'=>'1',

        );

          $update = $this->common_model->updateTableData('p2ptradeorder',$condition,$updateData);
          $admin='admin';
          $email_templats = 'Dispute_user_request';
          $special_varsseller = array(
         '###SENDER###' => $username,  
         '###BUYER###' => $buyer,
         '###SELLER###' => $buyer,
         '###TRADEID###'=> "#".$tradeid,
         '###REASON###'=> $message,
         '###LINK###' => base_url().'trade/'.$tradeorderid.'/'.$tradeid);
          
          $enc_email = getAdminDetails('1','email_id');
          // $email = decryptIt($enc_email);

          $email = 'sriayyappan@spiegeltechnologies.com';

          $this->email_model->sendMail($email, '', '', $email_templats, $special_varsseller);
          // $this->session->set_flashdata('success', 'Please wait for admin will chat with you');
          
          $data['msg'] = 'Please wait for admin will chat with you';
          $data['status'] = 'success';  


         }else{
          
          $data['msg'] = 'Invalid Try Again1';
          $data['status'] = 'error';


         }
      }
      else
      {
         $data['msg'] = 'Invalid Try Again-- Post';
         $data['status'] = 'error';
      } 

      echo json_encode($data);            


}

public function create_offersave(){

$user_id=$this->session->userdata('user_id');  

  $kyc = getUserDetails($row->user_id);
 $kyc_status=$kyc->verify_level2_status;
 //  if($kyc_status != 'Completed'){
 //     $this->session->set_flashdata('error','KYC is Not Completed');
 // front_redirect('offer','refresh');

 //  }
if($this->input->post('submit_two')){

$type=$this->input->post('type');

if($type=='buy'){
  $actualtype="sell";
}else{
   $actualtype="buy";
}
$amount=$this->input->post('amount');
$cytoid=$this->input->post('cypto_id');
 $userbalance = getBalance($user_id,$cytoid);

if($userbalance < $amount){
  $this->session->set_flashdata('error','Your Wallet Balance low');
              front_redirect('offer','refresh');

}
$finalbalance=$userbalance-$amount;
                    // Update user balance  
$updatebalance = updateBalance($user_id,$cytoid,$finalbalance,'');
$traderandom = mt_rand(10000000,99999999);
$data=array(
'user_id'=>$user_id,
'cryptocurrency'=>$this->input->post('cypto_id'),
'payment_method'=>$this->input->post('payment'),
'minimumtrade'=>$this->input->post('minamount'),
'maximumtrade'=>$this->input->post('maxamount'),
'type'=>$actualtype,
'actualtradebuy'=>$type,
'price'=>$this->input->post('amount'),
'payment_method'=>$this->input->post('payment'),
'currency'=>$this->input->post('fiat'),
'price_type'=>$this->input->post('offer_price'),
'paymenttime'=>$this->input->post('paymenttime'),
'tradeid'=>$traderandom,
'terms_conditions'=>$this->input->post('terms'),
    );
 $user_data_clean = $this->security->xss_clean($data);
 $id=$this->common_model->insertTableData('p2p_trade', $user_data_clean);

      $this->session->set_flashdata('success','Order Created successfully');
              front_redirect('offer','refresh');

  }

}

public function p2p_gettrade(){

  if($this->input->post('type')){
     // $this->load->library('pagination');
     $type=$this->input->post('type');
    $array=array('type'=> $type,);
    $data['get_record'] = $this->common_model->getTableData('p2p_trade',$array)->result();

  //   print_r($data['get_record']);

  // exit();

    }
    if($this->input->post('search')){
           $price=$this->input->post('search');
            $currency=$this->input->post('cryptocurrency');
            $type=$this->input->post('type');
    $data['get_record'] = $this->common_model->customQuery("SELECT * FROM blackcube_trade WHERE price LIKE '$price%' AND cryptocurrency LIKE '$currency%' AND type LIKE '$type%'")->result();

    }
        if($this->input->post('coin')){
           $coin=$this->input->post('coin');
           $type=$this->input->post('type');
                     $check_coin=array(
                 'cryptocurrency'=>$coin,
                 'type'=>$type  );
           
    $data['get_record'] = $this->common_model->getTableData('p2p_trade',$check_coin)->result();

    }

     if($this->input->post('payment')){
             $payment=$this->input->post('payment');
             $cat=$this->input->post('cat');
          $check_payment=array(
              'payment_method'=>$payment,
            );    
    $data['get_record'] = $this->common_model->getTableData('p2p_trade',$check_payment)->result();

    }

    $data['user_id']=$this->session->userdata('user_id'); 
    // print_r($data);die;
    $this->load->view('front/p2p/gettrades',$data);

}

  

public function p2porder()
{
    $user_id=$this->session->userdata('user_id');
    if($user_id=="")
    { 
      $this->session->set_flashdata('success', $this->lang->line('you are not logged in'));
      redirect(base_url().'home');
    }

    if($this->input->post('trade_btn'))
    {

    


        $id=$this->db->escape_str($this->input->post('trade_id'));
        $gettrade = $this->common_model->getTableData('p2p_trade', array('tradeid' => $id))->row();
        
        $crypto_amt =  $this->db->escape_str($this->input->post('cryptocurrency'));
        $insertData['tradeid'] = $this->db->escape_str($this->input->post('trade_id'));
        
        $insertData['crypto_amount'] =   $this->db->escape_str($this->input->post('cryptocurrency'));
        $insertData['fiat_amount'] =  $this->db->escape_str($this->input->post('fiat_currency'));

        $insertData['fiat_currency']=  $gettrade->fiat_currency;
        $insertData['cryptocurrency']= $gettrade->cryptocurrency;

        $insertData['escrowamount'] = $this->db->escape_str($gettrade->trade_amount);
        $insertData['tradeopentime'] =  date("Y-m-d H:i:s");
        $insertData['escrowstatus'] = 'waiting';             
        $insertData['type'] = $gettrade->type;

        if($gettrade->actualtradebuy == 'sell'){
          $insertData['sellerid'] =   $gettrade->user_id;
          $insertData['buyerid'] = $user_id;
        } else {
          $insertData['sellerid'] =  $user_id;
          $insertData['buyerid'] =  $gettrade->user_id;
        }
        
        $insertData['user_id']= $user_id;
        $insertData['tradestatus'] = 'open';


            if($crypto_amt < $gettrade->minimumtrade)
            {
              $this->session->set_flashdata('error','Amount you have entered is less than minimum p2p limit');
              front_redirect('create_offer','refresh');
            }
            elseif($crypto_amt > $gettrade->maximumtrade)
            {
              $this->session->set_flashdata('error', 'Amount you have entered is more than maximum p2p limit');
              front_redirect('create_offer','refresh');  
            }
            

        else {



        $insert = $this->common_model->insertTableData('p2ptradeorder', $insertData);
        if($insert)
        {
         
         $link=base_url().'p2ptrade/'.$gettrade->type.'/'.$id.'/'.$insert;
         $this->common_model->updateTableData('p2ptradeorder',array('id'=>$insert),array('link'=>$link));
         $this->common_model->updateTableData('p2p_trade',array('tradeid'=>$id),array('tradestatus'=>'filled'));
         $checktrade = $this->common_model->getTableData('p2p_trade', array('tradeid' => $id))->row();
         $checktradeorder=  $this->common_model->getTableData('p2ptradeorder', array('id' => $insert))->row();
        
         $buyerusername = $this->common_model->getTableData('users', array('id' => $user_id))->row('blackcube_username');
         $sellername = $this->common_model->getTableData('users', array('id' => $gettrade->user_id))->row('blackcube_username');
        
        $insopenchat['added'] =  date("Y-m-d H:i:s");
        $insopenchat['user_id'] = $user_id;
        $insopenchat['tradeuser_id'] = $gettrade->user_id;
        $insopenchat['tradeid'] = $gettrade->tradeid;
        $insopenchat['username'] = $buyerusername;
        $insopenchat['tradeorderid'] = $insert;
        $insopenchat['imagetype'] = "alertmsg";
        $insopenchat['tradestatus'] = "open";
        $insopenchat['comment'] = "The Buyer will have ".$gettrade->offertime." minutes to make their payment and click on the PAID button before the trade expires.";

        $this->common_model->insertTableData('p2pchat_history', $insopenchat);   
        
        $getcrypto=$this->common_model->getTableData('currency', array('id' => $gettrade->cryptocurrency))->row();
        $buyeremail=getUserEmail($user_id);
        $selleremail=getUserEmail($gettrade->user_id);                                  

           // Update user balance  
           // $updatebalance = updateBalance($checktrade->user_id,$checktrade->cryptocurrency,$finalbalance,'');
           // check to see if we are Seller
           $email_templats = 'Trade_user_requests';
           $special_varsseller = array(
           '###USERNAME###' => $sellername,
           '###BUYER###' => $buyerusername,
           '###AMOUNT###'   =>  $checktradeorder->amount,
           '###COIN###'  =>   $checktradeorder->amtofbtc,
           '###TRADCURRENCY###' =>  $gettrade->currency,
           '###TRADEID###'=> "#".$id,
           '###CRYPTO###'=> $getcrypto->currency_symbol,
           '###LINK###' => base_url().'p2ptrade/'.$id.'/'.$insert);

            $this->email_model->sendMail($selleremail, '', '', $email_templats, $special_varsseller);

            // check to see if we are Buyer
            $email_template = 'Trade_order_confirmation_confirmation';
         
             $special_varsbuyer = array(
             '###USERNAME###' => $buyerusername,
             '###AMOUNT###'   =>  $checktradeorder->amount,
             '###COIN###'  =>   $checktradeorder->amtofbtc,
             '###TRADCURRENCY###' =>  $gettrade->currency,
             '###TRADEID###'=> "#".$id,
             '###CRYPTO###'=> $getcrypto->currency_symbol,
             '###LINK###' => base_url().'p2ptrade/'.$id.'/'.$insert);

            $this->email_model->sendMail($buyeremail, '', '', $email_template, $special_varsbuyer);
           
            if($gettrade->type=='Buy'){
                  $this->session->set_flashdata('success', 'P2P Trade Started.Successfully Placed !');
                  redirect('p2p_chart/'.$gettrade->type.'/'.$id.'/'.$insert, 'refresh');
                } else {

                  $this->session->set_flashdata('success', 'P2P Trade Started.Successfully Placed !');
                  redirect('p2p_chart/'.$gettrade->type.'/'.$id.'/'.$insert, 'refresh');
                  
                }
        }

       } 



    }
}



// Order Confirm Start


public function p2p_orderconfirm($tradeuser,$tradeid)
{
                    
      // $user_id=$this->session->userdata('user_id');
      // if($user_id=="")
      // { 
      //   $this->session->set_flashdata('success', $this->lang->line('you are not logged in'));
      //   redirect(base_url().'home');
      // }



      if($tradeuser!='' && $tradeid!=''){

      $tradebuyerid = $tradeuser;
      $gettrade=  $this->common_model->getTableData('p2p_trade',array('tradeid'=>$tradeid))->row();
      $chart_det =  $this->common_model->getTableData('p2pchat_history',array('tradeid'=>$tradeid))->row();
      $get_user_id = $chart_det->tradeuser_id;
      
      $tradeordid= $tradeid;
      $sellertradeorder=$this->common_model->customQuery("select * from blackcube_p2ptradeorder where tradeid='".$tradeordid."' and id='".$gettrade->id."' and buyerid='".$tradebuyerid."' order by id desc limit 1")->row();
        $confirmtrade = 1;
        $condition = array('id' => $sellertradeorder->id,'buyerid'=>$tradebuyerid); 
        $updateData=array();
        $updateData['paymentconfirm'] = $confirmtrade;
        $updateData['tradestatus'] = 'paid';
        $updateData['paidtime'] = date("Y-m-d H:i:s");
        $update = $this->common_model->updateTableData('p2ptradeorder',$condition,$updateData);
        if($update){ 
        $buyerdet = $this->common_model->getTableData('users', array('id' => $tradebuyerid))->row();
        
        $inspaidchat['added'] =  date("Y-m-d H:i:s");
        $inspaidchat['user_id'] = $buyerdet->id;
        $inspaidchat['tradeuser_id'] = $get_user_id;
        $inspaidchat['tradeid'] = $gettrade->tradeid;
        $inspaidchat['username'] = $buyerdet->blackcube_username;
        $inspaidchat['tradeorderid'] = $sellertradeorder->id;
        $inspaidchat['imagetype'] = "alertmsg";
        $inspaidchat['tradestatus'] = "paid";
        $inspaidchat['comment'] = "The vendor is now verifying your payment.If you have not paid then you may be reported for coin locking and your account suspended.Once the vendor confirms payment bitcoins will be released escrow to your wallet";

        $insertdata = $this->common_model->insertTableData('p2pchat_history', $inspaidchat);

        if($insertdata)
        {
          $data['status'] = 'success';
          $data['msg'] = 'Seller has confirmed your payment, they will cryptos released to your Wallet..';
        }
        else
        {
          $data['status'] = 'error';
          $data['msg'] = 'Unable to submit your  request. Please try again ';
        }

      }

     }
     else
     {
         $data['status'] = 'error';
         $data['msg'] = 'Unable to submit your  request. Please try again ';
     } 



      echo json_encode($data);


}


// Order Confirm End



// Seller Release Section Start


public function p2p_release($tradeid,$trade_orderid)
{




  if($tradeid!='' && $trade_orderid!='') {
   $tradeid        = $tradeid;
   $trade_orderid  = $trade_orderid;
   $trade_details = $this->common_model->getTableData('p2p_trade',array('tradeid'=>$tradeid))->row();
   $tradeorder =  $this->common_model->getTableData('p2ptradeorder',array('tradeid'=>$tradeid,'id'=>$trade_orderid),'','','','','',array('id','DESC'))->row();

   if(isset($tradeorder)) {

    $condition = array('id' => $tradeorder->id,'sellerid'=>$tradeorder->sellerid);                      
    $updateData=array();


    if($trade_details >= $tradeorder->crypto_amount) {


      $updateorder = $trade_details->trade_amount - $tradeorder->crypto_amount;
      $updatetrade['trade_amount'] =  $updateorder;
      $conditionnew = array('tradeid' => $tradeid);   
      $update = $this->common_model->updateTableData('p2p_trade',$conditionnew,$updatetrade);
   

      //$updateData['paymentconfirm'] = $confirmtrade;
      $updateData['escrowstatus'] =  'Realsed';
      $updateData['tradestatus'] =  'completed';
      $update = $this->common_model->updateTableData('p2ptradeorder',$condition,$updateData);


      if($trade_details->actualtradebuy=='buy')
      {

        $sellerbalance=getBalance($tradeorder->sellerid,$tradeorder->cryptocurrency);
        $sellupdate= $sellerbalance - $tradeorder->crypto_amount;
        $updatebalancebuy = updateBalance($tradeorder->sellerid,$tradeorder->cryptocurrency,$sellupdate);

      }

    // Seller Balance Update End

    // Buyer Balance Update Start
    $buyerbalance=getBalance($tradeorder->buyerid,$tradeorder->cryptocurrency);
    $buyupdate=$buyerbalance + $tradeorder->crypto_amount; 
    $updatebalancesell = updateBalance($tradeorder->buyerid,$tradeorder->cryptocurrency,$buyupdate);
    // Buyer Balance Update End

    if($update)
    {

      $data['status'] ='success';
      $data['msg'] ='Fund Realsed Successfully!';
      
    }
    else
    {
      $data['status'] ='error';
      $data['msg'] ='Invalid Please Try Again!';
    }

  }
  else
  {
      $data['status'] ='error';
      $data['msg'] ='Amount you have entered is more than your Trade Amount';
  }


  }
  else
  {
      $data['status'] ='error';
      $data['msg'] ='Invalid Please Try Again!';
  }

    echo json_encode($data);

  }


}


public function p2p_chat($tradeid,$tradeorderid)
{

  if($tradeid!='' && $tradeorderid!='')
  {
    $data['chats']=$this->common_model->getTableData('p2pchat_history',array('tradeid'=>$tradeid,'tradeorderid' => $tradeorderid,'imagetype' =>'real'))->result();
    if(isset($data['chats']))
    {
       echo json_encode($data);
    }


  }


}


public function p2psend_message()
{


// echo "Hello---> "; 
// print_r($_FILES);
// exit();

  if($this->input->post())
  {
    
    $trade_id = $this->input->post('tradeid');
    $tradeorderid = $this->input->post('tradeorderid');
    $admin_status = $this->input->post('admin_status');
    $messsage = strip_tags(trim($this->input->post('chat_message')));
    $user_id = $this->input->post('user_id');

    if($messsage!='') {

      $image = $_FILES['image']['name']; 
      if($image!="") {
        if(getExtension($_FILES['image']['type']))
        {   

          $Img_Size = $_FILES['image']['size'];
          $uploadimage1=cdn_file_upload($_FILES["image"],'uploads/user/'.$user_id);
          if(is_array($uploadimage1))
          {
            $image=$uploadimage1['secure_url'];

          }
          else
          {
            $image = 'error First';
             $data['status'] ='error';
            $data['msg'] ='Not Uploaded Please try Again!---';
          }
          $image=$image;
        }
        else
        {

          $data['status'] ='error';
          $data['msg'] ='Please upload proper image format';
          $image = 'error';

        }
      } 
      else 
      { 
        $image = "";
      }



    $trade_details = $this->common_model->getTableData('p2p_trade',array('tradeid'=>$trade_id))->row();
    $tradeorder_details = $this->common_model->getTableData('p2ptradeorder',array('id'=>$tradeorderid))->row();

    if($admin_status=='1')
       $user_type = 'Admin';
    else if($tradeorder_details->buyerid==$user_id)
      $user_type = 'Buyer';
    else if($tradeorder_details->sellerid==$user_id)
      $user_type = 'Seller';
    

    if($admin_status=='1')
    {
     
      $username = 'Admin'; 
    }
    else
    {
       $username = UserName($user_id);  
    }
    

    $message_data = array(

      "user_id" => $user_id,
      "username" => $username,
      "user_type" => $user_type,
      "comment" => $messsage,
      "user_id" => $user_id,
      "admin_status" => $admin_status,
      "added" => date('Y-m-d H:i:s'),
      "tradestatus" => $tradeorder_details->tradestatus,
      "tradeuser_id" => $trade_details->user_id,
      "tradeid" => $trade_id,
      "imagetype" => 'real',
      "tradeorderid" => $tradeorderid,
      "sellerid" => '0',
      "image" => $image

    );

     $send = $this->common_model->insertTableData('p2pchat_history', $message_data);
     if($send)
     {
      $data['status'] ='success';
      $data['msg'] ='Message Send Successfully';
     }
     else
     {
      $data['status'] ='error';
      $data['msg'] ='Wrong Please try Again!';
     }

    }
    else
    {
      $data['status'] ='error';
      $data['msg'] ='Please Enter Message!';

    } 

     echo json_encode($data);


  }



}




 public function history(){


  $user_id = $this->session->userdata('user_id');
  if($user_id=="")
  { 
    $this->session->set_flashdata('success', $this->lang->line('you are not logged in'));
    redirect(base_url('home'));
  }

  $data['site_common'] = site_common();
  $where   = array('buyerid'=>$user_id);
  $whereor = array('sellerid'=>$user_id);
  $data['p2p_orders'] = $this->common_model->getTableData('p2ptradeorder',$where,'','',$whereor,'','','',array('id','DESC'))->result();

  $data['p2p_openorders'] = $this->common_model->getTableData('p2p_trade',array('user_id'=>$user_id),'','','','','','',array('id','DESC'))->result();
  



  $this->load->view('front/p2p/history',$data);
 }


 public function cancel($id=''){


  $user_id = $this->session->userdata('user_id');
  if($user_id=="")
  { 
    $this->session->set_flashdata('success', $this->lang->line('you are not logged in'));
    redirect(base_url('home'));
  }
  if($id!='')
  {

    $id = decryptIt($id);

    $gettrade    = $this->common_model->getTableData('p2p_trade', array('id' => $id))->row();
    if($gettrade->tradestatus=='open')
    {

      if($gettrade->actualtradebuy=='sell')
      {
            $trade_amount = $gettrade->trade_amount;
            $userbalance = getBalance($user_id,$gettrade->cryptocurrency);
            if($userbalance >= $trade_amount)
            {
                  $finalbalance=$userbalance+$trade_amount;
                  // Update user balance  
                  $updatebalance = updateBalance($user_id,$gettrade->cryptocurrency,$finalbalance);
            }
      }

      $condition=array('id'=>$id);
      $updateData=array('tradestatus'=>'cancelled');
      $update = $this->common_model->updateTableData('p2p_trade',$condition,$updateData);
      $this->session->set_flashdata('success','Order Cancelled Successfully');
      front_redirect('p2p_history', 'refresh');



    }
    else
    {
      $this->session->set_flashdata('error','Unable To cancel the Order. Please Try Again');
      front_redirect('p2p_history', 'refresh');

    }


  }

  
 
 }






 public function test_chat()
 {

$this->load->view('front/p2p/chat');


 }

 
 function p2p_offer(){  
 $data['currency']=$this->common_model->getTableData('currency')->result();
 $data['country'] = $this->common_model->getTableData('countries')->result();
 $data['service'] = $this->common_model->getTableData('service')->result();
 $this->load->view('front/p2p/p2ppage',$data);
 }


}


