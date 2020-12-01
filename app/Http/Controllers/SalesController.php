<?php

namespace App\Http\Controllers;

use App\Jobs\SalesCsvProcess;

class SalesController extends Controller
{
    public function index()
    {
        return view('upload-file');
    }

    public function upload()
    {
        if (request()->has('mycsv')) {
            $data   =   file(request()->mycsv);
            // Chunking file
            $chunks = array_chunk($data, 1000);

            $header = [];
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);

                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }

                if ($key == 2) {
                    $header = [];
                }

                SalesCsvProcess::dispatch($data, $header);
            }

            return 'stored';
        }

        return 'please upload file';
    }
}
