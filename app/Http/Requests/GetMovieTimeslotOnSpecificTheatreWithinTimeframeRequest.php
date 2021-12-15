<?php

namespace App\Http\Requests;

use App\Validation\Rules\DateTime;
use App\Validation\Rules\Str;
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
            'theatre_name' => Str::default(),
            'time_start'   => DateTime::default(),
            'time_end'     => DateTime::afterOrEqual('time_start'),
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
