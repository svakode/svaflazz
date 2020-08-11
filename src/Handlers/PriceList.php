<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class PriceList extends Base
{
    private $keyword = 'pricelist';

    /**
     * PriceList constructor.
     * @param SvaflazzClient $client
     */
    public function __construct(SvaflazzClient $client)
    {
        parent::__construct($client);
        $this->client->setUrl('/price-list')
            ->setBody([
                'cmd' => 'prepaid',
                'sign' => $this->sign($this->keyword)
            ]);
    }
}
