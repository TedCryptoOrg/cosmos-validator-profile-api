<?php

namespace App\Entity\Profile;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Interest\Interest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
/**
 * @ORM\Entity()
 */
class Validator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="keybase", type="string", nullable=false)
     */
    private string $keybase;

    /**
     * @ORM\Column(name="slug", type="string", nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="bio", type="text", nullable=true)
     */
    private string $bio;

    /**
     * @var Interest[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Interest\Interest")
     * @ORM\JoinColumn(name="interests_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
     */
    private iterable $interests;

    /**
     * @var ValidatorAddress[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Profile\ValidatorAddress", mappedBy="validator")
     */
    private iterable $addresses;

    public function __construct()
    {
        $this->interests = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Validator
    {
        $this->id = $id;
        return $this;
    }

    public function getKeybase(): string
    {
        return $this->keybase;
    }

    public function setKeybase(string $keybase): Validator
    {
        $this->keybase = $keybase;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Validator
    {
        $this->name = $name;
        return $this;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function setBio(string $bio): Validator
    {
        $this->bio = $bio;
        return $this;
    }

    public function getInterests(): ArrayCollection|array
    {
        return $this->interests;
    }

    public function setInterests(ArrayCollection|array $interests): Validator
    {
        $this->interests = $interests;
        return $this;
    }

    public function getAddresses(): ArrayCollection|array
    {
        return $this->addresses;
    }

    public function setAddresses(ArrayCollection|array $addresses): Validator
    {
        $this->addresses = $addresses;
        return $this;
    }
}