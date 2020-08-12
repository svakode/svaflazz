<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class TopupTest extends TestCase
{
    private $svaflazz, $svaflazzClient;
    private $buyerSkuCode, $customerNo, $refId;

    public function setUp(): void
    {
        parent::setUp();

        $this->buyerSkuCode = 'xld25';
        $this->customerNo = '08211234567';
        $this->refId = 'ref-id';

        $this->svaflazzClient = Mockery::mock(SvaflazzClient::class);
        $this->svaflazzClient->shouldReceive('setUrl')
            ->withArgs(['/transaction'])
            ->andReturn($this->svaflazzClient);

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'buyer_sku_code' => $this->buyerSkuCode,
                    'customer_no' => $this->customerNo,
                    'ref_id' => $this->refId,
                    'sign' => $this->sign($this->refId)
                ]
            ]);

        $this->svaflazz = new SvaflazzWrapper($this->svaflazzClient);
    }

    public function testTopupShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->topup($this->buyerSkuCode, $this->customerNo, $this->refId);

        $this->assertEquals(true, $response->success);
    }

    public function testTopupWithMessageShouldReturnSuccess()
    {
        $msg = 'some-message';

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'buyer_sku_code' => $this->buyerSkuCode,
                    'customer_no' => $this->customerNo,
                    'ref_id' => $this->refId,
                    'msg' => $msg,
                    'sign' => $this->sign($this->refId)
                ]
            ]);

        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->topup($this->buyerSkuCode, $this->customerNo, $this->refId, $msg);

        $this->assertEquals(true, $response->success);
    }
}
