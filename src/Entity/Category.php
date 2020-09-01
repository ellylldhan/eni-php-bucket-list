<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\App\Entity\Idea", mappedBy="category", cascade={"remove"})
     */
    private $ideas;


    public function __construct()
    {
        $this->ideas = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getIdeas()
    {
        return $this->ideas;
    }

    /**
     * @param ArrayCollection $ideas
     */
    public function setIdeas(ArrayCollection $ideas)
    {
        $this->ideas = $ideas;
    }


}
