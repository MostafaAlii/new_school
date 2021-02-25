<?php
namespace App\Http\Repository;
use App\Http\Interfaces\SectionsRepositoryInterface;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SectionsRepository implements SectionsRepositoryInterface
{
    protected $Section;
    public function __construct(Section $Section) {
        $this->Section = $Section;
    }

    public function GetSectionsWithGrades(){
        return Grade::with(['Sections'])->get();;
    }
}