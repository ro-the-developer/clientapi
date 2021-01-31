<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
    ];
    public function phones()
    {
        return $this->hasMany(ClientPhone::class);
    }
    public function emails()
    {
        return $this->hasMany(ClientEmail::class);
    }
    public function store($request)
    {
        DB::transaction(function() use ($request)
        {
            $this->firstname = $request->firstname;
            $this->lastname = $request->lastname;
            $this->save();

            foreach($request->phones as $row) {
                $phone = new ClientPhone();
                $phone->phone = $row;
                $this->phones()->save($phone);
            }
            foreach($request->emails as $row) {
                $email = new ClientEmail();
                $email->email = $row;
                $this->emails()->save($email);
            }
        });
    }
    public function overwrite($request)
    {
        DB::transaction(function() use ($request)
        {
            $this->phones()->delete();
            $this->emails()->delete();

            $this->firstname = $request->firstname;
            $this->lastname = $request->lastname;
            $this->save();

            foreach($request->phones as $row) {
                $phone = new ClientPhone();
                $phone->phone = $row;
                $this->phones()->save($phone);
            }
            foreach($request->emails as $row) {
                $email = new ClientEmail();
                $email->email = $row;
                $this->emails()->save($email);
            }
        });
    }
}
