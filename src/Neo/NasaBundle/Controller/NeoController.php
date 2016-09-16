<?php

namespace Neo\NasaBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NeoController
 * @package Neo\NasaBundle\Controller
 */
class NeoController extends Controller
{
    /**
     * @return Response
     */
    public function hazardousAction()
    {
        $response = $this->getService()->getHazardousObjects();
        return new Response($this->get("jms_serializer")->serialize($response, 'json'));
    }

    /**
     * @return Response
     */
    public function fastestAction()
    {
        $response = $this->getService()->getFastestObject();
        return new Response($this->get("jms_serializer")->serialize($response, 'json'));
    }

    /**
     * @return object
     */
    protected function getService()
    {
        return $this->get("neo.db.service");
    }
}