<?php

namespace Svakode\Svaflazz\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Svakode\Svaflazz\Exceptions\SvaflazzException;
use Svakode\Svaflazz\SvaflazzClient;

class SvaflazzClientTest extends TestCase
{
    private $svaflazzClient, $responseMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->responseMock = new MockHandler([]);

        $handlerStack = HandlerStack::create($this->responseMock);
        $client = new Client(['handler' => $handlerStack]);

        $this->svaflazzClient = new SvaflazzClient($client);
        $this->svaflazzClient->setUrl('/test')
            ->setBody(['cmd' => 'test']);
    }

    public function testSvaflazzClientRunShouldReturnSuccess()
    {
        $this->responseMock->append(new Response(200, [], json_encode(['success' => true])));
        $response = $this->svaflazzClient->run();

        $this->assertEquals(true, $response->success);
    }

    public function testSvaflazzClientRunShouldReturnErrorIfNotGet200()
    {
        $this->responseMock->append(new Response(500, [], json_encode(['data' => ['message' => 'some-error', 'rc' => '42']])));
        $this->expectException(SvaflazzException::class);

        $response = $this->svaflazzClient->run();

        $this->assertEquals(500, $response->getCode());
    }
}
