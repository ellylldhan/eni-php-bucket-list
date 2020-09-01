<?php

namespace App\Entity;

use App\Repository\IdeaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IdeaRepository::class)
 */
class Idea {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Donnez un titre")
     * @Assert\Length(
     *     max=255, maxMessage="Trop de caractères ! Max. 255",
     *     min=3, minMessage="Donnez un titre plus long ! Min. {{ limit }} lettres")
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Assert\NotBlank(message="Donnez une description")
     * @Assert\Length(
     *     max=1000, maxMessage="T'en dis trop ! Max. {{ limit }} signes",
     *     min=3, minMessage="Allez, raconte ! Min. {{ limit }} signes")
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\NotBlank(message="C'est à quel nom ?")
     * @Assert\Length(max=25, maxMessage="Trop de caractères ! Max. 25")
     * @ORM\Column(type="string", length=25)
     */
    private $author;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isPublished;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @var \App\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Category", inversedBy="ideas", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;



    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string {
        return $this->author;
    }

    public function setAuthor(string $author): self {
        $this->author = $author;

        return $this;
    }

    public function getIsPublished(): ?bool {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }





}
