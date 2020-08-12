<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class PriceList extends Base
{
    private $keyword = 'pricelist';

    /**
     * PriceList constructor.
     * @param string $buyerSkuCode
     * @param SvaflazzClient $client
     */
    public function __construct(SvaflazzClient $client, string $buyerSkuCode)
    {
        parent::__construct($client);

        $body = [
            'cmd' => 'prepaid',
            'sign' => $this->sign($this->keyword)
        ];

        if ($buyerSkuCode) {
            $body['code'] = $buyerSkuCode;
        }

        $this->client->setUrl('/price-list')
            ->setBody($body);
    }
}
