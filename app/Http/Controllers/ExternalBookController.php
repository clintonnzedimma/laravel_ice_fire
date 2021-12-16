<?php 


namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\BooksAPI;
use Illuminate\Http\Request;



class ExternalBookController extends Controller
{
    /**
     * Find book from the ICE & FIRE API
     *
     * @param  Illuminate\Http\Request;
    * @return array
     */
    public function find(Request $request){
        if($request->has("nameOfBook")) {
            $booksApi = new BooksAPI;
            
            $book =  $booksApi->fetchBookByName($request->query("nameOfBook"));
            $status_code = 404;
            $status = "Not Found";

            if (!$book) {
                http_response_code(404);
                return [
                    "status_code" => 404,
                    "status" => "not found",
                    "data" => []
                ];
            } 

            http_response_code(200);
            return  [
                "status_code" => 200,
                "status" => "success",
                "data" => $book
            ];
        }
    }
}