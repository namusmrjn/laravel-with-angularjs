<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Quote; // the Quote model
use App\Http\Requests\IndexQuoteGetRequest; // Request to perform validation
use App\Http\Requests\StoreQuotePostRequest; // Request to perform validation
use Illuminate\Validation\Validator;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(IndexQuoteGetRequest $req)
    {
        if (!$req->has('sp')) { // skip
            $sp = 0;
        } else {
            $sp = intval($req->input('sp'));
        }

        // fetch the quotes using Quote model
        // see, no SQL
        $response = [
            'sp' => $sp+10,
            'quotes' => Quote::orderBy('created_at', 'desc')->skip($sp)->take(10)->get()
        ];

        if (count($response['quotes']) > 0) {
            return response()->json($response, 200); // return the quotes
        } else {
            return response()->json($response, 404); // return nothing if there is no more quote available
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StoreQuotePostRequest $req)
    {
        // passing as assoc array to Quote model to insert a record
        $quote = Quote::create($req->only('quote', 'author', 'image'));

        return response()->json($quote, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // fetch one particular record by id 
        $quote = Quote::findOrFail($id);
        return response()->json($quote, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
