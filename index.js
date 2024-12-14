const express = require('express');
const bodyParser = require('body-parser');
const path = require('path');
const JazzCash = require('@zfhassaan/jazzcash');
const config = require('./config');

const app = express();
const jazzcash = new JazzCash(config);

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));
app.set('view engine', 'ejs');

// Routes
app.get('/', (req, res) => {
  res.render('index', { product: { name: 'Sample Product', price: 1000 } });
});

app.post('/checkout', (req, res) => {
  const { amount, billReference, productDescription } = req.body;

  const transactionData = {
    amount: parseInt(amount, 10),
    billReference,
    productDescription,
  };

  jazzcash
    .initiateTransaction(transactionData)
    .then((response) => {
      res.send(response); // Return the JazzCash HTML form to the client
    })
    .catch((error) => {
      console.error(error);
      res.status(500).send('Error initiating transaction');
    });
});

app.get('/success', (req, res) => {
  res.render('success');
});

// Start server
const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
