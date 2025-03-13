<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
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
     * Define a relationship with NewsItem.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function newsItems()
    {
        return $this->hasMany(News::class);
    }

    public function selectedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_selection_categories');
    }

    public function countriesCategoriesNews()
    {
        return $this->hasMany(CountriesCategoriesNews::class, 'category_id', 'id');
    }
}
