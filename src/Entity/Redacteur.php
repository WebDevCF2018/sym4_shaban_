<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Redacteur
 *
 * @ORM\Table(name="redacteur", uniqueConstraints={@ORM\UniqueConstraint(name="lenom_UNIQUE", columns={"surnom"})})
 * @ORM\Entity
 */
class Redacteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="idredacteur", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idredacteur;

    /**
     * @var string
     *
     * @ORM\Column(name="surnom", type="string", length=80, nullable=false)
     */
    private $surnom;

    /**
     * @var string
     *
     * @ORM\Column(name="thepwd", type="string", length=80, nullable=false)
     */
    private $thepwd;

    /**
     * @var string
     *
     * @ORM\Column(name="cname", type="string", length=160, nullable=false)
     */
    private $cname;

    public function getIdredacteur(): ?int
    {
        return $this->idredacteur;
    }

    public function getSurnom(): ?string
    {
        return $this->surnom;
    }

    public function setSurnom(string $surnom): self
    {
        $this->surnom = $surnom;

        return $this;
    }

    public function getThepwd(): ?string
    {
        return $this->thepwd;
    }

    public function setThepwd(string $thepwd): self
    {
        $this->thepwd = $thepwd;

        return $this;
    }

    public function getCname(): ?string
    {
        return $this->cname;
    }

    public function setCname(string $cname): self
    {
        $this->cname = $cname;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getSurnom();
    }
}
