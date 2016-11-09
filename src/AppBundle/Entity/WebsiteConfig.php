<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * WebsiteConfig
 *
 * @ORM\Table(name="website_config")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WebsiteConfigRepository")
 */
class WebsiteConfig
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
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @OneToOne(targetEntity="Project")
     * @JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @ORM\Column(name="current", type="integer", unique=true)
     * @var integer $current
     */
    private $current;

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
     * @return bool
     */
    public function isConfigured()
    {
        return null !== $this->project;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return WebsiteConfig
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return boolean
     */
    public function isCurrent()
    {
        return $this->current;
    }

    /**
     * @param boolean $current
     */
    public function setCurrent($current)
    {
        $this->current = $current;
    }

    public function currentVersion()
    {
        return $this->project->getCurrentVersion();
    }
}

