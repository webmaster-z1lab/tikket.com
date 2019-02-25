<?php
/**
 * Created by Olimar Ferraz
 * webmaster@z1lab.com.br
 * Date: 14/11/2018
 * Time: 21:22
 */

namespace App\Services;


use App\Traits\CacheTrait;
use GuzzleHttp\Client;

class ApiService
{
    use CacheTrait;

    /**
     * @var string
     */
    protected $api;
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var string
     */
    protected $method;
    /**
     * @var string
     */
    protected $resource;
    /**
     * @var bool
     */
    protected $authenticated;
    /**
     * @var array
     */
    protected $headers = [];
    /**
     * @var array
     */
    protected $body = [];
    /**
     * @var array
     */
    protected $params = [];
    /**
     * @var mixed
     */
    protected $response;

    /**
     * ApiService constructor.
     *
     * @param string $resource
     * @param string $method
     * @param array  $headers
     * @param array  $body
     */
    public function __construct(string $resource, string $method, array $headers = [], array $body = [])
    {
        $this->resource = $resource;
        $this->method = $method;
        $this->api = str_finish(getenv('API_ENDPOINT'), '/') . 'api/' . getenv('API_VERSION') . '/';

        $this->setHeaders($headers);
        $this->setBody($body);

        $this->client = new Client(['headers' => $this->headers]);
    }

    /**
     * @param string $param
     * @param array  $params
     *
     * @return $this
     */
    public function find(string $param = '', array $params = [])
    {
        try {
            $result = $this->client->request($this->method, "{$this->api}{$this->resource}/{$param}", $params);

            $this->response = json_decode($result->getBody());
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            abort(400, $e->getMessage());
        }

        return $this;
    }

    /**
     * @param string $param
     * @param string $relationship
     * @param array  $params
     *
     * @return $this
     */
    public function findRelationship(string $param, string $relationship, array $params = [])
    {
        try {
            $result = $this->client->request($this->method, "{$this->api}{$this->resource}/$param/$relationship", $params);

            $this->response = json_decode($result->getBody());
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            abort(400, $e->getMessage());
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function attributes()
    {
        return $this->response->data->attributes;
    }

    /**
     * @return mixed
     */
    public function collect()
    {
        return $this->response->data;
    }

    /**
     * @return mixed
     */
    public function relationships()
    {
        return $this->response->data->relationships;
    }

    /**
     * @return mixed
     */
    public function links()
    {
        return $this->response->data->links;
    }

    /**
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers['Accept'] = 'application/json';

        if (\Auth::check()) {
            $authHeaders = [
                'Authorization' => 'Bearer ' . \Cookie::get('auth_token'),
                'ID-TOKEN'      => \Cookie::get('id_token'),
            ];
        } else {
            $authHeaders = [
                'Authorization' => 'Bearer ' . \OpenID::getClientToken(),
            ];
        }

        $this->headers = array_merge($this->headers, $authHeaders);

        if (!empty($headers)) $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

    /**
     * @param array $body
     *
     * @return $this
     */
    public function setBody(array $body)
    {
        if (!empty($body)) $this->params['body'] = $body;

        return $this;
    }
}
