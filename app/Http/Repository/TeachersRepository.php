<?php
namespace App\Http\Repository;
use App\Http\Interfaces\TeachersRepositoryInterface;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TeachersRepository implements TeachersRepositoryInterface {
    protected $Teacher;
    public function __construct(Teacher $Teacher) {
        $this->Teacher = $Teacher;
    }
}
