<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\Svaflazz;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class CheckBillTest extends TestCase
{
    private $svaflazz, $svaflazzClient;
    private $buyer_sku_code, $customer_no, $ref_id;

    public function setUp(): void
    {
        parent::setUp();

        $this->buyer_sku_code = 'pln';
        $this->customer_no = '08211234567';
        $this->ref_id = 'ref-id';

        $this->svaflazzClient = Mockery::mock(SvaflazzClient::class);
        $this->svaflazzClient->shouldReceive('setUrl')
            ->withArgs(['/transaction'])
            ->andReturn($this->svaflazzClient);

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'commands' => 'inq-pasca',
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

    public function testCheckBillShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->checkBill($this->buyer_sku_code, $this->customer_no, $this->ref_id);

        $this->assertEquals(true, $response->success);
    }
}
