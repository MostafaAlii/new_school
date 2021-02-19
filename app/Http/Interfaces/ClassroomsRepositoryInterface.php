<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;
interface ClassroomsRepositoryInterface
{
    public function GetAllClassrooms();
    public function StoreNewClass(Request $request);
    public function UpdateClass(Request $request);
    public function DeleteClass(Request $request);
    public function DeleteAllClasses(Request $request);
    public function Classes_Filter(Request $request);
    
}
