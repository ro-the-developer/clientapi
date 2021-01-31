<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Http\Response;
use App\Http\Resources\ClientResource;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientSearchByNameRequest;
use App\Http\Requests\ClientSearchByPhoneRequest;
use App\Http\Requests\ClientSearchByEmailRequest;

class ClientController extends Controller
{
    const PAGINATION_LIMIT = 10;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        $client = new Client();
        $client->store($request);
        $response = ['id' => $client->id];
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClientResource(Client::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientStoreRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->overwrite($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
    }

    /**
     * Search by name.
     *
     * @param  ClientSearchByNameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function searchByName(ClientSearchByNameRequest $request)
    {
        $results = Client::where('firstname', $request->firstname)
            ->where('lastname', $request->lastname)
            ->paginate(self::PAGINATION_LIMIT);
        return ClientResource::collection($results);
    }

    /**
     * Search by phone.
     *
     * @param  ClientSearchByPhoneRequest $request
     * @return \Illuminate\Http\Response
     */
    public function searchByPhone(ClientSearchByPhoneRequest $request)
    {
        $results = Client::whereHas('phones', function($query) use ($request){
            $query->whereIn('phone', $request->phones);
        })->paginate(self::PAGINATION_LIMIT);
        return ClientResource::collection($results);
    }

    /**
     * Search by email.
     *
     * @param  ClientSearchByEmailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function searchByEmail(ClientSearchByEmailRequest $request)
    {
        $results = Client::whereHas('emails', function($query) use ($request){
            $query->whereIn('email', $request->emails);
        })->paginate(self::PAGINATION_LIMIT);
        return ClientResource::collection($results);
    }

    /**
     * Search by all parameters.
     *
     * @param  ClientSearchByEmailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function searchByAll(ClientStoreRequest $request)
    {
        $results = Client::where('firstname', $request->firstname)
            ->where('lastname', $request->lastname)
            ->whereHas('emails', function($query) use ($request){
                $query->whereIn('email', $request->emails);
            })
            ->whereHas('phones', function($query) use ($request){
                $query->whereIn('phone', $request->phones);
            })
            ->paginate(self::PAGINATION_LIMIT);
        return ClientResource::collection($results);
    }
}
