module.exports = (sequelize, Sequelize) => {
    const Favourites = sequelize.define("blackcube_favourite_pairs", {
      pair_id: {
        type: Sequelize.NUMBER
      },
      user_id: {
        type: Sequelize.NUMBER
      },
      user_ip: {
        type: Sequelize.STRING
      },
      created: {
        type: Sequelize.NUMBER
      }
    },{
      timestamps: false
    });
  
    return Favourites;
  };