<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// デバッグ用
use Illuminate\Support\Facades\Log;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'email',
        'url',
        'gender',
        'age',
        'contact',
    ];

    // ??DIコンテナ化してる？
    public function scopeSearch($query, $search)
    {
        if ($search !== null) {
            $search_split = mb_convert_kana($search, 's'); // 全角スペースを半角
            $search_split2 = preg_split('/[\s]+/', $search_split); //空白で区切る

            // ??追加していってる？2回検索してる?
            foreach ($search_split2 as $value) {
                $query->where('name', 'like', '%' . $value . '%');
                // Log::debug("aaa");
                // 配列
                // Log::debug(print_r($query, true));

                // オブジェクト
                // Log::debug(print_r($query, true));
            }
        }
        return $query;
    }
}
