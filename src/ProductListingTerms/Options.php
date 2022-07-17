<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusMultiVendorMarketplacePlugin\ProductListingTerms;

use BitBag\SyliusMultiVendorMarketplacePlugin\Entity\ProductListing\ProductDraftInterface;

final class Options
{
    public const STATUS_UNDER_VERIFICATION = 'bitbag_mvm_plugin.ui.under_verification';

    public const STATUS_VERIFIED = 'bitbag_mvm_plugin.ui.verified';

    public const STATUS_REJECTED = 'bitbag_mvm_plugin.ui.rejected';

    public static function getTypeFilter(): array
    {
        return [
            self::STATUS_UNDER_VERIFICATION => ProductDraftInterface::STATUS_UNDER_VERIFICATION,
            self::STATUS_VERIFIED => ProductDraftInterface::STATUS_VERIFIED,
            self::STATUS_REJECTED => ProductDraftInterface::STATUS_REJECTED,
        ];
    }
}