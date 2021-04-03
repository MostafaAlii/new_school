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
        return Grade::with(['Sections'])->get();
    }

    public function GetClassroomsByGrade($id){
        return Classroom::where("Grade_id", $id)->pluck("Class_Name", "id");
    }

    public function StoreNewSection(Request $request){
        try{
            DB::beginTransaction();
            // Store Statement
            $Sections = new Section();
            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;
            $Sections->Status = 1;
            $Sections->save();
            DB::commit();
            toastr()->success(trans('general.success_store_message'));
        } catch(\Exception $ex){
            DB::rollback();
            toastr()->error(trans('general.error_store_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function UpdateSectionInfo(Request $request){
        try {
            DB::beginTransaction();
            // Update Statement
            
            $Sections = Section::findOrFail($request->id);

            $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $Sections->Grade_id = $request->Grade_id;
            $Sections->Class_id = $request->Class_id;

            if(isset($request->Status)) {
                $Sections->Status = 1;
            } else {
                $Sections->Status = 2;
            }

            $Sections->save();
            DB::commit();
            toastr()->success(trans('general.success_update_message'));
        } catch (\Exception $ex) {
            DB::rollback();
            toastr()->error(trans('general.error_update_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function DeleteSection(Request $request){
        $Sections = $this->Section->findOrFail($request->id);
        try {
            DB::beginTransaction();
            $Sections->delete();
            DB::commit();
            toastr()->warning(trans('sections.success_delete_message'));
        }catch (\Exception $ex){
            DB::rollback();
            toastr()->error(trans('general.error_store_message'));
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
}