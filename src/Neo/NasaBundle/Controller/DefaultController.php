<?php

namespace Neo\NasaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package Neo\NasaBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function helloAction()
    {
        return new Response($this->get("jms_serializer")->serialize(['hello' => "world"], 'json'));
    }
}
