<?php

class connect {

    function __construct() 
    {
        session_start();
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
            $this->redirect();
        }
    }

    function deposit($value)
    {
        $_SESSION['balance'] = $_SESSION['balance'] + $value;
        $this->redirect();
    }

    function redirect()
    {
        header("location:index.php");
    }
}

?>