<?php

namespace App\Entity\Profile;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Blockchain\Blockchain;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
/**
 * @ORM\Entity()
 */
class ValidatorAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Profile\Validator", inversedBy="addresses")
     * @ORM\JoinColumn(name="validator_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private Validator $validator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blockchain\Blockchain")
     * @ORM\JoinColumn(name="blockchain_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private Blockchain $blockchain;

    /**
     * @ORM\Column(name="address", type="string", nullable=false)
     */
    private string $address;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ValidatorAddress
    {
        $this->id = $id;
        return $this;
    }

    public function getBlockchain(): Blockchain
    {
        return $this->blockchain;
    }

    public function setBlockchain(Blockchain $blockchain): ValidatorAddress
    {
        $this->blockchain = $blockchain;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): ValidatorAddress
    {
        $this->address = $address;
        return $this;
    }
}