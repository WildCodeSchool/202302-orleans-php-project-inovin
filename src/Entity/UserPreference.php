<?php

namespace App\Entity;

use App\Repository\UserPreferenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserPreferenceRepository::class)]
class UserPreference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $wineColour = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $wineKnowledge = null;

    #[ORM\OneToOne(inversedBy: 'userPreference', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToOne]
    private ?WineRegion $wineRegion = null;

    #[ORM\ManyToOne]
    private ?WineTaste $wineTaste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWineColour(): ?string
    {
        return $this->wineColour;
    }

    public function setWineColour(?string $wineColour): static
    {
        $this->wineColour = $wineColour;

        return $this;
    }

    public function getWineKnowledge(): ?string
    {
        return $this->wineKnowledge;
    }

    public function setWineKnowledge(?string $wineKnowledge): static
    {
        $this->wineKnowledge = $wineKnowledge;

        return $this;
    }

    public function getWineTaste(): ?WineTaste
    {
        return $this->wineTaste;
    }

    public function setWineTaste(?WineTaste $wineTaste): static
    {
        $this->wineTaste = $wineTaste;

        return $this;
    }

    public function getWineRegion(): ?WineRegion
    {
        return $this->wineRegion;
    }

    public function setWineRegion(?WineRegion $wineRegion): static
    {
        $this->wineRegion = $wineRegion;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
