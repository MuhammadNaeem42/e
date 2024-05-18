module.exports = (sequelize, Sequelize) => {
  const Currency = sequelize.define("blackcube_currency", {
    currency_name: {
      type: Sequelize.STRING
    },
    currency_symbol: {
      type: Sequelize.STRING
    },
    asset_type: {
      type: Sequelize.STRING
    },
    crypto_type: {
      type: Sequelize.STRING
    },
    blockchaintype: {
      type: Sequelize.STRING
    },
    tips: {
      type: Sequelize.STRING
    },
    tips_withdraw: {
      type: Sequelize.STRING
    },
    crypto_type_other: {
      type: Sequelize.STRING
    },
    token_type: {
      type: Sequelize.STRING
    },
      max_supply: {
      type: Sequelize.STRING
    },
     priority: {
      type: Sequelize.STRING
    },
     user_id: {
      type: Sequelize.STRING
    },
     added_by: {
      type: Sequelize.STRING
    },
     type: {
      type: Sequelize.STRING
    },
     coin_type: {
      type: Sequelize.STRING
    },
     image: {
      type: Sequelize.STRING
    },
     status: {
      type: Sequelize.STRING
    },
     verify_request: {
      type: Sequelize.STRING
    },
     created: {
      type: Sequelize.STRING
    },
     contract_address: {
      type: Sequelize.STRING
    },
     currency_sign: {
      type: Sequelize.STRING
    },
     reserve_Amount: {
      type: Sequelize.STRING
    },
     online_usdprice: {
      type: Sequelize.STRING
    },
     usdpice_ref_site: {
      type: Sequelize.STRING
    },
     min_deposit_limit: {
      type: Sequelize.STRING
    },
     max_deposit_limit: {
      type: Sequelize.STRING
    },
     min_withdraw_limit: {
      type: Sequelize.STRING
    },
     max_withdraw_limit: {
      type: Sequelize.STRING
    },
     deposit_fees_type: {
      type: Sequelize.STRING
    },
     deposit_fees: {
      type: Sequelize.STRING
    },
     deposit_max_fees: {
      type: Sequelize.STRING
    },
    withdraw_fees_type: {
      type: Sequelize.STRING
    },
    withdraw_fees: {
      type: Sequelize.STRING
    },
    maker_fee: {
      type: Sequelize.STRING
    },
    taker_fee: {
      type: Sequelize.STRING
    },
    oneday_change: {
      type: Sequelize.STRING
    },
    currency_decimal: {
      type: Sequelize.STRING
    },
      last_modified: {
      type: Sequelize.STRING
    },
      active_time: {
      type: Sequelize.STRING
    },
    token_bac_value: {
      type: Sequelize.STRING
    },
    sort_order: {
      type: Sequelize.STRING
    },
    market_cap_change_percentage_24h: {
      type: Sequelize.STRING
    },
    usd_cap: {
      type: Sequelize.STRING
    },
    token_price: {
      type: Sequelize.STRING
    },
    move_admin: {
      type: Sequelize.STRING
    },
    show_home: {
      type: Sequelize.STRING
    },
    deposit_currency: {
      type: Sequelize.STRING
    },
    deposit_status: {
      type: Sequelize.STRING
    },
    withdraw_status: {
      type: Sequelize.STRING
    },
    trade_status: {
      type: Sequelize.STRING
    },
    fiatdeposit_status: {
      type: Sequelize.STRING
    },
    fiatwithdraw_status: {
      type: Sequelize.STRING
    },
    move_coin_limit: {
      type: Sequelize.STRING
    },
      move_process_admin: {
      type: Sequelize.STRING
    },
    borrow_perc: {
      type: Sequelize.STRING
    }
  },{
    timestamps: false
  });

  return Currency;
};