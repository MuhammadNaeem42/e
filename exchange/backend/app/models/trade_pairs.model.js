module.exports = (sequelize, Sequelize) => {
    const TradePairs = sequelize.define("blackcube_trade_pairs", {
      id: {
        type: Sequelize.STRING,
        primaryKey: true 
      },
      to_symbol_id: {
        type: Sequelize.STRING 
      },
        from_symbol_id: {
        type: Sequelize.STRING
      },
      buy_rate_value: {
        type: Sequelize.STRING
      },
      sell_rate_value: {
        type: Sequelize.STRING
      },
      min_trade_amount: {
        type: Sequelize.STRING
      },
      status: {
        type: Sequelize.STRING
      },
      created: {
        type: Sequelize.STRING
      },
      coin_price: {
        type: Sequelize.STRING
      },
      coin_volume: {
        type: Sequelize.STRING
      },
      coin_change: {
        type: Sequelize.STRING
      },
      priceChangePercent: {
        type: Sequelize.STRING
      },
      lastPrice: {
        type: Sequelize.STRING
      },
      volume: {
        type: Sequelize.STRING
      },
      change_high: {
        type: Sequelize.STRING
      },
      change_low: {
        type: Sequelize.STRING
      },
      api_status: {
        type: Sequelize.STRING
      },
      shown_status: {
        type: Sequelize.STRING
      },
      bot_min_amount: {
        type: Sequelize.STRING
      },
      bot_max_amount: {
        type: Sequelize.STRING
      },
      bot_minprice_per: {
        type: Sequelize.STRING
      },
      bot_maxprice_per: {
        type: Sequelize.STRING
      },
      bot_time_min: {
        type: Sequelize.STRING
      },
      bot_time_max: {
        type: Sequelize.STRING
      },
      bot_status: {
        type: Sequelize.STRING
      },
      etf_status: {
        type: Sequelize.STRING
      },
      
    },{
      timestamps: false
    });
  
    return TradePairs;
  };