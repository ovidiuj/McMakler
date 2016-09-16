<?php

namespace Neo\NasaBundle\DTO;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Neo
 * @package Neo\NasaBundle\DTO
 */
class Neo
{
    /**
     * @JMS\Type ("ArrayCollection")
     */
    public $links;

    /**
     * @JMS\Type("integer")
     */
    public $element_count;

    /**
     * @JMS\Type("ArrayCollection")
     */
    public $near_earth_objects;
}