<?php
namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\SectionsRepositoryInterface;
use Illuminate\Http\Request;
class SectionController extends Controller{
    protected $SectionsInterface;
    public function __construct(SectionsRepositoryInterface $SectionsInterface){
        $this->SectionsInterface = $SectionsInterface;
    }

    public function index(){
        $Sections = $this->SectionsInterface->GetAllSections();
        return view('pages.Sections.Sections', compact('Sections'));
    }
}