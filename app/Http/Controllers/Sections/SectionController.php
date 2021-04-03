<?php
namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\SectionsRepositoryInterface;
use App\Http\Interfaces\GradesRepositoryInterface;
use App\Http\Interfaces\TeachersRepositoryInterface;
use App\Http\Requests\SectionsRequest;
use Illuminate\Http\Request;
class SectionController extends Controller{
    protected $SectionsInterface, $GradesInterface, $TeacherInterface;
    public function __construct(SectionsRepositoryInterface $SectionsInterface, GradesRepositoryInterface $GradesInterface, TeachersRepositoryInterface $TeacherInterface){
        $this->SectionsInterface = $SectionsInterface;
        $this->GradesInterface   = $GradesInterface;
        $this->TeacherInterface = $TeacherInterface;
    }

    public function index(){
        $Grades = $this->SectionsInterface->GetSectionsWithGrades();
        $list_Grades = $this->GradesInterface->GetAllGrade();
        $Teachers_List = $this->TeacherInterface->GetAllTeachers();
        return view('pages.Sections.Sections', compact('Grades', 'list_Grades', 'Teachers_List'));
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