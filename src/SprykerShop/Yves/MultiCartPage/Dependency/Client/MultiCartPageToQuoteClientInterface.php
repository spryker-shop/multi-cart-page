<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\MultiCartPage\Dependency\Client;

use Generated\Shared\Transfer\QuoteTransfer;

interface MultiCartPageToQuoteClientInterface
{
    public function isQuoteEditable(QuoteTransfer $quoteTransfer): bool;
}
