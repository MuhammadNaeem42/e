module.exports = app => {
    //const trade = require("../controllers/trade.controller.js");
    const common = require("../controllers/common.controller.js");
   
    var router = require("express").Router();

    router.get("/getActivePair", common.getActivePair);
    router.get("/getAllPairs", common.getAllPairs);
    router.get("/getFutureAllPairs", common.getFutureAllPairs);

    // Get Currency

    // router.get("/getActiveCurrency/:id", common.getActiveCurrency);



    router.get("/getRow/:table/:column/:value", common.getRow); 
    router.get("/getAllCurrencies/:pair/:user_id", common.getAllCurrencies);
    router.get("/getFavourites/:user_id", common.getFavourites);  
    router.get("/addFavourite/:pair/:user_id", common.addFavourite); 

    // Binance Call
    router.get("/GetBinanceTrades/:symbol", common.GetBinanceTrades); 

    router.get("/apiOrderBook/:pair", common.getTradeApiBookOrders); 


    // Future Order Book

    router.get("/getFutureTradeApiBookOrders/:pair", common.getFutureTradeApiBookOrders); 


    // SumSub

    router.get("/CreateSignature", common.CreateSignature);  
    router.get("/KycStatus/:applicantId", common.KycStatus); 
 

      //retrive open orders
      router.get("/open_orders/:id/:pair_id/:type", common.OpenOrder);
      router.get("/all_close_orders/:id/:pair_id/:type", common.allCloseOrders);
      router.get("/order_history/:id/:pair_id/:type", common.OrderHistory);
      router.get("/GetcoinOrder/:trade_id", common.GetcoinOrder); 
      router.put("/updateorderstatus/:trade_id", common.updateorderstatus); 
      router.get("/Getpairdetails/:id", common.Getpairdetails); 
      router.get("/GetOrderTemp/:temp_id", common.GetOrderTemp);
      router.get("/GetOrderTempsum/:temp_id/:column", common.GetOrderTempsum);  
      router.get("/GetBalance/:user_id/:cur_id", common.GetBalance);


      router.get("/lowestaskprice/:pair_id", common.lowestaskprice);  
      router.get("/highestbidprice/:pair_id", common.highestbidprice);
      router.get("/GetOrders/:pair_id/:trade_id/", common.GetOrders);  
      router.get("/GetOrderstotal/:type/:pair_id/", common.GetOrderstotal);     


      
      // Margin
      router.get("/GetMarginBalance/:user_id/:cur_id", common.GetMarginBalance);

      // Future 
      router.get("/GetFutureBalance/:user_id/:cur_id", common.GetFutureBalance);
      router.put("/FuturecreateOrder/", common.FuturecreateOrder); 
      router.get("/getFutureOpenOrders/:id/:pair_id", common.getFutureOpenOrders);
      router.put("/updateFuture/:id", common.updateFuture);  
      router.get("/getFutureLimitOrders/:id", common.getFutureLimitOrders);

      router.get("/getFutureCloseOrders/:id/:pair_id", common.getFutureCloseOrders);

        // Market Trades  
      router.get("/GetFutureBinanceTrades/:symbol", common.GetFutureBinanceTrades); 


      // ETF Trading
      router.get("/GetETFBalance/:user_id/:cur_id", common.GetETFBalance);

      // Bot Order 

       router.get("/getBotoreders/:pair_symbol", common.getBotoreders);
       router.get("/getBotTrades/:pair_symbol", common.getBotTrades);

      
      router.get("/GetAvailableBalance/:user_id/:cur_id", common.GetAvailableBalance); 
      router.get("/updateUserBalance/:user_id/:currency/:balance", common.updateUserBalance);    
      router.put("/pairData/:pair_id", common.pairData);
      router.get("/web3result/:id", common.updateUserBalance);  



    // execute order
    router.put("/createOrder/", common.createOrder); 
    router.get("/Duprecord/:updated_on", common.Duprecord); 
    router.get("/OpenMapOrder/:trade_id/:pair_id/", common.OpenMapOrder);
    router.get("/Getparticular/:price/:pair_id/:type", common.Getparticular);
    router.get("/checkOrdertemp/:orderId/:ordertype", common.checkOrdertemp); 
    router.put("/createOrdertemp/", common.createOrdertemp); 
    router.put("/createTranshistory/", common.createTranshistory);
    app.use('/api/common', router); 


    // Spot
    router.get("/Currencieslist", common.Currencieslist); 
    router.get("/GetUsersBal/:user_id/:currency", common.GetUsersBal); 
    router.put("/updateSpot/:id", common.updateSpot); 


    // Notification 

    router.get("/getNotification/:user_id", common.getNotification);


 
  }; 