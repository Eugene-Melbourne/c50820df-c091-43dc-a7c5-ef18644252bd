<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{


    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_env_type(): void
    {
        // it is important to remember that function env
        // does not convert string to int,
        // but it converts string to bool and null
        $this->assertSame('123', env('TEST_INT', 'a'));
        $this->assertSame(true, env('TEST_BOOL_TRUE', 'a'));
        $this->assertSame(false, env('TEST_BOOL_FALSE', 'a'));
        $this->assertSame(null, env('TEST_NULL', 'a'));
        $this->assertSame(null, env('TEST_NOT_EXISTANT_PARAMETER'));
    }
}
