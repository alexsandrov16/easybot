<?php

namespace Al3x5\Easybot\Entities;

use Al3x5\Easybot\Entities\Interfaces\EntityInterface;

/**
 * Base Class
 */
abstract class Base 
{
    protected array $entityMap = [];

    public function __construct(array $data)
    {
        $this->entityMap=$this->getEntities();
        $this->init($data);
    }

    /**
     * 
     */
    private function init(array $data): void
    {
        foreach ($data as $key => $value) {
            if (key_exists($key,$this->getEntities())) {
                $this->$key = $this->createEntity($key, $value);
            } else {
                $this->$key = $value;
            }
        }
    }

    /**
     * Instancia entidades hijas
     */
    protected function createEntity(string $class, array $params): object
    {
        return new $this->entityMap[$class]($params);
    }

    /**
     * Declarar Entidades Hijas
     */
    abstract protected function getEntities(): array;
}
