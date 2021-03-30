<?php
namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\TeachersRepositoryInterface;
use App\Http\Requests\TeachersRequest;
use Illuminate\Http\Request;
class TeacherController extends Controller{
    protected $TeachersInterface;
    public function __construct(TeachersRepositoryInterface $TeachersInterface){
        $this->TeachersInterface = $TeachersInterface;
    }
}
