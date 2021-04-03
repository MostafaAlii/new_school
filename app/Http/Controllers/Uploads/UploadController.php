<?php
namespace App\Http\Controllers\Uploads;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\UploadsRepositoryInterface;
use Illuminate\Http\Request;
class UploadController extends Controller
{
    protected $UploadsInterface;
    public function __construct(UploadsRepositoryInterface $UploadsInterface){
        $this->UploadsInterface = $UploadsInterface;
    }
}
