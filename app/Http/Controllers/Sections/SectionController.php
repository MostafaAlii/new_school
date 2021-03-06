<?php
namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\SectionsRepositoryInterface;
use App\Http\Interfaces\GradesRepositoryInterface;
use App\Http\Interfaces\TeachersRepositoryInterface;
use App\Http\Requests\SectionsRequest;
use Illuminate\Http\Request;
class SectionController extends Controller{
    protected $SectionsInterface, $GradesInterface, $TeachersInterface;
    public function __construct(TeachersRepositoryInterface $TeachersInterface,SectionsRepositoryInterface $SectionsInterface, GradesRepositoryInterface $GradesInterface){
        $this->TeachersInterface = $TeachersInterface;
        $this->SectionsInterface = $SectionsInterface;
        $this->GradesInterface   = $GradesInterface;
    }

    public function index(){
        $teachers   =   $this->TeachersInterface->GetAllTeachers();
        $Grades = $this->SectionsInterface->GetSectionsWithGrades();
        $list_Grades = $this->GradesInterface->GetAllGrade();
        return view('pages.Sections.Sections', compact('teachers', 'Grades', 'list_Grades'));
    }

    public function store(SectionsRequest $request){
        $StoreNewSection = $this->SectionsInterface->StoreNewSection($request);
        return redirect()->route('Sections.index');
    }

    public function update(SectionsRequest $request){
        $UpdateSection = $this->SectionsInterface->UpdateSectionInfo($request);
        return redirect()->route('Sections.index');
    }

    public function destroy(Request $request){
        $DestroySection = $this->SectionsInterface->DeleteSection($request);
        return redirect()->route('Sections.index');
    }

    public function getclasses($id){
        $list_classes = $this->SectionsInterface->GetClassroomsByGrade($id);
        return $list_classes;
    }
}
