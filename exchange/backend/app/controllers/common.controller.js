const db = require("../models");
const Currency = db.currency;
const Op = db.Sequelize.Op;
const Favourites = db.favourites;
const site_settings = db.site_settings;
const coin_order = db.coin_order;

const future_order = db.future_order;


const trade_pairs = db.trade_pairs;
const Wallet = db.wallet;
const ordertemp = db.ordertemp;
const Transhistory = db.Transhistory;

const spotfiat = db.spotfiat;

const func = require("../controllers/unserialize.controller.js");
const php_serialize = require("../controllers/php_serialize.controller.js");

const serialize = require("../controllers/serialize.controller.js");

// const phpSer = require('locutus/php/var/serialize')
const helper = require("../controllers/helper.js");
var crypto = require('crypto');
let Prefix = 'blackcube_';
// Create and Save a new Users
const Binance = require('node-binance-api');
const binance = new Binance().options({
  APIKEY: '',
  APISECRET: '',
  family: 0 
}); 


// Web3

var Web3 = require('web3');




// Sumsub  Start

const axios = require('axios'); 
// const crypto = require('crypto');
const fs = require('fs');
const FormData = require('form-data');

// These parameters should be used for all requests
const SUMSUB_APP_TOKEN = 'sbx:ZQGLMDjJQJDQVaqWaAWMc3Wq.O7IJkICi3kByqwrevgV6RMDxAw1NdllP'; // Example: sbx:uY0CgwELmgUAEyl4hNWxLngb.0WSeQeiYny4WEqmAALEAiK2qTC96fBad - Please don't forget to change when switching to production
const SUMSUB_SECRET_KEY = '68FXAJZQ0xmT0hcyLaLA9qu0gWrUnvjW'; // Example: Hej2ch71kG2kTd1iIUDZFNsO5C1lh5Gq - Please don't forget to change when switching to production
const SUMSUB_BASE_URL = 'https://api.sumsub.com'; 
var config = {};
config.baseURL= SUMSUB_BASE_URL; 

axios.interceptors.request.use(createSignature, function (error) {
  return Promise.reject(error);
}) 



// https://developers.sumsub.com/api-reference/#creating-an-applicant
function createApplicant(externalUserId, levelName) {
  // console.log("Creating an applicant...");

  var method = 'post';
  var url = '/resources/applicants?levelName=' + levelName;
  var ts = Math.floor(Date.now() / 1000);
  
  var body = {
      externalUserId: externalUserId
  };

  var headers = {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      'X-App-Token': SUMSUB_APP_TOKEN
  };

  config.method = method;
  config.url = url;
  config.headers = headers;
  config.data = JSON.stringify(body);

  return config;
}





  function createSignature(config) {
    // console.log('Creating a signature for the request...');
  
    var ts = Math.floor(Date.now() / 1000);
    const signature = crypto.createHmac('sha256',  SUMSUB_SECRET_KEY);
    signature.update(ts + config.method.toUpperCase() + config.url);
  
    if (config.data instanceof FormData) {
      signature.update (config.data.getBuffer());
    } else if (config.data) {
      signature.update (config.data);
    }
  
    config.headers['X-App-Access-Ts'] = ts;
    config.headers['X-App-Access-Sig'] = signature.digest('hex');
  
  
    return config;
  }

  // https://developers.sumsub.com/api-reference/#access-tokens-for-sdks
function createAccessToken (externalUserId, levelName = 'basic-kyc-level', ttlInSecs = 600) {
  // console.log("Creating an access token for initializng SDK...");

  var method = 'post';
  var url = `/resources/accessTokens?userId=${externalUserId}&ttlInSecs=${ttlInSecs}&levelName=${levelName}`;

  var headers = {
      'Accept': 'application/json',
      'X-App-Token': SUMSUB_APP_TOKEN
  };

  config.method = method;
  config.url = url;
  config.headers = headers;
  config.data = null;

  return config;
} 


exports.CreateSignature = (req, res) => {

  let datas = start();
  datas.then(function(result) {
    res.send(result) // "Some User token"
 })    
}; 


exports.KycStatus = (req, res) => {

  const applyId = req.params.applicantId; 
  let status = getStatus(applyId); 
  status.then(function(result) {

    // console.log('Kyc Status...');
    // console.log(result);  
    res.send(result)     
    // return result; 
  
  })      
}; 


const start = async function() {
  externalUserId = "random-JSToken-" + Math.random().toString(36).substr(2, 9);
  levelName = 'basic-kyc-level';
  // console.log("External UserID: ", externalUserId); 

  response = await axios(createApplicant(externalUserId, levelName))
    .then(function (response) {
      // console.log("Response:\n", response.data);
      return response;
    })
    .catch(function (error) {
      console.log("Error:\n", error.response.data);
    });
  
  const applicantId = response.data.id;

  
  return response = await axios(createAccessToken(externalUserId, levelName, 1200))
  .then(response => {

    this.token = response.data.token; 
    response.data.applicantId = applicantId;
    // console.log("Response:\n", response.data);
    return response.data; 
  })
  .catch(function (error) {
    console.log("Error:\n", error.response.data);
  });

}


// start();

// Sumsub End


async function binance_fun()
{
  var http = require('http');

  var pair = 'BTCUSDT'; 
  var tickers =  await binance.prices(pair);


  var options = {
    host: 'api.binance.com',
    // port: 80,
    path: '/api/v1/ticker/24hr?symbol=BTCUSDT'
  };
  
  http.get(options, function(resp){
    resp.on('data', function(chunk){
      // console.log(resp);  
      //do something with chunk 
    });
  }).on("error", function(e){
    console.log("Got error: " + e.message);
  });

  // var tickers = await v4_mk_request('GET', '/api/v1/ticker/24hr?symbol=BTCUSDT');
  // console.log("tickers section"); 
  // console.log(tickers.BTCUSDT);      
   

} 

binance_fun();  




// Binance  Trade History 
exports.GetBinanceTrades = async (req, res) => {
  let symbol = req.params.symbol;
  binance.aggTrades(symbol,{limit:20}, (error, response)=>{
      if(!error)
      {
        res.send(response)
      }
  });  
 
}; 



// Retrieve all Userss from the database.
exports.getTradeApiBookOrders = async (req, res) => {


  // var fut_orderbook = await binance.futuresDepth( "BTCUSDT" );
  // console.log(fut_orderbook);  
 

  let pair = req.params.pair.split('_');
  if(pair.length >0){
    let first_pair = pair[0];
    let second_pair1 = pair[1];
    let second_pair = '';
    let decimal = '';
    if(second_pair1=='USD'){
       second_pair = 'USDC';
       decimal = 2;
    }else{
       second_pair = second_pair1;
       decimal = 6;
    }
    let coin_pair = first_pair+second_pair;
        let sellData = [];
        let sell_res = [];
        let buyData = [];
        let buy_res = [];
        let data = [];
        binance.depth(coin_pair, (error, depth, symbol) => {
      let max = 20;
      let rew_result = depth;
      let length = Object.keys(rew_result).length;
      if(length >0 && rew_result !=''){
        let buy_orders = binance.sortBids(rew_result.bids, max);
        let sell_orders = binance.sortAsks(rew_result.asks, max);
        var i = 1;
        let max_sell_amount;
        var highest_sell_amount = Number.NEGATIVE_INFINITY;
        var highest_buy_amount = Number.NEGATIVE_INFINITY;
        for (const [price, quantity] of Object.entries(sell_orders)) {
          max_sell_amount = quantity;
          if (max_sell_amount > highest_sell_amount) highest_sell_amount = max_sell_amount;
        }
        for (const [price, quantity] of Object.entries(buy_orders)) {
          max_buy_amount = quantity;
          if (max_buy_amount > highest_buy_amount) highest_buy_amount = max_buy_amount;
        }
        for (const [price, quantity] of Object.entries(sell_orders)) {
          let x = quantity;
          let ask_bar = (x*100)/highest_sell_amount;
          sellData = {
            'id':i,
            'price':Number(price).toFixed(decimal),
            'ask_bar': Number(ask_bar).toFixed(2),
            'quantity':Number(quantity).toFixed(6),
            'total':Number(price*quantity).toFixed(decimal),
            'ordertype':'Sell'
          };
         sell_res.push(sellData);
           i++;
        }
        for (const [price, quantity] of Object.entries(buy_orders)) {
          let x = quantity;
          let bids_bar = (x*100)/highest_buy_amount;
          buyData = {
            'id':i,
            'price':Number(price).toFixed(decimal),
            'bids_bar': Number(bids_bar).toFixed(2),
            'quantity':Number(quantity).toFixed(6),
            'total':Number(price*quantity).toFixed(decimal),
            'ordertype':'Buy'
          };

           buy_res.push(buyData);
           i++;
        }


      }else{
        // let coin_pair = second_pair+first_pair;

      }
      data = {
        'buy_res':buy_res,
        'sell_res':sell_res
      }
      
      // console.log(data);
      // return; 
      if(!error)
      {
        return res.status(200).send(data); 
      }


      // if (error) return res.status(400).send({ success: false, error });
     

      //  res.send(data).end();

      }); 

  }
};



// Future OrderBook


