<?php

namespace ComBank\Bank;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:25 PM
 */

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class BankAccount
{

    private  $balance;
    private  $status;
    private static $overdraft;

/*     public function __constructt($balance, $status, $overdraft)
    {
        $this->balance = $balance;
        $this->status = $status;
        $this->overdraft = $overdraft;
    } */

    public function __construct(float $newbalance = 0.0)
    {
        $this->balance = $newbalance;
        $this->status = BankAccountInterface::STATUS_OPEN;
    }


    /* GETTERS */


    public function getStatus()
    {
        return $this->status;
    }



    /* Setters */

    public function setBalance($balance)
    {
        return $this->balance = $balance;
    }

    public function setStatus($status)
    {
        return $this->status = $status;
    }

    public function setOverDraft($overdraft)
    {
        return $this->overdraft = $overdraft;
    }


    /* Funciones */

    public function openAccount()
    {
        echo "El estado de la cuenta es ". $this->status;
    }

    public function closeAccount()
    {   
        if(!$this->openAccount()){
             throw new BankAccountException("La cuenta ya esta cerrada!");
        }
        $this->status = BankAccountInterface::STATUS_CLOSED;
    }

    public function reOpenAccount()
    {  
        if($this->openAccount()){
             throw new BankAccountException("La cuenta ya estaba abierta");
         }
        $this->status = BankAccountInterface::STATUS_OPEN;
    }


    public function getBalance()
    {
        return $this->balance;
    }

    public function getOverDraft($overdraft)
    {
        return $this->overdraft;
    }

}
