<?php

namespace Neo\NasaBundle\Services;


use JMS\Serializer\Serializer;
use Neo\NasaBundle\Document\Neo;

/**
 * Class NasaContentService
 * @package Neo\NasaBundle\Services
 */
class NasaContentService
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var array
     */
    protected $documentCollection;

    /**
     * @var integer
     */
    protected $elementCnt;

    /**
     * NasaContentService constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer) 
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     */
    private function dataTransferObject($data)
    {
        $dto = $this->serializer->deserialize($data, 'Neo\NasaBundle\DTO\Neo', 'json');
        $this->elementCnt = $dto->element_count;
        foreach ($dto->near_earth_objects as $date => $objects)  {
            foreach ($objects as $object) {
                $document = new Neo();
                $document->setDate($date);
                $document->setName($object['name']);
                $document->setReference((int) $object['neo_reference_id']) ;
                $document->setSpeed((float) $object['close_approach_data'][0]['relative_velocity']['kilometers_per_hour']);
                $document->setIsHazardous((bool) $object['is_potentially_hazardous_asteroid']);
                $this->documentCollection[] = $document;
            }
        }
    }

    /**
     * @param $data
     * @return array
     */
    public function getNeoDocumentCollection($data) {

        $this->dataTransferObject($data);
        return $this->documentCollection;
    }

    /**
     * @return int
     */
    public function getNeoCnt() 
    {
        return $this->elementCnt;
    }
}