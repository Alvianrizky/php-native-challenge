<?php

class connect {

    function __construct() 
    {
        session_start();
        date_default_timezone_set("Asia/Jakarta");
    }

    function balance() 
    {
        if(empty($_SESSION['account'][$this->key()]['balance'])) {
            $_SESSION['account'][$this->key()]['balance'] = 0;
        }

        $balance = $_SESSION['account'][$this->key()]['balance'];
        return $balance;
    }

    function transaction($action, $value)
    {
        if($action == 'Deposit') {
            $this->deposit($value);
        } else {
            $this->withdraw($value);
        }
    }

    function withdraw($value)
    {
        if($_SESSION['account'][$this->key()]['balance'] < $value) {
            $alert = 'Your balance is insufficient'; 
            echo '<script type ="text/JavaScript">alert("' . $alert . '");window.location.href="index.php";</script>';
        } else {
            $_SESSION['account'][$this->key()]['balance'] = $_SESSION['account'][$this->key()]['balance'] - $value;
            $this->addHistory('Withdraw', $value, '');
            $this->redirect();
        }
    }

    function deposit($value)
    {
        $_SESSION['account'][$this->key()]['balance'] = $_SESSION['account'][$this->key()]['balance'] + $value;
        $this->addHistory('Deposit', $value, '');
        $this->redirect();
    }

    function transfer($key, $value)
    {
        if ($_SESSION['account'][$this->key()]['balance'] < $value) {
            $alert = 'Your balance is insufficient';
            echo '<script type ="text/JavaScript">alert("' . $alert . '");window.location.href="index.php";</script>';
        } else {
            $_SESSION['account'][$this->key()]['balance'] = $_SESSION['account'][$this->key()]['balance'] - $value;
            $_SESSION['account'][$key]['balance'] = $_SESSION['account'][$key]['balance'] + $value;

            $toName = $_SESSION['account'][$key]['username'];
            $fromName = $_SESSION['account'][$this->key()]['username'];
            $this->addHistory('To', $value, 'Transfer to '.$toName);
            $this->addHistory('From', $value, 'Transfer from ' . $fromName, $key);
            
            $this->redirect();
        }
    }

    function listAcoount()
    {
        $data = $_SESSION['account'];
        $key = $this->key();
        unset($data[$key]);

        return $data;
    }

    function getHistory()
    {
        if (empty($_SESSION['account'][$this->key()]['history'])) {
            $_SESSION['account'][$this->key()]['history'] = [];
        }

        $history = $_SESSION['account'][$this->key()]['history'];
        return $history;
    }

    function addHistory($type, $value, $desc, $key = null)
    {
        $debit = 0;
        $credit = 0;

        $key = $key == null ? $this->key() : $key;

        switch ($type) {
            case "Deposit":
                $debit = $value;
                break;
            case "To":
                $credit = $value;
                $type = 'Transfer';
                break;
            case "From":
                $debit = $value;
                $type = 'Transfer';
                break;
            default:
                $credit = $value;
        }

        $balance = $_SESSION['account'][$key]['balance'];

        array_push($_SESSION['account'][$key]['history'], ['time' => date('Y-m-d H:i'), 'type' => $type, 'debit' => $debit, 'credit' => $credit, 'balance' => $balance, 'desc' => $desc]);
    }

    function register($username, $password)
    {
        if(empty($_SESSION['account'])) {
            $_SESSION['account'] = [];
        }

        $token = $this->getRandomStringSha1();
        array_push($_SESSION['account'], ['username' => $username, 'password' => $password, 'token' => $token]);
        $_SESSION['token_active'] = $token;
        $this->redirect();
    }

    function login($username, $password)
    {
        $key = $this->search($username, 'username');
        if (isset($key)) {
            if($_SESSION['account'][$key]['password'] == $password) {
                $token = $this->getRandomStringSha1();
                $_SESSION['account'][$key]['token'] = $token;
                $_SESSION['token_active'] = $token;
                $this->redirect();
            }
        }

        $alert = 'Username and/or Password incorrect.\\nTry again.'; 
        echo '<script type ="text/JavaScript">alert("' . $alert . '");window.location.href="login.php";</script>';
    }

    function logout()
    {
        $key = $this->key();
        if (isset($key)) {
            $_SESSION['account'][$key]['token'] = '';
        }

        $_SESSION['token_active'] = '';
        $this->redirectLogin();
    }

    function checkToken()
    {
        if(!empty($_SESSION['token_active'])) {
            $token = $this->key();
            if (isset($token)) {
                return true;
            }
        } 

        return false;
    }

    function getNameAccount()
    {
        return $_SESSION['account'][$this->key()]['username'];
    }

    function key()
    {
        $key = $this->search($_SESSION['token_active'], 'token');
        return $key;
    }

    function search($search, $field)
    {
        $key = array_search($search, array_column($_SESSION['account'], $field));
        return $key;
    }

    function redirect()
    {
        header("location:index.php");
    }

    function redirectLogin()
    {
        header("location:login.php");
    }

    function getRandomStringSha1($length = 16)
    {
        $string = sha1(rand());
        $randomString = substr($string, 0, $length);
        return $randomString;
    }
}

?>