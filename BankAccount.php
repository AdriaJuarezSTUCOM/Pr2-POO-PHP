<?php
session_start();

function createAccount($account): void{
    $_SESSION["account"] = $account;
}

function logIn($account): void{
    $_SESSION[$account]["status"] = true;
}

function logOff($account): void{
    $_SESSION[$account]["status"] = false;
}

function showBalance($account): void{
    echo"My balance: " . $_SESSION[$account]["balance"] . "<br>";
}

function deposit($account, $ammount): void{
    echo"Doing transaction deposit (+$ammount) with current balance " . $_SESSION[$account]["balance"] . "<br>";
    $_SESSION[$account]["balance"] += $ammount;
    echo"My new balance after deposit (+$ammount) : ". $_SESSION[$account]["balance"] . "<br>";
}

function withdrawal($account, $ammount, $limit): void{
    echo"Doing transaction withdrawal (-$ammount) with current balance " . $_SESSION[$account]["balance"] . "<br>";
    $currentBalance = $_SESSION[$account]["balance"];
    if($currentBalance - $ammount < $limit){
        echo"Error transaction: Insufficient balance to complete the withdrawal<br>";
        echo"My new balance after failed last transaction : " . $_SESSION[$account]["balance"] . "<br>";
    }else{
        $currentBalance -= $ammount;
        $_SESSION[$account]["balance"]=$currentBalance;
        echo"My new balance after withdrawal (-$ammount) : " . $_SESSION[$account]["balance"] . "<br>";
    }
}

$account = "account1";

createAccount($account);
$_SESSION[$account]["balance"] = 400.0;
showBalance($account);
logIn($account);
logOff($account);
logIn($account);
deposit($account, 150);
withdrawal($account, 25, 0);
withdrawal($account, 600, 0);
logOff($account);

