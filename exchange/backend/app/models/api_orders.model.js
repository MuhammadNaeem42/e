module.exports = (sequelize, Sequelize) => {
    const ApiOrders = sequelize.define("blackcube_api_orders", {
      trade_id: { 
        type: Sequelize.STRING
      },
      price: {
        type: Sequelize.STRING
      },
      quantity: {
        type: Sequelize.STRING
      },
      pair_id: {
        type: Sequelize.STRING
      },
      pair_symbol: {
        type: Sequelize.STRING
      },
      type: {
        type: Sequelize.STRING
      },
      updated_at: {
        type: Sequelize.STRING
      },
     
    },{
      timestamps: false
    });
  
    return ApiOrders;
  };