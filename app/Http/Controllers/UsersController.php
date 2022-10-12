<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User as UserModel;
use App\Http\Requests\UserRegisterPost;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * ユーザー登録画面 を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // // 1Page辺りの表示アイテム数を設定
        // $per_page = 20;

        // // 一覧の取得
        // $list = $this->getListBuilder()
        //              ->paginate($per_page);
        // /*
        // $sql = $this->getListBuilder()
        //             ->toSql();
        // //echo "<pre>\n"; var_dump($sql, $list); exit;
        // var_dump($sql);
        // */
        $user = new UserModel();
        return view('user.register', ['user' => $user]);
    }
    
    /**
     * ユーザー登録
     */
    public function register(UserRegisterPost $request)
    {
        
        // validate済みのデータの取得
        $datum = $request->validated();

        // パスワードのハッシュ化
        $datum['password'] = Hash::make($datum['password']);

        // テーブルへのINSERT
        try {
            $user = UserModel::create($datum);
        } catch(\Throwable $e) {
            // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
            echo $e->getMessage();
            exit;
        }

        // ユーザー登録成功
        $request->session()->flash('user_register_success', true);

        //
        return redirect('/');
    }

}
