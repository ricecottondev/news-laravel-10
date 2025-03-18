<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';
    protected $dates = ['created_at', 'updated_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'short_desc',
        'content',
        'is_breaking_news',
        'author',
        'slug',
        'status',
        'image',
        'views'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Define a relationship with Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function countriesCategories()
    {
        return $this->hasMany(CountriesCategories::class);
    }

    public function countriesCategoriesNews()
    {
        return $this->hasMany(CountriesCategoriesNews::class);
    }

    public function comments()
    {
        return $this->hasMany(NewsComment::class, 'news_id');
    }
}
