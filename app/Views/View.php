<?php

namespace Views;

use Exceptions\TemplateNotFoundException;

class View implements ViewInterface
{
    const TEMPLATE_DIRECTORY = __DIR__ . '/../../templates/';
    const TEMPLATE_EXTENSION = '.html.php';

    /**
     * Zmienne przekazywane do widoku
     */
    private $data = []; 

    public function render(string $template, array $data = []): void 
    {
        $this->data = array_merge($this->data, $data);
        $path = self::TEMPLATE_DIRECTORY . $template . self::TEMPLATE_EXTENSION;

        if (!file_exists($path)) {
            throw new TemplateNotFoundException();
        }
        require_once($path);
    }

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    public function __set(string $name, $value)
    {
        if (array_key_exists($name, $this->data)) {
            $this->data[$name] = $value;
        }
    }      
}