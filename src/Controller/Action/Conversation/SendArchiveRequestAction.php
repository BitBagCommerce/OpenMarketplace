<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Controller\Action\Conversation;

use ApiPlatform\Core\Api\UrlGeneratorInterface;
use BitBag\OpenMarketplace\Facade\Message\AddMessageFacadeInterface;
use BitBag\OpenMarketplace\Factory\Message\MessageFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class SendArchiveRequestAction
{
    private AddMessageFacadeInterface $addMessageFacade;

    private UrlGeneratorInterface $urlGenerator;

    private MessageFactoryInterface $messageFactory;

    public function __construct(
        AddMessageFacadeInterface $addMessageFacade,
        UrlGeneratorInterface $urlGenerator,
        MessageFactoryInterface $messageFactory
    ) {
        $this->addMessageFacade = $addMessageFacade;
        $this->urlGenerator = $urlGenerator;
        $this->messageFactory = $messageFactory;
    }

    public function __invoke(int $id, Request $request): Response
    {
        $redirect = $request->attributes->get('_sylius')['redirect'];

        $archiveRequestMessage = $this->messageFactory->createNewWithArchiveRequest();

        $this->addMessageFacade
            ->createWithConversation($id, $archiveRequestMessage, null, false);

        return new RedirectResponse($this->urlGenerator->generate($redirect, [
            'id' => $id,
        ]));
    }
}
