<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorManagmentTest extends TestCase
{
    use RefreshDatabase;

    private function data()
    {
        return [
            'name' => 'Author Name',
            'dob' => '1988-05-05',
            '_token' => 'bzz',
        ];
    }

    /** @test */
    public function test_a_author_can_be_created()
    {
        // $this->withoutExceptionHandling();
        $this->withSession(['_token' => 'bzz'])->post('/authors/store', $this->data());
        $author = Author::all();
        $this->assertCount(1, $author);
        // $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        // $this->assertEquals('1988-05-05', $author->first()->dob->format('Y/d/m'));
    }

    /** @test */
    public function test_a_name_is_required()
    {
        $response = $this->withSession(['_token' => 'bzz'])
            ->post('/authors/store', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function test_a_dob_is_required()
    {
        $response = $this->withSession(['_token' => 'bzz'])
            ->post('/authors/store', array_merge($this->data(), ['dob' => '']));

        $response->assertSessionHasErrors('dob');
    }
}
