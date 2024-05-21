<?php
class CurrencyConverter {
  private $currencies = array("USD", "EUR", "GBP");
  private $exchangeRates = array(
    "USD" => 0.000069,
    "EUR" => 0.000061,
    "GBP" => 0.000053
  );
  private $conversionHistory = array();

  public function __construct($amount, $fromCurrency, $toCurrency) {
    $this->conversionHistory[] = array(
      "amount" => $amount,
      "fromCurrency" => $fromCurrency,
      "toCurrency" => $toCurrency,
      "result" => $this->convertCurrency($amount, $fromCurrency, $toCurrency)
    );
    if (count($this->conversionHistory) > 5) {
      array_shift($this->conversionHistory);
    }
  }

  public function convertCurrency($amount, $fromCurrency, $toCurrency) {
    if ($fromCurrency == "IDR") {
      return $amount * $this->exchangeRates[$toCurrency];
    } else {
      return "Invalid from currency";
    }
  }

  public function getConversionHistory() {
    $history = "<table>";
    $history.= "<thead><tr><th>Amount</th><th>From</th><th>To</th><th>Result</th></tr></thead>";
    $history.= "<tbody>";
    foreach (array_slice(array_reverse($this->conversionHistory), 0, 5) as $conversion) {
      $history.= "<tr>";
      $history.= "<td>". $conversion["amount"]. "</td>";
      $history.= "<td>". $conversion["fromCurrency"]. "</td>";
      $history.= "<td>". $conversion["toCurrency"]. "</td>";
      $history.= "<td>". $conversion["result"]. " ". $conversion["toCurrency"]. "</td>";
      $history.= "</tr>";
    }
    $history.= "</tbody>";
    $history.= "</table>";
    return $history;
  }
}

if (isset($_GET["amount"]) && isset($_GET["fromCurrency"]) && isset($_GET["toCurrency"])) {
  $amount = $_GET["amount"];
  $fromCurrency = $_GET["fromCurrency"];
  $toCurrency = $_GET["toCurrency"];
  $currencyConverter = new CurrencyConverter($amount, $fromCurrency, $toCurrency);
?>
    <html>
      <head>
        <title>Currency Converter Result</title>
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
          <h1>Currency Converter Result</h1>
          <p>The result is: <?php echo $currencyConverter->convertCurrency($amount, $fromCurrency, $toCurrency);?> <?php echo $toCurrency;?></p>
          <a href="index.php">Return to converter</a>
          <h2>Conversion History</h2>
          <?php echo $currencyConverter->getConversionHistory();?>
        </div>
      </body>
    </html>
    <?php
}
?>