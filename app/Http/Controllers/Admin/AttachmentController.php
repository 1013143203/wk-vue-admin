<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AttachmentController extends Base
{
    public function load()
    {
        return success(config("attachment"));
    }
    public function update(Request $request)
    {
        $input = $request->only(['ali', 'storage']);
//        var_dump($input);die;
        modifyConfig('attachment',$input);
        return success();
    }
}
