<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Teacher extends Model {
    use HasTranslations;
    protected $table = 'teachers';
    public $translatable = ['Name'];
    protected $guarded = [];
    public $timestamps = true;
    // علاقة بين المعلمين والتخصصات لجلب اسم التخصص
    public function specializations()
    {
        return $this->belongsTo('App\Models\Specialization', 'Specialization_id');
    }

    // علاقة بين المعلمين والانواع لجلب جنس المعلم
    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'Gender_id');
    }

    // عﻻقة المعلمين مع اﻻقسام
    public function Sections()
    {
        return $this->belongsToMany('App\Models\Section', 'teacher_section');
    }
}
