<?php

namespace FusionClock\Pig;

class Cache implements CacheInterface
{
    /**
     * @var array
     */
    private $cache = [];

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->cache[$key] ?? $default;
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set(string $key, $value)
    {
        $this->cache[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->cache);
    }
}
