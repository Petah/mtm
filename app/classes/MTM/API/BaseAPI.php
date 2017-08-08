<?php
/**
 * MTM\API\BaseAPI
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\API;
use Stash;

class BaseAPI {

    public static $cache = null;

    public $url = 'http://api.trademe.co.nz';

    public function request($uri) {
        $path = $this->getCachePath($uri);
        $item = $this->getCache($path);
        $result = $item->get();
        if ($item->isMiss()) {
            debugLog($this->getURL() . $uri);
            $result = file_get_contents($this->getURL() . $uri);
            $result = json_decode($result, true);
            $item->set($result, 300);
        }
        return $result;
    }

    public static function getCache($path = null) {
        if (!static::$cache) {
            $driver = new Stash\Driver\FileSystem([
                'path' => ROOT . '/data/cache'
            ]);
            static::$cache = new Stash\Pool($driver);
        }
        if ($path) {
            return static::$cache->getItem($path);
        }
        return static::$cache;
    }

    public static function setCache($path, $value) {
        $item = static::getCache($path);
        $item->set($value);
    }

    public function isCached($path) {
        $item = $this->getCache($this->getCachePath($path));
        return !$item->isMiss();
    }

    public function getCachePath($path) {
        return trim(strtolower($path), '/');
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }



}
