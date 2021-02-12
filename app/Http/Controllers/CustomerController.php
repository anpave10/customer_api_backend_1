<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Customer::all();

        return $response;
    }
    /**
     *
     * @param  \Illuminate\Http\Request  $file
     * @return \Illuminate\Http\Response
     */
    private function uploadFile($file)
    {
        $fileName = time().".".$file->getClientOriginalExtension();
        $file->move(public_path('photos'), $fileName);

        return $fileName;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $input = $request->all();


        if($request->has('photo')){
            $input['photo'] = $this->uploadFile($request->photo);
        }

        Customer::create($input);

        return response()->json([
            'res' => true,
            'message' => 'Customer created successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $input = $request->all();

        if($request->has('photo')){
            $input['photo'] = $this->uploadFile($request->photo);
        }

        $customer->update($input);

        return response()->json([
            'res' => true,
            'message' => 'Customer updated successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);

        return response()->json([
            'res' => true,
            'message' => 'Customer deleted successfully'
        ], Response::HTTP_OK);
    }
}
