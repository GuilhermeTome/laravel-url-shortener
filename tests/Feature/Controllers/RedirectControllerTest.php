<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    private $redirect = 'https://www.google.com/';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_correctly_making_redirect()
    {
        $insert = $this->post('/api/insert', [
            'url' => $this->redirect
        ]);
        $insert = json_decode($insert->getContent());

        // test_not_found_case

        $response = $this->get("/redirect/not-found");
        $response->assertStatus(404);

        // test_correctly_redirect

        $response = $this->get("/redirect/{$insert->hash}");
        $response->assertRedirect($this->redirect);
    }
}
