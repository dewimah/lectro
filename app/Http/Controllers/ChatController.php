<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Chat;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $user_id = Auth()->user()->id;
        $tanggal = Carbon::now()->format('Y-m-d');
        $jam = Carbon::now()->format('H-i:s');

        $chat = Chat::create([
            "user_id" => $user_id,
            "tanggal" => $tanggal,
            "jam" => $jam,
            "message" => $request->message,
        ]);
        return $chat;
    }

    public function all()
    {
        // $data = Chat::all();
        // return ResponseFormatter::success($data);

        return DB::table('users')
        ->join('chat', 'chat.user_id', '=', 'users.id')
        ->select ('users.name', 'chat.user_id', 'chat.tanggal', 'chat.jam', 'chat.message')
        ->get();
    }
}
