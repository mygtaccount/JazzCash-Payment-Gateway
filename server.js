const { exec } = require('child_process');
const express = require('express');
const app = express();

app.get('/', (req, res) => {
  exec('php index.php', (error, stdout, stderr) => {
    if (error) {
      console.log(`exec error: ${error}`);
      return;
    }
    res.send(stdout);
  });
});

app.listen(3000, () => {
  console.log('Server running on port 3000');
});
