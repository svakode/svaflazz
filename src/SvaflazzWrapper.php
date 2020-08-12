<?php

namespace Svakode\Svaflazz;

use Svakode\Svaflazz\Handlers\CheckBalance;
use Svakode\Svaflazz\Handlers\CheckBill;
use Svakode\Svaflazz\Handlers\CheckStatusBill;
use Svakode\Svaflazz\Handlers\Deposit;
use Svakode\Svaflazz\Handlers\InquiryPLN;
use Svakode\Svaflazz\Handlers\PayBill;
use Svakode\Svaflazz\Handlers\PriceList;
use Svakode\Svaflazz\Handlers\Topup;

class SvaflazzWrapper
{
    private $client;

    /**
     * Svaflazz constructor.
     * @param SvaflazzClient $client
     */
    public function __construct(SvaflazzClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function checkBalance()
    {
        return (new CheckBalance($this->client))->perform();
    }

    /**
     * @param string|null $buyerSkuCode
     * @return mixed
     */
    public function priceList(string $buyerSkuCode = '')
    {
        return (new PriceList($this->client, $buyerSkuCode))->perform();
    }

    /**
     * @param int $amount
     * @param string $bank
     * @param string $ownerName
     * @return mixed
     */
    public function deposit(int $amount, string $bank, string $ownerName)
    {
        return (new Deposit($this->client, $amount, $bank, $ownerName))->perform();
    }

    /**
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @param string|null $msg
     * @return mixed
     */
    public function topup(string $buyerSkuCode, string $customerNo, string $refId, string $msg = '')
    {
        return (new Topup($this->client, $buyerSkuCode, $customerNo, $refId, $msg))->perform();
    }

    /**
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @return mixed
     */
    public function checkBill(string $buyerSkuCode, string $customerNo, string $refId)
    {
        return (new CheckBill($this->client, $buyerSkuCode, $customerNo, $refId))->perform();
    }

    /**
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @return mixed
     */
    public function payBill(string $buyerSkuCode, string $customerNo, string $refId)
    {
        return (new PayBill($this->client, $buyerSkuCode, $customerNo, $refId))->perform();
    }

    /**
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @return mixed
     */
    public function checkStatusBill(string $buyerSkuCode, string $customerNo, string $refId)
    {
        return (new CheckStatusBill($this->client, $buyerSkuCode, $customerNo, $refId))->perform();
    }

    /**
     * @param string $customerNo
     * @return mixed
     */
    public function inquiryPLN(string $customerNo)
    {
        return (new InquiryPLN($this->client, $customerNo))->perform();
    }
}
