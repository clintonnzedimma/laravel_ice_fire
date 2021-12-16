<?php 
/**
 * This class communicates with the  external ICE AND FIRE API at https://www.anapioficeandfire.com/api
 */

namespace App;
use Illuminate\Support\Facades\Http;

class BooksAPI {

    /**
     * Fetch all  books 
     * @return array
     */
    public function fetchAll() {
       return  Http::get('https://www.anapioficeandfire.com/api/books')->json();
    }

    /**
     * Fetch a single book by name
     * @param  string name
     * @return array
     */
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