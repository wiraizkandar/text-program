<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransformTest extends TestCase
{
    /**
     * Test the transform page.
     */
    public function test_can_view_transform_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
