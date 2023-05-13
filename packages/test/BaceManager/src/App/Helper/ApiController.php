<?php

namespace Test\BaceManager\App\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *  success Response method
     */
    public function successResponse($data, string $message='') : Response
    {
        return response([
            'error' => false,
            'data' => $data,
            'message' => $message
        ], Response::HTTP_OK, []);
    }
    
    /**
     * error Response method
     */
    public function errorResponse(Array $data=[], int $code=400, string $message='') : Response
    {
        return response([
            'error' => true,
            'data' => $data,
            'message' => $message
        ], $code, []);
    }


    public function validate(
        Request $request,
        array $rules,
        array $messages = [],
        array $customAttributes = []) 
    {

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

      
        if ($validator->fails()) {
            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                $this->errorResponse([
                    'errors' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY)
            );
        }
    }


    public function paginateObject($item)
    {
        return [
            'total' => $item->total(),
            'count' => $item->count(),
            'per_page' => $item->perPage(),
            'current_page' => $item->currentPage(),
            'total_pages' => $item->lastPage()
        ];
    }

    public function notFound()
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(
            $this->errorResponse([
            ], Response::HTTP_NOT_FOUND)
        );
    }

}
