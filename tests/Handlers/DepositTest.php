<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class DepositTest extends TestCase
{
    private $svaflazz, $svaflazzClient;
    private $amount, $bank, $ownerName, $keyword;

    public function setUp(): void
    {
        parent::setUp();

        $this->amount = 10000;
        $this->bank = 'Bank Name';
        $this->ownerName = 'John Doe';
        $this->keyword = 'deposit';

        $this->svaflazzClient = Mockery::mock(SvaflazzClient::class);
        $this->svaflazzClient->shouldReceive('setUrl')
            ->withArgs(['/deposit'])
            ->andReturn($this->svaflazzClient);

        $this->svaflazzClient->shouldReceive('setBody')
            ->withArgs([
                [
                    'amount' => $this->amount,
                    'Bank' => $this->bank,
                    'owner_name' => $this->ownerName,
                    'sign' => $this->sign($this->keyword)
                ]
            ]);

        $this->svaflazz = new SvaflazzWrapper($this->svaflazzClient);
    }

    public function testDepositShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->deposit($this->amount, $this->bank, $this->ownerName);

        $this->assertEquals(true, $response->success);
    }
}
