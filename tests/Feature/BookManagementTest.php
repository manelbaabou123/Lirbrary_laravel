<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    private function data()
    {
        return [
            'title' => 'Cool Book Title',
            'author_id' => 1,
        ];
    }

    /** @test */
    public function test_a_book_can_be_added_to_the_librery()
    {
        // $this->withoutExceptionHandling();
        $responce = $this->post('/books/store', $this->data());
        $book = Book::first();
        // $responce->assertok();
        $this->assertCount(1, Book::all());
        $responce->assertRedirect($book->path());
    }

    /** @test */
    public function test_a_title_is_required()
    {
        $responce = $this->post('/books/store', [
            'title' => '',
            'author_id' => 1,
        ]);
        $responce->assertSessionHasErrors('title');
    }

    /** @test */
    public function test_a_author_is_required()
    {
        $responce = $this->post('/books/store', array_merge($this->data(), ['author_id' => '']));
        $responce->assertSessionHasErrors('author_id');
    }

    /** @test */
    public function test_a_book_can_be_updated()
    {
        // $this->withoutExceptionHandling();
        $this->post('/books/store', $this->data());
        $book = Book::first();
        $responce = $this->patch('/books/update/'.$book->id, [
            'title' => 'New Title',
            'author_id' => 'New Author',
        ]);
        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals(26, Book::first()->author_id);
        $responce->assertRedirect($book->path());
    }

    /** @test */
    public function test_a_book_can_be_deleted()
    {
        // $this->withoutExceptionHandling();
        $this->post('/books/store', $this->data());
        $book = Book::first();
        $this->assertCount(1, Book::all());
        $responce = $this->delete('/books/destroy/'.$book->id);
        $this->assertCount(0, Book::all());
        $responce->assertRedirect('/books/index');
    }

    /** @test */
    public function test_a_new_author_is_automaticlly_added()
    {
        $this->withoutExceptionHandling();
        $this->post('/books/store', $this->data());
        $book = Book::first();
        $author = Author::first();
        // dd($book->author_id);
        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1, Author::all());
    }
}
