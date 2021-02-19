<?php
namespace App\Http\Repository;
use App\Http\Interfaces\GradesRepositoryInterface;
use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class GradesRepository implements GradesRepositoryInterface{

    protected $Grade;
    protected $Classroom;

    public function __construct(Grade $Grades, Classroom $Classroom){
        $this->Grade = $Grades;
        $this->Classroom = $Classroom;
    }

    public function GetAllGrade(){
        return $this->Grade->all();
    }

    public function StoreNewGrade(Request $request){
        try {
            DB::beginTransaction();
            // Store Statement
            $Grade = new Grade();
            $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
            $Grade->Notes = $request->Notes;
            $Grade->save();
            DB::commit();
            toastr()->success(trans('general.success_store_message'));
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error(trans('general.error_store_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function UpdateGrade(Request $request){
        try {
            $Grades = $this->Grade->findOrFail($request->id);
            DB::beginTransaction();
            $Grades->update([
                $Grades->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
                $Grades->Notes = $request->Notes,
            ]);
            DB::commit();
            toastr()->success(trans('general.success_update_message'));
        } catch (\Exception $ex){
            DB::rollback();
            toastr()->error(trans('general.error_store_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function DestroyGrade(Request $request){
        $Classroom_id = $this->Classroom->where('Grade_id',$request->id)->pluck('Grade_id');
        if ($Classroom_id->count() == 0) {
            $Grades = $this->Grade->findOrFail($request->id);
            try {
                DB::beginTransaction();
                $Grades->delete();
                DB::commit();
                toastr()->warning(trans('grades.success_delete_message'));
            }catch (\Exception $ex){
                DB::rollback();
                toastr()->error(trans('general.error_store_message'));
            }    
        }else {
            toastr()->error(trans('general.error_you_have_child_classes'));
            return redirect()->back();
        }
        
    }
}