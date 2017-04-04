<?php

namespace FusionClock\Pig;

interface CacheInterface
{
    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(string $key, $default);

    /**
     * @param string $key
     * @param mixed  $value
     */
    public function set(string $key, $value);

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool;
}
