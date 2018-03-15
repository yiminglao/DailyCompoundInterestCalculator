<?php
require_once 'calculator.php';

$cal = new calculator();
$cal->getPostData();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Daily Compound Interest Calculator</title>
</head>
<body>
<div class="container">

    <center>
        <h3>Daily Loan Principal & Interest Calculator</h3>
    </center>
    <br>
    <div class="row">
        <div class="col-sm">
            <h4>Loan Info</h4>
            <form method="post" action="">
                <div class="form-group">
                    <label for="loanAmount">Loan Amount</label>
                    <input type="text" class="form-control" id="loanAmount" name="loanAmount"  placeholder="<?php echo '$' . $cal->getLoanAmount()  ?>">
                </div>
                <div class="form-group">
                    <label for="annualInterestRate">Annual Interest Rate in percentage</label>
                    <input type="text" class="form-control" id="annualInterestRate" name="annualInterestRate"  placeholder="<?php echo $cal->getApr() . '%'?>">
                </div>
                <div class="form-group">
                    <label for="lengthOfTerm">Length of Term (in days)</label>
                    <input type="text" class="form-control" id="lengthOfTerm"  name="lengthOfTerm" placeholder="<?php echo $cal->getLengthOfTerm()?>">
                </div>

                <button type="submit" class="btn btn-primary">Calculate</button>
            </form>
        </div>
        <div class="col-sm">
            <h4>Summary</h4>
            <div class="row">
                <div class="col-sm">
                    <label>Beginning Balance: </label>
                    <label><?php echo  '$' . $cal->getLoanAmount() ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label>APR:</label>
                    <label><?php echo $cal->getApr() . '%'?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label>Daily interest: </label>
                    <label><?php echo $cal->getDailyInterestRate() . '%'?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <label>Maturity: </label>
                    <label><?php echo $cal->getLengthOfTerm() . ' days'?></label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <label>Payment: </label>
                    <label><?php echo '$' . $cal->getPayment()  ?></label>

                </div>

            </div>


        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Day</th>
                <th scope="col">Beginning Balance</th>
                <th scope="col">Payment</th>
                <th scope="col">Interest</th>
                <th scope="col">Principal</th>
                <th scope="col">Remaining Balance</th>

            </tr>
            </thead>
            <tbody>
            <?php

            for($i=1;$i<= $cal->getLengthOfTerm();  $i++){ ?>
            <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo '$' . $cal->getStartingBalance()  ?></td>
                <td><?php echo '$' . $cal->getPayment()  ?></td>
                <td><?php echo '$' . $cal->getInterest()  ?></td>
                <td><?php echo '$' . $cal->getPrincipalPaid()  ?></td>
                <td><?php echo '$' . $cal->getNewBalance()  ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
