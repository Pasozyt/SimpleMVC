<?php

namespace Http\Requests;

use Http\Requests\ValidationRulesTraits\RequiredValidationRule;

class CityRequest extends Request
{
    use RequiredValidationRule;
    
    protected $rules = [
        'city_name' => 'required'
    ];
}