<?php

namespace App\Entity;

use App\Repository\SocialNetworkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocialNetworkRepository::class)
 */
class SocialNetwork
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $linkFB;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $linkInstagram;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $linkTwitter;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $linkTumblr;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $linkDeviantArt;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $linkGithub;

    /**
     * @ORM\OneToOne(targetEntity=Login::class)
     */
    private $login;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLinkFB(): ?string
    {
        return $this->linkFB;
    }

    public function setLinkFB(string $linkFB): self
    {
        $this->linkFB = $linkFB;

        return $this;
    }

    public function getLinkInstagram(): ?string
    {
        return $this->linkInstagram;
    }

    public function setLinkInstagram(string $linkInstagram): self
    {
        $this->linkInstagram = $linkInstagram;

        return $this;
    }

    public function getLinkTwitter(): ?string
    {
        return $this->linkTwitter;
    }

    public function setLinkTwitter(string $linkTwitter): self
    {
        $this->linkTwitter = $linkTwitter;

        return $this;
    }

    public function getLinkTumblr(): ?string
    {
        return $this->linkTumblr;
    }

    public function setLinkTumblr(string $linkTumblr): self
    {
        $this->linkTumblr = $linkTumblr;

        return $this;
    }

    public function getLinkDeviantArt(): ?string
    {
        return $this->linkDeviantArt;
    }

    public function setLinkDeviantArt(string $linkDeviantArt): self
    {
        $this->linkDeviantArt = $linkDeviantArt;

        return $this;
    }

    public function getLinkGithub(): ?string
    {
        return $this->linkGithub;
    }

    public function setLinkGithub(string $linkGithub): self
    {
        $this->linkGithub = $linkGithub;

        return $this;
    }

    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param int
     */

    public function setLogin(Login $login)
    {
        $this->login = $login;

        return $this;
    }


}
