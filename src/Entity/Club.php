<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $club_name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $licence_number = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    /**
     * @var Collection<int, Tournament>
     */
    #[ORM\ManyToMany(targetEntity: Tournament::class, inversedBy: 'clubs')]
    private Collection $tournament;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'club')]
    private Collection $user;

    #[ORM\ManyToOne(inversedBy: 'firstClub')]
    private ?Game $game = null;

    #[ORM\ManyToOne(inversedBy: 'firstclub')]
    private ?Game $firstclub = null;

    #[ORM\ManyToOne(inversedBy: 'secondClub')]
    private ?Game $secondclub = null;

    #[ORM\ManyToOne(inversedBy: 'winner')]
    private ?Game $winner = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;



    public function __construct()
    {
        $this->tournament = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClubName(): ?string
    {
        return $this->club_name;
    }

    public function setClubName(string $club_name): static
    {
        $this->club_name = $club_name;

        return $this;
    }

    public function getLicenceNumber(): ?int
    {
        return $this->licence_number;
    }

    public function setLicenceNumber(int $licence_number): static
    {
        $this->licence_number = $licence_number;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Tournament>
     */
    public function getTournament(): Collection
    {
        return $this->tournament;
    }

    public function addTournament(Tournament $tournament): static
    {
        if (!$this->tournament->contains($tournament)) {
            $this->tournament->add($tournament);
        }

        return $this;
    }

    public function removeTournament(Tournament $tournament): static
    {
        $this->tournament->removeElement($tournament);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setClub($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getClub() === $this) {
                $user->setClub(null);
            }
        }

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getFirstclub(): ?Game
    {
        return $this->firstclub;
    }

    public function setFirstclub(?Game $firstclub): static
    {
        $this->firstclub = $firstclub;

        return $this;
    }

    public function getSecondclub(): ?Game
    {
        return $this->secondclub;
    }

    public function setSecondclub(?Game $secondclub): static
    {
        $this->secondclub = $secondclub;

        return $this;
    }

    public function getWinner(): ?Game
    {
        return $this->winner;
    }

    public function setWinner(?Game $winner): static
    {
        $this->winner = $winner;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }



}
