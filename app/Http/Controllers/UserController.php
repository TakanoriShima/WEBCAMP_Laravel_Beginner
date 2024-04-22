<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel;
use App\Http\Requests\UserRegisterPost;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
    
        return view('user.register');
    }
    
 
    public function register(UserRegisterPost $request){
        // validate済

        // データの取得
        $datum = $request->validated();
        // パスワードのハッシュ化
        $datum['password'] = Hash::make($datum['password']);
        
        // テーブルへのINSERT
        try {
            $r = UserModel::create($datum);
        } catch(\Throwable $e) {
            // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
            echo $e->getMessage();
            exit;
        }

        // タスク登録成功
        $request->session()->flash('front.user_register_success', true);

        // リダイレクト
        return redirect('/');
        
    }

}
