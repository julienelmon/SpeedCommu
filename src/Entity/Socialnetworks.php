<?php

namespace App\Entity;

use App\Repository\SocialnetworksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocialnetworksRepository::class)
 */
class Socialnetworks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $linkFB;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLinkFB(): ?string
    {
        return $this->linkFB;
    }

    public function setLinkFB(?string $linkFB): self
    {
        $this->linkFB = $linkFB;

        return $this;
    }
}
