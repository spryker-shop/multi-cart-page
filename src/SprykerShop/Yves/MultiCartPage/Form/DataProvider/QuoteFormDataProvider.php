<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\MultiCartPage\Form\DataProvider;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerShop\Yves\MultiCartPage\Dependency\Client\MultiCartPageToMultiCartClientInterface;

class QuoteFormDataProvider implements QuoteFormDataProviderInterface
{
    /**
     * @var \SprykerShop\Yves\MultiCartPage\Dependency\Client\MultiCartPageToMultiCartClientInterface
     */
    protected $multiCartClient;

    public function __construct(MultiCartPageToMultiCartClientInterface $multiCartClient)
    {
        $this->multiCartClient = $multiCartClient;
    }

    public function getData(?int $idQuote = null): ?QuoteTransfer
    {
        if ($idQuote) {
            return $this->multiCartClient->findQuoteById($idQuote);
        }

        return new QuoteTransfer();
    }
}
