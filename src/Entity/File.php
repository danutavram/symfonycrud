<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

#[ORM\Entity(repositoryClass: FileRepository::class)]
#[ORM\InheritanceType(value: 'JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['video' => 'Video', 'pdf' => 'Pdf'])]

class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fileName = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'files')]
    private ?Author $author = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): static
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

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

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): static
    {
        $this->author = $author;

        return $this;
    }
}
