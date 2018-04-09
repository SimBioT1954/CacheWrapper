<?php

namespace Phalcon\Cache\Backend\CacheWrapper;

use Phalcon\Cache\Backend\CacheWrapper\Adapter\AdapterInterface;
use Phalcon\Db\AdapterInterface as DbInterface;

class CacheProcessor
{
    private const PREFIX = '__';
    private const DEFAULT_CACHE_TIME = 86400 * 30;

    /**
     * @var DbInterface
     */
    private $db;

    /**
     * @var AdapterInterface
     */
    private $cache;

    /**
     * CacheProcessor constructor.
     *
     * @param DbInterface      $db
     * @param AdapterInterface $cache
     */
    public function __construct (DbInterface $db, AdapterInterface $cache)
    {
        $this->db = $db;
        $this->cache = $cache;
    }

    /**
     * @return DbInterface
     */
    public function getDb (): DbInterface
    {
        return $this->db;
    }

    /**
     * @return AdapterInterface
     */
    public function getCache (): AdapterInterface
    {
        return $this->cache;
    }

    /**
     * @param string $table
     *
     * @return array
     */
    public function getTableData (string $table): array
    {
        $item = $this->cache->getItem(self::PREFIX . $table);

        if (!$item->isHit()) {

            $data = $this->getTable($table);

            $item->set($data)->expiresAfter(self::DEFAULT_CACHE_TIME);
            $this->cache->save($item);

        } else {

            $data = $item->get();

        }

        return $data;
    }

    /**
     * @param string $table
     *
     * @return array
     */
    private function getTable ($table): array
    {
        $data = [];
        $query = $this->db->query('SELECT * FROM ' . $table);

        $row = $query->fetch();

        while (false !== $row) {

            $data[$row['id']] = $row;
            $row = $query->fetch();

        }

        return $data;
    }


    /**
     * @param string   $key
     * @param \Closure $callable
     * @param int      $time
     *
     * @return mixed|null
     */
    public function get (string $key, \Closure $callable, int $time = self::DEFAULT_CACHE_TIME)
    {
        $item = $this->cache->getItem($key);

        if (!$item->isHit()) {
            
            \Closure::bind($callable, $this);
            $data = $callable();

            $item->set($data)->expiresAfter($time);
            $this->cache->save($item);

            return $data;

        }

        return $item->get();
    }

    /**
     * @return int
     */
    /*
    private function getExpireTime (): int
    {
        $date = new \DateTimeImmutable();
        $date = $date->add(new \DateInterval('P30D'));
        return $date->getTimestamp();
    }
    */

}