<?php

namespace App\Domain\Entity;

use App\Infrastructure\Persistence\Doctrine\Repository\Article\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $uniqueCode = null;

    #[ORM\Column]
    private ?int $amountViews = null;

    #[ORM\Column]
    private ?bool $activity = null;

    #[ORM\Column(length: 3000)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUniqueCode(): ?string
    {
        return $this->uniqueCode;
    }

    public function setUniqueCode(string $uniqueCode): static
    {
        $this->uniqueCode = $uniqueCode;

        return $this;
    }

    public function getAmountViews(): ?int
    {
        return $this->amountViews;
    }

    public function setAmountViews(int $amountViews): static
    {
        $this->amountViews = $amountViews;

        return $this;
    }

    public function isActivity(): ?bool
    {
        return $this->activity;
    }

    public function setActivity(bool $activity): static
    {
        $this->activity = $activity;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeImmutable
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeImmutable $createdDate): static
    {
        $this->createdDate = $createdDate;

        return $this;
    }
}
