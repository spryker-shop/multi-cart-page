<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\MultiCartPage\Plugin\Provider;

use Silex\Application;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

class MultiCartPageControllerProvider extends AbstractYvesControllerProvider
{
    public const ROUTE_MULTI_CART_CREATE = 'multi-cart/create';
    public const ROUTE_MULTI_CART_UPDATE = 'multi-cart/update';
    public const ROUTE_MULTI_CART_DELETE = 'multi-cart/delete';
    public const ROUTE_MULTI_CART_CONFIRM_DELETE = 'multi-cart/confirm-delete';
    public const ROUTE_MULTI_CART_SET_DEFAULT = 'multi-cart/set-default';
    public const ROUTE_MULTI_CART_CLEAR = 'multi-cart/clear';
    public const ROUTE_MULTI_CART_DUPLICATE = 'multi-cart/duplicate';

    public const PARAM_ID_QUOTE = 'idQuote';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $this->addMultiCartCreateRoute()
            ->addMultiCartUpdateRoute()
            ->addMultiCartDeleteRoute()
            ->addMultiCartConfirmDeleteRoute()
            ->addMultiCartClearRoute()
            ->addMultiCartDuplicateRoute()
            ->addMultiCartSetDefaultRoute();
    }

    /**
     * @return $this
     */
    protected function addMultiCartCreateRoute(): self
    {
        $this->createController('/{multiCart}/create', static::ROUTE_MULTI_CART_CREATE, 'MultiCartPage', 'MultiCart', 'create')
            ->assert('multiCart', $this->getAllowedLocalesPattern() . 'multi-cart|multi-cart')
            ->value('multiCart', 'multi-cart');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addMultiCartUpdateRoute(): self
    {
        $this->createController('/{multiCart}/update/{idQuote}', static::ROUTE_MULTI_CART_UPDATE, 'MultiCartPage', 'MultiCart', 'update')
            ->assert('multiCart', $this->getAllowedLocalesPattern() . 'multi-cart|multi-cart')
            ->assert(self::PARAM_ID_QUOTE, '\d+')
            ->value('multiCart', 'multi-cart');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addMultiCartDeleteRoute(): self
    {
        $this->createGetController('/{multiCart}/delete/{idQuote}', static::ROUTE_MULTI_CART_DELETE, 'MultiCartPage', 'MultiCart', 'delete')
            ->assert('multiCart', $this->getAllowedLocalesPattern() . 'multi-cart|multi-cart')
            ->assert(self::PARAM_ID_QUOTE, '\d+')
            ->value('multiCart', 'multi-cart');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addMultiCartConfirmDeleteRoute(): self
    {
        $this->createGetController('/{multiCart}/confirm-delete/{idQuote}', static::ROUTE_MULTI_CART_CONFIRM_DELETE, 'MultiCartPage', 'MultiCart', 'confirmDelete')
            ->assert('multiCart', $this->getAllowedLocalesPattern() . 'multi-cart|multi-cart')
            ->assert(self::PARAM_ID_QUOTE, '\d+')
            ->value('multiCart', 'multi-cart');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addMultiCartClearRoute(): self
    {
        $this->createGetController('/{multiCart}/clear/{idQuote}', static::ROUTE_MULTI_CART_CLEAR, 'MultiCartPage', 'MultiCart', 'clear')
            ->assert('multiCart', $this->getAllowedLocalesPattern() . 'multi-cart|multi-cart')
            ->assert(self::PARAM_ID_QUOTE, '\d+')
            ->value('multiCart', 'multi-cart');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addMultiCartDuplicateRoute(): self
    {
        $this->createGetController('/{multiCart}/duplicate/{idQuote}', static::ROUTE_MULTI_CART_DUPLICATE, 'MultiCartPage', 'MultiCart', 'duplicate')
            ->assert('multiCart', $this->getAllowedLocalesPattern() . 'multi-cart|multi-cart')
            ->assert(self::PARAM_ID_QUOTE, '\d+')
            ->value('multiCart', 'multi-cart');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addMultiCartSetDefaultRoute(): self
    {
        $this->createGetController('/{multiCart}/set-default/{idQuote}', static::ROUTE_MULTI_CART_SET_DEFAULT, 'MultiCartPage', 'MultiCart', 'setDefault')
            ->assert('multiCart', $this->getAllowedLocalesPattern() . 'multi-cart|multi-cart')
            ->assert(self::PARAM_ID_QUOTE, '\d+')
            ->value('multiCart', 'multi-cart');

        return $this;
    }
}
