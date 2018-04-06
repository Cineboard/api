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
class ApiCategoriesTest extends TestCase
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
    public function getAllCategories()
    {
        $client=$this->client();
        $response = $client->get('/categories', ['headers'  => [], 'debug' => true]);
        $this->assertEquals(200, $response->getStatusCode());
        //print_r($response);
    }

    /**
     * @test
     **/
    public function postCategories()
    {
        $data = array(
            'name' => 'supercultmovie',
        );

        $client=$this->client();
        $response = $client->post('/categories', [
            'headers'  => [],
            'debug' => true,
            'form_params' => $data
        ]);

        $this->assertTrue($response->hasHeader('Access-Control-Allow-Methods'));
        $this->assertEquals(200, $response->getStatusCode());
        //$data = json_decode($response->getBody(true), true);
        //print_r($data);
    }

    /**
     * @test
     **/
    public function putCategories()
    {
        $data = array(
            'name' => 'supercultumovieEDITED',
        );

        $client=$this->client();
        $response = $client->put('/categories/4', [
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
    public function deleteCategories()
    {
        $client=$this->client();
        $response = $client->delete('/categories/4', [
            'headers'  => [],
            'debug' => true
        ]);

        $this->assertTrue($response->hasHeader('Access-Control-Allow-Methods'));
        $this->assertEquals(200, $response->getStatusCode());
        //$data = json_decode($response->getBody(true), true);
    }
}