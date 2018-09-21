<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CallRepository")
 */
class Call
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="Caller", inversedBy="calls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $caller;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getCaller(): ?Caller
    {
        return $this->caller;
    }

    public function setCaller(?Caller $caller): self
    {
        $this->caller = $caller;

        return $this;
    }
}
