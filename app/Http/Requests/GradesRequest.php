<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class GradesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
