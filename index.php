<?php
class CurrencyConverter {
  private $currencies = array("IDR", "USD", "EUR", "GBP");
  private $exchangeRates = array(
    "USD" => 14000,
    "EUR" => 15500,
    "GBP" => 19000,
    "IDR" => 1
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
          <form action="result.php" method="get" id="currencyForm">
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount"><br><br>
            <label for="fromCurrency">From:</label>
            <select id="fromCurrency" name="fromCurrency">
              <?php foreach ($this->currencies as $currency) {?>
                <option value="<?php echo $currency;?>"><?php echo $currency;?></option>
              <?php }?>
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
        <script>
          const amountInput = document.getElementById('amount');

          function showPopupNotification() {
            const popup = document.createElement('div');
            popup.className = 'popup';
            popup.textContent = 'Please enter an amount.';
            document.body.appendChild(popup);

            setTimeout(() => {
              document.body.removeChild(popup);
            }, 3000);
          }

          function handleSubmit(event) {
            event.preventDefault();

            const amount = amountInput.value.trim();
            if (amount === '') {
              showPopupNotification();
              return;
            }

            document.getElementById('currencyForm').submit();
          }

          
          document.getElementById('currencyForm').addEventListener('submit', handleSubmit);
        </script>
      </body>
    </html>
    <?php
  }
}

$currencyConverter = new CurrencyConverter();
?>