// Retrieve all Userss from the database.
exports.getFutureTradeApiBookOrders = async (req, res) => {


  // var fut_orderbook = await binance.futuresTrades( "BTCUSDT" );
  // console.log(fut_orderbook);  
  // return res.status(200).send(fut_orderbook);  
//  return; 

  let pair = req.params.pair.split('_');


  // console.log(" Future Pair ",req.params.pair);
  

  if(pair.length >0){         
    let first_pair = pair[0];
    let second_pair1 = pair[1];
    let second_pair = '';
    let decimal = '';
    if(second_pair1=='USD'){
       second_pair = 'USDC';
       decimal = 2;
    }else{
       second_pair = second_pair1;
       decimal = 6;
    }
    let coin_pair = first_pair+second_pair;
        let sellData = [];
        let sell_res = [];
        let buyData = [];
        let buy_res = [];
        let data = [];
        let fin_data = [];

        // console.log("  Pair ",pair);
        // binance.futuresDepth(coin_pair, (error, depth, symbol) => {
          var fut_orderbook = await binance.futuresDepth( coin_pair );
          
          let max = 20;
      let rew_result = fut_orderbook;
      let length = Object.keys(rew_result).length;
      // console.log(rew_result.bids); 

      // console.log(buy_orders);
      // return res.status(200).send(buy_orders); 
      
      if(max > 0){
        let buy_orders = binance.sortBids(rew_result.bids, max);
        let sell_orders = binance.sortAsks(rew_result.asks, max);

        var i = 1; 
        let max_sell_amount;
        var highest_sell_amount = Number.NEGATIVE_INFINITY;
        var highest_buy_amount = Number.NEGATIVE_INFINITY;
        for (const [price, datas] of Object.entries(sell_orders)) {
          max_sell_amount = datas[1];
          if (max_sell_amount > highest_sell_amount) highest_sell_amount = max_sell_amount;
        }
        for (const [price, datas] of Object.entries(buy_orders)) {
          max_buy_amount = datas[1];
          if (max_buy_amount > highest_buy_amount) highest_buy_amount = max_buy_amount;
        }

        let vdata = {
          'max_buy_amount' : highest_sell_amount,
          'max_sell_amount' : highest_buy_amount,
        }
        // console.log(vdata);
        // console.log(max_sell_amount);
        // return res.status(200).send(vdata); 


        for (const [price, datas] of Object.entries(sell_orders)) {
          let x = datas[1];
          let ask_bar = (x*100)/highest_sell_amount;
          let pric = datas[0];
          let qty = datas[1];
          sellData = {
            'id':i, 
            'price':Number(pric).toFixed(decimal),
            'ask_bar': Number(ask_bar).toFixed(2),
            'quantity':Number(qty).toFixed(6),
            'total':Number(pric*qty).toFixed(decimal),
            'ordertype':'Sell'
          };
         sell_res.push(sellData);
           i++;
        }
        for (const [price, datas] of Object.entries(buy_orders)) {
          let x = datas[1];
          let bids_bar = (x*100)/highest_buy_amount;
          let pric = datas[0];
          let qty = datas[1];
          buyData = {
            'id':i,
            'price':Number(pric).toFixed(decimal),
            'bids_bar': Number(bids_bar).toFixed(2),
            'quantity':Number(qty).toFixed(6),
            'total':Number(pric*qty).toFixed(decimal),
            'ordertype':'Buy'
          };

           buy_res.push(buyData);
           i++;
        }
 

      }else{
        console.log(" No Count Else "); 
        // let coin_pair = second_pair+first_pair;

      }

      fin_data = {
        'buy_res':buy_res,
        'sell_res':sell_res
      }
      if(fin_data)
      {
        // console.log(data);  
        return res.status(200).send(fin_data); 
      }
      
      // }); 

  }
};






exports.getRow = (req, res) => {
  db.sequelize.query("select * from "+Prefix+req.params.table+" WHERE "+req.params.column+" ='"+req.params.value+"'", { 
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
        res.json(data[0])  
    }).catch( err => {

    }) 
};




exports.getAllCurrencies = async (req, res) => {
  
 let user_id = req.params.user_id;
 let pair = req.params.pair.split('_');

//  console.log(pair); 
//  return; 


//  console.log("Node");
//  console.log(pair); 
 
 try{
   if(pair.length==2){
     var from_symbol_id = pair[0];
     var to_symbol_id = pair[1]; 
     let check_trade_pairs = [];
     let get_trade_pairs = await checkTradePairs(from_symbol_id,to_symbol_id);
     if(get_trade_pairs.length!=0){
      check_trade_pairs = get_trade_pairs;
     }else{
      let get_trade_pairs = await checkTradePairs(to_symbol_id,from_symbol_id);
      check_trade_pairs = get_trade_pairs;
     }
     if(check_trade_pairs.length ==1){
       let pair_details = check_trade_pairs[0];
       let min_trade_amount = pair_details.min_trade_amount;
       let from_currency =  await Currencydetails(pair_details.from_symbol_id);
       let to_currency =  await Currencydetails(pair_details.to_symbol_id);

      // console.log(from_currency);
       let from_sym_id = from_currency.id;
       let to_sym_id = to_currency.id;

       let allcurrencies = await allCurrencies();
       let pair_id = pair_details.id;
       let pair_currency = [];
       if(allcurrencies){
         for(let all_curr of allcurrencies) {
       // allcurrencies.forEach( function(all_curr) {
        let check_pair =  await checkpair_by_currency(all_curr.id);
        if(check_pair==1){
         pair_currency.push("'"+all_curr.currency_symbol+"'");
        }
           }
           let popular_currency = pair_currency.join(',');
          //  console.log(pair_currency);
           let currencies =  await get_popular_currency(popular_currency);
           let from_cur = await getUserBalance(user_id,pair_details.from_symbol_id);
           let to_cur = await getUserBalance(user_id,pair_details.to_symbol_id);
           let currency_details_from = await getcryptocurrencydetail(pair_details.from_symbol_id);
           let maker_fee = currency_details_from.maker_fee;
           let currency_details_to = await getcryptocurrencydetail(pair_details.to_symbol_id);
           let taker_fee = currency_details_to.taker_fee;
           if(allcurrencies.length >0){
             let final_data ={};
             let remCurData ={};
             let cur_usdt = [];
             for(let all_curr of allcurrencies) {
              let res_cur = [];
               let pair_currency = await get_pair_currency(all_curr.id);
               if(pair_currency.length >0){
                pair_currency.forEach( async function(pair) {
                 let from_currency_det = await getcryptocurrencydetail(pair.from_symbol_id);
                 let to_currency_det = await getcryptocurrencydetail(pair.to_symbol_id);
                 let pair_id = pair.id;
                //  console.log(pair_id)
                 let pairurl = from_currency_det.currency_symbol+'_'+to_currency_det.currency_symbol;
                 let orgpair = from_currency_det.currency_symbol+to_currency_det.currency_symbol;


                 let from_symbol = from_currency_det.currency_symbol;
                 let to_symbol = to_currency_det.currency_symbol;

                  

                 let pairLink = from_currency_det.currency_symbol+' / '+to_currency_det.currency_symbol;
                 let decimal = 0;
                 if(to_currency_det.currency_symbol =='USD'){
                   decimal = 2;
                 }else{
                   decimal = 6;
                 }
                 let price =0;

               

                 if(pair.lastPrice !=''){ price = parseFloat(pair.lastPrice).toFixed(decimal);}else{price = '0.00'; }
                 let change =0;
                 let s_class ='';
                 let changePR ='';
                 let b2 = '';
                 if(pair.priceChangePercent !=''){ change = pair.priceChangePercent;}else{change = '0.00'; }
                 if(change >=0){
                   s_class = 'text-success';
                   if(change==0){
                     changePR = '0';
                   }else{
                     b2 = change;
                    //  changePR = '+'+parseFloat(change).toFixed(2);
                    changePR = '+'+change;
                   }
                 }else{
                   s_class = 'text-danger';
                   b2 = change;
                  //  changePR = parseFloat(change).toFixed(2);
                  changePR =change;

                 }

                //  var live_pric =  await binance.prices(orgpair);
                //  var Pric = live_pric.orgpair;
 
                 let check_favourites = await check_favourites_data(pair_id,user_id);
                 remCurData = {
                   'id':pairurl,
                   'pair':pairLink,
                   'price':price,
                  // 'price' : Pric,
                   'change':changePR,
                   'class':s_class,
                   'pairurl':pairurl,
                   'pairid':pair_id,
                   'to_symbol':to_symbol,
                   'favourites':check_favourites,
                   'orgpair' : orgpair,
                   'etf_status' : pair.etf_status
                  
                 }
                 if(!isInArray(pairurl, cur_usdt)){
                  cur_usdt.push(pairurl)
                 if(remCurData["to_symbol"] == to_symbol){
                  res_cur.push(remCurData)
                 }
                 }
            //  console.log(res_cur); 
            //   final_data[from_symbol] = res_cur;
              final_data[to_symbol] = res_cur;

               })
               }
             }  
             setTimeout(() => {

              // console.log(from_sym_id);
              // console.log(to_sym_id);  
              
            data = {'currencies':currencies,'allcurrencies':final_data,'pair_id':pair_id,'from_cur':from_cur,'to_cur':to_cur,'maker':maker_fee,'taker':taker_fee,'from_symbol_id':from_sym_id,'to_symbol_id':to_sym_id,'minimum_trade_amount':min_trade_amount}
            res.send(data).end();
             }, 1000);
        
           }


         }
     }
   }

 }catch(e) {
   console.log(e); 
   res.sendStatus(500);
}
}


