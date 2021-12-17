<?php

namespace App\Http\Requests;

use App\Validation\Rules\Str;
use Illuminate\Foundation\Http\FormRequest;

class GiveRatingRequest extends FormRequest
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
            'movie_title' => ['bail', 'required', 'exists:movies,title'],
            'username'    => Str::default(),
            'rating'      => ['bail', 'required', 'integer', 'max:10'],
            'description' => Str::default()
        ];
    }

    /**
     * Not required in real world case. 
     * Required here because input from outside is different than what is accepted 
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'description'   => $this->r_description,
        ]);

        $this->offsetUnset('r_description');
    }
}
