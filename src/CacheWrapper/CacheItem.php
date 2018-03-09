<?php

namespace Phalcon\Cache\Backend\CacheWrapper;

use Phalcon\Cache\BackendInterface;

class CacheItem
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var BackendInterface
     */
    protected $cache;

    /**
     * @var int
     */
    protected $expiresAfter;

    /**
     * @var mixed
     */
    protected $content;

    /**
     * CacheItem constructor.
     *
     * @param        $cache
     * @param string $key
     */
    public function __construct (BackendInterface $cache, string $key)
    {
        $this->cache = $cache;
        $this->key = $key;
    }

    /**
     * @return bool
     */
    public function isHit (): bool
    {
        return $this->cache->exists($this->getKey());
    }

    /**
     * @return string
     */
    public function getKey (): string
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey ($key): void
    {
        $this->key = $key;
    }

    /**
     * @param int $expiresAfter
     */
    public function expiresAfter (int $expiresAfter): void
    {
        $this->expiresAfter = $expiresAfter;
    }

    /**
     * @param mixed $content
     *
     * @return $this
     */
    public function set ($content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function get ()
    {
        return $this->cache->get($this->getKey());
    }

    /**
     * @return BackendInterface
     */
    public function getCache (): BackendInterface
    {
        return $this->cache;
    }

    /**
     * @param mixed $cache
     */
    public function setCache ($cache): void
    {
        $this->cache = $cache;
    }

    /**
     * @return int
     */
    public function getExpiresAfter (): int
    {
        return $this->expiresAfter;
    }

    /**
     * @return mixed
     */
    public function getContent ()
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getLifetime (): ?int
    {
        return $this->cache->getLifetime();
    }

}