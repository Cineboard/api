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
class ApiUsersTest extends TestCase
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
    public function getAllUsers()
    {
        $client=$this->client();
        $response = $client->get('/users', [
            'headers'  => [],
            'debug' => true]
        );

        $this->assertEquals(200, $response->getStatusCode());
        // print_r($response);
    }

    /**
     * @test
     **/
    public function postUsers()
    {
        $data = array(
            'name' => 'phpUnit',
        );

        $client=$this->client();
        $response = $client->post('/users', [
            'headers'  => [],
            'debug' => true,
            'form_params' => $data
        ]);

        $this->assertTrue($response->hasHeader('Access-Control-Allow-Methods'));
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(true), true);
        print_r($data);
    }

    /**
     * @test
     **/
    public function putUsers()
    {
        $data = array(
            'name' => 'phpUnit2',
        );

        $client=$this->client();
        $response = $client->put('/users/5', [
            'headers'  => [],
            'debug' => true,
            'form_params' => $data
        ]);

        $this->assertTrue($response->hasHeader('Access-Control-Allow-Methods'));
        $this->assertEquals(200, $response->getStatusCode());
        //$data = json_decode($response->getBody(true), true);
    }

    /**
     * @test
     **/
    public function deleteUsers()
    {
        $client=$this->client();
        $response = $client->delete('/users/5', [
            'headers'  => [],
            'debug' => true
        ]);

        $this->assertTrue($response->hasHeader('Access-Control-Allow-Methods'));
        $this->assertEquals(200, $response->getStatusCode());
        //$data = json_decode($response->getBody(true), true);
    }
}