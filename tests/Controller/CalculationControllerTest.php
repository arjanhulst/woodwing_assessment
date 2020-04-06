<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculationControllerTest extends WebTestCase
{
    public function testApiAddUpDistance()
    {
        $client = static::createClient();
        $params = [
            'distances' => [
                [
                    'distance' => 5,
                    'unit' => 'meter'
                ],
                [
                    'distance' => 3,
                    'unit' => 'yard'
                ],
            ],
            'returnUnit' => 'meter',
        ];

        $client->request('GET', '/api/add-up-distance', $params);
        $this->assertJson($client->getResponse()->getContent(),'No valid JSON' );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testBadRequest()
    {
        $client = static::createClient();
        $params = [
            'distances' => [
                [
                    'distance' => 3,
                    'unit' => 'yard'
                ],
            ],
            'returnUnit' => 'meter',
        ];
        $client->request('GET', '/api/add-up-distance', $params);
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}