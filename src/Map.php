<?php

namespace Fabrizio\MapPhp;

/**
 * Class Map
 * @package Fabrizio\MapPhp
 */
class Map implements \Iterator {

    private $position = 0;
    private $keys = [];
    private $values = [];

    private $k;
    private $v;

    /**
     * Map constructor.
     * @param mixed $k
     * @param mixed $v
     */
    public function __construct($k,$v)
    {
        if (!($k && $v)) throw new \Exception('Null k & v');
        $this->k = $k; $this->v = $v;
    }

    /**
     * Returns the number of key-value mappings in this map.
     *
     * @return int the number of key-value mappings in this map
     */
    public function size(){
        return count($this->values);
    }

    /**
     * Returns true if this map contains no key-value mappings.
     *
     * @return bool if this map contains no key-value mappings
     */
    public function isEmpty(){
        return count($this->values) == 0;
    }

    /**
     * Returns true if this map contains a mapping for the specified
     * key.
     *
     * @param mixed $key key whose presence in this map is to be tested
     * @return bool if this map contains a mapping for the specified key
     */
    public function containsKey($key){
        return in_array($key,$this->keys);
    }

    /**
     * Returns true if this map maps one or more keys to the
     * specified value.
     *
     * @param mixed $value value whose presence in this map is to be tested
     * @return bool if this map maps one or more keys to the specified value
     */
    public function containsValue($value){
        return in_array($value,$this->values);
    }

    /**
     * @param mixed $key The key whose associated value is to be returned
     * @return mixed|null the value to which the specified key is mapped, or
     * null if this map contains no mapping for the key.
     *
     */
    public function get($key){
        if (!($key instanceof $this->k)) return null;
        $keyInt = $this->getIntKey($key);
        if (!$keyInt) return null;
        return $this->values[$keyInt] ?? null;
    }

    /**
     * Returns the value to which the specified key is mapped,
     * or null if this map contains no mapping for the key.
     *
     * @param $key
     * @return int|null
     */
    private function getIntKey($key){
        if (!($key instanceof $this->k)) return null;
        while($element = current($this->keys)) {
            if (key($this->keys) == $key){
                return key($this->keys);
            }
            next($this->keys);
        }
        return null;
    }


    /**
     * @param mixed $key key with which the specified value is to be associated
     * @param mixed $value value to be associated with the specified key
     * @return mixed the previous value associated with key
     * @throws \Exception
     */
    public function put($key, $value){
        if (!($key)) throw new \Exception('Null K');
        if (!($value)) throw new \Exception('Null V');
        $this->validType($key,$value);
        $this->values[] = $value;
        $this->keys[] = $key;
        return $value;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @throws \Exception
     */
    private function validType($key, $value){
        if ((!($key instanceof $this->k))) throw new \Exception('Error type K');
        if ((!($value instanceof $this->v))) throw new \Exception('Error type V');
    }

    /**
     * Removes the mapping for a key from this map if it is present
     *
     * @param mixed $key key whose mapping is to be removed from the map
     * @return mixed|null the previous value associated with key
     */
    public function remove($key){

        $keyInt = $this->getIntKey($key);
        if (!$keyInt) return null;
        if ($this->values[$keyInt]){
            $temp = $this->values[$keyInt];
            unset($this->values[$keyInt]);
            unset($this->keys[$keyInt]);
            return $temp;
        }
        return null;
    }

    /**
     * Copies all of the mappings from the specified map to this map.
     *
     * @param Map $map mappings to be stored in this map
     */
    public function putAll(Map $map){
        foreach ($map as $k => $v) {
            if ($k && $v){
                $this->keys[] = $k;
                $this->values[] = $v;
            }
        }
    }

    /**
     * Removes all of the mappings from this map (optional operation).
     * The map will be empty after this call returns.
     */
    public function clear(){
        $this->values = [];
        $this->keys = [];
    }

    /**
     * @return mixed|null
     */
    public function current()
    {
        return $this->values[$this->position] ?? null;
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
        return $this->keys[$this->position] ?? $this->position;
    }

    /**
     *
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->values[$this->position]);
    }

    /**
     *
     */
    public function keySet(){

    }

    /**
     *
     */
    public function values(){

    }

    /**
     *
     */
    public function entrySet(){

    }
}