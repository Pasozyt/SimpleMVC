<?php

namespace Views;

interface ViewInterface 
{
    public function render(string $template, array $data = []): void;
}