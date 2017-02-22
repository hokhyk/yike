<?php

namespace App;

use App\Jobs\ResizeImage;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'creator_id', 'path', 'title', 'size',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($image) {
            dispatch(new ResizeImage($image));
        });
    }

    public function url()
    {
        return asset($this->path);
    }
}
