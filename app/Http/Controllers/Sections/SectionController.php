<?php
namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\SectionsRepositoryInterface;
use App\Http\Interfaces\GradesRepositoryInterface;
use Illuminate\Http\Request;
class SectionController extends Controller{
    protected $SectionsInterface, $GradesInterface;
    public function __construct(SectionsRepositoryInterface $SectionsInterface, GradesRepositoryInterface $GradesInterface){
        $this->SectionsInterface = $SectionsInterface;
        $this->GradesInterface   = $GradesInterface;
    }

    public function index(){
        $Grades = $this->SectionsInterface->GetSectionsWithGrades();
        $list_Grades = $this->GradesInterface->GetAllGrade();
        return view('pages.Sections.Sections', compact('Grades', 'list_Grades'));
    }
}