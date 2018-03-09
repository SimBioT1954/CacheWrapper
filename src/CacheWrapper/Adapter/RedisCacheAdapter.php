<?php

namespace Phalcon\Cache\Backend\CacheWrapper\Adapter;

class RedisCacheAdapter extends BaseCacheAdapter
{
    /**
     * Stores cached content into the file backend and stops the frontend
     *
     * @param int|string $keyName
     * @param string     $content
     * @param int        $lifetime
     *
     * @return bool
     */
    public function set ($keyName, $content, $lifetime): bool
    {
        return $this->cache->save($keyName, $content, $lifetime);
    }

    /**
     * @param int|string $keyName
     *
     * @return mixed|null
     */
    public function get ($keyName)
    {
        return $this->cache->get($keyName);
    }

    /**
     * @param $keyName
     *
     * @return bool
     */
    public function exists ($keyName): bool
    {
        return $this->cache->exists($keyName);
    }

    /**
     * @param mixed $prefix
     *
     * @return array
     */
    public function queryKeys ($prefix)
    {
        return $this->cache->queryKeys($prefix);
    }
}