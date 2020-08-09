<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovie extends FormRequest
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
            'title' => ['required', 'between:3,255'],
            'description' => 'required',
            'poster' => 'required',
            'categories' => 'exists:categories,id',
            'year' => ['required', 'integer'],
            'fdb' => ['required', 'integer'],
            'rate' => ['nullable', 'numeric'],
            'view' => ['nullable', 'integer']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'description' => $this->description ?? 'Ten film nie ma jeszcze zarysu fabuły.',
            'rate' => $this->rate ?? 0,
            'view' => $this->view ?? 0
        ]);
    }
}
