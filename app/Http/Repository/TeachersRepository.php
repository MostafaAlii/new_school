<?php
namespace App\Http\Repository;
use App\Http\Interfaces\TeachersRepositoryInterface;
use App\Models\Teacher;
use App\Models\Specialization;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TeachersRepository implements TeachersRepositoryInterface {
    protected $Teacher, $Specialization, $Gender;
    public function __construct(Teacher $Teacher, Specialization $Specialization, Gender $Gender) {
        $this->Teacher = $Teacher;
        $this->Specialization = $Specialization;
        $this->Gender = $Gender;
    }
    public function GetAllTeachers(){
        return $this->Teacher->all();
    }

    public function GetAllSpecializations(){
        return $this->Specialization->all();
    }

    public function GetAllGenders(){
        return $this->Gender->all();
    }

    public function TeacherStore(){
        try {
            DB::beginTransaction();

            DB::commit();
            toastr()->success(trans('general.success_store_message'));
        } catch (\Exception $e){
            DB::rollBack();
            toastr()->error(trans('general.error_store_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
    public function TeacherUpdate(){}
    public function TeacherDelete(){}
    public function TeacherMultiDelete(){}

    public function TeacherExcelExport(){}
}
