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
        $payload =  json_decode(request()->getContent(), true);

        $validator = Validator::make($payload,[
            'name' => 'required',
            'isbn' => 'required',
            'authors' => 'required',
            'country' => 'required',
            'number_of_pages' => 'required',
            'publisher' => 'required',
            'release_date' => 'required|min:10|max:10',
        ]);
  

        if ($validator->fails()) {
            return response()->json([
                "status_code" => 400,
                "status" => "error occured",
                "errors" => $validator->errors(),
                "data" => []
            ], 400);
        }

        Book::insert($payload);

        return response()->json([
            "status_code" => 201,
            "status" => "success",
            "data" => ["book" => $payload]
            ], 201);
    }


  /**
     * Fetch all the books
     * @param  Illuminate\Http\Request;
     * @return  array
    */
    public function read(Request $request)
    {  
        try {  
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
        } catch(\Exception $e){
            return response()->json([
                "status_code" => 400,
                "status" => "error occured",
                "message" => $e->getMessage(),
                "data" => []
            ],400);
        }

    }
    
    
    /**
     * Updates a book
     * @param  id
     * @param  Illuminate\Http\Request
     * @return  array
 
     */
    public function update($id, Request $request)
    {    
        $payload =  json_decode(request()->getContent(), true);
  
        try {
           Book::where("id", $id)->update($payload);
           $book = Book::where("id",$id)->first();
           $book['authors'] = [$book['authors']];
            
            return [
                "status_code" => 200,
                "status" => "success",
                "data" => $book
            ];
        } catch (\Exception $e) {
            return response()->json([
                "status_code" => 400,
                "status" => "error occured",
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
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
           $bookName = $book['name'];
           $book->delete();
    
            return response()->json([
                "status_code" => 204,
                "status" => "success",
                "message" => "The book '{$bookName}' was deleted successfully",
                "data" => []
            ], 200);

        } catch (\Exception $e) {
               return response()->json([
                "status_code" => 404,
                "status" => "not found",
                "data" => []
            ], 404);
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
        
            return response()->json([
                "status_code" => 404,
                "status" => "not found",
                "data" => []
            ],404);
        }
    }
    
  /**
     * Finds a bok
     * @param  id
     * @param  Illuminate\Http\Request
     * @return  array
     */
    public function search(Request $request)
    {    
        try {
           $searchQuery = $request->query("q");
          
            $result = Book::where('name','LIKE','%'.$searchQuery.'%')
            ->orWhere('country','LIKE','%'.$searchQuery.'%')
            ->orWhere('publisher','LIKE','%'.$searchQuery.'%')
            ->orWhere('release_date','LIKE','%'.$searchQuery.'%')
            ->get();

            return [
                "status_code" => 200,
                "status" => "success",
                "data" => $result
            ];

        } catch (\Exception $e) {
        
            return response()->json([
                "status_code" => 404,
                "status" => "not found",
                "message" => $e->getMessage(),
                "data" => []
            ],404);
        }
    }  
}