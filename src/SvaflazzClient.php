<?php

namespace Svakode\Svaflazz;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Svakode\Svaflazz\Exceptions\SvaflazzException;

class SvaflazzClient
{
    protected $client, $url, $body;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->body = [
            'username' => config('svaflazz.username'),
        ];
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    public function setBody(array $body)
    {
        $this->body = array_merge($this->body, $body);
        return $this;
    }

    protected function url()
    {
        return config('svaflazz.base_url') . $this->url;
    }

    protected function options()
    {
        return ['json' => $this->body];
    }

    public function run()
    {
        try {
            $response = $this->client->post($this->url(), $this->options());
        } catch (RequestException $ex) {
            $response = $ex->getResponse();
            $data = json_decode($response->getBody())->data;
            throw SvaflazzException::requestFailed($data->rc, $data->message, $ex->getCode());
        }

        return json_decode($response->getBody());
    }
}
