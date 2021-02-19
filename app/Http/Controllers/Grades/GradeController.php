<?php
namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\GradesRepositoryInterface;
use App\Http\Requests\GradesRequest;
use Illuminate\Http\Request;
class GradeController extends Controller
{
    protected $GradesInterface;
    public function __construct(GradesRepositoryInterface $GradesInterface){
        $this->GradesInterface = $GradesInterface;
    }

    public function index(){
        $Grades = $this->GradesInterface->GetAllGrade();
        return view('pages.Grades.Grades', compact('Grades'));
    }

    public function store(GradesRequest $request){
         $NewGrade = $this->GradesInterface->StoreNewGrade($request);
        return redirect()->route('Grades.index');
    }

    public function update(GradesRequest $request){
      $UpdateGrade = $this->GradesInterface->UpdateGrade($request);
      return redirect()->route('Grades.index');
    }

    public function destroy(Request $request){
        $DestroyGrade = $this->GradesInterface->DestroyGrade($request);
        return redirect()->route('Grades.index');
    }

}
