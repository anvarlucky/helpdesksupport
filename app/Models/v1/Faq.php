<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Faq extends Model
{
    protected $guarded = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public const STORAGE_URL = 'public/faq/file';

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
        return $this->belongsTo('App\Models\v1\Project');
    }

    public static function projectsFaq(){
        $faq = Faq::select('faqs.title->uz as title_uz','faqs.id', 'projects.name as project_name')
            ->leftJoin('projects','faqs.project_id','=','projects.id')
            ->get();
        return $faq;
    }

    public static function projectFaq($id){
        $faq = Faq::select('faqs.title->uz as title_uz','faqs.id','faqs.text->uz as text_uz','faqs.file','projects.name as project_name')
            ->where('faqs.id',$id)
            ->leftJoin('projects','faqs.project_id','=','projects.id')
            ->first();
        return $faq;
    }
}
