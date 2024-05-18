module.exports = (sequelize, Sequelize) => {
    const Ordertemp = sequelize.define("blackcube_ordertemp", {
      tempId: { 
        type: Sequelize.STRING,
        autoIncrement: true,
        primaryKey: true
      },
      sellorderId: {
        type: Sequelize.STRING
      },
      sellerUserid: {
        type: Sequelize.STRING
      },
      askAmount: {
        type: Sequelize.STRING
      },
      askPrice: {
        type: Sequelize.STRING
      },
      filledAmount: {
        type: Sequelize.STRING
      },
      buyorderId: {
        type: Sequelize.STRING
      },
        buyerUserid: {
        type: Sequelize.STRING
      },
      sellerStatus: {
        type: Sequelize.STRING
      },
      buyerStatus: {
        type: Sequelize.STRING
      },
      datetime: {
        type: Sequelize.STRING
      },
      pair: {
        type: Sequelize.STRING
      },
      ac_price: {
        type: Sequelize.STRING
      },
      wantPrice: {
        type: Sequelize.STRING
      },
      ac_type: {
        type: Sequelize.STRING
      },
      ac_amount: {
        type: Sequelize.STRING
      }
     
    },{
      timestamps: false
    });
  
    return Ordertemp;
  };

  

 
