<?php

namespace Services\Translation;

use Exceptions\TranslationException;

/**
 * Tłumaczenie informacji wyświetlanych w graficznym interfejsie użytkownika
 */
class TranslationService 
{
    const PATH = __DIR__ . '/../../../translations/';
    const FILE_EXTENSION = '.php';
    const DELIMITER = '.';

    private static $singleton = null;
    private static $cache = [];

    private function __construct()
    {
        $path = self::PATH . config('app.language') . self::FILE_EXTENSION;
        if (file_exists($path)) {
            self::$cache = require($path);   
        } else {
            throw new TranslationException();
        }
    }

    private function __clone() {}

    public static function getInstance()
    {
        if (self::$singleton === null) 
        {
            self::$singleton = new self();
        }
        return self::$singleton;
    }

    /**
     * Przygotowanie tłumaczenia zmienne o kluczy $name
     * oraz podmiana argumentów tej zmiennej na wartości 
     * zgodnie z paramterami podanymi w $arguments
     */
    public function translate(string $name, array $arguments = null)
    {
        $tmpCache = self::$cache;
        foreach (explode(self::DELIMITER, $name) as $key) {
            if (!array_key_exists($key, $tmpCache)) {
                return $name;
            }
            $tmpCache = $tmpCache[$key];
        }
        if ($arguments !== null) {
            $replace = array();
            foreach ($arguments as $key => $val) {
                if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                    $replace[':' . $key] = $val;
                }
            }
            return strtr($tmpCache, $replace);            
        }
        return $tmpCache;
    }    
}