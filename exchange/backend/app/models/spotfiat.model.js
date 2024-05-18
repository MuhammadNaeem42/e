module.exports = (sequelize, Sequelize) => {
    const spotfiat = sequelize.define("blackcube_spotfiat", {
      id: {
        type: Sequelize.STRING,
        primaryKey: true 
      },
      unique_id: {
        type: Sequelize.STRING 
      },
      user_id: {
        type: Sequelize.STRING 
      },
      cryptocurrency: {
        type: Sequelize.STRING
      },
      fiat_currency: {
        type: Sequelize.STRING
      },
      fiat_amount: {
        type: Sequelize.STRING
      },
      crypto_amount: {
        type: Sequelize.STRING
      },
      bank_id: {
        type: Sequelize.STRING
      },
      bank_type: {
        type: Sequelize.STRING
      },
      card_name: {
        type: Sequelize.STRING
      },
      card_number: {
        type: Sequelize.STRING
      },
      expiry_date: {
        type: Sequelize.STRING
      },
      ccv: {
        type: Sequelize.STRING
      },
      type: {
        type: Sequelize.STRING
      },
      perprice: {
        type: Sequelize.STRING
      },
      status: {
        type: Sequelize.STRING
      },
      datetime: {
        type: Sequelize.STRING
      },
     
      
    },{
      timestamps: false
    });
  
    return spotfiat;
  };