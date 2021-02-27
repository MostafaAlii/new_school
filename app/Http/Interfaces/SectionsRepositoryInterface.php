<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;
interface SectionsRepositoryInterface{
    public function GetSectionsWithGrades();
    public function GetClassroomsByGrade($id);
    public function StoreNewSection(Request $request);
    public function UpdateSectionInfo(Request $request);
}