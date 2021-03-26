<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function __construct()
    {
        parent::setUp();

        $this->actingAs(User::first(), 'api');
        $this->withoutExceptionHandling();
    }


    protected function apiHeader()
    {
        return [
            'Accept' => 'application/json'
        ];
    }

    /**
     * Expected JSON response from the request
     * 
     * @return array
     */
    protected function jsonStructure()
    {
        return [
            'status',
            'message',
            'data'
        ];
    }


    /**
     * 
     * @param integer @code
     * @param [type] $response
     * @return void
     */
    protected function assertResponse($response, int $code = 200)
    {
        $response
            ->assertStatus($code)
            ->assertJsonStructure($this->jsonStructure());
    }

}
