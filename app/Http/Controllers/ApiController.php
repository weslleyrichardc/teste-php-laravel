<?php

namespace App\Http\Controllers;

use App\Http\Resources\HashResource;
use App\Models\Hash;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function index() {
        return HashResource::collection(Hash::paginate(10));
    }

    public function create() {
        $key = Str::random(8);
        $hash = '0000' . md5(request('string') . $key);

        return [
            "hash" => $hash,
            "key" => $key
        ];
    }
}