exports.getFavourites = async (req, res) => {
  var user_id = req.params.user_id;
  let get_favourites;
  // if(user_id!=0){
  //   get_favourites =  await get_favourites_data(user_id,'');
  // }else{
  //   get_favourites =  await get_favourites_data('',req.socket.localAddress);
  // }
  let remCurData ={};
  let final_data = [];
//  if(get_favourites.length >0){
  // for(let get_fav of get_favourites) {
    let pair_currency =  await getAllTradePairs('1');
    

    if(pair_currency !=''){ 
      let pair_list = [];
      for(let pair of pair_currency) {

       
    // return;

        // console.log('from '+pair.from_symbol_id+'---- to '+pair.to_symbol_id);
        let from_currency_det = await getcryptocurrencydetail(pair.from_symbol_id);
        let to_currency_det = await getcryptocurrencydetail(pair.to_symbol_id);
        let pair_id = pair.id;
        let pairurl = from_currency_det.currency_symbol+'_'+to_currency_det.currency_symbol;
        let from_symbol = from_currency_det.currency_symbol;
        let to_symbol = to_currency_det.currency_symbol;
        let pairLink = from_currency_det.currency_symbol+' / '+to_currency_det.currency_symbol;
        let decimal = 0;
        if(to_currency_det.currency_symbol =='USD'){
          decimal = 2;
        }else{
          decimal = 6;
        }
        let price =0;
        if(pair.lastPrice !=''){ price = parseFloat(pair.lastPrice).toFixed(decimal);}else{price = '0.00'; }
        let change =0;
        let s_class ='';
        let changePR ='';
        let b2 = '';
        if(pair.priceChangePercent !=''){ change = pair.priceChangePercent;}else{change = '0.00'; }
        if(change >=0){
          s_class = 'text-success';
          if(change==0){
            changePR = '0';
          }else{
            b2 = change;
            changePR = '+'+parseFloat(change).toFixed(2);
          }
        }else{
          s_class = 'text-danger';
          b2 = change;
          changePR = parseFloat(change).toFixed(2);
        }
        // console.log(pair_id)
        remCurData = {
          'id':pairurl,
          'pair':pairLink,
          'price':price,
          'change':changePR,
          'class':s_class,
          'pairurl':pairurl,
          'pair_id':pair_id,
          'etf_status' : pair.etf_status
        }

        
        final_data.push(remCurData);

      }
      //  final_data = remCurData.reverse();
    }
//  }
// }
res.send(final_data).end();
};


get_favourites_data = (user_id,ipaddress) =>{
  return new Promise((resolve, reject)=>{
    if(user_id!=0){
      var sql = "select * from "+Prefix+"favourite_pairs where user_id ="+user_id; 
    }else{
      var sql = "select * from "+Prefix+"favourite_pairs where user_ip ='"+ipaddress+"'"; 
    }
      
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })

  });
};

get_favourites_pair_data = (user_id,pair_id) =>{
  return new Promise((resolve, reject)=>{
    var sql = "select * from "+Prefix+"favourite_pairs where user_id ="+user_id+" and pair_id = "+pair_id;
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data[0]);
    })

  });
};


exports.getActivePair = (req, res) => {
  db.sequelize.query("select * from "+Prefix+"trade_pairs where status =1", { 
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      if(data){
        res.json(data[0])
      }
       
    }).catch( err => {

    }) 
};


exports.getAllPairs = (req, res) => {
  db.sequelize.query("select * from "+Prefix+"trade_pairs where status =1", { 
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      if(data){
        res.json(data)
      }
       
    }).catch( err => {

    }) 
};




exports.getFutureAllPairs = (req, res) => {
  db.sequelize.query("select * from "+Prefix+"future_pairs where status =1", { 
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      if(data){
        res.json(data)
      }
    }).catch( err => {

    }) 
};




exports.addFavourite = async (req, res) => {

  // console.log(req.params);
  // return;
 
  var user_id = req.params.user_id;
  var pair_id = req.params.pair;
  var ip_address = req.socket.localAddress;
   let check_favourites =  await check_favourites_data(pair_id,user_id);
  let status;
  let result;
   if(check_favourites==0){
    let add_favourite =  await common_insert(user_id,pair_id,ip_address);
    status = 'insert';
    result = '';
   }else{
    let get_favourites =  await get_favourites_pair_data(user_id,pair_id);
    let delete_favourite =  await common_delete(get_favourites.id);
    status = 'delete';
    result = '';
   }
   data = {'result':result,'status':status}
   res.json(data).end();
}


common_delete = (id) =>{
  return new Promise((resolve, reject)=>{
    // return resolve(data);
    Favourites.destroy({
    where: { id: id }
  })
    .then(data => {
      return resolve(data);
    })
    .catch(err => {
      res.status(500).send({
        message: "Could not delete Admin with id=" + id
      });
    });
  });
};



common_insert = (user_id,pair_id,ipaddress) =>{
  return new Promise((resolve, reject)=>{
    var currentdate = Date.parse(new Date()) / 1000;
    const Fav = {
      user_id: user_id,
      pair_id: pair_id,
      user_ip: ipaddress,
      created:currentdate
    };
    // Save Fav in the database
    Favourites.create(Fav)
      .then(data => {
        return resolve(data);
      })
      .catch(err => {
        console.log(err)
      });
  });
};


function isInArray(value, array) {
 return array.indexOf(value) > -1;
}
getTradePairs = (id) =>{
  return new Promise((resolve, reject)=>{
    var sql = "select * from "+Prefix+"trade_pairs where status='1' and  id = "+id+" order by id DESC"; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })

  });
};


getAllTradePairs = (id) =>{
  return new Promise((resolve, reject)=>{
    var sql = "select * from "+Prefix+"trade_pairs where status='1' order by id DESC"; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      // console.log(data);
      // console.log('End');
      return resolve(data);
    })

  });
};

checkTradePairs = (from_id,to_id) =>{

  

  return new Promise((resolve, reject)=>{
      var sql = "SELECT *,a.id as pair_id FROM "+Prefix+"trade_pairs as a INNER JOIN "+Prefix+"currency as b ON a.from_symbol_id = b.id INNER JOIN "+Prefix+"currency as c ON a.to_symbol_id = c.id WHERE a.status = 1 AND b.status !=0 AND c.status !=0 AND   b.currency_symbol ='"+from_id+"' AND c.currency_symbol = '"+to_id+"'"; 
      // console.log(sql); 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })

  });
};

Currencydetails = (id) =>{
  return new Promise((resolve, reject)=>{
      var sql = "SELECT * FROM `"+Prefix+"currency` WHERE id ="+id; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data[0]);
    })

  });
};

allCurrencies = () =>{
  return new Promise((resolve, reject)=>{
      var sql = "select * from "+Prefix+"currency where status='1' order by sort_order ASC"; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })

  });
};

checkpair_by_currency = (id) =>{
  return new Promise((resolve, reject)=>{
      var sql = "select * from "+Prefix+"trade_pairs where status='1' and  to_symbol_id = "+id+" order by id DESC"; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      if(data.length >0){
        return resolve(1);
      }else{
        return resolve(0);
      }
      
    })

  });
};

get_digital_currency = (popular_currency) =>{
  return new Promise((resolve, reject)=>{
      var sql = "select currency_symbol,type from "+Prefix+"currency where status='1' and type='digital' and currency_symbol in ("+popular_currency+")"; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })

  });
};

get_popular_currency = (popular_currency) =>{
  return new Promise((resolve, reject)=>{
      var sql = "select currency_symbol,type from "+Prefix+"currency where status='1' and currency_symbol in ("+popular_currency+") order by id ASC"; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })

  });
};
getcryptocurrencydetail = (id) =>{
  return new Promise((resolve, reject)=>{
      var sql = "select * from "+Prefix+"currency where id="+id; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      if(data){
      return resolve(data[0]);
    }
    })

  });
};

get_pair_currency = (id) =>{
  return new Promise((resolve, reject)=>{
      // var sql = "select * from "+Prefix+"trade_pairs where status='1' and (from_symbol_id = "+id+" or to_symbol_id = "+id+") order by id DESC"; 
      var sql = "select * from "+Prefix+"trade_pairs where status='1' and to_symbol_id = "+id+" order by id DESC"; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })

  });
};
getUserBalance = (user_id,currency_id) =>{
  return new Promise((resolve, reject)=>{
    var sql = "SELECT * FROM "+Prefix+"wallet WHERE `user_id` = "+user_id+""; 
    return db.sequelize.query(sql, {   
  type: db.sequelize.QueryTypes.SELECT   
  }).then( (data) => { 
    if(data !=''){
   var rtn = func.unserialize((data[0].crypto_amount) ? data[0].crypto_amount : 0);
   if(rtn){
    const resultArray = Object.keys(rtn).map(index => {
      var BAL = rtn[index][currency_id];
      return resolve(BAL);
  }); 
}
    }else{
      return resolve(0);
    }
  })

});
};

