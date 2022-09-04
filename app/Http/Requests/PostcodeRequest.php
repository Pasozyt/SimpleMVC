<?php

namespace Http\Requests;

use Http\Requests\Request;
use Http\Requests\ValidationRulesTraits\PostcodeValidationRule;
use Http\Requests\ValidationRulesTraits\RequiredValidationRule;

class PostcodeRequest extends Request
{
    use RequiredValidationRule;
    use PostcodeValidationRule;
    
    protected $rules = [
        'postcode_postcode' => ['required', 'Postcode']
    ];
}