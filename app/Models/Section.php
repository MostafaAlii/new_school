<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Section extends Model
{
    use HasTranslations;
    protected $table = 'sections';
    public $timestamps = true;
    

}