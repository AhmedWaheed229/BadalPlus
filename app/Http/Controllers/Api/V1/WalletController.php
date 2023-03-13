<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function wallet()
    {
        $record = User::with('soldPosts', 'boughtPosts',)->findOrFail(auth()->user()->id);
        // $balance = $this->model->scopeSelectAttribute(['balance'])->findOrFail(auth()->user()->id);
        return response()->json(['data'=>['balance'=>$record->balance,'soldPosts'=>$record->soldPosts,'boughtPosts'=>$record->boughtPosts]]);
    }
}
