<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookApplicationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */

    public function a_book_can_be_added() 
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/books', [
            'title' =>'Random Book',
            'author' => 'Shotegai'
        ]);
        $response->assertStatus(201);  //$response->assertOK();

        $this->assertCount(1, Book::all());
    }

    /** @test */

    public function a_title_is_required() 
    {
        //$this->withoutExceptionHandling();

        $response = $this->post('/api/books', [
            'title' =>   '',
            'author' => 'Shotegai'
        ]);
        $response->assertSessionHasErrors('title');

        
    }

     /** @test */

     public function an_author_is_required() 
     {
         //$this->withoutExceptionHandling();
 
         $response = $this->post('/api/books', [
             'title' =>   'Linux TOOLBOX',
             'author' =>  ''
         ]);
         $response->assertSessionHasErrors('author');
 
         
     }

       /** @test */

    public function a_book_can_be_updated() 
  
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/books', [
            'title' =>'Random Book',
            'author' => 'Shotegai'
        ]);

        $book = Book::first();

        $response = $this->put('/api/books/' . $book->id,[
            'title' =>'new Book',
            'author' => 'Shoro'
        ]);

        $response->assertStatus(201);  //$response->assertOK();
        $this->assertEquals('new Book', Book::first()->title);
        $this->assertEquals('Shoro', Book::first()->author);
       
    }


    
       /** @test */

       public function a_book_can_be_deleted() 
  
       {
           $this->withoutExceptionHandling();
   
           $response = $this->post('/api/books', [
               'title' =>'Random Book',
               'author' => 'Shotegai'
           ]);
   
           $book = Book::first();
           $this->assertCount(1, Book::all());
   
           $response = $this->delete('/api/books/' . $book->id,[
               'title' =>'new Book',
               'author' => 'Shoro'
           ]);
   
        
           $this->assertCount(0, Book::all());

       }
   


}
