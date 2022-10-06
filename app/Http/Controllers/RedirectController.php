<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $hash)
    {
        $url = Cache::get($hash, function () use ($hash) {
            $url = Url::where('hash', $hash)->first();
            if (is_null($url)) {
                abort(404);
            }

            return $url->url;
        });

        return redirect($url);
    }
}
