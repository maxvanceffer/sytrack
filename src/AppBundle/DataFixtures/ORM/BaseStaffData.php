<?php
/**
 * Created by PhpStorm.
 * User: dev06
 * Date: 02.11.2016
 * Time: 10:07
 */

namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Component;
use AppBundle\Entity\Device;
use AppBundle\Entity\Priority;
use AppBundle\Entity\Status;
use AppBundle\Entity\Type;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class BaseStaffData implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        foreach(['Bug','Improvement', 'Bug report'] as $title) {
            $type = new Type();
            $type->setTitle($title);
            $manager->persist($type);
        }
        $manager->flush();

        foreach(['Blocker','Critical','Major','Minor'] as $title) {
            $type = new Priority();
            $type->setTitle($title);
            $manager->persist($type);
        }
        $manager->flush();

        foreach(['In progress','Open','Resolved','Fix released'] as $title) {
            $type = new Status();
            $type->setTitle($title);
            $manager->persist($type);
        }
        $manager->flush();

        $tags = ['News','Chat','Events','Music','Video','Picture','Settings','Imports','Menu','No category'];
        foreach($tags as $title) {
            $type = new Component();
            $type->setTitle($title);
            $manager->persist($type);
        }
        $manager->flush();


        $devices = [
            [
                'manufacturer' => 'Meizu',
                'model' => 'MX4'
            ],
            [
                'manufacturer' => 'Bq',
                'model' => '5'
            ]
        ];

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach($devices as $device) {
            $type = new Device();

            try {
                foreach($device as $property => $value) {
                    if($accessor->isWritable($type, $property))
                        $accessor->setValue($type, $property, $value);
                }
            }catch(\Exception $e) {
                continue;
            }

            $manager->persist($type);
        }
        $manager->flush();
    }
}
