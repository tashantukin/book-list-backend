<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *      title="Store Book request",
 *      description="Store book request body data",
 * )
 */


class BookCreateRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     title="title"
     * )
     * 
     * @var string
     */
    public $title;
     /**
     * @OA\Property(
     *     title="author"
     * )
     * 
     * @var string
     */

    public $author;
     /**
     * @OA\Property(
     *     title="description"
     * )
     * 
     * @var string
     */

    public $description;
     /**
     * @OA\Property(
     *     title="publisher"
     * )
     * 
     * @var string
     */

    public $publisher;
     /**
     * @OA\Property(
     *     title="genre"
     * )
     * 
     * @var string
     */

    public $genre;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'author' => 'required'
        
        ];
    }
}
