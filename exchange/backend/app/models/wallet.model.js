module.exports = (sequelize, Sequelize) => {
    const Wallet = sequelize.define("blackcube_wallet", {
      user_id: {
        type: Sequelize.STRING
      },
      crypto_amount: {
        type: Sequelize.STRING
      },
      margin_amount: {
        type: Sequelize.STRING
      },
      future_amount: {
        type: Sequelize.STRING
      },
      etf_amount: {
        type: Sequelize.STRING
      },
      fiat_amount:{
        type: Sequelize.STRING 
      },
      status: {
        type: Sequelize.STRING
      }
      
    },{
      timestamps: false
    }); 
  
    return Wallet;
  };