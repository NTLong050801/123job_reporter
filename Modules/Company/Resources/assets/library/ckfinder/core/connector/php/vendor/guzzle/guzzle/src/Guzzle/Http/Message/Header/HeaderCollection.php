<?php

namespace Guzzle\Http\Message\Header;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Guzzle\Common\ToArrayInterface;
use IteratorAggregate;

/**
 * Provides a case-insensitive collection of headers
 */
class HeaderCollection implements IteratorAggregate, Countable, ArrayAccess, ToArrayInterface
{
    /** @var array */
    protected $headers;

    public function __construct($headers = array())
    {
        $this->headers = $headers;
    }

    public function __clone()
    {
        foreach ($this->headers as &$header) {
            $header = clone $header;
        }
    }

    /**
     * Clears the header collection
     */
    public function clear()
    {
        $this->headers = array();
    }

    /**
     * Get an array of header objects
     *
     * @return array
     */
    public function getAll()
    {
        return $this->headers;
    }

    /**
     * Alias of offsetGet
     */
    public function get($key)
    {
        return $this->offsetGet($key);
    }

    public function offsetGet($offset)
    {
        $l = strtolower($offset);

        return isset($this->headers[$l]) ? $this->headers[$l] : null;
    }

    public function count()
    {
        return count($this->headers);
    }

    public function offsetExists($offset)
    {
        return isset($this->headers[strtolower($offset)]);
    }

    public function offsetSet($offset, $value)
    {
        $this->add($value);
    }

    /**
     * Set a header on the collection
     *
     * @param HeaderInterface $header Header to add
     *
     * @return self
     */
    public function add(HeaderInterface $header)
    {
        $this->headers[strtolower($header->getName())] = $header;

        return $this;
    }

    public function offsetUnset($offset)
    {
        unset($this->headers[strtolower($offset)]);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->headers);
    }

    public function toArray()
    {
        $result = array();
        foreach ($this->headers as $header) {
            $result[$header->getName()] = $header->toArray();
        }

        return $result;
    }
}
