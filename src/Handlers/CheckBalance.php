<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class CheckBalance extends Base
{
    private $keyword = 'depo';

    /**
     * CheckBalance constructor.
     * @param SvaflazzClient $client
     */
    public function __construct(SvaflazzClient $client)
    {
        parent::__construct($client);
        $this->client->setUrl('/cek-saldo')
            ->setBody([
                'cmd' => 'deposit',
                'sign' => $this->sign($this->keyword)
            ]);
    }
}
