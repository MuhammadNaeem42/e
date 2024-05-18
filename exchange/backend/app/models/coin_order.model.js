module.exports = (sequelize, Sequelize) => {
    const CoinOrder = sequelize.define("blackcube_coin_order", {
      
      trade_id: {
        type: Sequelize.STRING,
        autoIncrement: true,
        primaryKey: true
      }, 
      userId: {
        type: Sequelize.STRING
      },
      Amount: {
        type: Sequelize.STRING
      },
      Price: {
        type: Sequelize.STRING
      },
      Type: {
        type: Sequelize.STRING
      },
      Fee: {
        type: Sequelize.STRING
      },
      Total: {
        type: Sequelize.STRING
      },
      wallet: {
        type: Sequelize.STRING
      },
      orderDate: {
        type: Sequelize.STRING
      },
      orderTime: {
        type: Sequelize.STRING
      },
      ordertype: {
        type: Sequelize.STRING
      },
      datetime: {
        type: Sequelize.STRING
      },
      pair: {
        type: Sequelize.STRING
      },
      pair_symbol: {
        type: Sequelize.STRING
      },
      status: {
        type: Sequelize.STRING
      },
      stoporderprice: {
        type: Sequelize.STRING
      },
      limit_price: {
        type: Sequelize.STRING
      },
       
       fee_per: {
        type: Sequelize.STRING
      },
       tradetime: {
        type: Sequelize.STRING
      },
       remarket_order_id: {
        type: Sequelize.STRING,
        allowNull: false,
        defaultValue: '0'
      },
       old_remarket_id: {
        type: Sequelize.STRING,
        allowNull: false,
        defaultValue: '0'
      },
       click_status: {
        type: Sequelize.STRING,
        allowNull: false,
        defaultValue: '0'
      },
       updated_on: {
        type: Sequelize.STRING
      },
       bot_order: {
        type: Sequelize.STRING
      },
      borrow_amt: {
        type: Sequelize.STRING
      },
      borrow_status: {
        type: Sequelize.STRING
      },
      etf_status: {
        type: Sequelize.STRING
      }  

    },{
      timestamps: false
    });
    // CoinOrder.removeAttribute('id');  
    return CoinOrder;
  };
  

  

  // coin_order_data = {trade_id:null,userId:null,Amount:null,Price:null,type:null,Fee:null,Total:null,wallet:null,orderDate:null,orderTime:null,ordertype:null,datetime:null,pair:null,pair_symbol:null,status:null,stoporderprice:null,limit_price:null,trigger_price:null,fee_per:null,tradetime:null,remarket_order_id:null,old_remarket_id:null,click_status:null,updated_on:null,bot_order:null};
 