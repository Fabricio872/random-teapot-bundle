<?php

namespace Fabricio872\RandomTeapotBundle\EventListener;

use Psr\EventDispatcher\StoppableEventInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

final class RequestListener
{
    public function __construct(
        private float           $randomness,
        private string          $pathFilter,
        private string          $template,
        private Environment     $twig,
        private LoggerInterface $logger
    )
    {
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $uri = $this->getUri($event);

        $this->logger->debug(sprintf('Uri "%s" is%s available for teapoting', $uri, fnmatch($this->pathFilter, $uri) ? '' : ' not'));

        if (!fnmatch($this->pathFilter, $uri)){
            return null;
        }

        $number = rand(0, getrandmax()) * $this->randomness;
        if ($event->isMainRequest() && floor($number) == $number) {

            $this->getResponse()->send();
            die();
        }
        return null;
    }

    private function getResponse(): Response
    {
        $response = new Response();
        $response->setStatusCode(418);

        $response->setContent($this->twig->render($this->template));
        return $response;
    }

    private function getUri(KernelEvent $event): string
    {
        return substr($event->getRequest()->headers->get('referer'),
            strlen($event->getRequest()->server->get('SECURE_SCHEME')) + 3 +
            strlen($event->getRequest()->server->get('HTTP_HOST'))
        );
    }
}