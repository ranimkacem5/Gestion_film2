<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $descrition = null;

    #[ORM\Column]
    private ?int $releaseyear = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?float $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $director = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\OneToMany(targetEntity: Categorie::class, mappedBy: 'movies')]
    private Collection $Categories;

    public function __construct()
    {
        $this->Categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescrition(): ?string
    {
        return $this->descrition;
    }

    public function setDescrition(string $descrition): static
    {
        $this->descrition = $descrition;

        return $this;
    }

    public function getReleaseyear(): ?int
    {
        return $this->releaseyear;
    }

    public function setReleaseyear(int $releaseyear): static
    {
        $this->releaseyear = $releaseyear;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): static
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->Categories;
    }

    public function addCategory(Categorie $category): static
    {
        if (!$this->Categories->contains($category)) {
            $this->Categories->add($category);
            $category->setMovies($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): static
    {
        if ($this->Categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getMovies() === $this) {
                $category->setMovies(null);
            }
        }

        return $this;
    }
}
