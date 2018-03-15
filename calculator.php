<?php
/**
 * Created by PhpStorm.
 * User: Monkey Park
 * Date: 3/8/2018
 * Time: 6:12 PM
 */


class calculator
{
    private $lengthOfTerm = 0;
    private $loanAmount = 0;
    private $apr = 0;
    private $dailyInterestRate = 0;
    private $cumulativeAccrued = 0;
    private $payment = 0;
    private $interestPaid = 0;
    private $principalPaid = 0;
    private $remainingBalance = 0;
    private $newBalance = 0;
    private $interestEachDay = 0;
    private $startingBalance = 0;





    /**
     * @return int
     */
    public function getCumulativeAccrued()
    {
        return $this->cumulativeAccrued;
    }

    /**
     * @return int
     */
    public function getStartingBalance()
    {
        return $this->startingBalance;
    }

    /**
     * @return int
     */
    public function getNewBalance()
    {

        $this->newBalance = $this->startingBalance - $this->payment + $this->interestPaid;
        if($this->newBalance <= 0)
        {
            $this->newBalance = 0;
        }
        $this->startingBalance = $this->newBalance;
        return $this->newBalance;
    }

    public function checkNewBalance()
    {
        if($this->newBalance <= 0)
        {
            return false;
        }
        return true;
    }




    /**
     * calculator constructor.
     */
    public function __construct()
    {
    }


    public function getPostData()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $amount = preg_replace('/\s+/', '', $_POST['loanAmount']);
            $rate = preg_replace('/\s+/', '', $_POST['annualInterestRate']);
            $length = preg_replace('/\s+/', '', $_POST['lengthOfTerm']);
            if(strlen($amount) < 1 || strlen($rate) < 1 || strlen($length) < 1)
            {
                echo '<script type="text/javascript">alert("Please fill up all the data to calculator!");</script>';
                return;
            }
            if($amount <= 0 || $rate <= 0 || $length <= 0)
            {
                echo '<script type="text/javascript">alert("please enter right number");</script>';
                return;
            }
            $this->loanAmount = $amount;
            $this->startingBalance = $amount;
            $this->apr = $rate;
            $this->lengthOfTerm = $length;
            $this->setDayilyInterestRate();

        }
    }

    /**
     * @return mixed
     */
    public function getInterestAccruedEachDay()
    {
        $amount = $this->getLoanAmount();
        $DailyInterestRate = $this->getDailyInterestRate();
        return $this->interestEachDay = $amount * $DailyInterestRate;
    }



    /**
     * @return mixed
     */
    public function getLengthOfTerm()
    {
        if($this->lengthOfTerm == null)
        {
            $this->lengthOfTerm = 0;
        }
        return $this->lengthOfTerm;
    }

    /**
     * @param mixed $lengthOfTerm
     */
    public function setLengthOfTerm($lengthOfTerm)
    {
        $this->lengthOfTerm = $lengthOfTerm;
    }


    /**
     * @return mixed
     */
    public function getLoanAmount()
    {
        if($this->loanAmount == null)
        {
            $this->loanAmount = 0;
        }
        return $this->loanAmount;
    }

    /**
     * @param mixed $loanAmount
     */
    public function setLoanAmount($loanAmount)
    {
        $this->loanAmount = $loanAmount;
    }

    /**
     * @return mixed
     */
    public function getApr()
    {
        return $this->apr;
    }


    /**
     * @return mixed
     */
    public function getDailyInterestRate()
    {
        return $this->dailyInterestRate;

    }

    /**
     * @param mixed $dayilyInterestRate
     */
    public function setDayilyInterestRate()
    {

        $this->dailyInterestRate = round(($this->apr / 365)/100,6);

    }

    /**
     * @return mixed
     */
    public function getInterest()
    {
        $iRate = $this->getDailyInterestRate();
        $num = $this->lengthOfTerm;
        $interst = ($iRate/$num) * $this->startingBalance;
        $this->interestPaid = round($interst,2);

        return round($interst,2);
    }



    /**
     * @return mixed
     */
    public function getPayment()
    {

        $one = pow($this->dailyInterestRate + 1,$this->lengthOfTerm) - 1;
        $two =$this->dailyInterestRate * pow($this->dailyInterestRate + 1,$this->lengthOfTerm);
        if($two != 0)
        {
            $d = $one / $two;
            $this->payment = round($this->loanAmount/$d,2);
        }
       return $this->payment;

    }



    /**
     * @return mixed
     */
    public function getInterestPaid()
    {
        return $this->interestPaid;
    }



    /**
     * @return mixed
     */
    public function getPrincipalPaid()
    {
        if($this->payment <= 0)
        {
            return $this->principalPaid = 0;
        }
        return $this->principalPaid = $this->payment - $this->interestPaid;
    }


    /**
     * @return mixed
     */
    public function getRemainingBalance()
    {
        $this->remainingBalance = $this->remainingBalance - $this->payment + $this->cumulativeAccrued;
        if($this->remainingBalance <= 0)
        {
            return $this->remainingBalance = 0;
        }
        return $this->remainingBalance;
    }







}