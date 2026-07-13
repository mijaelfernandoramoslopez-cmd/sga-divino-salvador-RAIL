<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_students_index_loads_correctly()
    {
        $response = $this->get('/alumnos/mostrar');

        $response->assertStatus(200);
    }
}