<?php

namespace Http\Requests;

use Http\Requests\ValidationRulesTraits\RequiredValidationRule;

class CombinedRequest extends Request
{
    use RequiredValidationRule;
    
    protected $rules = [
        'combined_id_city' => 'required',
        'combined_id_code' => 'required'
    ];
}