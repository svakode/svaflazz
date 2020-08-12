<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class CheckBalanceTest extends TestCase
{
    private $svaflazz, $svaflazzClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->svaflazzClient = Mockery::mock(SvaflazzClient::class);
        $this->svaflazzClient->shouldReceive('setUrl')
            ->withArgs(['/cek-saldo'])
            ->andReturn($this->svaflazzClient);

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'cmd' => 'deposit',
                    'sign' => $this->sign('depo')
                ]
            ]);

        $this->svaflazz = new SvaflazzWrapper($this->svaflazzClient);
    }

    public function testCheckBalanceShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->checkBalance();

        $this->assertEquals(true, $response->success);
    }
}
