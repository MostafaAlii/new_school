<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;
interface TeachersRepositoryInterface {
    // Get Operation ::
    public function GetAllTeachers();
    public function GetAllSpecializations();
    public function GetAllGenders();
    // CRUD Operation ::
    public function TeacherStore(Request $request);
    public function TeacherEdit($id);
    public function TeacherUpdate(Request $request);
    public function TeacherDelete();
    public function TeacherMultiDelete();
    // Export Operation ::
    public function TeacherExcelExport();
}
