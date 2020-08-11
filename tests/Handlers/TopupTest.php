<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\Svaflazz;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class TopupTest extends TestCase
{
    private $svaflazz, $svaflazzClient;
    private $buyer_sku_code, $customer_no, $ref_id;

    public function setUp(): void
    {
        parent::setUp();

        $this->buyer_sku_code = 'xld25';
        $this->customer_no = '08211234567';
        $this->ref_id = 'ref-id';

        $this->svaflazzClient = Mockery::mock(SvaflazzClient::class);
        $this->svaflazzClient->shouldReceive('setUrl')
            ->withArgs(['/transaction'])
            ->andReturn($this->svaflazzClient);

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'buyer_sku_code' => $this->buyer_sku_code,
                    'customer_no' => $this->customer_no,
                    'ref_id' => $this->ref_id,
                    'sign' => $this->sign($this->ref_id)
                ]
            ]);

        $this->svaflazz = new SvaflazzWrapper($this->svaflazzClient);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testTopupShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->topup($this->buyer_sku_code, $this->customer_no, $this->ref_id);

        $this->assertEquals(true, $response->success);
    }

    public function testTopupWithMessageShouldReturnSuccess()
    {
        $msg = 'some-message';

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'buyer_sku_code' => $this->buyer_sku_code,
                    'customer_no' => $this->customer_no,
                    'ref_id' => $this->ref_id,
                    'msg' => $msg,
                    'sign' => $this->sign($this->ref_id)
                ]
            ]);

        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->topup($this->buyer_sku_code, $this->customer_no, $this->ref_id, $msg);

        $this->assertEquals(true, $response->success);
    }
}
