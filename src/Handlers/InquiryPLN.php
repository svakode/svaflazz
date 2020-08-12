<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class InquiryPLN extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $customerNo
     * @param SvaflazzClient $client
     */
    public function __construct(SvaflazzClient $client, string $customerNo)
    {
        parent::__construct($client);
        $this->client->setUrl('/transaction')
            ->setBody([
                'commands' => 'pln-subscribe',
                'customer_no' => $customerNo
            ]);
    }
}
