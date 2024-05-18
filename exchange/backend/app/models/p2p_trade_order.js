module.exports = (sequelize, Sequelize) => {
    const P2ptradeOrder = sequelize.define("blackcube_p2ptradeorder", {
      id: {
        type: Sequelize.STRING,
        primaryKey: true 
      },
      buyerid: {
        type: Sequelize.STRING 
      },
      sellerid: {
        type: Sequelize.STRING
      },
      vendorid: {
        type: Sequelize.STRING
      },
      first_amount: {
        type: Sequelize.STRING
      },
      second_amount: {
        type: Sequelize.STRING
      },
      tradeid: {
        type: Sequelize.STRING
      },
      type: {
        type: Sequelize.STRING
      },
      message: {
        type: Sequelize.STRING
      },
      datetime: {
        type: Sequelize.STRING
      },
      status: {
        type: Sequelize.STRING
      },
      escrowamount: {
        type: Sequelize.STRING
      },
      paymentamount: {
        type: Sequelize.STRING
      },
      paymentconfirm: {
        type: Sequelize.STRING
      },
      escrowstatus: {
        type: Sequelize.STRING
      },
      tradestatus: {
        type: Sequelize.STRING
      },
      canceldatetime: {
        type: Sequelize.STRING
      },
      disputecomments: {
        type: Sequelize.STRING
      },
      disputetime: {
        type: Sequelize.STRING
      },
      paidtime: {
        type: Sequelize.STRING
      },
      vedor_paymentconfirm: {
        type: Sequelize.STRING
      },
      tradeopentime: {
        type: Sequelize.STRING
      },
      first_coin: {
        type: Sequelize.STRING
      },
      second_coin: {
        type: Sequelize.STRING
      },
      link: {
        type: Sequelize.STRING
      },
      dispute_status: {
        type: Sequelize.STRING
      },
      user_id: {
        type: Sequelize.STRING
      },
      
    },{
      timestamps: false
    });
  
    return P2ptradeOrder;
  };