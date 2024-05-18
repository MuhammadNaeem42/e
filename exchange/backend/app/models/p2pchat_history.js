module.exports = (sequelize, Sequelize) => {
    const P2pchatHistory = sequelize.define("blackcube_p2pchat_history", {
      id: {
        type: Sequelize.STRING,
        primaryKey: true 
      },
      user_id: {
        type: Sequelize.STRING 
      },
      username: {
        type: Sequelize.STRING
      },
      comment: {
        type: Sequelize.STRING
      },
      added: {
        type: Sequelize.STRING
      },
      tradestatus: {
        type: Sequelize.STRING
      },
      tradeuser_id: {
        type: Sequelize.STRING
      },
      tradeid: {
        type: Sequelize.STRING
      },
      imagetype: {
        type: Sequelize.STRING
      },
      tradeorderid: {
        type: Sequelize.STRING
      },
      sellerid: {
        type: Sequelize.STRING
      },
     
      
    },{
      timestamps: false
    });
  
    return P2pchatHistory;
  };