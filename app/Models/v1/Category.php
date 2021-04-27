<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            $model->name = json_encode($model->name);
        });
    }

    public function project()
    {
        return $this->belongsTo('App\Models\v1\Project');
    }
}
