<?php

namespace HishamTarek\IbtdiMyFatoorah\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

abstract class  IbtdiMyFatoorahService
{


    /**
     * @const TEST_URI
     */
    const TEST_URI = 'https://apitest.myfatoorah.com/v2/';

    /**
     * @const LIVE_URI
     */
    const LIVE_URI = 'https://api.myfatoorah.com/v2/';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var $mode
     */
    protected $mode;

    /**
     * @var $token
     */
    protected $token;

    /**
     * @var $baseUrl
     */
    protected $baseUrl;

    /**
     * @var $endPoint
     */
    protected $endPoint;

    /**
     * @var $headers
     */
    protected $headers = [];

    /**
     * Service constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get instance
     *
     * @throws \Exception
     */
    public function getInstance()
    {
        $this->setMode();

        $this->setBaseUrl();

        $this->setAccessToken();

        $this->setHeader('Content-Type', 'application/json');
        $this->setHeader('Accept-Type', 'application/json');

        $this->setClient();

        if ($this->token == null) {
            throw new \Exception("You must send token");
        }

        if ($this->mode == null) {
            throw new \Exception("You must send mode");
        }
    }

    /**
     * Set header
     *
     * @param $key
     * @param $value
     * @return $this
     */
    protected function setHeader($key, $value)
    {
        $this->headers[$key] = $value;

        return $this;
    }

    /**
     * Get headers
     *
     * @return array
     */

    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set base path
     *
     * @throws \Exception
     */
    protected function setBaseUrl()
    {
        if (!in_array($this->getMode(), ['test', 'live'])) {
            throw new \Exception("Mode is not supported, we supported only : test and live modes");
        }

        $this->baseUrl = $this->getMode() == "live" ? self::LIVE_URI : self::TEST_URI;
    }

    /**
     * Get base url
     *
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->baseUrl;
    }


    /**
     * Set mode
     *
     * @param null $mode
     * @return $this
     * @throws \Exception
     */
    public function setMode($mode = null)
    {
        if ($mode != null && !in_array($mode, ['test', 'live'])) {
            throw new \Exception("Mode is not supported, only supported : test and live");
        }

        if ($this->mode == null) {
            $this->mode = is_null($mode) ? config('ibtdimyfatoorah.mode', 'test') : $mode;
        }

        return $this;
    }

    /**
     * Get mode
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Get endpoint
     *
     * @return string
     * @throws \Exception
     */
    protected function getEndPoint()
    {
        if (!isset($this->endPoint)) {
            throw new \Exception("Endpoint is not exists");
        }

        return $this->endpoint;
    }

    /**
     * Set client
     */
    protected function setClient()
    {
        $this->client = Http::withHeaders($this->getHeaders());
    }

    /**
     * Get client
     *
     * @return Client
     * @throws \Exception
     */
    public function getClient()
    {
        $this->getInstance();

        return $this->client;
    }

    /**
     * Set access token
     *
     * @param null $token
     * @return $this
     */
    public function setAccessToken($token = null)
    {
        if ($this->token == null) {
            $this->token = is_null($token) ? config('ibtdimyfatoorah.token') : $token;
        }

        $this->setHeader('Authorization', "Bearer $this->token");

        return $this;
    }

    /**
     * Get full url
     *
     * @return string
     * @throws \Exception
     */
    public function getFullUrl()
    {
        return $this->getBaseUrl() . $this->getEndPoint();
    }


}