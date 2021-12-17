<?php

namespace App\Http\Requests;

use App\Actions\CreateNewMovie;
use App\Validation\Rules\Genre;
use App\Validation\Rules\Performer;
use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
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
        info($this->all());
        return [
            ...CreateNewMovie::validationRules(),
            'genres'          => Genre::list(),
            'genres.*'        => Genre::default(),
            'performers'      => Performer::list(),
            'performers.*'    => Performer::name(),
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
            'genres'        => $this->genre,
            'performers'    => $this->performer,
            'releaseDate'   => $this->release,
            'duration'      => 0,
        ]);

        $this->offsetUnset('genre');
        $this->offsetUnset('performer');
        $this->offsetUnset('release');
    }
}
