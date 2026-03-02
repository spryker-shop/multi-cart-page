<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\MultiCartPage\Dependency\Client;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface MultiCartPageToMultiCartClientInterface
{
    public function getDefaultCart(): QuoteTransfer;

    public function markQuoteAsDefault(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;

    /**
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function getQuoteCollection();

    public function findQuoteById(int $idQuote): ?QuoteTransfer;

    public function createQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;

    public function updateQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;

    public function deleteQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;

    public function duplicateQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;

    public function clearQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;

    public function isQuoteDeletable(): bool;
}
