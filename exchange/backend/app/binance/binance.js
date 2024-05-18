//const Binance = require('binance-api-node').default
const Binance = require('node-binance-api');
 

const binance = new Binance().options({
  APIKEY: 'en6EkW0HBhf5b60KaDJCvLtUvNpoSIfeia8Roi14i1wJzde5Z1vESFNxoMM2NsVF',
  APISECRET: 'erHfe51Pp5n2RiGDvUg8i4C7blONYarw8vqvwSkTpgwQTHpxpoG6DFCJiPTSnOGA'
}); 
 
//(async () => console.log(await client.futuresOpenOrders()))()   


// Price Changes
// binance.prevDay("ETHBTC", (error, prevDay, symbol) => {
//   console.info(symbol+" previous day:", prevDay);
//   console.info("BNB change since yesterday: "+prevDay.priceChangePercent+"%")
// });



// 24hr ticker

// binance.prevDay("BNBBTC", (error, prevDay, symbol) => {
//   console.info(symbol+" previous day:", prevDay);
//   console.info("BNB change since yesterday: "+prevDay.priceChangePercent+"%")
// }); 
 

// Trade Orders 

   


function test()
{
 
  return 'Hello';


}

 

module.exports.Binancecall = (symbol) => {
};


module.exports.trades = (symbol) => {

 
  
  //  binance.websockets(['ETHUSDT'], (trades) => {

  //   let {e:eventType, E:eventTime, s:symbol, p:price, q:quantity, m:maker, a:tradeId} = trades;
        
  //         return trades;
  //     })
  //     .catch((error) => {
  //         return { message: "Fail" };
  //     }); 



};