check_favourites_data = (pair_id,user_id) =>{
  return new Promise((resolve, reject)=>{
      var sql = "select * from "+Prefix+"favourite_pairs where pair_id="+pair_id+" and user_id ="+user_id; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data.length);
    })

  });
};

exports.createOrder = (req, res) => {
  
  // Create a Users
  const Datas = {
  userId: req.body.userId,
  Amount :req.body.Amount,
  stoporderprice:req.body.stoporderprice,
  limit_price:req.body.limit_price,
  trigger_price:0, 
  ordertype:req.body.ordertype,
  Fee:req.body.Fee,
  Total:req.body.Total,
  Price:req.body.Price,
  Type:req.body.Type, 
  oco_id:req.body.oco_id, 
  orderDate:req.body.orderDate, 
  orderTime:req.body.orderTime, 
  datetime:req.body.datetime,
  tradetime:req.body.tradetime,    
  pair:req.body.pair,
  pair_symbol:req.body.pair_symbol,  
  status:req.body.status,
  fee_per:req.body.fee_per,
  wallet:req.body.wallet,
  updated_on:req.body.updated_on,
  borrow_amt : req.body.borrow_amt,
  borrow_status:req.body.borrow_status,
  etf_status:req.body.etf_status 

  };    
  coin_order.create(Datas)   
  .then(data => { 
    res.json(data);     
  }).catch( err => { 

    console.log(err); 

  }) 
       
 
}; 



exports.Duprecord = (req, res) => {
 
  let updated_on = req.params.updated_on;
    var sql = "SELECT * FROM "+Prefix+"coin_order WHERE updated_on = "+ updated_on + " "; 
    db.sequelize.query(sql, {  
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => { 
          res.json(data) 
      }).catch( err => {
              res.json(500).send({
            message:
              err.message || "Some error occurred while retrieving Currency."
          });
      }) 
};
exports.OpenOrder = (req, res) => {
  let table = req.params.table;
  let pair_id = req.params.pair_id;
  let type = req.params.type;
  let id = req.params.id;
  var sql = "SELECT `CO`.*, date_format(CO.datetime, '%d-%b-%Y %h:%i %p') as trade_time, sum(OT.filledAmount) as totalamount FROM `blackcube_coin_order` as `CO` LEFT JOIN `blackcube_ordertemp` as `OT` ON `CO`.`trade_id` = `OT`.`sellorderId` OR `CO`.`trade_id` = `OT`.`buyorderId` LEFT JOIN `blackcube_trade_pairs` as `TP` ON `CO`.`pair` = `TP`.`id` WHERE `CO`.`userId` = '"+id+"' AND `CO`.`status` IN('active', 'partially', 'margin', 'stoporder') GROUP BY `CO`.`trade_id` ORDER BY `CO`.`trade_id` DESC";
    // var sql ="SELECT `CO`.*, date_format(CO.datetime, '%d-%b-%Y %h:%i %p') as trade_time, sum(OT.filledAmount) as totalamount FROM `"+Prefix+"coin_order` as `CO` LEFT JOIN `"+Prefix+"ordertemp` as `OT` ON `CO`.`trade_id` = `OT`.`sellorderId` OR `CO`.`trade_id` = `OT`.`buyorderId` LEFT JOIN `"+Prefix+"trade_pairs` as `TP` ON `CO`.`pair` = `TP`.`id` WHERE `CO`.`userId` = "+ id +" AND `CO`.`pair` = "+ pair_id +" AND `CO`.`status` IN('active', 'partially', 'margin', 'stoporder') GROUP BY `CO`.`trade_id` ORDER BY `CO`.`trade_id` DESC" ; 
  db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => {
      if(data){
        let object_data = {};
        let fetch_data = [];
        for(let getOrder of data) {
          var activefilledAmount=getOrder.totalamount;
          var activePrice=getOrder.Price;
          var Fee=Number(getOrder.Fee).toFixed(6);
          activePrice=Number(activePrice).toFixed(6);
          var activeAmount  = getOrder.Amount;
          if(activefilledAmount)
          {
            activefilledAmount = activeAmount-activefilledAmount;
          }
          else
          {
            activefilledAmount = activeAmount;
          }
          activefilledAmount=Number(activefilledAmount).toFixed(6);
          var trade_id = getOrder.trade_id;
          var odr_type = getOrder.Type;
          var odr_status = getOrder.status;
          if(odr_type=='buy')
          {
            odr_color = 'text-success';
            var ordtype1 = 'Buy';
            // var activeCalcTotal = Number(activefilledAmount*activePrice) + Number(Fee);
            var activeCalcTotal = Number(activefilledAmount*activePrice);
              activeCalcTotal=Number(activeCalcTotal).toFixed(6);
          }
          else
          {
            odr_color = 'text-danger';
            var ordtype1 = 'Sell';
            // var activeCalcTotal = Number(activefilledAmount*activePrice) - Number(Fee);
            var activeCalcTotal = Number(activefilledAmount*activePrice);
            activeCalcTotal=Number(activeCalcTotal).toFixed(6);
          }
          var time = getOrder.trade_time;
          var pair_symbol = getOrder.pair_symbol.replace("_","/"); 
          var pairy  = getOrder.pair;               
          var ordtypes = getOrder.ordertype;
          if(ordtypes == 'limit') var ordtype = 'Limit';
          else if(ordtypes == 'stop') var ordtype = 'Stop Order';
          else if(ordtypes == 'instant') var ordtype = 'Market';
          else var ordtype = '-';


          if(getOrder.stoporderprice > 0)
          var stop_Price = Number(getOrder.stoporderprice).toFixed(6);
          else
          var stop_Price = '-';
           
          // if(pair_active==pair_symbol) var myclass = 'currentpair';
          // else var myclass = 'differpair';

          // var coinAmt = activefilledAmount;
          // var usdPrice = coinAmt*usd_price;
          // usdPrice = Number(usdPrice).toFixed(2);
          object_data = {
            trade_time:time,
            pair_symbol:pair_symbol,
            Type:ordtype1,
            class:odr_color,
            ordertype:ordtype,
            Price:activePrice,
            Amount:activefilledAmount,
            Total:activeCalcTotal,
            userId:id,
            trade_id:trade_id,
            pair:pairy,
            borrow_amt : getOrder.borrow_amt,
            borrow_status : getOrder.borrow_status,
            etf_status : getOrder.etf_status,
            status : getOrder.status,
            stoporderprice : stop_Price

          }
          fetch_data.push(object_data);
        }
        // console.log(fetch_data) 
        res.json(fetch_data) 
      }
        
    }).catch( err => {
       
      console.log(err); 
        //     res.json(500).send({
        //   message:
        //     err.message || "Some error occurred while retrieving Currency."
        // });
    }) 
  };


