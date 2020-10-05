<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repository\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ApiCustomerController extends Controller
{
    private $customer;

    public function __construct(CustomerRepositoryInterface $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'premium_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data is invalid',
                'error' => $validator->messages()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->customer->saveCustomer($request->all());
        $data['status'] = 'success';
        $data['message'] = 'The new customer is added';
        return response()->json($data, Response::HTTP_ACCEPTED);
    }

    public function getCustomerQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data is invalid',
                'error' => $validator->messages()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data['customer'] = $this->customer->findCustomerQuote($request->all()['email']);
        if (!empty($data['customer'])) {
            return response()->json($data['customer'], Response::HTTP_ACCEPTED);
        }
        
        return response()->json([
            'message' => 'The given data is invalid',
            'error' => ['No customer found']
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
