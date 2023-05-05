<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagmentTest extends TestCase
{
    use RefreshDatabase;

       /** @test */
       public function test_a_author_can_be_created()
       {
        //    $this->withoutExceptionHandling();
           $this->withSession(['_token' => 'bzz'])->post('/authors/store', [
               'name' => 'Author Name',
               'dob' => '1988-05-05',
               '_token' => 'bzz'
           ]);
           $author = Author::all();
           $this->assertCount(1, $author);
        //    $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        // $this->assertEquals('1988-05-05', $author->first()->dob->format('Y/d/m'));
       }
}
