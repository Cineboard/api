<?php
/**
 * PHP version 7
 * API functional tests class
 */

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class ApiTest
 *
 * @package Cineboard\Tests
 */
class ApiLibrariesTest extends TestCase
{
    /**
     * @beforeClass
     */
    public function client()
    {
        $client = new Client([
            'base_uri' => 'http://localhost:8081',
            'cookies' => true,
            array(
                'request.options' => array(
                    'exceptions' => false,
                ))
            ]);
            return $client;
    }


    /**
     * @test
     **/
    public function getAllLibraries()
    {
        $client=$this->client();
        $response = $client->get('/libraries', ['headers'  => [], 'debug' => true]);
        $this->assertEquals(200, $response->getStatusCode());
        //print_r($response);
    }

    /**
     * @test
     **/

}