exports.GetOpenOrders = (req, res) => {
 
  let pair_id = req.params.pair_id;
  let type = req.params.type;
  var sql = "SELECT `CO`.*, date_format(CO.datetime, '%d-%b-%Y %h:%i %p') as trade_time, sum(OT.filledAmount) as totalamount FROM `blackcube_coin_order` as `CO` LEFT JOIN `blackcube_ordertemp` as `OT` ON `CO`.`trade_id` = `OT`.`sellorderId` OR `CO`.`trade_id` = `OT`.`buyorderId` LEFT JOIN `blackcube_trade_pairs` as `TP` ON `CO`.`pair` = `TP`.`id` WHERE `CO`.`userId` = '"+id+"' AND `CO`.`status` IN('active', 'partially', 'margin', 'stoporder') GROUP BY `CO`.`trade_id` ORDER BY `CO`.`trade_id` DESC";
      // var sql = "SELECT `CO`.`Price`, `CO`.`Amount`, sum(OT.filledAmount) as filledAmount FROM `"+Prefix+"coin_order` as `CO` LEFT JOIN `"+Prefix+"ordertemp` as `OT` ON `CO`.`trade_id` = `OT`.`buyorderId` WHERE `CO`.`Type` = '"+ type +"' AND `CO`.`pair` = '"+ pair_id +"' AND `CO`.`status` IN('active', 'partially') GROUP BY `CO`.`trade_id` ORDER BY `CO`.`Price` DESC"; 
    db.sequelize.query(sql, {    
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => { 
        // console.log(data)
       
      }).catch( err => {
               
                //console.log(err); 
        
            res.json(500).send({
            message:
              err.message || "Some error occurred while retrieving Currency."
          });
      }) 
};

exports.allCloseOrders = (req, res) => {
  let pair_id = req.params.pair_id;
  let type = req.params.type;
  let id = req.params.id;
  // var sql = "SELECT * FROM "+Prefix+"coin_order WHERE pair = "+ pair_id + " AND userId = "+id+" AND status = 'cancelled'";
  var sql = "SELECT `CO`.*, `OT`.`filledAmount` as `totalamount` FROM `blackcube_coin_order` as `CO` LEFT JOIN `blackcube_ordertemp` as `OT` ON `CO`.`trade_id` = `OT`.`sellorderId` OR `CO`.`trade_id` = `OT`.`buyorderId` WHERE `CO`.`pair` = '"+pair_id+"' AND `CO`.`userId` = '"+id+"' AND `CO`.`status` = 'cancelled' ORDER BY `CO`.`trade_id` DESC";  
  db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      // console.log(data)
        res.json(data) 
    }).catch( err => {
      console.log(err)
        //     res.json(500).send({
        //   message:
        //     err.message || "Some error occurred while retrieving Currency."
        // });
    }) 
  };

  exports.OrderHistory = (req, res) => {
  
    let table = req.params.table;
    let pair_id = req.params.pair_id;
    let type = req.params.type;
    let id = req.params.id;
    // var sql = "SELECT a.*, b.ordertype as ordertype, date_format(b.datetime, '%H:%i:%s') as sellertime, b.trade_id as seller_trade_id, date_format(c.datetime, '%H:%i:%s') as buyertime, c.pair_symbol as pair_symbol, c.trade_id as buyer_trade_id, a.askPrice as sellaskPrice, c.Price as buyaskPrice, b.Fee as sellerfee, c.Fee as buyerfee, b.Total as sellertotal, c.Total as buyertotal, c.status as status, b.status as statuss FROM `blackcube_ordertemp` as `a` JOIN `blackcube_coin_order` as `b` ON `a`.`sellorderId` = `b`.`trade_id` JOIN `blackcube_coin_order` as `c` ON `a`.`buyorderId` = `c`.`trade_id` WHERE `b`.`pair` = '"+pair_id+"' AND `c`.`userId` = '"+id+"' OR  `b`.`userId` = '"+id+"' ORDER BY `a`.`tempId` DESC LIMIT 40";
    var sql = "SELECT a.*, b.ordertype as ordertype, date_format(b.datetime, '%H:%i:%s') as sellertime, b.trade_id as seller_trade_id, date_format(c.datetime, '%H:%i:%s') as buyertime, c.pair_symbol as pair_symbol, c.trade_id as buyer_trade_id, a.askPrice as sellaskPrice, c.Price as buyaskPrice, b.Fee as sellerfee, c.Fee as buyerfee, b.Total as sellertotal, b.Amount as selleramount,c.Total as buyertotal,c.Amount as buyeramount, c.status as status, b.status as statuss, c.borrow_amt as borrow_amt,c.borrow_status as borrow_status,c.etf_status as etf_status FROM `blackcube_ordertemp` as `a` JOIN `blackcube_coin_order` as `b` ON `a`.`sellorderId` = `b`.`trade_id` JOIN `blackcube_coin_order` as `c` ON `a`.`buyorderId` = `c`.`trade_id` WHERE `b`.`pair` = '"+pair_id+"' AND `c`.`userId` = '"+id+"' OR  `b`.`userId` = '"+id+"' ORDER BY `a`.`tempId` DESC LIMIT 40";
    db.sequelize.query(sql, {  
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => {
        if(data){
            let object_data = {};
            let fetch_data = [];
            for(let getOrder of data) {              
              if(getOrder.buyerUserid == getOrder.sellerUserid){
                if(getOrder.buyer_trade_id < getOrder.seller_trade_id){
                  cancelamt=Number(getOrder.buyeramount );
                  canceltot=Number(cancelamt * getOrder.buyaskPrice);
                  object_data = {
                    type1:"Buy",
                    filledAmount:getOrder.filledAmount,
                    askPrice:getOrder.buyaskPrice,
                    sellaskPrice:Number(getOrder.sellaskPrice).toFixed(6),
                    orderTime1:getOrder.buyertime,
                    orderTime2:getOrder.sellertime,
                    buyerfee:getOrder.buyerfee,
                    sellerfee:getOrder.sellerfee,
                    buyertotal:getOrder.buyertotal,
                    sellertotal:getOrder.sellertotal,
                    time1:getOrder.buyertime,
                    datetime:getOrder.datetime,
                    myuserID:getOrder.buyerUserid,
                    pairy: getOrder.pair_symbol.replace("_","/"),
                    orderType :getOrder.ordertype,
                    class :'text-success',
                    cancelamount: cancelamt,
                    canceltotal: canceltot,
                    b_tot:Number(getOrder.buyaskPrice * getOrder.filledAmount),
                    status: getOrder.status.charAt(0).toUpperCase()+getOrder.status.slice(1),
                    borrow_amt : getOrder.borrow_amt,
                    borrow_status : getOrder.borrow_status,
                    etf_status : getOrder.etf_status
                  }
                  
              fetch_data.push(object_data);
                }else{ 
                  cancelamt=Number(getOrder.selleramount);
                  canceltot=Number(cancelamt * getOrder.sellaskPrice);
                  object_data = {
                    type1:"Sell",
                       filledAmount:getOrder.filledAmount,
                       askPrice:getOrder.sellaskPrice,
                       sellaskPrice:Number(getOrder.buyaskPrice).toFixed(6),
                       orderTime1:getOrder.buyertime,
                       orderTime2:getOrder.sellertime,
                       buyerfee:getOrder.buyerfee,
                       sellerfee:getOrder.sellerfee,
                       buyertotal:getOrder.buyertotal,
                       sellertotal:getOrder.sellertotal,
                       time1:getOrder.buyertime,
                       datetime:getOrder.datetime,
                       myuserID:getOrder.buyerUserid,
                       pairy: getOrder.pair_symbol.replace("_","/"),
                       orderType :getOrder.ordertype,
                       class :'text-danger',
                       cancelamount: cancelamt,
                        canceltotal: canceltot,
                       b_tot:Number(getOrder.sellaskPrice * getOrder.filledAmount),
                       status: getOrder.status.charAt(0).toUpperCase()+getOrder.status.slice(1),
                       borrow_amt : getOrder.borrow_amt,
                       borrow_status : getOrder.borrow_status,
                       etf_status : getOrder.etf_status
                 }
                  fetch_data.push(object_data);
                }
              }else{
                if(getOrder.buyerUserid==id)
                {
                  cancelamt=Number(getOrder.buyeramount );
                  canceltot=Number(cancelamt * getOrder.buyaskPrice);
                  object_data = {
                        type1:"Buy",
                        filledAmount:getOrder.filledAmount,
                        askPrice:getOrder.buyaskPrice,
                        sellaskPrice:Number(getOrder.sellaskPrice).toFixed(6),
                        orderTime1:getOrder.buyertime,
                        orderTime2:getOrder.sellertime,
                        buyerfee:getOrder.buyerfee,
                        sellerfee:getOrder.sellerfee,
                        buyertotal:getOrder.buyertotal,
                        sellertotal:getOrder.sellertotal,
                        time1:getOrder.buyertime,
                        datetime:getOrder.datetime,
                        myuserID:getOrder.buyerUserid,
                        pairy: getOrder.pair_symbol.replace("_","/"),
                        orderType :getOrder.ordertype,
                        class :'text-success',
                        cancelamount: cancelamt,
                        canceltotal: canceltot,
                        b_tot:Number(getOrder.buyaskPrice * getOrder.filledAmount),
                        status: getOrder.status.charAt(0).toUpperCase()+getOrder.status.slice(1),
                        borrow_amt : getOrder.borrow_amt,
                        borrow_status : getOrder.borrow_status,
                        etf_status : getOrder.etf_status
                  }
                  fetch_data.push(object_data);
                }
                else if(getOrder.sellerUserid==id)
                {
                  cancelamt=Number(getOrder.selleramount);
                  canceltot=Number(cancelamt * getOrder.sellaskPrice);
                  object_data = {
                     type1:"Sell",
                        filledAmount:getOrder.filledAmount,
                        askPrice:getOrder.sellaskPrice,
                        sellaskPrice:Number(getOrder.buyaskPrice).toFixed(6),
                        orderTime1:getOrder.buyertime,
                        orderTime2:getOrder.sellertime,
                        buyerfee:getOrder.buyerfee,
                        sellerfee:getOrder.sellerfee,
                        buyertotal:getOrder.buyertotal,
                        sellertotal:getOrder.sellertotal,
                        time1:getOrder.buyertime,
                        datetime:getOrder.datetime,
                        myuserID:getOrder.buyerUserid,
                        pairy: getOrder.pair_symbol.replace("_","/"),
                        orderType :getOrder.ordertype,
                        class :'text-danger',
                        cancelamount: cancelamt,
                        canceltotal: canceltot,                        
                        b_tot:Number(getOrder.sellaskPrice * getOrder.filledAmount),
                        status: getOrder.statuss.charAt(0).toUpperCase()+getOrder.statuss.slice(1),
                        borrow_amt : getOrder.borrow_amt,
                        borrow_status : getOrder.borrow_status,
                        etf_status : getOrder.etf_status
                  }
                  fetch_data.push(object_data);
                } 
              }
            // }
            }
            // console.log(fetch_data) 
            res.json(fetch_data) 
          }

  
      }).catch( err => {
        console.log(err)
          //     res.json(500).send({
          //   message:
          //     err.message || "Some error occurred while retrieving Currency."
          // });
      }) 
    };
//    exports.OrderHistory = (req, res) => {
  
//     let table = req.params.table;
//     let pair_id = req.params.pair_id;
//     let type = req.params.type;
//     let id = req.params.id;
//     var sql = "SELECT `CO`.*, SUM(CO.Amount) as TotAmount, date_format(CO.datetime, '%d-%m-%Y %H:%i') as trade_time, sum(OT.filledAmount) as totalamount FROM `blackcube_coin_order` as `CO` LEFT JOIN `blackcube_ordertemp` as `OT` ON `CO`.`trade_id` = `OT`.`sellorderId` OR `CO`.`trade_id` = `OT`.`buyorderId` WHERE `CO`.`pair` = '"+pair_id+"' AND `CO`.`userId` = '"+id+"' AND `CO`.`status` IN('filled', 'partially', 'cancelled') GROUP BY `CO`.`trade_id` ORDER BY `CO`.`trade_id` DESC";
    
//     db.sequelize.query(sql, {  
//       type: db.sequelize.QueryTypes.SELECT   
//       }).then( (data) => {
//         // console.log(data)
//       res.send(data)    
//       }).catch( err => {
//       console.log(err)
//       //     res.json(500).send({
//       //   message:
//       //     err.message || "Some error occurred while retrieving Currency."
//       // });
//   })  
// };
exports.GetcoinOrder = (req, res) => {
  
  let trade_id = req.params.trade_id;
  
  var sql = "SELECT * FROM "+Prefix+"coin_order WHERE trade_id = "+trade_id+"";
      db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 

      // console.log(data); 

        res.send(data[0])    
    }).catch( err => {
      console.log(err)
        //     res.json(500).send({
        //   message:
        //     err.message || "Some error occurred while retrieving Currency."
        // });
    })  
  };

  coinOrder = (currency_symbol) =>{
    return new Promise((resolve, reject)=>{
        var sql = "SELECT SUM(Total) as Total FROM `"+Prefix+"coin_order` WHERE `pair_symbol` LIKE '%"+currency_symbol+"%'"; 
        return db.sequelize.query(sql, {    
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => { 
        return resolve(data);
      })
  
    });
  };

  exports.updateorderstatus = (req, res) => {
    const trade_id = req.params.trade_id;  
    coin_order.update(req.body, {
      where: { trade_id: trade_id }
    })
      .then(data => {
        res.json(data);
      })
      .catch(err => {
         
        //console.log(err); 

        res.status(500).send({
          message: "Error updating user with id=" + id
        });
      }); 
};
exports.pairData = (req, res) => {
  
  const pair_id = req.params.pair_id; 
  // console.log(req.body); 
  trade_pairs.update(req.body, {
    where: { id: pair_id }
  })
    .then(data => {
      
      res.json(data);
    })
    .catch(err => {
       
      console.log(err); 

      // res.status(500).send({
      //   message: "Error updating user with id=" + pair_id
      // });
    }); 
};

exports.Getpairdetails = (req, res) => {
   
  let id = req.params.id;
  
  var sql = "SELECT * FROM "+Prefix+"trade_pairs WHERE id = "+id+"";   
  db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
        res.json(data[0]) 
    }).catch( err => {
            res.json(500).send({
          message:
            err.message || "Some error occurred while retrieving Currency."
        });
    }) 
  };

  
