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
            $result = json_decode(file_get_contents($this->getURL() . $uri), true);
            $item->set($result);
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

    public function cache() {

        // Set the "key", which is the path the Stash object points to. This will be
        // discussed in depth later, but for now just know it's an identifier.
        $item = $stash->getItem('path/to/data');
    }

    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }



}
