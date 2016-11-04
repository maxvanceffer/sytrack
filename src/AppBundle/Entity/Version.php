<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Version
 *
 * @ORM\Table(name="version")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VersionRepository")
 */
class Version
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
     * @var int
     *
     * @ORM\Column(name="major", type="integer")
     */
    private $major;

    /**
     * @var int
     *
     * @ORM\Column(name="minor", type="integer")
     */
    private $minor;

    /**
     * @var int
     *
     * @ORM\Column(name="revision", type="integer")
     */
    private $revision;

    /**
     * Version constructor.
     */
    public function __construct()
    {
        $this->major = 0;
        $this->minor = 0;
        $this->revision = 1;
    }

    public function __toString()
    {
        return sprintf('%s.%s.%s', $this->major, $this->minor, $this->revision);
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
     * Set major
     *
     * @param integer $major
     *
     * @return Version
     */
    public function setMajor($major)
    {
        $this->major = $major;

        return $this;
    }

    /**
     * Get major
     *
     * @return int
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * Set minor
     *
     * @param integer $minor
     *
     * @return Version
     */
    public function setMinor($minor)
    {
        $this->minor = $minor;

        return $this;
    }

    /**
     * Get minor
     *
     * @return int
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * Set revision
     *
     * @param integer $revision
     *
     * @return Version
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get revision
     *
     * @return int
     */
    public function getRevision()
    {
        return $this->revision;
    }
}

