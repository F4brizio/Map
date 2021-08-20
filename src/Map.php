<?php

namespace Fabrizio\Map;

use Exception;

/**
 * Class Map
 * @package Fabrizio\MapPhp
 */
class Map implements \Iterator {

    private $dataMap = [];
    private $position = 0;
    private $k;
    private $v;

    /**
     * Map constructor.
     * @param mixed $k
     * @param mixed $v
     */
    public function __construct($k,$v)
    {
        if (!($k && $v)) throw new Exception('NullPointerException');
        $this->k = $k; $this->v = $v;
    }

    /**
     * Returns the number of key-value mappings in this map.
     *
     * @return int the number of key-value mappings in this map
     */
    public function size(): int
    {
        return count($this->dataMap);
    }

    /**
     * Returns true if this map contains no key-value mappings.
     *
     * @return bool if this map contains no key-value mappings
     */
    public function isEmpty(): bool
    {
        return count($this->dataMap) == 0;
    }

    /**
     * Returns true if this map contains a mapping for the specified
     * key.
     *
     * @param mixed $key key whose presence in this map is to be tested
     * @return bool if this map contains a mapping for the specified key
     */
    public function containsKey(&$key): bool
    {
        if (!($key)) throw new Exception('NullPointerException');
        if (!($key instanceof $this->k)) throw new Exception('ClassCastException');
        return in_array($key,array_column($this->dataMap, 'key'));
    }

    /**
     * Returns true if this map maps one or more keys to the
     * specified value.
     *
     * @param mixed $value value whose presence in this map is to be tested
     * @return bool if this map maps one or more keys to the specified value
     * @throws Exception
     */
    public function containsValue($value): bool
    {
        if (!($value)) throw new Exception('NullPointerException');
        if (!($value instanceof $this->v)) throw new Exception('ClassCastException');
        return in_array($value,array_column($this->dataMap, 'value'));
    }

    /**
     * @param mixed $key The key whose associated value is to be returned
     * @return mixed|null the value to which the specified key is mapped, or
     * null if this map contains no mapping for the key.
     *
     * @throws Exception
     */
    public function get($key){
        if (!($key)) throw new Exception('NullPointerException');
        if (!($key instanceof $this->k)) throw new Exception('ClassCastException');
        return $this->dataMap[$this->getUniqueID($key)]['value'] ?? null;
    }

    /**
     * @param mixed $key key with which the specified value is to be associated
     * @param mixed $value value to be associated with the specified key
     * @return mixed the previous value associated with key
     * @throws Exception
     */
    public function put($key, $value){
        if (!($key)) throw new Exception('NullPointerException');
        if (!($key instanceof $this->k)) throw new Exception('ClassCastException');
        if (!($value)) throw new Exception('NullPointerException');
        if (!($value instanceof $this->v)) throw new Exception('ClassCastException');
        $this->dataMap[$this->getUniqueID($key)] = array('key' => $key, 'value' => $value);
        return $value;
    }

    public function getUniqueID($dat): int
    {
        return spl_object_id($dat);
        #return spl_object_hash($dat);
    }

    /**
     * Removes the mapping for a key from this map if it is present
     *
     * @param mixed $key key whose mapping is to be removed from the map
     * @return mixed|null the previous value associated with key
     * @throws Exception
     */
    public function remove($key){
        if (!($key)) throw new Exception('NullPointerException');
        if (!($key instanceof $this->k)) throw new Exception('ClassCastException');
        unset($this->dataMap[$this->getUniqueID($key)]);
        return null;
    }

    /**
     * Copies all of the mappings from the specified map to this map.
     *
     * @param Map $map mappings to be stored in this map
     * @throws Exception
     */
    public function putAll(Map $map){
        if (!($map)) throw new Exception('NullPointerException');
        if (!($map instanceof Map)) throw new Exception('ClassCastException');
        foreach ($map as $k => $v) {
            if ($k && $v){
                $this->dataMap[$this->getUniqueID($k)] = array('key' => $k, 'value' => $v);
            }
        }
    }

    /**
     * Removes all of the mappings from this map (optional operation).
     * The map will be empty after this call returns.
     */
    public function clear(){
        $this->dataMap = [];
    }

    /**
     * @return mixed|null
     */
    public function current()
    {
        return (array_column($this->dataMap, 'value'))[$this->position] ?? null;
    }

    /**
     *
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @return bool|float|int|mixed|string|null
     */
    public function key()
    {
        return (array_column($this->dataMap, 'key'))[$this->position];
    }


    /**
     *
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     *
     */
    public function keySet(){
        return array_column($this->dataMap, 'key');
    }

    /**
     *
     */
    public function values(){
        return array_column($this->dataMap, 'value');
    }

    /**
     *
     */
    #public function entrySet(){

    #}
    public function valid(): bool
    {
        return isset(($this->values())[$this->position]);
    }
}