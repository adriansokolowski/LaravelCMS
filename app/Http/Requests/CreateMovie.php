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
            'user_id' => ['integer'],
            'description' => 'required',
            'poster' => ['required'], ['url'],
            'categories' => 'exists:categories,id',
            'release_date' => ['required'],
            'fdb' => ['required', 'integer'],
            'imdb_rate' => ['nullable', 'numeric'],
            'view' => ['nullable', 'integer']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'description' => $this->description ?? 'Ten film nie ma jeszcze zarysu fabuły.',
            'imdb_rate' => $this->imdb_rate ?? 0,
            'view' => $this->view ?? 0
        ]);
    }
}
