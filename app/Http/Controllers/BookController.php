<?php

namespace App\Http\Controllers;
use App\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
class BookController extends Controller
{
    /**
     * @OA\GET(path="/books",
     *  tags={"Books"},
     *  @OA\Response(response="200",
     *      description="Book Collection",
     *     ),
     *  @OA\Parameter(
     *     name="page",
     *     description="Pagination page",
     *     in="query",
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   )
     * )
     */
    public function index()
    {
        $books = Book::paginate();

        return BookResource::collection($books);
    }
     /**
     * @OA\GET(path="/books/{id}",
     *  tags={"Books"},
     *  @OA\Response(response="200",
     *      description="Book",
     *     ),
     *  @OA\Parameter(
     *     name="id",
     *     required=true,
     *     description="Book ID",
     *     in="path",
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   )
     * )
     */

    public function show($id)
    {
        return new BookResource(Book::find($id));
    }

    /**
     * @OA\Post(
     *  path="/books/",
     *  tags={"Books"},
     *  @OA\Response(response="201",
     *      description="Book create",
     *     ),
     *     @OA\RequestBody(
     *       required=true,
     *      @OA\JsonContent(ref="#/components/schemas/BookCreateRequest")      
     *  )
     * )
     */
    public function store(BookCreateRequest $request)
    {
      
        $book = Book:: create($request->only('title', 'description', 'author', 'publisher', 'genre', 'image'));
            
        return response($book, 201);
    }

    /**
     * @OA\Put(
     *  path="/books/{id}",
     *  tags={"Books"},
     *  @OA\Response(response="202",
     *      description="Book update",
     *     ),
     *  @OA\Parameter(
     *     name="id",
     *     description="User ID",
     *     in="path",
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   ),
     *     @OA\RequestBody(
     *       required=true,
     *      @OA\JsonContent(ref="#/components/schemas/BookUpdateRequest")      
     *  )
     * )
     */


    public function update(BookUpdateRequest $request, $id)
    {
        $book = Book::find($id);

        $book->update($request->only('title', 'description', 'author', 'publisher', 'genre', 'image'));

        return response($book, 201);

    }
    /**
     * @OA\Delete(path="/books/{id}",
     *  tags={"Books"},
     *  @OA\Response(response="204",
     *      description="Delete book",
     *     ),
     *  @OA\Parameter(
     *     name="id",
     *     required=true,
     *     description="Book ID",
     *     in="path",
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   )
     * )
     */

    public function destroy($id)
    {
        Book::destroy($id);

        return response(null,  204);

    }
    /**
     * @OA\GET(path="/books/export/{filter}",
     *  tags={"File Export"},
     *  @OA\Response(response="200",
     *      description="Export book data to CSV/XML format.",
     *     ),
     *  @OA\Parameter(
     *     name="/all || /titles || /authors",
     *     required=true,
     *     description="To export book details",
     *     in="path",
     *     @OA\Schema(
     *        type="string"
     *     )
     *   )
     * )
     */

    public function export($details)
    {
        $params = $details;
        $headers = [

            "Content-type" => "text/csv",
            "Content-Disposition"=> "attachment; filename=books.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",

        ];

        $callback = function() use ($details) {

            $books = Book::all();
            $file = fopen('php://output', 'w');

            if($details == 'authors'){
                fputcsv($file,['Authors']);

                //Body
                foreach($books as $book){
                    fputcsv($file,[$book->author]);
                }
              
            }elseif ($details =='titles') {
                fputcsv($file,['Title']);

                //Body
                foreach($books as $book){
                    fputcsv($file,[$book->title]);
                }
            }else{
                fputcsv($file,['ID', 'Title', 'Author', 'Description', 'Publisher', 'Genre']);

                //Body
                foreach($books as $book){
                    fputcsv($file,[$book->id, $book->title, $book->author, $book->description, $book->publisher, $book->genre ]);
                }
                
                fclose($file);

            }

          

        };

        return \Response::stream($callback, 200, $headers);


    }
 

}
