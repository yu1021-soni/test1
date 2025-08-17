<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $q, array $filters): Builder
    {
        // 名前 メール
        if (!empty($filters['keyword'])) {
            $kw = trim($filters['keyword']);
            $q->where(function ($qq) use ($kw) {
                $qq->where('last_name',  'like', "%{$kw}%")
                    ->orWhere('first_name','like', "%{$kw}%")
                    ->orWhere('email',     'like', "%{$kw}%");
            });
        }

        // 性別
        if (!empty($filters['gender'])) {
            $q->where('gender', $filters['gender']);
        }

        // お問い合わせの種類
        if (!empty($filters['content'])) {
            $q->whereHas('category', function ($qq) use ($filters) {
                $qq->where('content', $filters['content']);
            });
        }

        // 日付
        if (!empty($filters['date'])) {
            $q->whereDate('created_at', $filters['date']);
        }

        return $q;
    }

        // フルネームアクセサ（$contact->full_name で使える）
        public function getFullNameAttribute(): string {
        return trim(($this->last_name ?? '') . ' ' . ($this->first_name ?? ''));
        }

        //CSV のヘッダ行（見出し）をモデルが教える
        public static function csvHeader(): array {
        return ['ID', 'お名前', '性別', 'メールアドレス', 'お問い合わせの種類', '作成日'];
        }

        // 1件分のデータをCSVにする
        public function toCsvRow(): array {
        $genderLabel = $this->gender == 1 ? '男性' : ($this->gender == 2 ? '女性' : 'その他');
        return [
        $this->id,
        $this->full_name,   //アクセサ
        $genderLabel,
        $this->email,
        $this->category->content ?? '',
        optional($this->created_at)->format('Y-m-d H:i:s'),
        ];
        }
}
