<?php

namespace BitBag\SyliusMultiVendorMarketplacePlugin\Factory;

use BitBag\SyliusMultiVendorMarketplacePlugin\Entity\VendorInterface;
use BitBag\SyliusMultiVendorMarketplacePlugin\Entity\VendorProfileUpdateInterface;

interface VendorProfileUpdateFactoryInterface
{
    public function createWithGeneratedTokenAndVendor(VendorInterface $vendor): VendorProfileUpdateInterface;
}