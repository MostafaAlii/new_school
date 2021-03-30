<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Teacher extends Model
{
    use HasTranslations;
    protected $table = 'teachers';
    public $timestamps = true;
}
