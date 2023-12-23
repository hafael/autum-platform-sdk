<?php

namespace Autum\SDK\Platform\Models;

class Model {

    /**
     * @var array
     */
    private $attributes = [];

    public function __construct(array $data = [])
    {
        foreach($data as $key => $value)
        {
            $this->__set($key, $value);
        }
    }

    /**
     * @param string $key
     * @param null $defaultValue
     * @return mixed|null
     */
    public function get(string $key, $defaultValue = null)
    {
        return $this->attributes[$this->snakeMethodName($key)] ?? $defaultValue;
    }

    /**
     * @param string $key
     * @param null $value
     */
    public function set(string $key, $value = null): void
    {
        $this->attributes[$this->snakeMethodName($key)] = $value;
    }
    

    public function __call($key, $params)
    {

        if(substr($key, 0, 3) === 'get')
        {
            return $this->get(lcfirst(substr($key, 3)), $params);
        }elseif(substr($key, 0, 3) === 'set')
        {
            return $this->set(lcfirst(substr($key, 3)), $params[0]);
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->attributes[$key]);
    }
    
    /**
     * @param string $key
     */
    public function remove(string $key): void
    {
        unset($this->attributes[$key]);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return $this->has($key);
    }

    /**
     * @param string $key
     */
    public function __unset(string $key): void
    {
        $this->remove($key);
    }

    public function __get($name) 
    {   
        return $this->get($name, null);
    }

    public function __set($name, $value) 
    {
        $this->set($name, $value);
    }
    

    public function toArray() 
    {
        return $this->attributes;
    }

    public function toString() 
    {
        return json_encode($this->toArray());
    }

    public function toObject() 
    {
        return (object) $this->attributes;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    public function keys(): array
    {
        return array_keys($this->attributes);
    }

    /**
     * @return array
     */
    public function values(): array
    {
        return array_values($this->attributes);
    }

    private function camelMethodName($method) 
    {
        return implode("", array_map(function($m) {
            return ucfirst($m);
        }, explode('_', $method)));
    }

    private function snakeMethodName($method) 
    {
        return strtolower( preg_replace(["/([A-Z]+)/", "/_([A-Z]+)([A-Z][a-z])/"], ["_$1", "_$1_$2"], lcfirst($method) ) );
    }

    /**
     * @return array
     */
    public function methods(): array
    {   
        return array_merge(...array_values(array_map(function($method) {
            return ['get'. $this->camelMethodName($method), 'set' . $this->camelMethodName($method)];
        }, array_keys($this->attributes))));
    }

    /**
     *
     */
    public function clear(): void
    {
        foreach($this->attributes as $attr) {
            $this->attributes[$attr] = null;
        }
    }

    /**
     * @return void
     */
    public function destroy(): void
    {
        $this->attributes = [];
    }

}