<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Worklog
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $worklog;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Task", inversedBy="worklogs")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id", nullable=false)
     */
    private $task;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="worklogs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getWorklog(): ?int
    {
        return $this->worklog;
    }

    public function setWorklog(int $worklog): self
    {
        $this->worklog = $worklog;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}