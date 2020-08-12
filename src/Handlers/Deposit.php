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
     * @param string $ownerName
     * @param SvaflazzClient $client
     */
    public function __construct(SvaflazzClient $client, int $amount, string $bank, string $ownerName)
    {
        parent::__construct($client);
        $this->client->setUrl('/deposit')
            ->setBody([
                'amount' => $amount,
                'Bank' => $bank,
                'owner_name' => $ownerName,
                'sign' => $this->sign($this->keyword)
            ]);
    }
}
