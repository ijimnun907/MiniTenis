<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\SocioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method string getUserIdentifier()
 */
#[ORM\Entity(repositoryClass: SocioRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(security: 'is_granted("ROLE_INSCRIPTOR")'),
        new Get(security: 'is_granted("ROLE_INSCRIPTOR")'),
        new Delete(security: 'is_granted("ROLE_ADMINISTRADOR")'),
        new Post(security: 'is_granted("ROLE_ADMINISTRADOR")'),
        new Patch(security: 'is_granted("ROLE_ADMINISTRADOR")'),
        new Put(security: 'is_granted("ROLE_ADMINISTRADOR")')
    ]
)]
class Socio implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $usuario = null;

    #[ORM\Column(length: 255)]
    private ?string $clave = null;

    #[ORM\Column]
    private ?bool $administrador = null;

    #[ORM\Column]
    private ?bool $inscriptor = null;

    #[ORM\OneToMany(targetEntity: Partido::class, mappedBy: 'juez')]
    private Collection $partidos;

    public function __construct()
    {
        $this->partidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): static
    {
        $this->clave = $clave;

        return $this;
    }

    public function isAdministrador(): ?bool
    {
        return $this->administrador;
    }

    public function setAdministrador(bool $administrador): static
    {
        $this->administrador = $administrador;

        return $this;
    }

    public function isInscriptor(): ?bool
    {
        return $this->inscriptor;
    }

    public function setInscriptor(bool $inscriptor): static
    {
        $this->inscriptor = $inscriptor;

        return $this;
    }

    /**
     * @return Collection<int, Partido>
     */
    public function getPartidos(): Collection
    {
        return $this->partidos;
    }

    public function addPartido(Partido $partido): static
    {
        if (!$this->partidos->contains($partido)) {
            $this->partidos->add($partido);
            $partido->setJuez($this);
        }

        return $this;
    }

    public function removePartido(Partido $partido): static
    {
        if ($this->partidos->removeElement($partido)) {
            // set the owning side to null (unless already changed)
            if ($partido->getJuez() === $this) {
                $partido->setJuez(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
        $roles = [];
        $roles[] = 'ROLE_USER';
        if ($this->inscriptor){
            $roles[] = 'ROLE_INSCRIPTOR';
        }
        if ($this->administrador){
            $roles[] = 'ROLE_ADMINISTRADOR';
        }
        return $roles;
    }

    public function getPassword(): ?string
    {
        return $this->clave;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        return $this->usuario;
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
