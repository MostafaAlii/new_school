<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['Class_Name'];
    protected $table = 'Classrooms';
    public $timestamps = true;
    protected $fillable = ['Class_Name', 'Grade_id'];

    public function Grade() {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

}
