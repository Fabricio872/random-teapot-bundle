<?php

namespace Fabricio872\RandomTeapotBundle\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

final class RequestListener
{
    public function __construct(
        private float       $randomness,
        private Environment $twig
    )
    {
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $number = rand(0, 65535) * $this->randomness;
        if ($event->isMainRequest() && floor($number) == $number) {

            $response = new Response();
            $response->setStatusCode(418);

            $response->setContent($this->twig->render('@RandomTeapot/i_am_a_teapod.html.twig'));
            $response->send();
            die();
        }
        return null;
    }
}