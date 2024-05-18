module.exports = (sequelize, Sequelize) => {
    const TransactionHistory = sequelize.define("blackcube_transaction_history", {
      userId: {
        type: Sequelize.STRING
      },
      currency: {
        type: Sequelize.STRING
      },
      profit_amount: {
        type: Sequelize.STRING
      },
      bonus_amount: {
        type: Sequelize.STRING
      },
      amount: {
        type: Sequelize.STRING
      },
      type: {
        type: Sequelize.STRING
      },
      comment: {
        type: Sequelize.STRING
      },
        datetime: {
        type: Sequelize.STRING
      },
      currency_type: {
        type: Sequelize.STRING
      },
      user_crypto_balance: {
        type: Sequelize.STRING
      }
      
     
    },{
      timestamps: false
    });
  
    return TransactionHistory;
  };

  

 
