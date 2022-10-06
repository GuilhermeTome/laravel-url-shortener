<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HashGenerator
{
    /**
     * generate a random alphanumerical hash that
     * not exists in database
     * 
     * @param integer $lenght
     * @return string
     */
    public static function generate(int $lenght = 8): string
    {
        /** @var string */
        $hash = Str::random($lenght);

        $validator = Validator::make(['hash' => $hash], ['hash' => 'unique:urls,hash']);
        if ($validator->fails()) {
            return self::generate($lenght);
        }

        return $hash;
    }
}
