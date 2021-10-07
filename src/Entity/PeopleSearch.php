<?php

namespace App\Entity;

class PeopleSearch 
{
    /**
     * @var string|null
     */
    private $category;

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): PeopleSearch
    {
        $this->category = $category;

        return $this;
    }
}

?>