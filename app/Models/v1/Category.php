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

    public static function getAllByProject(){
        $projectCategory = Category::select('categories.name->uz as name_uz','projects.name as project_name','categories.id')
            ->join('projects','categories.project_id','=','projects.id')
            ->get();
        return $projectCategory;
    }

    public static function getProjectByID($id){
        $projectCategorySingle = Category::select('categories.name->uz as name_uz','projects.name as project_name','categories.id','categories.name','categories.project_id')
            ->leftJoin('projects','categories.project_id','=','projects.id')
            ->findOrFail($id);
        return $projectCategorySingle;
    }
}
