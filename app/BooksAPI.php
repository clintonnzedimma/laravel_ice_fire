<?php 
namespace App;
use Illuminate\Support\Facades\Http;


class BooksAPI {

    public function fetchAll() {
       return  Http::get('https://www.anapioficeandfire.com/api/books')->json();
    }

    public function fetchBookByName ($name) {
        $books = $this->fetchAll();

        $book = array_filter($books, function($arr) use($name){
            return $arr['name'] == $name;
        });

        if(!$book) return null;

        foreach ($book as $key => $b) {
            unset($b["url"]);
            $b['number_of_pages'] = $b["numberOfPages"];
            unset($b["numberOfPages"]);
            unset($b["characters"]);
            unset($b["povCharacters"]);
            $b['release_date'] = date("Y-m-d", strtotime($b["released"]));
            unset($b["released"]);
            unset($b['mediaType']);
        }

       return  $book = $b;
    }
}