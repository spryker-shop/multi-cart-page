<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\MultiCartPage\Dependency\Client;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class MultiCartPageToMultiCartClientBridge implements MultiCartPageToMultiCartClientInterface
{
    /**
     * @var \Spryker\Client\MultiCart\MultiCartClientInterface
     */
    protected $multiCartClient;

    /**
     * @param \Spryker\Client\MultiCart\MultiCartClientInterface $multiCartClient
     */
    public function __construct($multiCartClient)
    {
        $this->multiCartClient = $multiCartClient;
    }

    public function getDefaultCart(): QuoteTransfer
    {
        return $this->multiCartClient->getDefaultCart();
    }

    public function markQuoteAsDefault(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->multiCartClient->markQuoteAsDefault($quoteTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function getQuoteCollection()
    {
        return $this->multiCartClient->getQuoteCollection();
    }

    public function findQuoteById(int $idQuote): ?QuoteTransfer
    {
        return $this->multiCartClient->findQuoteById($idQuote);
    }

    public function createQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->multiCartClient->createQuote($quoteTransfer);
    }

    public function updateQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->multiCartClient->updateQuote($quoteTransfer);
    }

    public function deleteQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->multiCartClient->deleteQuote($quoteTransfer);
    }

    public function duplicateQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->multiCartClient->duplicateQuote($quoteTransfer);
    }

    public function clearQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        return $this->multiCartClient->clearQuote($quoteTransfer);
    }

    public function isQuoteDeletable(): bool
    {
        return $this->multiCartClient->isQuoteDeletable();
    }
}
