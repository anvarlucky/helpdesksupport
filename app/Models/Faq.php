<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Faq extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public const STORAGE_URL = '/faq/file';

    public static function uploadFile($uploadFile){
        $filename = time().$uploadFile->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            self::STORAGE_URL,
            $uploadFile,
            $filename
        );
        return $filename;
    }

    public static function boot()
    {
        parent::boot();
        self::saving(function ($model) {
            $model->title = json_encode($model->title);
            $model->text = json_encode($model->text);
        });
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
