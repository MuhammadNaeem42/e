const dbConfig = require("../config/db.config.js");
const Sequelize = require("sequelize");
const sequelize = new Sequelize(dbConfig.DB, dbConfig.USER, dbConfig.PASSWORD, {
  host: dbConfig.HOST,
  dialect: dbConfig.dialect,
  operatorsAliases: 0,
  define: {
    timestamps: true,
    freezeTableName: true,
    paranoid: true
  },
  pool: {
    max: dbConfig.pool.max,
    min: dbConfig.pool.min,
    acquire: dbConfig.pool.acquire,
    idle: dbConfig.pool.idle
  },
  logging: false

});
// sequelize
// .authenticate()
// .then(() => {
// console.log('Connection has been established successfully.');
// })
// .catch(err => {
// console.error('Unable to connect to the database:', err);
// });
const db = {};

db.Sequelize = Sequelize;
db.sequelize = sequelize;

// db.admin = require("./admin.model.js")(sequelize, Sequelize);
db.site_settings = require("./site_settings.model.js")(sequelize, Sequelize);
// db.users = require("./users.model.js")(sequelize, Sequelize);
 db.currency = require("./currency.model.js")(sequelize, Sequelize);
 db.coin_order = require("./coin_order.model.js")(sequelize, Sequelize); 
 db.api_orders = require("./api_orders.model.js")(sequelize, Sequelize); 
 db.trade_pairs = require("./trade_pairs.model.js")(sequelize, Sequelize); 
 db.wallet = require("./wallet.model.js")(sequelize, Sequelize); 
 db.ordertemp = require("./ordertemp.model.js")(sequelize, Sequelize); 
 db.Transhistory = require("./transaction_history.model.js")(sequelize, Sequelize);  
 db.favourites = require("./favourites.model.js")(sequelize, Sequelize);  

 db.spotfiat = require("./spotfiat.model.js")(sequelize, Sequelize);  

 db.future_order = require("./future_order.model.js")(sequelize, Sequelize); 


 module.exports = db;   
