<?php
class CurrencyConverter {
  private $currencies = array("IDR", "USD", "EUR", "GBP");
  private $exchangeRates = array(
    "USD" => 14000,
    "EUR" => 15500,
    "GBP" => 19000,
    "IDR" => 1
  );

  private $amount;
  private $fromCurrency;
  private $toCurrency;
  private $conversionHistory = array();

  public function __construct($amount, $fromCurrency, $toCurrency) {
    $this->amount = $amount;
    $this->fromCurrency = strtoupper($fromCurrency);
    $this->toCurrency = strtoupper($toCurrency);
  }

  public function convertCurrency() {
    if ($this->fromCurrency == "IDR") {
      return $this->amount / $this->exchangeRates[$this->toCurrency];
    } elseif ($this->toCurrency == "IDR") {
      return $this->amount * $this->exchangeRates[$this->fromCurrency];
    } else {
      return ($this->amount / $this->exchangeRates[$this->fromCurrency]) * $this->exchangeRates[$this->toCurrency];
    }
  }

  public function addToConversionHistory() {
    $conversion = array(
      'amount' => $this->amount,
      'fromCurrency' => $this->fromCurrency,
      'toCurrency' => $this->toCurrency,
      'result' => $this->convertCurrency()
    );
    array_unshift($this->conversionHistory, $conversion);
    if (count($this->conversionHistory) > 5) {
      array_pop($this->conversionHistory);
    }
  }

  public function getConversionHistory() {
    $history = '<table>';
    $history .= '<tr><th>Amount</th><th>From</th><th>To</th><th>Result</th></tr>';
    foreach ($this->conversionHistory as $conversion) {
      $history .= '<tr>';
      $history .= '<td>' . $conversion['amount'] . '</td>';
      $history .= '<td>' . $conversion['fromCurrency'] . '</td>';
      $history .= '<td>' . $conversion['toCurrency'] . '</td>';
      $history .= '<td>' . number_format($conversion['result'], 2) . '</td>';
      $history .= '</tr>';
    }
    $history .= '</table>';
    return $history;
  }
}

if (isset($_GET["amount"]) && isset($_GET["fromCurrency"]) && isset($_GET["toCurrency"])) {
  $amount = $_GET["amount"];
  $fromCurrency = $_GET["fromCurrency"];
  $toCurrency = $_GET["toCurrency"];
  $currencyConverter = new CurrencyConverter($amount, $fromCurrency, $toCurrency);
  $result = $currencyConverter->convertCurrency();
  $currencyConverter->addToConversionHistory();
?>
    <html>
      <head>
        <title>Currency Converter Result</title>
        <link rel="stylesheet" href="style.css">
      </head>
      <body>
        <div class="container">
          <h1>Currency Converter Result</h1>
          <p>The result is: <?php echo number_format($result, 2);?> <?php echo $toCurrency;?></p>
          <h2>Conversion History</h2>
          <?php echo $currencyConverter->getConversionHistory();?>
          <div class="back-button">
            <a href="index.php">
              <div class="button">Return to Converter</div>
            </a>
          </div>
        </div>
      </body>
    </html>
    <?php
}
?>
