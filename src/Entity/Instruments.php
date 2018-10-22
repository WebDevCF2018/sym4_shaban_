<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Instruments
 *
 * @ORM\Table(name="instruments", indexes={@ORM\Index(name="fk_instruments_redacteur_idx", columns={"redacteur_idredacteur"})})
 * @ORM\Entity
 */
class Instruments
{
    /**
     * @var int
     *
     * @ORM\Column(name="idinstruments", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idinstruments;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=150, nullable=false)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="ladesc", type="text", length=65535, nullable=false)
     */
    private $ladesc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="parution", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $parution = 'CURRENT_TIMESTAMP';

    /**
     * @var \Redacteur
     *
     * @ORM\ManyToOne(targetEntity="Redacteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="redacteur_idredacteur", referencedColumnName="idredacteur")
     * })
     */
    private $redacteurredacteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Familles", inversedBy="instrumentsinstruments")
     * @ORM\JoinTable(name="instruments_has_familles",
     *   joinColumns={
     *     @ORM\JoinColumn(name="instruments_idinstruments", referencedColumnName="idinstruments")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="familles_idfamilles", referencedColumnName="idfamilles")
     *   }
     * )
     */
    private $famillesfamilles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->famillesfamilles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdinstruments(): ?int
    {
        return $this->idinstruments;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getLadesc(): ?string
    {
        return $this->ladesc;
    }

    public function setLadesc(string $ladesc): self
    {
        $this->ladesc = $ladesc;

        return $this;
    }

    public function getParution(): ?\DateTimeInterface
    {
        return $this->parution;
    }

    public function setParution(?\DateTimeInterface $parution): self
    {
        $this->parution = $parution;

        return $this;
    }

    public function getRedacteurredacteur(): ?Redacteur
    {
        return $this->redacteurredacteur;
    }

    public function setRedacteurredacteur(?Redacteur $redacteurredacteur): self
    {
        $this->redacteurredacteur = $redacteurredacteur;

        return $this;
    }

    /**
     * @return Collection|Familles[]
     */
    public function getFamillesfamilles(): Collection
    {
        return $this->famillesfamilles;
    }

    public function addFamillesfamille(Familles $famillesfamille): self
    {
        if (!$this->famillesfamilles->contains($famillesfamille)) {
            $this->famillesfamilles[] = $famillesfamille;
        }

        return $this;
    }

    public function removeFamillesfamille(Familles $famillesfamille): self
    {
        if ($this->famillesfamilles->contains($famillesfamille)) {
            $this->famillesfamilles->removeElement($famillesfamille);
        }

        return $this;
    }

}
