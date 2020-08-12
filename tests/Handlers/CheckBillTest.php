<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class CheckBillTest extends TestCase
{
    private $svaflazz, $svaflazzClient;
    private $buyerSkuCode, $customerNo, $refId;

    public function setUp(): void
    {
        parent::setUp();

        $this->buyerSkuCode = 'pln';
        $this->customerNo = '08211234567';
        $this->refId = 'ref-id';

        $this->svaflazzClient = Mockery::mock(SvaflazzClient::class);
        $this->svaflazzClient->shouldReceive('setUrl')
            ->withArgs(['/transaction'])
            ->andReturn($this->svaflazzClient);

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'commands' => 'inq-pasca',
                    'buyer_sku_code' => $this->buyerSkuCode,
                    'customer_no' => $this->customerNo,
                    'ref_id' => $this->refId,
                    'sign' => $this->sign($this->refId)
                ]
            ]);

        $this->svaflazz = new SvaflazzWrapper($this->svaflazzClient);
    }

    public function testCheckBillShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->checkBill($this->buyerSkuCode, $this->customerNo, $this->refId);

        $this->assertEquals(true, $response->success);
    }
}
