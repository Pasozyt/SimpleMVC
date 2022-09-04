<?php

namespace Http\Requests\ValidationRulesTraits;

trait RequiredValidationRule
{
    public function requiredValidationRule(?string $value, ?string $name): array {
        if ($value !== null && \strlen($value) > 0) {
            return [];
        }
        return [
            __('validation.required', [
                'attribute' => __('fileds.' . $name)
            ])
        ];
    }
}