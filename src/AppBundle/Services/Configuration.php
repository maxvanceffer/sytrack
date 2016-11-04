<?php
/**
 * Created by PhpStorm.
 * User: dev06
 * Date: 04.11.2016
 * Time: 09:51
 */

namespace AppBundle\Services;
use AppBundle\Entity\User;
use AppBundle\Entity\WebsiteConfig;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class Configuration
 *
 * @package AppBundle\Services
 */
class Configuration
{
    /**
     * @var WebsiteConfig $configuration
     */
    private $config;

    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * Configuration constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     */
    private function requestConfig()
    {
        return $this->config =  $this->em
            ->getRepository('AppBundle:WebsiteConfig')
            ->findOneBy(array('current' => 1))
        ;
    }

    public function configuration()
    {
        if(!$this->config)
            return $this->requestConfig();

        return $this->config;
    }
}
