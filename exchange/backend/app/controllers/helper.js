const db = require("../models");
const Currency = db.currency;
const Op = db.Sequelize.Op;
let Prefix = 'blackcube_';

// Wrapper for nodejs/browser compat
(function (window, exports) {
    // Public API
    // exports.checkTradePairs = checkTradePairs;
    // exports.number_check = number_check;
    
// getPairId = () =>{
//     return new Promise((resolve, reject)=>{
//         var sql = "select id,from_symbol_id,to_symbol_id,lastPrice,priceChangePercent from bitwhalex_trade_pairs where id=1 order by id DESC"; 
//           return db.sequelize.query(sql, {    
//         type: db.sequelize.QueryTypes.SELECT   
//         }).then( (data) => { 
//           return resolve(data);
//         })
    
//       });
//   };


//   module.exports = getPairId;


function checkTradePairs(from_id,to_id){
  return new Promise((resolve, reject)=>{
      var sql = "SELECT * FROM "+Prefix+"trade_pairs as a INNER JOIN "+Prefix+"currency as b ON a.from_symbol_id = b.id INNER JOIN "+Prefix+"currency as c ON a.to_symbol_id = c.id WHERE a.status = 1 AND b.status !=0 AND c.status !=0 AND   b.currency_symbol ='"+from_id+"' AND c.currency_symbol = '"+to_id+"'"; 
      return db.sequelize.query(sql, {    
    type: db.sequelize.QueryTypes.SELECT   
    }).then( (data) => { 
      return resolve(data);
    })

  });
};


function number_check()
{

  console.log("Checking Process"); 

  return new Promise((resolve, reject)=>{
    var sql = "SELECT * FROM blackcube_trade_pairs where status = '1'"; 
    return db.sequelize.query(sql, {    
  type: db.sequelize.QueryTypes.SELECT   
  }).then( (data) => { 
    return resolve(data);
  })

}); 

}

module.exports = number_check;

})