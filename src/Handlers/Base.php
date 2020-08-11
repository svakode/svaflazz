<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class Base
{
    protected $client;

    /**
     * Base constructor.
     * @param SvaflazzClient $client
     */
    protected function __construct(SvaflazzClient $client)
    {
        $this->client = $client;
    }

    public function sign(string $keyword)
    {
        return md5(config('svaflazz.username') . config('svaflazz.key') . $keyword);
    }

    public function perform()
    {
        return $this->client->run();
    }
}
