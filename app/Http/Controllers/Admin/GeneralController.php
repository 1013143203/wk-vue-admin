<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class GeneralController extends Base
{
    public function code(Request $request)
    {
        $name = request('name');
        $action = request('action');
        $dirs = request('dirs');
        Artisan::command('help', function ($project) {
            var_dump($project);die;
        });
    }
}
