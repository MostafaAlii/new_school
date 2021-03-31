<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Specialization;
use App\Models\Gender;
use Spatie\Translatable\HasTranslations;
class Teacher extends Model {
    use HasTranslations;
    protected $table = 'teachers';
    public $translatable = ['Name'];
    protected $guarded = [];
    public $timestamps = true;
}
