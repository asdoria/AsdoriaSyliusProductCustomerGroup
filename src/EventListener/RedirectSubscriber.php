<?php


declare(strict_types=1);

namespace Asdoria\SyliusProductCustomerGroupPlugin\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Webmozart\Assert\Assert;

/**
 * Class RedirectSubscriber
 * @package Asdoria\SyliusProductCustomerGroupPlugin\EventListener
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class RedirectSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse'],
        ];
    }

    private Session $session;

    /**
     * @param Session $session
     */
    public function __construct (
        Session $session
    ) {
        $this->session = $session;
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $request = $event->getRequest();

        if (!$request->attributes->has(AccessCheckListener::_REDIRECT_ATTRIBUTE)) {
            return;
        }

        $redirectResponse = $request->attributes->get(AccessCheckListener::_REDIRECT_ATTRIBUTE);
        if ($redirectResponse instanceof RedirectResponse) {
            $event->setResponse($redirectResponse);
            $this->session->getFlashBag()->add('info', 'asdoria.ui.you_are_not_allowed_to_access_product');
        }
    }
}
