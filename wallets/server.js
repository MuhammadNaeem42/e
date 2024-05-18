var http = require('http'),
    qs = require('querystring');
var WAValidator = require('wallet-address-validator');

var server = http.createServer(function(req, res) {
  if (req.method === 'POST') {
    var body = '';
    req.on('data', function(chunk) {
      body += chunk;
    });
    req.on('end', function() {
		var data = JSON.parse(body);
		console.log(data);
		var Url = data.url;

		
		if(data.method === 'getnewaddress'){
			try{

				  	const RippleAPI = require('ripple-lib').RippleAPI;

				  	const Ripple = new RippleAPI({ server: 'ws://127.0.0.1:6006' })

				  	 var results = Ripple.generateAddress();

				  	 //console.log(results);
					 var address = "r3fnhspxk1c7bN7PM7RV46UiFQguPpsPj7";
                     var secret = "sn8Sey5hosbnTzErA7bTyTjtEeo3Z";

				  	 if(results)
				  	 {
				  	 	var obj = {
							//"address" : results.address,
							"address" : address,
							"secret": secret,
							'tag': Math.floor(Math.random() * 1000000000)
						};
						res.writeHead(200);
						res.end(JSON.stringify(obj));
				  	 }
			}
			catch(err) {
				console.log(err);
			}
		}
		else if(data.method == "gettransaction")
		{

			console.log(data);

			try{
	               console.log('transactions');

				  	const RippleAPI = require('ripple-lib').RippleAPI;

				  	const Ripple = new RippleAPI({ server: 'ws://127.0.0.1:6006' });

				  	var address = data.address;

					console.log(address);

                    Ripple.getTransactions(address).then(transaction => {
                   	console.log(transaction);
					});
		
			}
			catch(err) {
				console.log(err);
			}
		}
		else if(data.method == "sendamount")
		{

			 const RippleAPI = require('ripple-lib').RippleAPI;
			 const api = new RippleAPI({server: 'ws://127.0.0.1:6006'});
			 const sender = data.sendaddress;
		     const amount  = data.amount;
		     const address1 = data.address;
		     const secret = data.tag_id;
		     const SECRET_1 = data.secret;
		     const amount_string = amount.toString();
			const xyz = data.destag;
		     const tag_string = parseInt(xyz);
			 api.connect().then(() => {
			  const address = sender;
			  const payment = {
			    'source': {
			      'address': sender,
			      'maxAmount': {
			        'value': amount_string,
			        'currency': 'XRP'
			      }
			    },
			    'destination': {
			      'address': address1,
			      'tag': tag_string,
			      'amount': {
			        'value': amount_string,
			        'currency': 'XRP'
			      },
			     
			    }
			  }
//console.log(data.destag);
			   api.preparePayment(address, payment).then(prepared => {
			      console.log(prepared);
			      console.log(prepared.txJSON);
				  console.log(SECRET_1);
				  const {signedTransaction, id} = api.sign(prepared.txJSON,SECRET_1);
				  console.log(id);
				  api.submit(signedTransaction).then(result => 
			      {
			   		console.log(JSON.stringify(result, null, 2));
				    const results  = JSON.stringify(result, null, 2);
				      if(results)
					  {
					  	 	var obj = {
								"result":result
							};
							res.writeHead(200);
							res.end(JSON.stringify(obj));
					  }
			  	 });

			  }).catch(error => {
			   console.log(error);
			  });
			});
		}
		
		else if(data.method == "validateaddress")
		{
			var valid = WAValidator.validate(data.address, 'XRP');
			console.log(valid);
			if(valid){
				var obj = {
				"result": "1"
				};
				res.writeHead(200);
				res.end(JSON.stringify(obj));
			}
			else
			{
				var obj = {
				"result": "0"
				};
				res.writeHead(200);
				res.end(JSON.stringify(obj));
			}
		}


	});
  } else {
    res.writeHead(404);
    res.end();

  }
});

server.listen(7000, '127.0.0.1');