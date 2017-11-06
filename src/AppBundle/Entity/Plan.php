<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="plan")
 */
class Plan
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", nullable=false, length=100)
     */
    protected $title;

    /**
     * @ORM\Column(type="integer", nullable=false, length=100)
     */
    protected $maxTasks;

    /**
     * One Plan has Many Users.
     * @ORM\OneToMany(targetEntity="User", mappedBy="plan")
     */
    private $users;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Plan
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set maxTasks
     *
     * @param integer $maxTasks
     *
     * @return Plan
     */
    public function setMaxTasks($maxTasks)
    {
        $this->maxTasks = $maxTasks;

        return $this;
    }

    /**
     * Get maxTasks
     *
     * @return integer
     */
    public function getMaxTasks()
    {
        return $this->maxTasks;
    }

    /**
     * Set startedAt
     *
     * @param \DateTime $startedAt
     *
     * @return Plan
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Get startedAt
     *
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }
}
