module.exports = (sequelize, Sequelize) => {
    const FutureOrder = sequelize.define("blackcube_future_order", {
      
      id: {
        type: Sequelize.STRING,
        autoIncrement: true,
        primaryKey: true
      },
      order_id: {
        type: Sequelize.STRING
      }, 
      user_id: {
        type: Sequelize.STRING
      },
      amount: {
        type: Sequelize.STRING
      },
      price: {
        type: Sequelize.STRING
      },
      type: {
        type: Sequelize.STRING
      },
      fee: {
        type: Sequelize.STRING
      },
      total: {
        type: Sequelize.STRING
      },
      leverage: {
        type: Sequelize.STRING
      },
      wallet: {
        type: Sequelize.STRING
      },
      take_profit: {
        type: Sequelize.STRING
      },
      stop_loss: {
        type: Sequelize.STRING
      },
      orderDate: {
        type: Sequelize.STRING
      },
      ordertype: {
        type: Sequelize.STRING
      },
      order_method: {
        type: Sequelize.STRING
      },
      order_status: {
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
      close_status: {
        type: Sequelize.STRING
      },
      PNL: {
        type: Sequelize.STRING
      },
      ROE: {
        type: Sequelize.STRING
      },
      close_price : {
        type: Sequelize.STRING
      },
     pair: {
        type: Sequelize.STRING
      },
      pair_symbol: {
        type: Sequelize.STRING
      } 

    },{
      timestamps: false
    });
    // CoinOrder.removeAttribute('id');  
    return FutureOrder;
  };
   