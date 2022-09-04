<?php

namespace Services\Config;

/**
 * Zwracanie zmiennych konfiguracyjnych z pliku ini.
 * 
 * Wykorzystuje notację nazwa_sekcji.nazwa_zmiennej.
 * Notacja nie dopuszcza zagnieżdżeń w ramach zmiennych.
 * 
 * Klasa wykorzystuje wzorzec projektowy singleton.
 * 
 */
class ConfigService
{
    const FILENAME = 'env.ini';
    const PATH = __DIR__ . '/../../../config/';
    const DELIMITER = '.';

    private static $singleton = null;
    private static $cache = null;

    private function __construct()
    {
        self::$cache = parse_ini_file(self::PATH . self::FILENAME, true, INI_SCANNER_TYPED);   
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

    public function config(string $name = null)
    {
        $keys = explode(self::DELIMITER, $name);
        if (!isset($keys[0], $keys[1])) {
            return null;
        }
        $section = strtoupper($keys[0]);
        $variable = strtolower($keys[1]);
        return isset(self::$cache[$section][$variable]) 
            ? self::$cache[$section][$variable] 
            : null;
    }    
}