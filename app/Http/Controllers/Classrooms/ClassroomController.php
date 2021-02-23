<?php
namespace App\Http\Controllers\Classrooms;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\ClassroomsRepositoryInterface;
use App\Http\Interfaces\GradesRepositoryInterface;
use App\Http\Requests\ClassroomRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassroomExport;
use Illuminate\Http\Request;
class ClassroomController extends Controller
{
    protected $ClassroomsInterface, $GradesInterface;
    public function __construct(ClassroomsRepositoryInterface $ClassroomsInterface, GradesRepositoryInterface $GradesInterface){
        $this->ClassroomsInterface = $ClassroomsInterface;
        $this->GradesInterface     =   $GradesInterface;
    }

    public function index(){
        $Classrooms = $this->ClassroomsInterface->GetAllClassrooms();
        $Grades = $this->GradesInterface->GetAllGrade();
        return view('pages.Classrooms.Classrooms', compact('Classrooms', 'Grades'));
    }

    public function store(ClassroomRequest $request) {
        $StoreNewClass = $this->ClassroomsInterface->StoreNewClass($request);
        return redirect()->route('Classrooms.index');
    }

    public function update(ClassroomRequest $request){
        $UpdateClass = $this->ClassroomsInterface->UpdateClass($request);
        return redirect()->route('Classrooms.index');
    }

    public function destroy(Request $request){
        $DeleteClass = $this->ClassroomsInterface->DeleteClass($request);
        return redirect()->route('Classrooms.index');
    }

    public function destroyAll(Request $request){
        $DeleteAllClass = $this->ClassroomsInterface->DeleteAllClasses($request);
        return redirect()->route('Classrooms.index');
    }

    public function classesFilter(Request $request){
        $Grades = $this->GradesInterface->GetAllGrade();
        $Search = $this->ClassroomsInterface->Classes_Filter($request);
        return view('pages.Classrooms.Classrooms',compact('Grades'))->withDetails($Search);
    }

    public function excelExport(Request $request){
        return Excel::download(new ClassroomExport(), 'Classrooms-' .date('Y-m-d'). '.xlsx');
    }

    public function excelUpload(Request $request){
        # code...
    }

    public function excelImport(ClassroomRequest $request){
        # code...
    }
}

?>
