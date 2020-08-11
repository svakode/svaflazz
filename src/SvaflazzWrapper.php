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
     * @return mixed
     */
    public function priceList()
    {
        return (new PriceList($this->client))->perform();
    }

    /**
     * @param int $amount
     * @param string $bank
     * @param string $owner_name
     * @return mixed
     */
    public function deposit(int $amount, string $bank, string $owner_name)
    {
        return (new Deposit($amount, $bank, $owner_name, $this->client))->perform();
    }

    /**
     * @param string $buyer_sku_code
     * @param string $customer_no
     * @param string $ref_id
     * @param string|null $msg
     * @return mixed
     */
    public function topup(string $buyer_sku_code, string $customer_no, string $ref_id, string $msg = '')
    {
        return (new Topup($buyer_sku_code, $customer_no, $ref_id, $msg, $this->client))->perform();
    }

    /**
     * @param string $buyer_sku_code
     * @param string $customer_no
     * @param string $ref_id
     * @return mixed
     */
    public function checkBill(string $buyer_sku_code, string $customer_no, string $ref_id)
    {
        return (new CheckBill($buyer_sku_code, $customer_no, $ref_id, $this->client))->perform();
    }

    /**
     * @param string $buyer_sku_code
     * @param string $customer_no
     * @param string $ref_id
     * @return mixed
     */
    public function payBill(string $buyer_sku_code, string $customer_no, string $ref_id)
    {
        return (new PayBill($buyer_sku_code, $customer_no, $ref_id, $this->client))->perform();
    }

    /**
     * @param string $buyer_sku_code
     * @param string $customer_no
     * @param string $ref_id
     * @return mixed
     */
    public function checkStatusBill(string $buyer_sku_code, string $customer_no, string $ref_id)
    {
        return (new CheckStatusBill($buyer_sku_code, $customer_no, $ref_id, $this->client))->perform();
    }

    /**
     * @param string $customer_no
     * @return mixed
     */
    public function inquiryPLN(string $customer_no)
    {
        return (new InquiryPLN($customer_no, $this->client))->perform();
    }
}
