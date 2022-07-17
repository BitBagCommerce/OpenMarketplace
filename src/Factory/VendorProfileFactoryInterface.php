<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusMultiVendorMarketplacePlugin\Factory;

use BitBag\SyliusMultiVendorMarketplacePlugin\Entity\VendorAddressInterface;
use BitBag\SyliusMultiVendorMarketplacePlugin\Entity\VendorProfileInterface;

interface VendorProfileFactoryInterface
{
    public function createVendor(
        string $companyName,
        string $taxIdentifier,
        string $phoneNumber,
        string $description,
        VendorAddressInterface $address
    ): VendorProfileInterface;

    public function createNew(): VendorProfileInterface;
}
