<?php

namespace App\Http\Controllers\V1\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreRequest;
use App\Jobs\Customer\DeleteJob;
use App\Jobs\Customer\IndexJob;
use App\Jobs\Customer\SingleJob;
use App\Jobs\Customer\StoreJob;
use OpenApi\Attributes\Delete;

class CustomerController extends Controller
{
	/**
	 * @OA\Post(
	 *     path="/api/v1/customer",
	 *     summary="create new customer",
	 *     tags={"customers"},
	 * @OA\RequestBody(
	 *         @OA\MediaType(
	 *             mediaType="application/json",
	 *             @OA\Schema(
	 *                 @OA\Property(
	 *                     property="firstName",
	 *                     type="string"
	 *                 ),
	 * 					@OA\Property(
	 *                     property="lastName",
	 *                     type="string"
	 *                 ),
	 * 					@OA\Property(
	 *                     property="dateOfBirth",
	 *                     type="string"
	 *                 ),
	 * 					@OA\Property(
	 *                     property="phoneNumber",
	 *                     type="string"
	 *                 ),
	 *                    @OA\Property(
	 *                     property="email",
	 *                     type="string"
	 *                 ),
	 *                    @OA\Property(
	 *                     property="bankAccountNumber",
	 *                     type="string"
	 *                 ),
	 *                 example={ "firstName":"your_first_name", "lastName": "your_last_name","dateOfBirth"
	 *                 :"2011/12/12" , "phoneNumber":"989114321212", "email":"a@a.com","bankAccountNumber":"1234" }
	 *             )
	 *         )
	 *     ),
	 * @OA\Response(
	 *         response=201,
	 *         description="OK!",
	 *         @OA\JsonContent(
	 *             @OA\Examples(example="success", summary="An result object."),
	 *         )
	 *     ),@OA\Response(
	 *         response=422,
	 *         description="invalid payload!."
	 *     )
	 * )
	 */
	public function store( StoreRequest $request )
	{
		return dispatch_sync( new StoreJob( $request->validated() ) );
	}

	/**
	 * @OA\Get(
	 *     path="/api/v1/customer",
	 *     summary="paginate customers",
	 *     tags={"customers"},
	 * @OA\Response(
	 *         response=200,
	 *         description="OK!",
	 *         @OA\JsonContent(
	 *             @OA\Examples(example="success", summary="pages of customer rows."),
	 *         )
	 * )
	 * )
	 */
	public function index()
	{
		return dispatch_sync( new IndexJob());
	}

	/**
	 * @OA\Get(
	 *     path="/api/v1/customer/{id}",
	 *     summary="single customer",
	 *     tags={"customers"},
	 *  @OA\Parameter(
	 *      name="id",
	 *      description="Customer ID",
	 *      example=1,
	 *      required=true,
	 *      in="path",
	 *      @OA\Schema(
	 *          type="integer"
	 *      )
	 *  ),
	 * @OA\Response(
	 *         response=200,
	 *         description="OK!",
	 *         @OA\JsonContent(
	 *             @OA\Examples(example="success", summary="customer single."),
	 *         ),
	 *     ),@OA\Response(
	 *         response=404,
	 *         description="customer not found!."
	 *     )
	 * )
	 * )
	 */
	public  function single($id)
	{
		return dispatch_sync( new SingleJob($id));
	}

	/**
	 * @OA\Delete(
	 *     path="/api/v1/customer/{id}",
	 *     summary="delete customer",
	 *     tags={"customers"},
	 *  @OA\Parameter(
	 *      name="id",
	 *      description="Customer ID",
	 *      example=1,
	 *      required=true,
	 *      in="path",
	 *      @OA\Schema(
	 *          type="integer"
	 *      )
	 *  ),
	 * @OA\Response(
	 *         response=200,
	 *         description="OK!",
	 *         @OA\JsonContent(
	 *             @OA\Examples(example="success", summary="customer deleted."),
	 *         ),
	 *     ),@OA\Response(
	 *         response=404,
	 *         description="customer not found!."
	 *     )
	 * )
	 * )
	 */
	public  function delete($id)
	{
		return dispatch_sync( new DeleteJob($id));
	}

}
