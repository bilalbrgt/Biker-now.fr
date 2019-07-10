<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeopleRepository")
 * @UniqueEntity(
 *     fields={"Email"},
 *     message="l'adreese Email a deja etais utilisés"
 * )
 */
class People
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()

     */
    private $Email;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     * @Assert\Length(min="2",minMessage="votre numero doit comporter 2 chiffres")

     */
    private $Age;

    /**
     * @ORM\Column(type="decimal", precision=10)
     * @Assert\Length(min="10",minMessage="votre numero doit comporter 10 chiffres")

     */
    private $Numero;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getAge()
    {
        return $this->Age;
    }

    public function setAge($Age): self
    {
        $this->Age = $Age;

        return $this;
    }

    public function getNumero()
    {
        return $this->Numero;
    }

    public function setNumero($Numero): self
    {
        $this->Numero = $Numero;

        return $this;
    }
}
