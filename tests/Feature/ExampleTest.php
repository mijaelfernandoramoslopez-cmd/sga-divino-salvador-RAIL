<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_route()
    {
        $response = $this->get('/alumnos/mostrar');

        dd($response->status());
    }
}