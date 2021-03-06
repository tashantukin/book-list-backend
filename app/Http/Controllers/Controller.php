<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *  @OA\Info(
     *       version="1.0.0",
     *       description="API documentation using OpenAPi",
     *       title="API Documentation",
     *        @OA\Contact(
     *              email="nmfnavarro@gmail.com"
     *        ),
     *  )
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Admin API Server" 
     * )
    */
}
