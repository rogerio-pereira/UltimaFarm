<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivateController extends Controller
{
    public function activateInactivate(Request $request)
    {
        $data = $request->all();
        $model = '\\App\\Models\\'.$data['model'];
        $id = $data['id'];

        try {
            $item = call_user_func($model.'::find', $id);
            $item->active = !$item->active;
            $item->save();
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
