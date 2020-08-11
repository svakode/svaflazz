<?php

namespace Svakode\Svaflazz\Tests;

use Mockery;
use Svakode\Svaflazz\Svaflazz;
use Svakode\Svaflazz\SvaflazzClient;
use Svakode\Svaflazz\SvaflazzWrapper;

class DepositTest extends TestCase
{
    private $svaflazz, $svaflazzClient;
    private $amount, $bank, $owner_name, $keyword;

    public function setUp(): void
    {
        parent::setUp();

        $this->amount = 10000;
        $this->bank = 'Bank Name';
        $this->owner_name = 'John Doe';
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
                    'owner_name' => $this->owner_name,
                    'sign' => $this->sign($this->keyword)
                ]
            ]);

        $this->svaflazz = new SvaflazzWrapper($this->svaflazzClient);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testDepositShouldReturnSuccess()
    {
        $this->svaflazzClient->shouldReceive('run')->andReturnUsing(function()
        {
            $mockThreadResult = new \StdClass;
            $mockThreadResult->success = true;

            return $mockThreadResult;
        });;

        $response = $this->svaflazz->deposit($this->amount, $this->bank, $this->owner_name);

        $this->assertEquals(true, $response->success);
    }
}
