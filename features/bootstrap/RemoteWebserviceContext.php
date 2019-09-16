<?php

declare(strict_types=1);

/*
 * This file is part of previsionmanager
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Behat\Behat\Context\Context;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Http\Client\Exception\NetworkException;
use Http\Mock\Client;


/**
 * Class RemoteWebserviceContext
 */
class RemoteWebserviceContext implements Context
{
    /** @var Client */
    private $httpClient;

    /**
     * RemoteWebservicesContext constructor.
     *
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @Given /^(?:|I )connect to webservice and receive "(?P<responseFile>(?:[^"]|\\")*)"$/
     *
     * @param string $responseFile
     * @param int    $statusCode
     */
    public function iConnectToWebservicesAndReceive($responseFile, $statusCode = 200)
    {
        $response = new Response(
            $statusCode,
            [],
            file_get_contents(__DIR__ . '/../fixtures/webservices_responses/' . $responseFile),
            '1.1',
            null
        );
        $test = $response;

        $this->httpClient->addResponse($response);
    }

    /**
     * @Given /^I fail to connect to webservice$/
     */
    public function iFailToConnectToWebservice()
    {
        $this->httpClient->addException(new NetworkException('Fail to connect to webservice', new Request('get', 'someurl')));
    }
}
