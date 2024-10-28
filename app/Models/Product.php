<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'recommend_flag',
        'carriage_flag',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function average_score()
    {
        // スコアの平均を取得し、小数点以下1桁に四捨五入して返す
        $averageScore = $this->reviews()->avg('score');
        return round($averageScore, 1);
    }

    public function favorited_users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
