<?php

namespace App\Http\Requests;

use App\Validation\Rules\Date;
use App\Validation\Rules\Theatre;
use Illuminate\Foundation\Http\FormRequest;

class GetMovieTimeslotOnSpecificTheatreWithinTimeframeRequest extends FormRequest
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
            'theatre_name' => Theatre::name(),
            'time_start'    => Date::default(),
            'time_end'  => Date::default(),
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
            'theatre_name' => $this->theater_name,
        ]);

        $this->offsetUnset('theater_name');
    }
}
