<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ClassroomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'List_Classes.*.Name'                  =>  'required',
            'List_Classes.*.Name_class_en'         =>  'required',
            //'attachment'                           =>  'required|mimes:xlsx,xls',
        ];
    }

    public function messages()
    {
        return [
            'List_Classes.*.Name.required'                      =>             trans('classes.class_name_required'),
            'List_Classes.*.Name_class_en.required'             =>             trans('classes.other_class_name_lang_required'),
            'attachment.requried'                               =>              trans('general.attachment_required'),
            'attachment.mimes'                                  =>              trans('general.attachment_mimes'),
        ];
    }
}
