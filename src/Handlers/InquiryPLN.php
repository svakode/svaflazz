<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class InquiryPLN extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $customer_no
     * @param SvaflazzClient $client
     */
    public function __construct(string $customer_no, SvaflazzClient $client)
    {
        parent::__construct($client);
        $this->client->setUrl('/transaction')
            ->setBody([
                'commands' => 'pln-subscribe',
                'customer_no' => $customer_no
            ]);
    }
}
