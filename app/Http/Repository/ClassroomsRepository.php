<?php
namespace App\Http\Repository;
use App\Http\Interfaces\ClassroomsRepositoryInterface;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ClassroomsRepository implements ClassroomsRepositoryInterface
{
    protected $Classroom;
    public function __construct(Classroom $Classroom) {
        $this->Classroom = $Classroom;
    }

    public function GetAllClassrooms(){
        return $this->Classroom->all();
    }

    public function StoreNewClass(Request $request){
        $List_Classes = $request->List_Classes;
        try {
            DB::beginTransaction();
            // Store Statement
            foreach ($List_Classes as $List_Class) {
                $Classroom = new Classroom();
                $Classroom->Class_Name = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];
                $Classroom->Grade_id = $List_Class['Grade_id'];
                $Classroom->save();
            }
            DB::commit();
            toastr()->success(trans('general.success_store_message'));
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error(trans('general.error_store_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function UpdateClass(Request $request){
        try {
            $Classrooms = $this->Classroom->findOrFail($request->id);
            DB::beginTransaction();
            // Update Statement
            $Classrooms->update([
                $Classrooms->Class_Name = ['en' => $request->Name_en, 'ar' => $request->Name],
                $Classrooms->Grade_id = $request->Grade_id,
            ]);
            DB::commit();
            toastr()->success(trans('general.success_update_message'));
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error(trans('general.error_update_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function DeleteClass(Request $request){
        $Classrooms = $this->Classroom->findOrFail($request->id);
        try {
            DB::beginTransaction();
            $Classrooms->delete();
            DB::commit();
            toastr()->warning(trans('grades.success_delete_message'));
        }catch (\Exception $ex){
            DB::rollback();
            toastr()->error(trans('general.error_store_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function DeleteAllClasses(Request $request){
        $delete_all_id = explode(",", $request->delete_all_id);
        try {
            DB::beginTransaction();
            Classroom::whereIn('id', $delete_all_id)->Delete();
            DB::commit();
            toastr()->warning(trans('grades.success_delete_message'));
        }catch (\Exception $ex){
            DB::rollback();
            toastr()->error(trans('general.error_store_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function Classes_Filter(Request $request){
        return $this->Classroom->select('*')->where('Grade_id','=',$request->Grade_id)->get();
    }
}
