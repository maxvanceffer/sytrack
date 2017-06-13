<?php
/**
 * Created by PhpStorm.
 * User: dev06
 * Date: 13.06.2017
 * Time: 10:10
 */

namespace AppBundle\Entity;


use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Objects implementing JsonSerializable
 * can customize their JSON representation when encoded with
 * <b>json_encode</b>.
 *
 * @link http://php.net/manual/en/class.jsonserializable.php
 */
class Serializable implements \JsonSerializable
{

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * @throws \Symfony\Component\PropertyAccess\Exception\InvalidArgumentException
     *        which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $properties = get_object_vars($this);
        $json = [];

        foreach($properties as $property) {
            if($accessor->isReadable($property))
                $json[$property] = $accessor->getValue($this, $property);
        }

        return $json;
    }

    public function parseRequest(Request $request)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        $json = (array)json_decode($request->getContent());

        foreach($json as $property => $value) {
            if($accessor->isWritable($property))
                $accessor->setValue($this, $property, $value);
        }
    }
}
