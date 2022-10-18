<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Biodata\BiodataResource;
use App\Models\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BiodataResource
     */
    public function index(Request $request)
    {
        return new BiodataResource($request->user()->load('biodata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Biodata $biodata
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->update($request->all());
        $request->user()->biodata()->update($request->all());

        return response()->noContent();
    }
}
