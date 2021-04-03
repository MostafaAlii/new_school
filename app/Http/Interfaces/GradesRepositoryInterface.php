<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;
interface GradesRepositoryInterface{
    public function GetAllGrade();
    public function StoreNewGrade(Request $request);
    public function UpdateGrade(Request $request);
    public function DestroyGrade(Request $request);
}
