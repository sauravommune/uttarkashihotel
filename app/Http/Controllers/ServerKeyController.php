<?php

namespace App\Http\Controllers;

use App\Models\ServerKey;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServerKeyController extends Controller
{
    public function serverKey()
    {
        addVendors(['serverKey', 'select2', 'jquery-validate']);
        $data = ServerKey::with('GetSource', 'GetUser')->latest()->get();
        $sources = Source::all();
        return view('accountSetting.serverKey')->with(compact('data', 'sources'));
    }


    /**
     * Insert a new KEy
     */
    public function serverKeyStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'status' => 'required|string|max:200',
            'key' => 'required|string|max:200',
            'source' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors(), 'msg' => array_values($validator->errors()->toArray())[0][0]], 422);
        }

        $master = new ServerKey();
        $master->name = $request->name;
        $master->status = $request->status;
        $master->source = $request->source;
        $master->key = $request->key;
        $master->created_by = auth()->user()->id;
        $master->save();

        return response()->json(['status' => '200', 'message' => 'Server Key Generated', 'redirect' => route('serverkey.index')]);
    }


    public function delete($id)
    {
        ServerKey::find($id)->delete();
        return response()->json(['status' => '200', 'message' => 'Server Key is deleted successfully']);
    }
}
