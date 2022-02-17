<?php

namespace Asdoria\SyliusProductCustomerGroupPlugin\EventListener;

use Asdoria\SyliusProductCustomerGroupPlugin\Model\Aware\CustomerGroupsAwareInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Customer\Model\CustomerGroupInterface;
use Sylius\Component\User\Model\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 *
 */
class AccessCheckListener
{
    const _CHECKED_ROUTES = ['sylius_shop_product_show'];

    private TokenStorageInterface $tokenStorage;
    private UrlGeneratorInterface $router;
    private RequestStack $requestStack;
    private Session $session;

    public function __construct (
        TokenStorageInterface $tokenStorage,
        UrlGeneratorInterface $router,
        RequestStack $requestStack,
        Session $session
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->router = $router;
        $this->requestStack = $requestStack;
        $this->session = $session;
    }

    /**
     * @param ResourceControllerEvent $event
     * @return void
     */
    public function onCheck(ResourceControllerEvent $event): void
    {
        $resource = $event->getSubject();
        if (!$resource instanceof CustomerGroupsAwareInterface) {
            return;
        }

        if (!$resource->hasCustomerGroups()) {
            return;
        }

        $request = $this->requestStack->getMainRequest();
        $routeName = $request->attributes->get('_route');

        if(!in_array($routeName, self::_CHECKED_ROUTES)) {
            return;
        }

        try {
            /** @var ShopUserInterface $user */
            /** @var CustomerGroupInterface $group */
            $user  = $this->getUser();
            $group = $user->getCustomer()->getGroup();
            if(!$resource->hasCustomerGroup($group)) {
                throw new \InvalidArgumentException('user is not granted');
            }
        } catch (\Throwable $exception) {
            $this->session->getFlashBag()->add('error', 'asdoria.ui.you_are_not_allowed_to_access_product');
            $event->setResponse($this->getRedirectResponse($resource, $request->headers->get('referer')));
        }
    }

    /**
     * @return UserInterface
     */
    protected function getUser(): UserInterface
    {
        if (!$this->tokenStorage) {
            throw new \LogicException('The SecurityBundle is not registered in your application. Try running "composer require symfony/security-bundle".');
        }

        if (null === $token = $this->tokenStorage ->getToken()) {
            throw new \InvalidArgumentException('token not found');
        }

        if (!\is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            throw new \InvalidArgumentException('user not found');
        }
        /** @var $user UserInterface */
        return $user;
    }

    /**
     * @param ProductInterface $product
     * @param string|null $referer
     * @return RedirectResponse
     */
    private function getRedirectResponse(ProductInterface $product, ?string $referer): RedirectResponse
    {
        if ($product->getMainTaxon() instanceof TaxonInterface) {
            return new RedirectResponse(
                $this->router->generate('sylius_shop_product_index', ['slug'=> $product->getMainTaxon()->getSlug()])
            );
        }

        if (null !== $referer) {
            return new RedirectResponse($referer);
        }

        return new RedirectResponse($this->router->generate('sylius_shop_homepage'));
    }


}