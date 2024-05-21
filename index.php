<?php
class CurrencyConverter {
  private $currencies = array("USD", "EUR", "GBP");
  private $exchangeRates = array(
    "USD" => 0.000069,
    "EUR" => 0.000061,
    "GBP" => 0.000053
  );

  public function __construct() {
?>
    <html>
      <head>
        <title>Currency Converter</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
          }
      .container {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
          }
          h1, h2 {
            color: #333;
          }
          label, input, select, button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
          }
          input, select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
          }
          button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
          }
          button:hover {
            background-color: #45a049;
            cursor: pointer;
          }
        </style>
      </head>
      <body>
        <div class="container">
          <h1>Currency Converter</h1>
          <form action="result.php" method="get">
            <label for="amount">Amount in IDR:</label>
            <input type="number" id="amount" name="amount"><br><br>
            <label for="fromCurrency">From:</label>
            <select id="fromCurrency" name="fromCurrency">
              <option value="IDR">IDR</option>
            </select><br><br>
            <label for="toCurrency">To:</label>
            <select id="toCurrency" name="toCurrency">
              <?php foreach ($this->currencies as $currency) {?>
                <option value="<?php echo $currency;?>"><?php echo $currency;?></option>
              <?php }?>
            </select><br><br>
            <input type="submit" value="Convert">
          </form>
        </div>
      </body>
    </html>
    <?php
  }
}

$currencyConverter = new CurrencyConverter();
?>