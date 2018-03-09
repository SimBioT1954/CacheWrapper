<?php

namespace Phalcon\Cache\Backend\CacheWrapper\Adapter;

use Phalcon\Cache\Backend\CacheWrapper\CacheItem;
use Phalcon\Cache\BackendInterface;

interface AdapterInterface
{
    /**
     * CacheAdapterInterface constructor.
     *
     * @param BackendInterface $cache
     */
    public function __construct (BackendInterface $cache);

    /**
     * @param string $key
     *
     * @return CacheItem
     */
    public function getItem (string $key): CacheItem;

    /**
     * @param CacheItem $item
     *
     * @return bool
     */
    public function save (CacheItem $item): bool;

    /**
     * Deletes a value from the cache by its key
     *
     * @param int|string $keyName
     *
     * @return boolean
     */
    public function delete ($keyName): bool;


}