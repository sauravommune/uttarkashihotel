<?php

namespace App\Repositories;

use App\Models\Bank;
use Illuminate\Http\Request;


class BankRepository extends BaseRepository
{
    public $id = null;
    public function __construct(private Bank $Banks){
        $id =request('id');
        $this->Banks = request('id') ? Bank::find($id) : new Bank();
    }
    public function saveBank(Request $request)
    {

        $request->validate([
            'code' => 'required|string|max:255|unique:banks,code,'.$request->id,
            
        ]);
        $this->Banks->name = $request->name;
        $this->Banks->code = $request->code;
        return $this->Banks->save();
    }

    public function removeBank()
    {
        return $this->Banks->delete();
    }
    public function getBank()
    {
        return $this->Banks;
    }
}
