<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class Deposit extends Base
{
    private $keyword = 'deposit';

    /**
     * CheckBalance constructor.
     * @param int $amount
     * @param string $bank
     * @param string $owner_name
     * @param SvaflazzClient $client
     */
    public function __construct(int $amount, string $bank, string $owner_name, SvaflazzClient $client)
    {
        parent::__construct($client);
        $this->client->setUrl('/deposit')
            ->setBody([
                'amount' => $amount,
                'Bank' => $bank,
                'owner_name' => $owner_name,
                'sign' => $this->sign($this->keyword)
            ]);
    }
}
