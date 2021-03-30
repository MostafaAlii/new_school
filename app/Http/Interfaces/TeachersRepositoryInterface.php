<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;
interface TeachersRepositoryInterface {
    public function GetAllTeachers();
    public function GetAllSpecializations();
    public function GetAllGenders();
}
