<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class Topup extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $buyer_sku_code
     * @param string $customer_no
     * @param string $ref_id
     * @param string $msg
     * @param SvaflazzClient $client
     */
    public function __construct(string $buyer_sku_code, string $customer_no, string $ref_id, string $msg, SvaflazzClient $client)
    {
        parent::__construct($client);

        $body = [
            'buyer_sku_code' => $buyer_sku_code,
            'customer_no' => $customer_no,
            'ref_id' => $ref_id,
            'sign' => $this->sign($ref_id)
        ];

        if ($msg) {
            $body['msg'] = $msg;
        }

        $this->client->setUrl('/transaction')
            ->setBody($body);
    }
}
