<?php

namespace Amasty\Trainee\Models;

class Pizza
{
    private int $size;

    private string $sous;

    private string $type;

    /**
     * @param int $size
     * @param string $sous
     * @param string $type
     */
    public function __construct(int $size, string $sous, string $type)
    {
        $this->size = $size;
        $this->sous = $sous;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getSous(): string
    {
        return $this->sous;
    }

    /**
     * @param string $sous
     */
    public function setSous(string $sous): void
    {
        $this->sous = $sous;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}