// Ordertemp Sum

exports.GetOrderTempsum = (req, res) => { 
  
  let temp_id = req.params.temp_id;
  let column = req.params.column;
  var sql = "SELECT SUM(filledAmount) as totalamount FROM "+Prefix+"ordertemp WHERE "+column+" = "+	temp_id+"";    
  db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
        res.json(data[0])   
    }).catch( err => {
            res.json(500).send({ 
          message:
            err.message || "Some error occurred while retrieving Currency."
        });
    }) 
  };
  exports.GetOrderTemp = (req, res) => {
  
    let 	temp_id = req.params.temp_id;
    
    var sql = "SELECT * FROM blackcube_ordertemp WHERE tempId = "+	temp_id+""; 
        
     
    db.sequelize.query(sql, {  
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => { 
          res.json(data[0]) 
      }).catch( err => {
              res.json(500).send({
            message:
              err.message || "Some error occurred while retrieving Currency."
          });
      }) 
    };

  exports.GetBalance = async (req, res) => {
    const id = req.params.user_id;
    const cur_id = req.params.cur_id; 
    const condition = {user_id: id };

    var currency_check = await Currencydetails(cur_id);
    if(currency_check) {

      if(currency_check.etf_status!=1) {

        // console.log(" Spot If Stmt ");
        // Normal Spot Amount

    Wallet.findOne({ where: condition })
    .then(data => { 
    var rtn = func.unserialize(data.crypto_amount);
      const resultArray = Object.keys(rtn).map(index => {
        var BAL = rtn[index][cur_id];
         res.status(200).send((BAL).toString()); 
    });   
    })
    .catch(err => {  
      console.log(err); 
      // res.status(500).send({
      // message: "Error retrieving Tutorial with id=" + id
      // });
      }); 

    }
    else 
    {

      // console.log(" ETF Else Stmt ");
      // ETF Amount 

      Wallet.findOne({ where: condition })
      .then(data => { 
      var rtn = func.unserialize(data.etf_amount);
        const resultArray = Object.keys(rtn).map(index => {
          var BAL = rtn[index][cur_id];
           res.status(200).send((BAL).toString()); 
      });   
      })
      .catch(err => {  
        console.log(err); 
        // res.status(500).send({
        // message: "Error retrieving Tutorial with id=" + id
        // }); 
        }); 

    }

    }

  };  

  exports.GetMarginBalance = (req, res) => {
    const id = req.params.user_id;
    const cur_id = req.params.cur_id; 
    const condition = {user_id: id };
    Wallet.findOne({ where: condition })
    .then(data => { 
    var rtn = func.unserialize(data.margin_amount);
      const resultArray = Object.keys(rtn).map(index => {
        var BAL = rtn[index][cur_id];
         res.status(200).send((BAL).toString()); 
    });   
    })
    .catch(err => {  
      console.log(err); 
      // res.status(500).send({
      // message: "Error retrieving Tutorial with id=" + id
      // });
      }); 
  };  


// ETF Trading 

exports.GetETFBalance = (req, res) => {
  const id = req.params.user_id;
  const cur_id = req.params.cur_id; 
  const condition = {user_id: id };
  Wallet.findOne({ where: condition })
  .then(data => { 
  var rtn = func.unserialize(data.etf_amount);
    const resultArray = Object.keys(rtn).map(index => {
      var BAL = rtn[index][cur_id];
       res.status(200).send((BAL).toString()); 
  });   
  })
  .catch(err => {  
    console.log(err); 
    // res.status(500).send({
    // message: "Error retrieving Tutorial with id=" + id
    // });
    }); 
};  
 



  exports.GetAvailableBalance = async (req, res) => {
    const id = req.params.user_id;
    const currency_id = req.params.cur_id;
    let digital_currencies = await Currencydetails(currency_id);
    let balanceData = {};
    let allBalanceData = [];
    if(digital_currencies){
      let currency_symbol = digital_currencies.currency_symbol;
      let order_balance = await coinOrder(currency_symbol);
       let order_bal = 0;
        if(order_balance==''){
          order_bal =0;
        }else{
          order_bal = order_balance[0].Total;
        }
        let userBalance = await getUserBalance(id,digital_currencies.id);
         balanceData = {
          'currency_symbol':digital_currencies.currency_symbol,
          'totalBalance':userBalance,
          'order_balance':order_bal,
          'available_balance':Number(userBalance) - Number(order_bal)
        }
        res.send(balanceData).end();
  }
 
    }; 


  
  exports.OpenMapOrder = (req, res) => {
  
    let pair_id = req.params.pair_id;
    let trade_id = req.params.trade_id;
    var sql = "SELECT * FROM "+Prefix+"coin_order WHERE trade_id = "+trade_id+" AND pair = "+ pair_id + "   AND status IN ('active','partially')";
            db.sequelize.query(sql, {  
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => { 
          res.json(data) 
      }).catch( err => {
              res.json(500).send({
            message:
              err.message || "Some error occurred while retrieving Currency."
          });
      }) 
    }; 
    exports.Getparticular = (req, res) => {
      let price = req.params.price;
      let pair_id = req.params.pair_id;
      let type = req.params.type;
      if(type=='sell')
      {
        var sql = "SELECT * FROM "+Prefix+"coin_order WHERE   pair = "+ pair_id + " AND Type = 'buy' AND Price >= "+ price +"  AND status IN ('active','partially') ORDER BY Price DESC";
      }
      else
      { 
        var sql = "SELECT * FROM "+Prefix+"coin_order WHERE   pair = "+ pair_id + " AND Type = 'sell' AND Price <= "+ price +"  AND status IN ('active','partially') ORDER BY Price ASC";
      }  
      db.sequelize.query(sql, {  
        type: db.sequelize.QueryTypes.SELECT   
        }).then( (data) => { 
            res.json(data) 
        }).catch( err => {
        }) 
      }; 
      exports.checkOrdertemp = (req, res) => {
        let orderId = req.params.orderId;
        // console.log('order id '+orderId)
        let ordertype = req.params.ordertype;
        // console.log('order type '+ordertype)
        var sql = "SELECT SUM(filledAmount) as totalamount FROM "+Prefix+"ordertemp WHERE "+ ordertype +" = "+orderId+" "; 
        db.sequelize.query(sql, {  
          type: db.sequelize.QueryTypes.SELECT   
          }).then( (data) => {  
            // console.log(data[0].totalamount); 
              //res.json(100);   
            res.json(data[0].totalamount)   
          }).catch( err => {

            console.log(err); 

                  res.json(500).send({ 
                message:
                  err.message || "Some error occurred while retrieving Currency."
              }); 
          }) 
        };

        exports.createOrdertemp = (req, res) => {
          ordertemp.create(req.body)    
          .then(data => { 
            res.json(data);      
          }).catch( err => { 
              console.log(err); 
             
            // res.json(500).send({
            //     message:
            //       err.message || "Some error occurred while retrieving Currency."
            //   });
          }) 
        };  

exports.createTranshistory = (req, res) => {
  Transhistory.create(req.body)    
          .then(data => { 
              res.json(data);       
          }).catch( err => { 
  
            console.log(err);

              // res.json(500).send({
              //   message:
              //     err.message || "Some error occurred while retrieving Currency."
              // });
          }) 
        };
  exports.updateUserBalance = (req, res) => {
    let user_id = req.params.user_id;
    let currency = req.params.currency;
    let balance = req.params.balance;
    const condition = {user_id: user_id };
    Wallet.findOne({where: condition})
      .then(data => {
        let wallet_type = 'Exchange AND Trading';
      const wallet =func.unserialize(data.crypto_amount); 

      wallet[wallet_type][currency] = Number(balance).toFixed(8); 

        console.log(wallet);  

        var seriz = serialize.serialize(wallet);

        console.log(seriz);
        return;
        
        // Wallet.update(req.body, { 
        //   where: { user_id: user_id }
        // })
        //   .then(data => {
        //     res.json(wallet);
        //   })
        //   .catch(err => {
        //     res.status(500).send({
        //       message: "Error updating user with id=" + id
        //     });
        //   });




      })
  
  
    };
    const https = require('https');
const { log } = require("console");
    
    const host = '';
    const key = '';
    const secret = '';
    
    function response_as_json(resolve, reject) {
      return function(res) {
        let str = '';
        res.on('data', function (chunk) { str += chunk; });
        res.on('end', function (arg) {
          console.log(JSON.parse(str));
          ((res.statusCode >= 200 && res.statusCode < 300) ? resolve : reject)(str ? JSON.parse(str) : '');
        });
      }
    }
    
    function gen_sig_helper(secret, data) {
      const secret_bytes = Buffer.from(secret, 'base64');
      return crypto.createHmac('sha512', secret_bytes).update(data).digest('base64');
    }
    
    function v4_gen_sig(secret, method, path, expires, body_str) {
      let data = method + path + expires;
      if (body_str) {
        data = data + body_str;
      }
      return gen_sig_helper(secret, data);
    }
    
    function v4_mk_request(method, path, body) {
      // console.log(`=> ${method} ${path}`);
      return new Promise((resolve, reject) => {
        const tonce = Math.floor(Date.now() / 1000) + 10;
        const body_str = JSON.stringify(body);
        console.log(tonce);
        console.log(v4_gen_sig(secret, method, path, tonce, body_str));
        const headers = {
          'api-key': key,
          'api-signature': v4_gen_sig(secret, method, path, tonce, body_str),
          'api-expires': tonce,
          'Content-Type': 'application/json'
        }
        if (body) {
          headers['Content-Length'] = Buffer.byteLength(body_str);
        }
        const opt = { host, method, path, headers };
        const req = https.request(opt, response_as_json(resolve, reject));
        if (body) {
          req.write(body_str);
        }
        req.end();
      }); 
    }
    
    function v3_gen_sig(secret, path, body_str) {
      let data = path;
      if (body_str) {
        data = data + '\0' + body_str;
      }
      return gen_sig_helper(secret, data);
    }
    
    function v3_mk_request(method, path, body) {
      return new Promise((resolve, reject) => {
        const tonce = Math.floor(Date.now() * 1000);
        // console.log(path);
        body['tonce'] = tonce;
        // body['ccy'] = 'BTC'
        const body_str = JSON.stringify(body);
        const headers = {
          'Rest-Key': key,
          'Rest-Sign': v3_gen_sig(secret, path, body_str),
          'Content-Type': 'application/json'
        }
        // console.log(v3_gen_sig(secret, path, body_str));
        const opt = { host, method, path: '/' + path, headers };
        const req = https.request(opt, response_as_json(resolve, reject));
        // console.log(req);
        req.write(body_str);
        req.end();
      });
    }
    
    async function run() {
      try {
      const order_id_v4 = (await v4_mk_request('POST', '/api/v4/order', {
        'ordType': 'Limit',
        'symbol': 'BTCUSD',
        'orderQty': '0.01',
        'price': '39000',
        'side': 'Buy'
      }))['orderID'];
      await v4_mk_request('GET', '/api/v4/order?orderID=' + order_id_v4);
      await v4_mk_request('DELETE', '/api/v4/order', {'orderID': [order_id_v4]});
    }
    catch (e) {
      // User denied access
      return false;
    }
     try {
      const order_id_v3 = (await v3_mk_request('POST', 'api/3/receive/create', {
        // 'order': {
        //   'orderType': 'LIMIT',
        //   'tradedCurrency': 'BTC',
        //   'settlementCurrency': 'USD',
        //   'buyTradedCurrency': true,
        //   'tradedCurrencyAmount': '0.01',
        //   'limitPriceInSettlementCurrency': '39000'
        // }
      }))
      await v3_mk_request('POST', 'api/3/receive/create',{'ccy': 'BTC'});
     } 
     catch (e) {
      // User denied access
      return false;
    }
      
      // await v3_mk_request('POST', 'api/3/order/cancel', {'orderIds': [order_id_v3]});
    }
    
    // run();

// Web3 Start

exports.web3result = (req, res) => {
    var data = [];
    res.json(data);  
};




// Spot ( 30-11-2022)

exports.Currencieslist = async (req,res) => {

  let allcurrencies = await allCurrencies();
  if(allcurrencies)
  {
    res.json(allcurrencies);
  }
};


exports.GetUsersBal = async (req,res) => {

  var user_id = req.params.user_id;
  var currency = req.params.currency;
  let balance = await getUserBalance(user_id,currency);
 
    res.json(balance);
  
};


exports.updateSpot = (req, res) => {
  const id = req.params.id;  
  spotfiat.update(req.body, {
    where: { id: id }
  })
    .then(data => {
      res.json(data);
    })
    .catch(err => {
      res.status(500).send({
        message: "Error updating user with id=" + id
      });
    }); 
};



// Future 


exports.FuturecreateOrder = (req, res) => {
  
  
  future_order.create(req.body)   
  .then(data => { 
    res.json(data);     
  }).catch( err => { 

    console.log(err); 

  }) 
       
 
}; 



exports.GetFutureBalance = (req, res) => {
  const id = req.params.user_id;
  const cur_id = req.params.cur_id; 
  const condition = {user_id: id };
  
  if(id > 0 && cur_id > 0) {

  Wallet.findOne({ where: condition })
  .then(data => { 

    // console.log(data.future_amount);

    var rtn = func.unserialize(data.future_amount);
    const resultArray = Object.keys(rtn).map(index => {
      var BAL = rtn[index][cur_id];
       res.status(200).send((BAL).toString()); 
  });   
  })
  .catch(err => {  
    console.log(err); 
    // res.status(500).send({
    // message: "Error retrieving Tutorial with id=" + id
    // });
    }); 

  }

};  



exports.getFutureOpenOrders = (req, res) => {
  
  let id = req.params.id;
  let pair_id = req.params.pair_id;
  
  var sql = "SELECT * FROM "+Prefix+"future_order WHERE user_id = "+id+" and pair = "+pair_id+" and status !='cancelled'";
      db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
        res.send(data)    
    }).catch( err => {
      console.log(err)
       
    })  
  };



  exports.getFutureCloseOrders = (req, res) => {
  
    let id = req.params.id;
    let pair_id = req.params.pair_id;
    
    var sql = "SELECT * FROM "+Prefix+"future_order WHERE user_id = "+id+" and pair = "+pair_id+" and status ='cancelled'";
        db.sequelize.query(sql, {  
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => { 
          res.send(data)    
      }).catch( err => {
        console.log(err)
         
      })  
    };


  exports.getFutureLimitOrders = (req,res) => {

    let id = req.params.id;
    
    var sql = "SELECT * FROM "+Prefix+"future_order WHERE user_id = "+id+" and order_status ='in-active'";
        db.sequelize.query(sql, {  
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => { 

        // console.log(data);
          res.send(data)    
      }).catch( err => {
        console.log(err)
         
      })  

  };


  exports.updateFuture = (req, res) => {
    const id = req.params.id;  
    future_order.update(req.body, {
      where: { id: id }
    })
      .then(data => {
        res.json(data);
      })
      .catch(err => {
        res.status(500).send({
          message: "Error updating user with id=" + id
        });
      }); 
  };


// Bot Orders Related
getBuyAllBotTrades = (pair) =>{
    return new Promise((resolve, reject)=>{
    var sql = "select Price,Amount from "+Prefix+"coin_order where bot_order ='1' and Type = 'buy' and pair_symbol ='"+pair+"' limit 20";
    return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })
  });
};

