<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\MultiCartPage\Dependency\Client;

use Generated\Shared\Transfer\QuoteResponseTransfer;

class MultiCartPageToCartClientBridge implements MultiCartPageToCartClientInterface
{
    /**
     * @var \Spryker\Client\Cart\CartClientInterface
     */
    protected $cartClient;

    /**
     * @param \Spryker\Client\Cart\CartClientInterface $cartClient
     */
    public function __construct($cartClient)
    {
        $this->cartClient = $cartClient;
    }

    /**
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     */
    public function validateQuote(): QuoteResponseTransfer
    {
        return $this->cartClient->validateQuote();
    }
}
