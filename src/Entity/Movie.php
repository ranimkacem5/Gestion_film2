<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[Vich\Uploadable]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $releaseyear = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?float $rating = null;

    #[ORM\Column(length: 255)]
    private ?string $director = null;
   // #[ORM\Column(length: 255, nullable: true)]
   // private ?string $image = null;
   #[ORM\Column(type: 'datetime_immutable', nullable: true)]
   private ?\DateTimeImmutable $updatedAt = null;
   
   public function getUpdatedAt(): ?\DateTimeImmutable
   {
       return $this->updatedAt;
   }
   
   public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
   {
       $this->updatedAt = $updatedAt;
       return $this;
   }
   
    #[Vich\UploadableField(mapping: 'movie_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'movies')]
    private Collection $Categories;

    #[ORM\Column(length: 255)]
    private ?string $Url = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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
    //public function getImage(): ?string
//{
    //return $this->image;
//}

//public function setImage(?string $image): static
//{
    //$this->image = $image;

    //return $this;
//}
public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
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
    }

    return $this;
}

public function removeCategory(Categorie $category): static
{
    $this->Categories->removeElement($category);

    return $this;
}

public function getUrl(): ?string
{
    return $this->Url;
}

public function setUrl(string $Url): static
{
    $this->Url = $Url;

    return $this;
}


   
}
