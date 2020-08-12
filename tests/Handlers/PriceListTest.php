<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class PriceListTest extends TestCase
{
    private $svaflazz, $svaflazzClient;
    private $keyword;

    public function setUp(): void
    {
        parent::setUp();

        $this->keyword = 'pricelist';

        $this->svaflazzClient = Mockery::mock(SvaflazzClient::class);
        $this->svaflazzClient->shouldReceive('setUrl')
            ->withArgs(['/price-list'])
            ->andReturn($this->svaflazzClient);

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'cmd' => 'prepaid',
                    'sign' => $this->sign($this->keyword)
                ]
            ]);

        $this->svaflazz = new SvaflazzWrapper($this->svaflazzClient);
    }

    public function testPriceListShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->priceList();

        $this->assertEquals(true, $response->success);
    }

    public function testPriceListWithCodeShouldReturnSuccess()
    {
        $code = 'xld25';

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'cmd' => 'prepaid',
                    'code' => $code,
                    'sign' => $this->sign($this->keyword)
                ]
            ]);

        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->priceList($code);

        $this->assertEquals(true, $response->success);
    }
}
