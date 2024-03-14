<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransformAPITest extends TestCase
{
    /**
     *
     *
     * @return void
     */
    public function test_post_transform_text(): void
    {
        $data = [
            'text' => 'hello world'
        ];

        $this->postJson('api/transform', $data)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'transformed_text' => [
                        'uppercase' => 'HELLO WORLD',
                        'alternatecase' => 'hElLo wOrLd',
                    ],
                    'export_path' => '/storage/csv/file.csv',
                ],
                'message' => 'Text Transformed Successfully',
            ]);
    }
}
