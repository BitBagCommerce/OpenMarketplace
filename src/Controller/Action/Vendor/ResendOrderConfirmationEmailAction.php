<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusMultiVendorMarketplacePlugin\Controller\Action\Vendor;

use Sylius\Bundle\AdminBundle\EmailManager\OrderEmailManagerInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

final class ResendOrderConfirmationEmailAction
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private OrderEmailManagerInterface $orderEmailManager,
        private CsrfTokenManagerInterface $csrfTokenManager,
        private Session $session,
        ) {
    }

    public function __invoke(Request $request): Response
    {
        $orderId = $request->attributes->get('id');

        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken($orderId, (string) $request->query->get('_csrf_token')))) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Invalid csrf token.');
        }

        /** @var OrderInterface|null $order */
        $order = $this->orderRepository->find($orderId);
        if (null === $order) {
            throw new NotFoundHttpException(sprintf('The order with id %s has not been found', $orderId));
        }

        $this->orderEmailManager->sendConfirmationEmail($order);

        $this->session->getFlashBag()->add(
            'success',
            'sylius.email.order_confirmation_resent',
        );

        return new RedirectResponse($request->headers->get('referer'));
    }
}
