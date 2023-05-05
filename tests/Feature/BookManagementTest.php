<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_a_book_can_be_added_to_the_librery()
    {
        // $this->withoutExceptionHandling();
        $responce = $this->post('/books/store', [
            'title' => 'Cool Book Title',
            'author' => 'Victor',
        ]);
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
            'author' => 'Victor',
        ]);
        $responce->assertSessionHasErrors('title');
    }

    /** @test */
    public function test_a_author_is_required()
    {
        $responce = $this->post('/books/store', [
            'title' => 'Cool Book Title',
            'author' => '',
        ]);
        $responce->assertSessionHasErrors('author');
    }

    /** @test */
    public function test_a_book_can_be_updated()
    {
        // $this->withoutExceptionHandling();
        $this->post('/books/store', [
            'title' => 'Cool Book Title',
            'author' => 'Victor',
        ]);
        $book = Book::first();
        $responce = $this->patch('/books/update/' . $book->id, [
            'title' => 'New Title',
            'author' => 'New Author',
        ]);
        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
        $responce->assertRedirect($book->path());
    }

    /** @test */
    public function test_a_book_can_be_deleted()
    {
        // $this->withoutExceptionHandling();
        $this->post('/books/store', [
            'title' => 'Cool Book Title',
            'author' => 'Victor',
        ]);
        $book = Book::first();
        $this->assertCount(1, Book::all());
        $responce = $this->delete('/books/destroy/' . $book->id);
        $this->assertCount(0, Book::all());
        $responce->assertRedirect('/books/index');
    }
}
