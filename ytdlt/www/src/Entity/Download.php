<?php

namespace App\Entity;

use App\Repository\DownloadRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DownloadRepository::class)]
class Download
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $telecharger = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isTelecharger(): ?bool
    {
        return $this->telecharger;
    }

    public function setTelecharger(bool $telecharger): static
    {
        $this->telecharger = $telecharger;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
