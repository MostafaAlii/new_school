<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class SectionsRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Name_Section_Ar' => 'required',
            'Name_Section_En' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Name_Section_Ar.required' => trans('sections.required_ar'),
            'Name_Section_En.required' => trans('sections.required_en'),
            'Grade_id.required' => trans('sections.Grade_id_required'),
            'Class_id.required' => trans('sections.Class_id_required'),
        ];
    }
}
