<?php 
namespace Tests;
use App\BooksAPI;

trait  CallBooksAPI{

    public function testFetchAllBooks()
    {
        $booksApi = new BooksAPI;
        $this->assertNotEmpty($booksApi->fetchAll(), true);
    }


    public function testFetchBookByName()
    {
        $booksApi = new BooksAPI;
        $data = $booksApi->fetchBookByName("A Clash of Kings");

        $expected = [
            "name" => "A Clash of Kings",
            "isbn" => "978-0553108033",
            "authors" => [
                "George R. R. Martin"
            ],
            "number_of_pages" => 768,
            "publisher" => "Bantam Books",
            "country" => "United States",
            "release_date" => "1999-02-02"
        ];
        
        $this->assertEquals($data, $expected);
    }
}
   
