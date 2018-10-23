<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Familles
 *
 * @ORM\Table(name="familles")
 * @ORM\Entity
 */
class Familles
{
    /**
     * @var int
     *
     * @ORM\Column(name="idfamilles", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfamilles;

    /**
     * @var string
     *
     * @ORM\Column(name="lintitule", type="string", length=150, nullable=false)
     */
    private $lintitule;

    /**
     * @var string
     *
     * @ORM\Column(name="breve", type="string", length=600, nullable=false)
     */
    private $breve;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Instruments", mappedBy="famillesfamilles")
     * @ORM\OrderBy({"idinstruments" = "DESC"})
     */
    private $instrumentsinstruments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->instrumentsinstruments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdfamilles(): ?int
    {
        return $this->idfamilles;
    }

    public function getLintitule(): ?string
    {
        return $this->lintitule;
    }

    public function setLintitule(string $lintitule): self
    {
        $this->lintitule = $lintitule;

        return $this;
    }

    public function getBreve(): ?string
    {
        return $this->breve;
    }

    public function setBreve(string $breve): self
    {
        $this->breve = $breve;

        return $this;
    }

    /**
     * @return Collection|Instruments[]
     */
    public function getInstrumentsinstruments(): Collection
    {
        return $this->instrumentsinstruments;
    }

    public function addInstrumentsinstrument(Instruments $instrumentsinstrument): self
    {
        if (!$this->instrumentsinstruments->contains($instrumentsinstrument)) {
            $this->instrumentsinstruments[] = $instrumentsinstrument;
            $instrumentsinstrument->addFamillesfamille($this);
        }

        return $this;
    }

    public function removeInstrumentsinstrument(Instruments $instrumentsinstrument): self
    {
        if ($this->instrumentsinstruments->contains($instrumentsinstrument)) {
            $this->instrumentsinstruments->removeElement($instrumentsinstrument);
            $instrumentsinstrument->removeFamillesfamille($this);
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getLintitule();
    }

}
