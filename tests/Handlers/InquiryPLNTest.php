<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\Svaflazz;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class InquiryPLNTest extends TestCase
{
    private $svaflazz, $svaflazzClient;
    private $customer_no;

    public function setUp(): void
    {
        parent::setUp();

        $this->customer_no = 'customer-no';

        $this->svaflazzClient = Mockery::mock(SvaflazzClient::class);
        $this->svaflazzClient->shouldReceive('setUrl')
            ->withArgs(['/transaction'])
            ->andReturn($this->svaflazzClient);

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'commands' => 'pln-subscribe',
                    'customer_no' => $this->customer_no
                ]
            ]);

        $this->svaflazz = new SvaflazzWrapper($this->svaflazzClient);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInquiryPLNShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->inquiryPLN($this->customer_no);

        $this->assertEquals(true, $response->success);
    }
}
