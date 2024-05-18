module.exports = {
  HOST: "localhost",
  USER: "root",
  PASSWORD: "",
  DB: "blackcube_exchange",
  dialect: "mysql",
  pool: {
    max: 5,
    min: 0,
    acquire: 30000,
    idle: 10000
  }
}; 

// Live Server
// module.exports = {
//   HOST: "localhost",
//   USER: "root",
//   PASSWORD: "D&B&NnE3$s#aGJh@fFta&HxBWX",
//   DB: "bitwhalex",
//   dialect: "mysql",
//   pool: {
//     max: 5,
//     min: 0,
//     acquire: 30000,
//     idle: 10000
//   }
// };