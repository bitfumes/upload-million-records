<?php

namespace App\Http\Controllers;

use App\Models\Sales;

class SalesController extends Controller
{
    public function index()
    {
        return view('upload-file');
    }

    public function store()
    {
        if (request()->has('mycsv')) {
            $data   =  array_map('str_getcsv', file(request()->mycsv));
            $header = $data[0];
            unset($data[0]);

            foreach ($data as $value) {
                $saleData = array_combine($header, $value);
                Sales::create($saleData);
            }

            return 'Done';
        }

        return 'please upload file';
    }
}
