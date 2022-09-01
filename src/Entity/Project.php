<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=10, nullable=false)
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Epic", mappedBy="project")
     */
    private $epics;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Release", mappedBy="project")
     */
    private $releases;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserProject", mappedBy="project")
     */
    private $userProjects;

    public function __construct()
    {
        $this->epics = new ArrayCollection();
        $this->releases = new ArrayCollection();
        $this->userProjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Epic>
     */
    public function getEpics(): Collection
    {
        return $this->epics;
    }

    public function addEpic(Epic $epic): self
    {
        if (!$this->epics->contains($epic)) {
            $this->epics->add($epic);
            $epic->setProject($this);
        }

        return $this;
    }

    public function removeEpic(Epic $epic): self
    {
        if ($this->epics->removeElement($epic)) {
            // set the owning side to null (unless already changed)
            if ($epic->getProject() === $this) {
                $epic->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Release>
     */
    public function getReleases(): Collection
    {
        return $this->releases;
    }

    public function addRelease(Release $release): self
    {
        if (!$this->releases->contains($release)) {
            $this->releases->add($release);
            $release->setProject($this);
        }

        return $this;
    }

    public function removeRelease(Release $release): self
    {
        if ($this->releases->removeElement($release)) {
            // set the owning side to null (unless already changed)
            if ($release->getProject() === $this) {
                $release->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserProject>
     */
    public function getUserProjects(): Collection
    {
        return $this->userProjects;
    }

    public function addUserProject(UserProject $userProject): self
    {
        if (!$this->userProjects->contains($userProject)) {
            $this->userProjects->add($userProject);
            $userProject->setProject($this);
        }

        return $this;
    }

    public function removeUserProject(UserProject $userProject): self
    {
        if ($this->userProjects->removeElement($userProject)) {
            // set the owning side to null (unless already changed)
            if ($userProject->getProject() === $this) {
                $userProject->setProject(null);
            }
        }

        return $this;
    }
}