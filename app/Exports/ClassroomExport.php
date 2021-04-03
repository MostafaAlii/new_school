<?php
namespace App\Exports;
use App\Models\Classroom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ClassroomExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        $Classroom = Classroom::orderBy('id', 'desc')->get();
        return $Classroom;
    }

    public function map($Classroom): array
    {
        return [
            $Classroom->Class_Name,
            $Classroom->Grade->Name,
            $Classroom->created_at->toDateString(),
        ];
    }

    public function headings(): array
    {
        return [
            trans('classes.class_name'),
            trans('classes.class_grade_name'),
            trans('classes.Date'),
        ];
    }
}
