module.exports = (sequelize, Sequelize) => {
    const Users = sequelize.define("blackcube_users", {
      ip_address: {
        type: Sequelize.STRING
      },
      browser_name: {
        type: Sequelize.STRING
      },
      blackcube_fname: {
        type: Sequelize.STRING
      },
      blackcube_lname: {
        type: Sequelize.STRING
      },
      blackcube_username: {
        type: Sequelize.STRING
      },
      blackcube_password: {
        type: Sequelize.STRING
      },
      blackcube_email: {
        type: Sequelize.STRING
      },
      activation_code: {
        type: Sequelize.STRING
      },
      verification_code: {
        type: Sequelize.STRING
      },
      forgotten_password_code: {
        type: Sequelize.STRING
      },
      forgotten_password_time: {
        type: Sequelize.STRING
      },
      forgot_url: {
        type: Sequelize.STRING
      },
      remember_code: {
        type: Sequelize.STRING
      },
      created_on: {
        type: Sequelize.STRING
      },
      last_login: {
        type: Sequelize.STRING
      },
      profile_picture: {
        type: Sequelize.STRING
      },
      phone_prefix: {
        type: Sequelize.STRING
      },
      blackcube_phone: {
        type: Sequelize.STRING
      },
      blackcube_language: {
        type: Sequelize.STRING
      },
      city: {
        type: Sequelize.STRING
      },
      country: {
        type: Sequelize.STRING
      },
      randcode: {
        type: Sequelize.STRING
      },
      secret: {
        type: Sequelize.STRING
      },
      verified: {
        type: Sequelize.STRING
      },
      register_from: {
        type: Sequelize.STRING
      },
      verification_level: {
        type: Sequelize.STRING
      },
      street_address: {
        type: Sequelize.STRING
      },
      street_address_2: {
        type: Sequelize.STRING
      },
      state: {
        type: Sequelize.STRING
      },
      postal_code: {
        type: Sequelize.STRING
      },
      photo_id_1: {
        type: Sequelize.STRING
      },
      photo_id_2: {
        type: Sequelize.STRING
      },
      photo_id_3: {
        type: Sequelize.STRING
      },
      photo_id_4: {
        type: Sequelize.STRING
      },
      photo_id_5: {
        type: Sequelize.STRING
      },
      verify_level2_status: {
        type: Sequelize.STRING
      },
      verify_level2_date: {
        type: Sequelize.STRING
      },
      photo_1_status: {
        type: Sequelize.STRING
      },
      photo_2_status: {
        type: Sequelize.STRING
      },
      photo_3_status: {
        type: Sequelize.STRING
      },
      photo_4_status: {
        type: Sequelize.STRING
      },
      photo_5_status: {
        type: Sequelize.STRING
      },
      photo_1_reason: {
        type: Sequelize.STRING
      },
      photo_2_reason: {
        type: Sequelize.STRING
      },
      photo_3_reason: {
        type: Sequelize.STRING
      },
      photo_4_reason: {
        type: Sequelize.STRING
      },
      photo_5_reason: {
        type: Sequelize.STRING
      },
      usertype: {
        type: Sequelize.STRING
      },
      profile_status: {
        type: Sequelize.STRING
      },
      kyc_status: {
        type: Sequelize.STRING
      },
      trade_check: {
        type: Sequelize.STRING
      },
      trade_start_date: {
        type: Sequelize.STRING
      },
      trade_expire_date: {
        type: Sequelize.STRING
      },
      bot_account: {
        type: Sequelize.STRING
      },
      facebook_id: {
        type: Sequelize.STRING
      },
      instagram_id: {
        type: Sequelize.STRING
      },
      twitter_id: {
        type: Sequelize.STRING
      },
      linkedin_id: {
        type: Sequelize.STRING
      }

    },{
      timestamps: false
    });
  
    return Users;
  };