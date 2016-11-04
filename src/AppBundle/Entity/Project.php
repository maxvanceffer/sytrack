<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use AppBundle\Entity\Version;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
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
     * @Assert\NotBlank(message="Project name can not be empty")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Project title must be at least {{ limit }} characters long",
     *      maxMessage = "Project title cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="title", type="string", length=50, unique=true)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ManyToOne(targetEntity="Version")
     * @JoinColumn(name="version_id", referencedColumnName="id")
     *
     * @var Version $currentVersion
     */
    private $currentVersion;

    /**
     * @ManyToMany(targetEntity="Version")
     * @JoinTable(name="version_groups",
     *      joinColumns={@JoinColumn(name="version_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="group_id", referencedColumnName="id")}
     *      )
     */
    private $versions;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->versions  = new ArrayCollection();
        $this->createdAt = new \DateTime();
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
     * @return Project
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Project
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
     * @return mixed
     */
    public function getCurrentVersion()
    {
        return $this->currentVersion;
    }

    /**
     * @param mixed $currentVersion
     */
    public function setCurrentVersion($currentVersion)
    {
        $this->currentVersion = $currentVersion;
    }

    /**
     * @return mixed
     */
    public function getVersions()
    {
        return $this->versions;
    }

    /**
     * @param mixed $versions
     */
    public function setVersions($versions)
    {
        $this->versions = $versions;
    }

    /**
     * @param \AppBundle\Entity\Version $version
     *
     * @return $this
     */
    public function addVersion(Version $version)
    {
        if($this->versions->exists($version))
            return $this;

        $this->versions->add($version);
        return $this;
    }
}

