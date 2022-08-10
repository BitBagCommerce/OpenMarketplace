<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusMultiVendorMarketplacePlugin\Manager;

use BitBag\SyliusMultiVendorMarketplacePlugin\Entity\OrderInterface;
use BitBag\SyliusMultiVendorMarketplacePlugin\Entity\OrderItemInterface;
use BitBag\SyliusMultiVendorMarketplacePlugin\Entity\VendorInterface;

interface OrderManagerInterface
{
    public function generateNewSecondaryOrder(
        OrderInterface $order,
        VendorInterface $itemVendor,
        OrderItemInterface $item
    ): OrderInterface;

    public function addItemIntoSecondaryOrder(
        array $secondaryOrders,
        VendorInterface $itemVendor,
        OrderItemInterface $item
    ): void;
}
