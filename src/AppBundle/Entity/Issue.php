<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Issue
 *
 * @ORM\Table(name="issue")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IssueRepository")
 */
class Issue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ManyToOne(targetEntity="Type")
     * @JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @var int
     *
     * @ManyToOne(targetEntity="Status")
     * @JoinColumn(name="status_id", referencedColumnName="id")
     */
    private $status;

    /**
     * @var int
     *
     * @ManyToOne(targetEntity="Priority")
     * @JoinColumn(name="priority_id", referencedColumnName="id")
     */
    private $priority;

    /**
     * @var int
     *
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $reportedBy;

    /**
     * @var int
     *
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $resolvedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var int
     *
     * @ManyToOne(targetEntity="Component")
     * @JoinColumn(name="component_id", referencedColumnName="id")
     */
    private $component;

    /**
     * @var int
     *
     * @ManyToOne(targetEntity="Version")
     * @JoinColumn(name="version_id", referencedColumnName="id")
     */
    private $affectVersion;

    /**
     * @var int
     *
     * @ManyToOne(targetEntity="Version")
     * @JoinColumn(name="version_id", referencedColumnName="id")
     */
    private $fixVersion;

    /**
     * Issue constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
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
     * @return Issue
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
     * Set description
     *
     * @param string $description
     *
     * @return Issue
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Issue
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Issue
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return Issue
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set reportedBy
     *
     * @param integer $reportedBy
     *
     * @return Issue
     */
    public function setReportedBy($reportedBy)
    {
        $this->reportedBy = $reportedBy;

        return $this;
    }

    /**
     * Get reportedBy
     *
     * @return int
     */
    public function getReportedBy()
    {
        return $this->reportedBy;
    }

    /**
     * Set resolvedBy
     *
     * @param integer $resolvedBy
     *
     * @return Issue
     */
    public function setResolvedBy($resolvedBy)
    {
        $this->resolvedBy = $resolvedBy;

        return $this;
    }

    /**
     * Get resolvedBy
     *
     * @return int
     */
    public function getResolvedBy()
    {
        return $this->resolvedBy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Issue
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Issue
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set component
     *
     * @param integer $component
     *
     * @return Issue
     */
    public function setComponent($component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Get component
     *
     * @return int
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Set affectVersion
     *
     * @param integer $affectVersion
     *
     * @return Issue
     */
    public function setAffectVersion($affectVersion)
    {
        $this->affectVersion = $affectVersion;

        return $this;
    }

    /**
     * Get affectVersion
     *
     * @return int
     */
    public function getAffectVersion()
    {
        return $this->affectVersion;
    }

    /**
     * Set fixVersion
     *
     * @param integer $fixVersion
     *
     * @return Issue
     */
    public function setFixVersion($fixVersion)
    {
        $this->fixVersion = $fixVersion;

        return $this;
    }

    /**
     * Get fixVersion
     *
     * @return int
     */
    public function getFixVersion()
    {
        return $this->fixVersion;
    }
}

