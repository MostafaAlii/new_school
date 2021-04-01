<?php
namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\TeachersRepositoryInterface;
use App\Http\Requests\TeachersRequest;
use Illuminate\Http\Request;
class TeacherController extends Controller{
    protected $TeachersInterface;
    public function __construct(TeachersRepositoryInterface $TeachersInterface){
        $this->TeachersInterface = $TeachersInterface;
    }

    public function index(){
        $Teachers = $this->TeachersInterface->GetAllTeachers();
        return view('pages.Teachers.Teachers', compact('Teachers'));
    }

    public function create() {
        $specializations = $this->TeachersInterface->GetAllSpecializations();
        $genders         = $this->TeachersInterface->GetAllGenders();
        return view('pages.Teachers.create', compact('specializations', 'genders'));
    }

    public function store(TeachersRequest $request) {
        $StoreNewTeacher = $this->TeachersInterface->TeacherStore($request);
        return redirect()->route('Teachers.index');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        //
    }

    public function update(TeachersRequest $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
