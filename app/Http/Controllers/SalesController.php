<?php

namespace App\Http\Controllers;

use App\Models\Sales;

class SalesController extends Controller
{
    public function index()
    {
        return view('upload-file');
    }

    public function upload()
    {
        if (request()->has('mycsv')) {
            // $data   =  array_map('str_getcsv', file(request()->mycsv));
            $data   =   file(request()->mycsv);
            // $header = $data[0];
            // unset($data[0]);

            // Chunking file
            $chunks = array_chunk($data, 1000);
            //  convert 1000 records into a new csv file
            foreach ($chunks as $key => $chunk) {
                $name = "/tmp{$key}.csv";
                $path = resource_path('temp');
                file_put_contents($path . $name, $chunk);
            }

            // foreach ($data as $value) {
            //     $saleData = array_combine($header, $value);
            //     Sales::create($saleData);
            // }

            return 'Done';
        }

        return 'please upload file';
    }

    public function store()
    {
        $path  = resource_path('temp');
        $files = glob("$path/*.csv");

        $header = [];
        foreach ($files as $key => $file) {
            $data = array_map('str_getcsv', file($file));
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }

            foreach ($data as $sale) {
                $saleData = array_combine($header, $sale);
                Sales::create($saleData);
            }
        }

        return 'stored';
    }
}
