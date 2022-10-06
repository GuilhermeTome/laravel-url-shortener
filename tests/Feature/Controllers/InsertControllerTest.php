<?php

namespace Tests\Feature\Controllers;

use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InsertControllerTest extends TestCase
{
    private $redirect = 'https://www.google.com/';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_correctly_insert_in_database()
    {
        $response = $this->post('/api/insert', [
            'url' => $this->redirect
        ]);

        $response->assertStatus(200);

        $data = json_decode($response->getContent());
        $this->assertEquals('success', $data->status);

        $url = Url::where('hash', $data->hash)->first();
        $this->assertEquals($this->redirect, $url->url);

        // test_if_return_same_hash_in_duplicated_url

        $response = $this->post('/api/insert', [
            'url' => $this->redirect
        ]);

        $response->assertStatus(200);

        $data = json_decode($response->getContent());
        $this->assertEquals('success', $data->status);

        $this->assertEquals($url->hash, $data->hash);
    }
}
