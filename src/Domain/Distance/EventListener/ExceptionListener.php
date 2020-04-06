<?php

namespace App\Domain\Distance\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use ApiException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if(!$exception instanceof ApiException)
        {
            return;
        }
        $response = new JsonResponse(['error'=>$exception->getMessage()], $exception->getCode()?:400);
        $event->setResponse($response);
    }
}