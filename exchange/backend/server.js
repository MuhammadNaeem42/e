const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();

// Add headers

app.use(function(req, res, next) {
res.header("Access-Control-Allow-Origin", "*");
res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
res.header('Access-Control-Allow-Methods', 'PUT, POST, GET, DELETE, OPTIONS');
next();
});

// app.use(cors(corsOptions));

// parse requests of content-type - application/json
app.use(bodyParser.json());

// parse requests of content-type - application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }));

const db = require("./app/models");


// simple route
app.get("/", (req, res) => {
res.json({ message: "Welcome to Blackcube Trade Page." });
});





 require("./app/routes/common.routes")(app); 
// require("./app/routes/site_settings.routes")(app);
// require("./app/routes/users.routes")(app);
//  require("./app/routes/currency.routes")(app);

// set port, listen for requests
const PORT = process.env.PORT || 8080;
app.listen(PORT, () => {
console.log(`Server is running on port ${PORT}.`);
});  