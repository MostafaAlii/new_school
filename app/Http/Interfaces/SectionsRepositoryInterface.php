<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;
interface SectionsRepositoryInterface{
    public function GetSectionsWithGrades();
}