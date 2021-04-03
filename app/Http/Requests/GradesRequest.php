<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class GradesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Name'          =>      'required|unique:grades,name->ar,' . $this->id,
            'Name_en'       =>      'required|unique:grades,name->en,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'Name.required'                     =>          trans('grades.gradeName_ar_required'),
            'Name.unique'                       =>          trans('grades.gradeName_ar_unique'),
            'Name_en.required'                  =>          trans('grades.gradeName_en_required'),
            'Name_en.unique'                    =>          trans('grades.gradeName_en_unique'),
        ];
    }
}
