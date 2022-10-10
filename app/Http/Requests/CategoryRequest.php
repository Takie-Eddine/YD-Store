<?php

namespace App\Http\Requests;

use App\Rules\Filter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('category');
        return [

            'name' => ['required',
                'string',
                'min:3',
                'max:255',
                //'unique:categories,name,'.$id,
                Rule::unique('categories','name')->ignore($id),
                // function($attribute,$value,$fails){
                //     if (strtolower($value) == 'laravel') {
                //         $fails('This name is forbiden!');
                //     }
                // },
                //'filter:php,laravel,html'
                new Filter(['laravel','php','html']),
            ],
            'parent_id' => [
                'nullable' , 'int' , 'exists:categories,id'
            ],
            'image' => [
                'image' , 'max:2000000' , 'dimensions:min_width=100,min_height=100',
            ],
            'status' => 'in:active,archived'
        ];
    }
}
