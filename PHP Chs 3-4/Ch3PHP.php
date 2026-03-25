<?php 
$employeename = "Kevin Slonka";
$hoursworked = 40.0;
$payrate = 54.50;
$fedtax = .245;
$statetax = .055;
$annualgross = ($hoursworked*$payrate);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
        <title>Taxation Calculator</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <!-- <link rel="stylesheet" src="styles.css" /> -->
  </head>
  <body>
      <h1> <b><u>Employee Pay</b></u> </h1>
      <p>
      Employee Name: <?php echo $employeename; ?>  <br />
      Hours Worked: <?php echo $hoursworked; ?> <br />
      Hourly Pay Rate: <?php echo $payrate; ?> <br />
      Gross Pay: <?php echo ($hoursworked * $payrate); ?> <br />
      </p>
      
      <h2> <b><u>Pay Deductions</b></u> </h2>
      <p>
      Federal Withholding (<?php echo ($fedtax * 100); ?>%): $<?php echo($fedtax*($hoursworked*$payrate)); ?> <br />
      State Withholding (<?php echo ($statetax * 100); ?>%): $<?php echo($statetax*($hoursworked*$payrate)); ?> <br />
      Total Deductions: $<?php echo (($fedtax*($hoursworked*$payrate))+($statetax*($hoursworked*$payrate))); ?> <br />
      Net Pay: <?php echo($annualgross)-(($fedtax*($hoursworked*$payrate))+($statetax*($hoursworked*$payrate))); ?>
      </p>
      
      <h3> <b><u>2025 Federal Tax Rate</b></u> </h3>
      <p>
              <?php
        if($annualgross <= 11925)
            echo "Based on an annual gross of $" . number_format($annualgross, 2) . ", you fall in the <b>10%</b> federal tax bracket.";
        elseif($annualgross <= 48475)
            echo "Based on an annual gross of $" . number_format($annualgross, 2) . ", you fall in the <b>12%</b> federal tax bracket.";
        elseif($annualgross <= 103350)
            echo "Based on an annual gross of $" . number_format($annualgross, 2) . ", you fall in the <b>22%</b> federal tax bracket.";
        elseif($annualgross <= 197300)
            echo "Based on an annual gross of $" . number_format($annualgross, 2) . ", you fall in the <b>24%</b> federal tax bracket.";
        elseif($annualgross <= 250525)
            echo "Based on an annual gross of $" . number_format($annualgross, 2) . ", you fall in the <b>32%</b> federal tax bracket.";
        elseif($annualgross <= 626350)
            echo "Based on an annual gross of $" . number_format($annualgross, 2) . ", you fall in the <b>35%</b> federal tax bracket.";
        else
            echo "Based on an annual gross of $" . number_format($annualgross, 2) . ", you fall in the <b>37%</b> federal tax bracket.";
        ?>
      </p>
  
  </body>
  
</html>
