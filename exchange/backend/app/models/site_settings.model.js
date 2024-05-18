
module.exports = (sequelize, Sequelize) => {
    const SiteSettings = sequelize.define("blackcube_site_settings", {
      site_name: {
        type: Sequelize.STRING
      },
      site_email: {
        type: Sequelize.STRING
      },
      site_logo: {
        type: Sequelize.STRING
      },
      site_favicon: {
        type: Sequelize.STRING
      },
      auth_id: {
        type: Sequelize.STRING
      },
      auth_token: {
        type: Sequelize.STRING
      },
      from_number: {
        type: Sequelize.STRING
      },
      smtp_host: {
        type: Sequelize.STRING
      },
      smtp_port: {
        type: Sequelize.STRING
      },
      smtp_email: {
        type: Sequelize.STRING
      },
      smtp_password: {
        type: Sequelize.STRING
      },
      copy_right_text: {
        type: Sequelize.STRING
      },
      google_captcha_secretkey: {
        type: Sequelize.STRING
      },
      google_captcha_sitekey: {
        type: Sequelize.STRING
      },
      address: {
        type: Sequelize.STRING
      },
      city: {
        type: Sequelize.STRING
      },
      state: {
        type: Sequelize.STRING
      },
      country: {
        type: Sequelize.STRING
      },
      zip: {
        type: Sequelize.STRING
      },
      contactno: {
        type: Sequelize.STRING
      },
      altcontactno: {
        type: Sequelize.STRING
      },
      facebooklink: {
        type: Sequelize.STRING
      },
      twitterlink: {
        type: Sequelize.STRING
      },
      telegramlink: {
        type: Sequelize.STRING
      },
      youtube_link: {
        type: Sequelize.STRING
      },
      linkedin_link: {
        type: Sequelize.STRING
      },
      googlelink: {
        type: Sequelize.STRING
      },
      dribble_link: {
        type: Sequelize.STRING
      },
      withdraw_limit_1: {
        type: Sequelize.STRING
      },
      withdraw_limit_2: {
        type: Sequelize.STRING
      },
      withdraw_limit_3: {
        type: Sequelize.STRING
      },
      margin_trading_percentage: {
        type: Sequelize.STRING
      },
      lending_min_loan_rate: {
        type: Sequelize.STRING
      },
      lending_fees: {
        type: Sequelize.STRING
      },
      base_price_calculation: {
        type: Sequelize.STRING
      },
      sell_offer_update_time: {
        type: Sequelize.STRING
      },
      buy_offer_update_time: {
        type: Sequelize.STRING
      },
      ios_app_link: {
        type: Sequelize.STRING
      },
      android_app_link: {
        type: Sequelize.STRING
      },
      trade_execution_type: {
        type: Sequelize.STRING
      },
      remarket_concept: {
        type: Sequelize.STRING
      },
      liquidity_concept: {
        type: Sequelize.STRING
      },
      balance_alert: {
        type: Sequelize.STRING
      },
      admin_withdraw_confirmation: {
        type: Sequelize.STRING
      },
      newuser_reg_status: {
        type: Sequelize.STRING
      },
      verify_user_cash_status: {
        type: Sequelize.STRING
      },
      unverify_user_cash_status: {
        type: Sequelize.STRING
      },
      tradehistory_via_api: {
        type: Sequelize.STRING
      },
      paypal_id: {
        type: Sequelize.STRING
      },
      paypal_mode: {
        type: Sequelize.STRING
      },
      token_fees: {
        type: Sequelize.STRING
      },
   
      stripeapi_private_key: {
        type: Sequelize.STRING
      },

      stripeapi_public_key: {
        type: Sequelize.STRING
      },
      stripe_mode: {
        type: Sequelize.STRING
      },
      cryptocompare_apikey: {
        type: Sequelize.STRING
      },
      chart_interval: {
        type: Sequelize.STRING
      },
      chart_days: {
        type: Sequelize.STRING
      },

      stellar_address: {
        type: Sequelize.STRING
      },
      binance_api_key: {
        type: Sequelize.STRING
      },
      binance_secret_key: {
        type: Sequelize.STRING
      }
  
    },{
      timestamps: false
    });
  
    return SiteSettings;
  };