getSellAllBotTrades = (pair) =>{
    return new Promise((resolve, reject)=>{
    var sql = "select Price,Amount from "+Prefix+"coin_order where bot_order ='1' and Type = 'sell' and pair_symbol ='"+pair+"' limit 20";
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })
  });
};


getAllBotTrades = (pair) =>{
  return new Promise((resolve, reject)=>{
  var sql = "select Price,Amount,tradetime,Type from "+Prefix+"coin_order where bot_order ='1'  and pair_symbol ='"+pair+"' limit 20";
    return db.sequelize.query(sql, {    
  type: db.sequelize.QueryTypes.SELECT   
  }).then( (data) => { 
    return resolve(data);
  })
});
};

// async function getBororeders()
//   {
  exports.getBotoreders = async (req, res) => {

    let pair = req.params.pair_symbol;


    // if(pair.length >0){
     

    var buy_bots = await getBuyAllBotTrades(pair);
    var sell_bots = await getSellAllBotTrades(pair);
   
    // console.log(sell_bots);
    // console.log(buy_bots);
    // return;

    let sellData = [];
    let sell_res = [];
    let buyData = [];
    let buy_res = [];
    let data = [];

    var i = 1; 
    let max_sell_amount;
    var highest_sell_amount = Number.NEGATIVE_INFINITY;
    var highest_buy_amount = Number.NEGATIVE_INFINITY;
    for (const [price, datas] of Object.entries(sell_bots)) {

      var pric  = datas['Price'];
      var Amount = datas['Amount'];
      max_sell_amount = Amount;
      if (max_sell_amount > highest_sell_amount) highest_sell_amount = max_sell_amount;
    }
    for (const [price, datas] of Object.entries(buy_bots)) {
      var pric  = datas['Price'];
      var Amount = datas['Amount'];
      max_buy_amount = Amount;
      if (max_buy_amount > highest_buy_amount) highest_buy_amount = max_buy_amount;
    }

    // console.log(highest_sell_amount);
    // console.log(highest_buy_amount); 

    var decimal = 6;
    for (const [price, datas] of Object.entries(sell_bots)) {
      
      let pric = datas['Price'];
      let quantity = datas['Amount'];

      let ask_bar = (quantity*100)/highest_sell_amount;
      sellData = {
        'id':i,
        'price':Number(pric).toFixed(decimal),
        'ask_bar': Number(ask_bar).toFixed(2),
        'quantity':Number(quantity).toFixed(6),
        'total':Number(pric*quantity).toFixed(decimal),
        'ordertype':'Sell'
      };
     sell_res.push(sellData);
       i++;
    }
    for (const [price, datas] of Object.entries(buy_bots)) {
      let pric = datas['Price'];
      let quantity = datas['Amount'];
      let bids_bar = (quantity*100)/highest_buy_amount;
      buyData = {
        'id':i,
        'price':Number(pric).toFixed(decimal),
        'bids_bar': Number(bids_bar).toFixed(2),
        'quantity':Number(quantity).toFixed(6),
        'total':Number(pric*quantity).toFixed(decimal),
        'ordertype':'Buy'
      };

       buy_res.push(buyData);
       i++;
    }
    data = {
      'buy_res':buy_res,
      'sell_res':sell_res
    }

    if(data)
    {
      return res.status(200).send(data); 
    }

    // console.log(data); 
    // }
  
  };
