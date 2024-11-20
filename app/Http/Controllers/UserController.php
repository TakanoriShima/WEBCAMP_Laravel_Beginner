<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegisterPost;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('user.register');
    }

    public function register(UserRegisterPost $request){
        // validate済みのデータの取得
        $datum = $request->validated();
        // テーブルへのINSERT
        try {
            $datum['password'] = Hash::make($datum['password']);
            $user = User::create($datum);
        } catch(\Throwable $e) {
            // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
            echo $e->getMessage();
            exit;
        }

        // ユーザー登録成功
        $request->session()->flash('front.user_register_success', true);

        // リダイレクト
        return redirect('/');

    }
}
