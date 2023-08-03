<?php

namespace Svakode\Svaflazz\Handlers;

use Svakode\Svaflazz\SvaflazzClient;

class Topup extends Base
{
    /**
     * CheckBalance constructor.
     * @param string $buyerSkuCode
     * @param string $customerNo
     * @param string $refId
     * @param string $msg
     * @param SvaflazzClient $client
     */
    public function __construct(SvaflazzClient $client, string $buyerSkuCode, string $customerNo, string $refId, string $msg)
    {
        parent::__construct($client);

        $body = [
            'buyer_sku_code' => $buyerSkuCode,
            'customer_no' => $customerNo,
            'ref_id' => $refId,
            'sign' => $this->sign($refId),
            'testing' => env("DIGIFLAZZ_TESTING",false)
        ];

        if ($msg) {
            $body['msg'] = $msg;
        }

        $this->client->setUrl('/transaction')
            ->setBody($body);
    }
}
