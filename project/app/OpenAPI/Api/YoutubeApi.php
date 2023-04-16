<?php
/**
 * YoutubeApi
 * PHP version 7.4
 *
 * @category Class
 * @package  App\OpenAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * OpenAPI Tutorial
 *
 * OpenAPI Tutorial by halhorn
 *
 * The version of the OpenAPI document: 0.0.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.6.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace App\OpenAPI\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use App\OpenAPI\ApiException;
use App\OpenAPI\Configuration;
use App\OpenAPI\HeaderSelector;
use App\OpenAPI\ObjectSerializer;

/**
 * YoutubeApi Class Doc Comment
 *
 * @category Class
 * @package  App\OpenAPI
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class YoutubeApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'youtubeOauthPost' => [
            'application/json',
        ],
        'youtubeOauthUrlGet' => [
            'application/json',
        ],
        'youtubeVideosPost' => [
            'application/json',
        ],
    ];

/**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation youtubeOauthPost
     *
     * アクセストークンを取得
     *
     * @param  \App\OpenAPI\Model\YoutubeOauthPostRequest $youtubeOauthPostRequest youtubeOauthPostRequest (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthPost'] to see the possible values for this operation
     *
     * @throws \App\OpenAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function youtubeOauthPost($youtubeOauthPostRequest, string $contentType = self::contentTypes['youtubeOauthPost'][0])
    {
        $this->youtubeOauthPostWithHttpInfo($youtubeOauthPostRequest, $contentType);
    }

    /**
     * Operation youtubeOauthPostWithHttpInfo
     *
     * アクセストークンを取得
     *
     * @param  \App\OpenAPI\Model\YoutubeOauthPostRequest $youtubeOauthPostRequest (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthPost'] to see the possible values for this operation
     *
     * @throws \App\OpenAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function youtubeOauthPostWithHttpInfo($youtubeOauthPostRequest, string $contentType = self::contentTypes['youtubeOauthPost'][0])
    {
        $request = $this->youtubeOauthPostRequest($youtubeOauthPostRequest, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation youtubeOauthPostAsync
     *
     * アクセストークンを取得
     *
     * @param  \App\OpenAPI\Model\YoutubeOauthPostRequest $youtubeOauthPostRequest (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function youtubeOauthPostAsync($youtubeOauthPostRequest, string $contentType = self::contentTypes['youtubeOauthPost'][0])
    {
        return $this->youtubeOauthPostAsyncWithHttpInfo($youtubeOauthPostRequest, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation youtubeOauthPostAsyncWithHttpInfo
     *
     * アクセストークンを取得
     *
     * @param  \App\OpenAPI\Model\YoutubeOauthPostRequest $youtubeOauthPostRequest (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function youtubeOauthPostAsyncWithHttpInfo($youtubeOauthPostRequest, string $contentType = self::contentTypes['youtubeOauthPost'][0])
    {
        $returnType = '';
        $request = $this->youtubeOauthPostRequest($youtubeOauthPostRequest, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'youtubeOauthPost'
     *
     * @param  \App\OpenAPI\Model\YoutubeOauthPostRequest $youtubeOauthPostRequest (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function youtubeOauthPostRequest($youtubeOauthPostRequest, string $contentType = self::contentTypes['youtubeOauthPost'][0])
    {

        // verify the required parameter 'youtubeOauthPostRequest' is set
        if ($youtubeOauthPostRequest === null || (is_array($youtubeOauthPostRequest) && count($youtubeOauthPostRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $youtubeOauthPostRequest when calling youtubeOauthPost'
            );
        }


        $resourcePath = '/youtube/oauth';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($youtubeOauthPostRequest)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($youtubeOauthPostRequest));
            } else {
                $httpBody = $youtubeOauthPostRequest;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation youtubeOauthUrlGet
     *
     * 認可画面のURLを取得
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthUrlGet'] to see the possible values for this operation
     *
     * @throws \App\OpenAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \App\OpenAPI\Model\YoutubeOauthUrlGet200Response
     */
    public function youtubeOauthUrlGet(string $contentType = self::contentTypes['youtubeOauthUrlGet'][0])
    {
        list($response) = $this->youtubeOauthUrlGetWithHttpInfo($contentType);
        return $response;
    }

    /**
     * Operation youtubeOauthUrlGetWithHttpInfo
     *
     * 認可画面のURLを取得
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthUrlGet'] to see the possible values for this operation
     *
     * @throws \App\OpenAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \App\OpenAPI\Model\YoutubeOauthUrlGet200Response, HTTP status code, HTTP response headers (array of strings)
     */
    public function youtubeOauthUrlGetWithHttpInfo(string $contentType = self::contentTypes['youtubeOauthUrlGet'][0])
    {
        $request = $this->youtubeOauthUrlGetRequest($contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\OpenAPI\Model\YoutubeOauthUrlGet200Response' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\OpenAPI\Model\YoutubeOauthUrlGet200Response' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\OpenAPI\Model\YoutubeOauthUrlGet200Response', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\OpenAPI\Model\YoutubeOauthUrlGet200Response';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\OpenAPI\Model\YoutubeOauthUrlGet200Response',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation youtubeOauthUrlGetAsync
     *
     * 認可画面のURLを取得
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthUrlGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function youtubeOauthUrlGetAsync(string $contentType = self::contentTypes['youtubeOauthUrlGet'][0])
    {
        return $this->youtubeOauthUrlGetAsyncWithHttpInfo($contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation youtubeOauthUrlGetAsyncWithHttpInfo
     *
     * 認可画面のURLを取得
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthUrlGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function youtubeOauthUrlGetAsyncWithHttpInfo(string $contentType = self::contentTypes['youtubeOauthUrlGet'][0])
    {
        $returnType = '\App\OpenAPI\Model\YoutubeOauthUrlGet200Response';
        $request = $this->youtubeOauthUrlGetRequest($contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'youtubeOauthUrlGet'
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeOauthUrlGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function youtubeOauthUrlGetRequest(string $contentType = self::contentTypes['youtubeOauthUrlGet'][0])
    {


        $resourcePath = '/youtube/oauth/url';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation youtubeVideosPost
     *
     * 本人がアップロードした動画一覧を取得
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeVideosPost'] to see the possible values for this operation
     *
     * @throws \App\OpenAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \App\OpenAPI\Model\YoutubeVideosPost200ResponseInner[]
     */
    public function youtubeVideosPost(string $contentType = self::contentTypes['youtubeVideosPost'][0])
    {
        list($response) = $this->youtubeVideosPostWithHttpInfo($contentType);
        return $response;
    }

    /**
     * Operation youtubeVideosPostWithHttpInfo
     *
     * 本人がアップロードした動画一覧を取得
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeVideosPost'] to see the possible values for this operation
     *
     * @throws \App\OpenAPI\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \App\OpenAPI\Model\YoutubeVideosPost200ResponseInner[], HTTP status code, HTTP response headers (array of strings)
     */
    public function youtubeVideosPostWithHttpInfo(string $contentType = self::contentTypes['youtubeVideosPost'][0])
    {
        $request = $this->youtubeVideosPostRequest($contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\App\OpenAPI\Model\YoutubeVideosPost200ResponseInner[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\App\OpenAPI\Model\YoutubeVideosPost200ResponseInner[]' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\App\OpenAPI\Model\YoutubeVideosPost200ResponseInner[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\App\OpenAPI\Model\YoutubeVideosPost200ResponseInner[]';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\App\OpenAPI\Model\YoutubeVideosPost200ResponseInner[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation youtubeVideosPostAsync
     *
     * 本人がアップロードした動画一覧を取得
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeVideosPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function youtubeVideosPostAsync(string $contentType = self::contentTypes['youtubeVideosPost'][0])
    {
        return $this->youtubeVideosPostAsyncWithHttpInfo($contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation youtubeVideosPostAsyncWithHttpInfo
     *
     * 本人がアップロードした動画一覧を取得
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeVideosPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function youtubeVideosPostAsyncWithHttpInfo(string $contentType = self::contentTypes['youtubeVideosPost'][0])
    {
        $returnType = '\App\OpenAPI\Model\YoutubeVideosPost200ResponseInner[]';
        $request = $this->youtubeVideosPostRequest($contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'youtubeVideosPost'
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['youtubeVideosPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function youtubeVideosPostRequest(string $contentType = self::contentTypes['youtubeVideosPost'][0])
    {


        $resourcePath = '/youtube/videos';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
