<?php

namespace App\Http\Requests;

use App\Validation\Rules\Performer;
use Illuminate\Foundation\Http\FormRequest;

class GetMovieBySpecificPerformer extends FormRequest
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
            'performer_name' => Performer::name()
        ];
    }
}
