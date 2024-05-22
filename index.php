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
        <link rel="stylesheet" href="style.css">
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
