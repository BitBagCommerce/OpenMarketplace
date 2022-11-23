<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\OpenMarketplace\Api\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use BitBag\OpenMarketplace\Entity\VendorInterface;
use BitBag\OpenMarketplace\Generator\VendorSlugGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class VendorSlugEventSubscriber implements EventSubscriberInterface
{
    private VendorSlugGeneratorInterface $vendorSlugGenerator;

    public function __construct(VendorSlugGeneratorInterface $vendorSlugGenerator)
    {
        $this->vendorSlugGenerator = $vendorSlugGenerator;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['generateSlug', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function generateSlug(ViewEvent $event): void
    {
        $vendor = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (
            !$vendor instanceof VendorInterface ||
            !in_array($method, [Request::METHOD_POST, Request::METHOD_PUT], true)
        ) {
            return;
        }

        $slug = $this->vendorSlugGenerator->generateSlug($vendor->getCompanyName());
        $vendor->setSlug($slug);

        $event->setControllerResult($slug);
    }
}
