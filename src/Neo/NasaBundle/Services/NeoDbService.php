<?php

namespace Neo\NasaBundle\Services;


use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class NeoDbService
 * @package Neo\NasaBundle\Services
 */
class NeoDbService
{
    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * NeoDbService constructor.
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * @return array
     */
    public function getHazardousObjects() {
        $repository = $this->om->getRepository('NasaBundle:Neo');
        return $repository->findBy(['is_hazardous' => true]);
    }

    /**
     * @return array
     */
    public function getFastestObject() {
        $repository = $this->om->getRepository('NasaBundle:Neo');
        return $repository->findBy([], ['speed' => 'desc'], 1, 0);
    }
}