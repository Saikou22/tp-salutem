<?php

namespace App\Entity;

use App\Repository\SocialNetworksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocialNetworksRepository::class)]
class SocialNetworks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $icon;

    #[ORM\Column(type: 'string', length: 255)]
    private $social_networks_url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getSocialNetworksUrl(): ?string
    {
        return $this->social_networks_url;
    }

    public function setSocialNetworksUrl(string $social_networks_url): self
    {
        $this->social_networks_url = $social_networks_url;

        return $this;
    }
}
