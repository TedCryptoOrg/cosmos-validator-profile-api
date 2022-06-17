<?php

namespace App\Entity\Blockchain;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
/**
 * @ORM\Entity()
 */
class Blockchain
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

    /**
     * @ORM\Column(name="chain_id", type="string", nullable=false)
     */
    private string $chainId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Blockchain
    {
        $this->id = $id;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): Blockchain
    {
        $this->slug = $slug;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Blockchain
    {
        $this->name = $name;
        return $this;
    }

    public function getChainId(): string
    {
        return $this->chainId;
    }

    public function setChainId(string $chainId): Blockchain
    {
        $this->chainId = $chainId;
        return $this;
    }
}