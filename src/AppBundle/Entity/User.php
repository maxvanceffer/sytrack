<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="uq_code", type="string", length=255, unique=true)
     */
    private $uqCode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="device_name", type="string", length=255, nullable=true)
     */
    private $deviceName;

    /**
     * @ORM\Column(name="last_seen", type="datetime", nullable=true)
     * @var \DateTime $lastSeenAt
     */
    private $lastSeenAt;

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
     * Set uqCode
     *
     * @param string $uqCode
     *
     * @return User
     */
    public function setUqCode($uqCode)
    {
        $this->uqCode = $uqCode;

        return $this;
    }

    /**
     * Get uqCode
     *
     * @return string
     */
    public function getUqCode()
    {
        return $this->uqCode;
    }

    /**
     * Set deviceName
     *
     * @param string $deviceName
     *
     * @return User
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;

        return $this;
    }

    /**
     * Get deviceName
     *
     * @return string
     */
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    /**
     * @return \DateTime
     */
    public function getLastSeenAt()
    {
        return $this->lastSeenAt;
    }

    /**
     * @param \DateTime $lastSeenAt
     */
    public function setLastSeenAt($lastSeenAt)
    {
        $this->lastSeenAt = $lastSeenAt;
    }

    /**
     *
     */
    public function isOnline()
    {
        $diff = $this->lastSeenAt->diff(new DateTime());
        if($diff) return true;
        return false;
    }
}

