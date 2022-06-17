<?php

namespace App\Entity\Interest;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
/**
 * @ORM\Entity()
 */
class Interest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="slug", type="string", nullable=false)
     */
    private string $slug;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Interest
    {
        $this->id = $id;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): Interest
    {
        $this->slug = $slug;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Interest
    {
        $this->name = $name;
        return $this;
    }
}