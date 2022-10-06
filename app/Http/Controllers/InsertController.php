<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertRequest;
use App\Models\Url;
use App\Services\HashGenerator;
use Illuminate\Http\Request;

class InsertController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(InsertRequest $request)
    {
        $url = Url::where('url', $request->url)->firstOr(function () use ($request) {
            $hash = HashGenerator::generate();

            return Url::create([
                'url'  => $request->url,
                'hash' => $hash,
            ]);
        });

        return response()->json([
            'status' => 'success',
            'hash'   => $url->hash
        ]);
    }
}