// getBororeders();  




exports.getBotTrades = async (req, res) => {

  let pair = req.params.pair_symbol;
  var all_bots = await getAllBotTrades(pair);
 
  let sellData = [];
  let sell_res = [];
  let buyData = [];
  let buy_res = [];
  let data = [];
  let datares= [];

  var i = 1; 
  var decimal = 6;
  for (const [price, datas] of Object.entries(all_bots)) {
    
    let pric = datas['Price'];
    let quantity = datas['Amount'];
    let Time = datas['tradetime'];
    let Type = datas['Type'];
    
    var ore_type = true;
    if(Type=='buy')
    ore_type = true;
    else
    ore_type = false;


    data = {
      'id':i,
      'p':Number(pric).toFixed(decimal),
      'q':Number(quantity).toFixed(6),
      'm':ore_type,
      'T': Time
    };
    datares.push(data);
     i++;
  }
 
  return res.status(200).send(datares);  

 

};




  // Lowest Ask Price 

  exports.lowestaskprice = (req, res) => {
  
    let pair_id = req.params.pair_id;
    
    var sql = "SELECT MIN(Price) as Price FROM `blackcube_coin_order` WHERE `pair` = "+ pair_id +" AND `Type` = 'sell' AND `ordertype` NOT IN('stop') AND `status` IN('active', 'partially')";
        
    db.sequelize.query(sql, {  
      type: db.sequelize.QueryTypes.SELECT   
      }).then( (data) => { 
              
        
        if(data[0].Price!='')
        {
          res.send(data[0].Price) 
        }
        else
        {

          var sql = "SELECT sell_rate_value FROM `blackcube_trade_pairs` WHERE id = "+ pair_id +"";
          db.sequelize.query(sql, {  
            type: db.sequelize.QueryTypes.SELECT   
            }).then( (data) => { 
                   
                if(data[0]!='')
                {
                  res.send(data[0].sell_rate_value) 
                }

                
            }).catch( err => { 
                    res.json(500).send({
                  message:
                    err.message || "Some error occurred while retrieving Currency."
                });
            })          


 
        }



      }).catch( err => { 
          
        console.log(err); 
        
        //     res.json(500).send({
          //   message:
          //     err.message || "Some error occurred while retrieving Currency."
          // });
      })  
    }; 

 //highestbidprice
 
 exports.highestbidprice = (req, res) => {
  
    console.log(' Highest Fun '); 

  let pair_id = req.params.pair_id;
  
  var sql = "SELECT MAX(Price) as Price FROM `blackcube_coin_order` WHERE `pair` = "+ pair_id +" AND `Type` = 'buy' AND `ordertype` NOT IN('stop') AND `status` IN('active', 'partially')";
  db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 

      if(data[0].Price!='')
      { 
        console.log(data[0].Price);  
        //res.send(data[0].Price) 
      } 
      else
      {

        var sql = "SELECT buy_rate_value FROM `blackcube_trade_pairs` WHERE id = "+ pair_id +"";
        db.sequelize.query(sql, {  
          type: db.sequelize.QueryTypes.SELECT   
          }).then( (data) => { 

                console.log(data[0]); 

              if(data[0]!='')
              {
                res.send(data[0].buy_rate_value) 
              }

              
          }).catch( err => { 
              
                console.log(err);  
            
                  res.json(500).send({
                message:
                  err.message || "Some error occurred while retrieving Currency."
              });
          })          



      }




    }).catch( err => { 

          console.log(err); 
        
        //   res.json(500).send({
        //   message:
        //     err.message || "Some error occurred while retrieving Currency."
        // });
    })  
  };
  



exports.GetOrders = (req, res) => {
  
  let pair_id = req.params.pair_id;
  let trade_id = req.params.trade_id;
  var sql = "SELECT * FROM blackcube_coin_order WHERE trade_id = '"+trade_id+"' AND pair = '"+ pair_id + "'";

  //console.log(sql);    

  db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 

       // console.log(data[0]);  
        res.json(data[0]) 
    }).catch( err => {
            res.json(500).send({
          message:
            err.message || "Some error occurred while retrieving Currency."
        });
    }) 
  }; 


exports.GetOrderstotal = (req, res) => {
  
  let pair_id = req.params.pair_id;
  let type = req.params.type;
  var sql = "SELECT * FROM blackcube_coin_order WHERE Type = '"+type+"' AND pair = '"+ pair_id + "'";
  // console.log(sql);
  db.sequelize.query(sql, {  
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => {  
        res.json(data)  
    }).catch( err => {
            res.json(500).send({
          message:
            err.message || "Some error occurred while retrieving Currency."
        });
    }) 
  };




// Future Order Book
exports.GetFutureBinanceTrades = async (req, res) => {

    let symbol = req.params.symbol;
    var orderbook =   await binance.futuresAggTrades( symbol,{limit:20} );

    // var trades = await binance.futuresMarkPrice( "BTCUSDT",{limit:20} )

    // console.log(trades);   

    res.send(orderbook)     
  
    // binance.futuresAggTrades(symbol,{limit:20}, (error, response)=>{
    //     console.log(response); 
    //     if(!error)
    //     {
    //       res.send(response)    
    //     }
    // }); 

};




exports.getNotification = (req, res) => {
  
  let user_id = req.params.user_id;
  if(user_id) {

  var sql = "select * from "+Prefix+"transactions where user_id="+user_id+" and (type = 'Withdraw' OR type = 'Deposit' OR type = 'Buy' OR type = 'Sell') and clear_status='0'";
  // console.log(sql); 
  db.sequelize.query(sql, {  
  type: db.sequelize.QueryTypes.SELECT   
  }).then( (data) => { 

    // console.log(data);
      res.send(data)    
  }).catch( err => {
    console.log(err)
    
  })  

  }

};