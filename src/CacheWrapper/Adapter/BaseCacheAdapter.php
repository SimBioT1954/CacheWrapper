<?php

namespace Phalcon\Cache\Backend\CacheWrapper\Adapter;

use Phalcon\Cache\Backend\CacheWrapper\CacheItem;
use Phalcon\Cache\BackendInterface;

class BaseCacheAdapter implements AdapterInterface
{
    /**
     * @var BackendInterface
     */
    protected $cache;

    /**
     * CacheAdapter constructor.
     *
     * @param BackendInterface $cache
     */
    public function __construct (BackendInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $key
     *
     * @return CacheItem
     */
    public function getItem (string $key): CacheItem
    {
        return new CacheItem($this->cache, $key);
    }

    /**
     * @param CacheItem $item
     *
     * @return bool
     */
    public function save (CacheItem $item): bool
    {
        return $this->cache->save($item->getKey(), $item->getContent(), $item->getExpiresAfter());
    }

    /**
     * Deletes a value from the cache by its key
     *
     * @param int|string $keyName
     *
     * @return boolean
     */
    public function delete ($keyName): bool
    {
        return $this->cache->delete($keyName);
    }


}