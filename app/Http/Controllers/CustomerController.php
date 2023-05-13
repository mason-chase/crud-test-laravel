<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Rules\CustomerNameAndBrithDateRule;
use App\Rules\PhoneRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0", title: "Customer Api")]
class CustomerController extends Controller
{
    #[OA\Get(path: '/api/customers')]
    #[OA\Response(response: 200, description: 'Ok', content: [
        new OA\JsonContent(properties: [
            new OA\Property(property: 'data', ref: '#/components/schemas/Customer'),
            new OA\Property(property: 'link', type: 'object'),
            new OA\Property(property: 'meta', type: 'object'),
        ], type: 'object')
    ])]
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerResource::collection(
            Customer::query()->paginate()
        );
    }

    #[OA\Post(path: '/api/customers')]
    #[OA\RequestBody(content: [
        new OA\JsonContent(ref: '#/components/schemas/Customer', type: 'object')
    ])]
    #[OA\Response(response: 201, description: 'Created', content: [
        new OA\JsonContent(properties: [
            new OA\Property(property: 'data', ref: '#/components/schemas/Customer')
        ], type: 'object')
    ])]
    #[OA\Response(
        response: 422,
        description: 'Unprocessable Content',
        content: [
            new OA\JsonContent(ref: '#/components/schemas/CustomerValidationError')
        ])]
    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('customers', 'email'),
            ],
            'phone_number' => [
                'required',
                new PhoneRule
            ],
            'first_name' => [
                'required',
                'string',
                new CustomerNameAndBrithDateRule(
                    $request->first_name,
                    $request->last_name,
                    Carbon::parse($request->date_of_brith)
                )
            ],
            'last_name' => [
                'required',
                'string'
            ],
            'date_of_brith' => [
                'required',
                'date'
            ],
            'bank_account_number' => [
                'required',
                'numeric'
            ],
        ]);

        return CustomerResource::make(
            Customer::create($request->all())
        );
    }

    #[OA\Get(path: '/api/customers/{uuid}')]
    #[OA\Parameter(parameter: 'uuid', name: 'uuid', in: "path")]
    #[OA\Response(response: 200, description: 'Ok', content: [
        new OA\JsonContent(properties: [
            new OA\Property(property: 'data', ref: '#/components/schemas/Customer')
        ], type: 'object')
    ])]
    #[OA\Response(response: 404, description: 'Not Found')]
    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return CustomerResource::make($customer);
    }

    #[OA\Put(path: '/api/customers/{uuid}')]
    #[OA\Parameter(parameter: 'uuid', name: 'uuid', in: "path")]
    #[OA\RequestBody(content: [
        new OA\JsonContent(ref: '#/components/schemas/Customer', type: 'object')
    ])]
    #[OA\Response(response: 200, description: 'Ok', content: [
        new OA\JsonContent(properties: [
            new OA\Property(property: 'data', ref: '#/components/schemas/Customer')
        ], type: 'object')
    ])]
    #[OA\Response(response: 404, description: 'Not Found')]
    #[OA\Response(
        response: 422,
        description: 'Unprocessable Content',
        content: [
            new OA\JsonContent(ref: '#/components/schemas/CustomerValidationError')
        ])]
    /**
     * Update the specified resource in storage.
     * @throws ValidationException
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('customers', 'email')->ignoreModel($customer),
            ],
            'phone_number' => [
                'required',
                new PhoneRule
            ],
            'first_name' => [
                'required',
                'string',
                new CustomerNameAndBrithDateRule(
                    $request->first_name,
                    $request->last_name,
                    Carbon::parse($request->date_of_brith),
                    $customer
                )
            ],
            'last_name' => [
                'required',
                'string'
            ],
            'date_of_brith' => [
                'required',
                'date'
            ],
            'bank_account_number' => [
                'required',
                'numeric'
            ],
        ]);

        $customer->update($request->all());

        return CustomerResource::make($customer);
    }

    #[OA\Delete(path: '/api/customers/{uuid}')]
    #[OA\Parameter(parameter: 'uuid', name: 'uuid', in: "path")]
    #[OA\Response(response: 204, description: 'Ok')]
    #[OA\Response(response: 404, description: 'Not Found')]
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->noContent();
    }
}
