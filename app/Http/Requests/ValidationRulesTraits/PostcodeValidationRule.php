<?php
namespace Http\Requests\ValidationRulesTraits;

trait PostcodeValidationRule
{
    public function PostcodeValidationRule(?string $value, ?string $name): array
    {

        if(is_numeric($value) && $value > 0 && preg_match('/^([0-9]{2})(-[0-9]{3})?$/i',$value)) {
            return [];
        }
        return [
            __('validation.Postcode', [
                'attribute' => __('fields.'.$name)
            ])
            ];
    }
}