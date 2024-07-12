<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::STRING, length:255)]
    private ?string $score = null;

    /**
     * @var Collection<int, Tournament>
     */
    #[ORM\ManyToMany(targetEntity: Tournament::class, mappedBy: 'game')]
    private Collection $tournaments;

    /**
     * @var Collection<int, Club>
     */
    #[ORM\OneToMany(targetEntity: Club::class, mappedBy: 'game')]
    private Collection $clubs;

    /**
     * @var Collection<int, Club>
     */
    #[ORM\OneToMany(targetEntity: Club::class, mappedBy: 'game')]
    private Collection $firstClub;

    /**
     * @var Collection<int, Club>
     */
    #[ORM\OneToMany(targetEntity: Club::class, mappedBy: 'firstclub')]
    private Collection $firstclub;

    /**
     * @var Collection<int, Club>
     */
    #[ORM\OneToMany(targetEntity: Club::class, mappedBy: 'secondclub')]
    private Collection $secondClub;

    /**
     * @var Collection<int, Club>
     */
    #[ORM\OneToMany(targetEntity: Club::class, mappedBy: 'winner')]
    private Collection $winner;

    public function __construct()
    {
        $this->tournaments = new ArrayCollection();
        $this->clubs = new ArrayCollection();
        $this->firstClub = new ArrayCollection();
        $this->firstclub = new ArrayCollection();
        $this->secondClub = new ArrayCollection();
        $this->winner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): static
    {
        $this->score = $score;

        return $this;
    }

    /**
     * @return Collection<int, Tournament>
     */
    public function getTournaments(): Collection
    {
        return $this->tournaments;
    }

    public function addTournament(Tournament $tournament): static
    {
        if (!$this->tournaments->contains($tournament)) {
            $this->tournaments->add($tournament);
            $tournament->addGame($this);
        }

        return $this;
    }

    public function removeTournament(Tournament $tournament): static
    {
        if ($this->tournaments->removeElement($tournament)) {
            $tournament->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): static
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs->add($club);
            $club->setGame($this);
        }

        return $this;
    }

    public function removeClub(Club $club): static
    {
        if ($this->clubs->removeElement($club)) {
            // set the owning side to null (unless already changed)
            if ($club->getGame() === $this) {
                $club->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getFirstClub(): Collection
    {
        return $this->firstClub;
    }

    public function addFirstClub(Club $firstClub): static
    {
        if (!$this->firstClub->contains($firstClub)) {
            $this->firstClub->add($firstClub);
            $firstClub->setGame($this);
        }

        return $this;
    }

    public function removeFirstClub(Club $firstClub): static
    {
        if ($this->firstClub->removeElement($firstClub)) {
            // set the owning side to null (unless already changed)
            if ($firstClub->getGame() === $this) {
                $firstClub->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getSecondClub(): Collection
    {
        return $this->secondClub;
    }

    public function addSecondClub(Club $secondClub): static
    {
        if (!$this->secondClub->contains($secondClub)) {
            $this->secondClub->add($secondClub);
            $secondClub->setSecondclub($this);
        }

        return $this;
    }

    public function removeSecondClub(Club $secondClub): static
    {
        if ($this->secondClub->removeElement($secondClub)) {
            // set the owning side to null (unless already changed)
            if ($secondClub->getSecondclub() === $this) {
                $secondClub->setSecondclub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getWinner(): Collection
    {
        return $this->winner;
    }

    public function addWinner(Club $winner): static
    {
        if (!$this->winner->contains($winner)) {
            $this->winner->add($winner);
            $winner->setWinner($this);
        }

        return $this;
    }

    public function removeWinner(Club $winner): static
    {
        if ($this->winner->removeElement($winner)) {
            // set the owning side to null (unless already changed)
            if ($winner->getWinner() === $this) {
                $winner->setWinner(null);
            }
        }

        return $this;
    }
}
