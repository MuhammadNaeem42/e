module.exports = (sequelize, Sequelize) => {
    const P2ptrade = sequelize.define("blackcube_p2p_trade", {
      id: {
        type: Sequelize.STRING,
        primaryKey: true 
      },
      user_id: {
        type: Sequelize.STRING 
      },
      cryptocurrency: {
        type: Sequelize.STRING
      },
      country: {
        type: Sequelize.STRING
      },
      tradepricetype: {
        type: Sequelize.STRING
      },
      payment_method: {
        type: Sequelize.STRING
      },
      currency: {
        type: Sequelize.STRING
      },
      minimumtrade: {
        type: Sequelize.STRING
      },
      maximumtrade: {
        type: Sequelize.STRING
      },
      comission: {
        type: Sequelize.STRING
      },
      addtional_info: {
        type: Sequelize.STRING
      },
      terms_conditions: {
        type: Sequelize.STRING
      },
      type: {
        type: Sequelize.STRING
      },
      actualtradebuy: {
        type: Sequelize.STRING
      },
      price: {
        type: Sequelize.STRING
      },
      trade_amount: {
        type: Sequelize.STRING
      },
      offertime: {
        type: Sequelize.STRING
      },
      status: {
        type: Sequelize.STRING
      },
      tradestatus: {
        type: Sequelize.STRING
      },
      tradeid: {
        type: Sequelize.STRING
      },
      created_on: {
        type: Sequelize.STRING
      },
      updated_on: {
        type: Sequelize.STRING
      },
      price_type: {
        type: Sequelize.STRING
      },
      paymenttime: {
        type: Sequelize.STRING
      },
      datetime: {
        type: Sequelize.STRING
      },
      
    },{
      timestamps: false
    });
  
    return P2ptrade;
  };