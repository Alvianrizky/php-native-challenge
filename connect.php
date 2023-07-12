<?php

class connect {

    function __construct() 
    {
        session_start();
        date_default_timezone_set("Asia/Jakarta");
    }

    function balance() 
    {
        if(empty($_SESSION)) {
            $_SESSION['balance'] = 0;
        }

        $balance = $_SESSION['balance'];
        return $balance;
    }

    function withdraw($value)
    {
        if($_SESSION['balance'] < $value) {
            $alert = 'Your balance is insufficient'; 
            echo '<script type ="text/JavaScript">alert("' . $alert . '");window.location.href="index.php";</script>';
        } else {
            $_SESSION['balance'] = $_SESSION['balance'] - $value;
            $this->addHistory('Withdraw', $value);
            $this->redirect();
        }
    }

    function deposit($value)
    {
        $_SESSION['balance'] = $_SESSION['balance'] + $value;
        $this->addHistory('Deposit', $value);
        $this->redirect();
    }

    function getHistory()
    {
        $history = $_SESSION['history'];
        return $history;
    }

    function addHistory($type, $value)
    {
        $debit = 0;
        $credit = 0;

        $type == 'Deposit' ? ($debit = $value) : ($credit = $value);
        $balance = $_SESSION['balance'];

        array_push($_SESSION['history'], ['time' => date('Y-m-d H:i'), 'type' => $type, 'debit' => $debit, 'credit' => $credit, 'balance' => $balance]);
    }

    function redirect()
    {
        header("location:index.php");
    }
}

?>