<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Creates new book
    * @param  Illuminate\Http\Request;
     * @return array
 
     */
    public function create(Request $request)
    {    

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'isbn' => 'required',
            'authors' => 'required',
            'country' => 'required',
            'number_of_pages' => 'required',
            'publisher' => 'required',
            'release_date' => 'required|min:10|max:10',
        ]);
  

        if ($validator->fails()) {
            return [
                "status_code" => 424,
                "status" => "error occured",
                // "errors" => $validator->errors(),
                "data" => []
            ];
        }

        Book::insert( [
            'name' => $request->input("name"),
            'isbn' => $request->input("isbn"),
            'authors' => $request->input("authors"),
            'country' => $request->input("country"),
            'number_of_pages' => $request->input("number_of_pages"),
            'publisher' => $request->input("publisher"),
            'release_date' => $request->input("release_date"),
        ]);

        return [
            "status_code" => 201,
            "status" => "success",
            "errors" => null,
            "data" => [
                'name' => $request->input("name"),
                'isbn' => $request->input("isbn"),
                'authors' => [$request->input("authors")],
                'country' => $request->input("country"),
                'number_of_pages' => $request->input("number_of_pages"),
                'publisher' => $request->input("publisher"),
                'release_date' => $request->input("release_date"),
                ]
            ];
    }


  /**
     * Fetch all the books
    * @param  Illuminate\Http\Request;
     * @return  array
 
     */
    public function read(Request $request)
    {    
        $books = Book::get()->toArray();

        $books = array_map(function($arr){
            $arr['authors'] = [ $arr['authors'] ];
            return $arr;
        }, $books);


        return [
                "status_code" => 200,
                "status" => "success",
                "data" => $books
            ];
    }
    
    
    /**
     * Updates a book
     * @param  id
     * @param  Illuminate\Http\Request
     * @return  array
 
     */
    public function update($id, Request $request)
    {    
        try {
           Book::where("id", $id)->update($request->input());
           $book = Book::where("id",$id)->first();
           $book['authors'] = [$book['authors']];
            
            return [
                "status_code" => 200,
                "status" => "success",
                "data" => $book
            ];
        } catch (\Exception $e) {
            return [
                "status_code" => 304,
                "status" => "error occured",
                "data" => []
            ];
        }
    } 
    

    /**
     * Deletes a book
     * @param  id
     * @param  Illuminate\Http\Request
     * @return  array
     */
    public function delete($id, Request $request)
    {    
        try {
           
           $book = Book::where("id", $id)->first();

           Book::where('id', $id)->delete();
    
            return [
                "status_code" => 204,
                "status" => "success",
                "message" => "The book `{$book['name']}` was deleted successfully",
                "data" => []
            ];

        } catch (\Exception $e) {
        
            return [
                "status_code" => 304,
                "status" => "error occured",
                "data" => []
            ];
        }
    }  



    /**
     * Finds a bok
     * @param  id
     * @param  Illuminate\Http\Request
     * @return  array
     */
    public function findOne($id, Request $request)
    {    
        try {
           $book = Book::where("id", $id)->first();
           $book['authors'] = [$book['authors']];
    
            return [
                "status_code" => 200,
                "status" => "success",
                "data" => $book
            ];

        } catch (\Exception $e) {
        
            return [
                "status_code" => 404,
                "status" => "not found",
                "data" => []
            ];
        }
    }  
}