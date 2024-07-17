<?php

// App/Entity/Game.php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;


    #[ORM\Column(type: Types::STRING, length:255, nullable: true)]
    #[Groups(['score_browse'])]
    private ?string $score = null;

  

    #[ORM\ManyToOne(targetEntity: Club::class)]
    private ?Club $firstClub = null;

    #[ORM\ManyToOne(targetEntity: Club::class)]
    private ?Club $secondClub = null;

    #[ORM\ManyToOne(targetEntity: Club::class)]
    private ?Club $winner = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tournament $tournament = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

   
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

   
    public function getFirstClub(): ?Club
    {
        return $this->firstClub;
    }

    public function setFirstClub(?Club $firstClub): static
    {
        $this->firstClub = $firstClub;

        return $this;
    }

    public function getSecondClub(): ?Club
    {
        return $this->secondClub;
    }

    public function setSecondClub(?Club $secondClub): static
    {
        $this->secondClub = $secondClub;

        return $this;
    }

    public function getWinner(): ?Club
    {
        return $this->winner;
    }

    public function setWinner(?Club $winner): static
    {
        $this->winner = $winner;

        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): static
    {
        $this->tournament = $tournament;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}