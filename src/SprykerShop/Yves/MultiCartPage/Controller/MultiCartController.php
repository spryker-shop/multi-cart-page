<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\MultiCartPage\Controller;

use Generated\Shared\Transfer\QuoteTransfer;
use SprykerShop\Yves\CartPage\Plugin\Provider\CartControllerProvider;
use SprykerShop\Yves\MultiCartPage\Plugin\Provider\MultiCartPageControllerProvider;
use SprykerShop\Yves\ShopApplication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \SprykerShop\Yves\MultiCartPage\MultiCartPageFactory getFactory()
 */
class MultiCartController extends AbstractController
{
    public const GLOSSARY_KEY_CART_UPDATED_SUCCESS = 'multi_cart_widget.cart.updated.success';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $response = $this->executeCreateAction($request);

        if (!is_array($response)) {
            return $response;
        }

        return $this->view($response, [], '@MultiCartPage/views/cart-create/cart-create.twig');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function executeCreateAction(Request $request)
    {
        $quoteForm = $this->getFactory()
            ->getQuoteForm()
            ->handleRequest($request);

        if ($quoteForm->isSubmitted() && $quoteForm->isValid()) {
            $quoteTransfer = $quoteForm->getData();

            $quoteResponseTransfer = $this->getFactory()
                ->getMultiCartClient()
                ->createQuote($quoteTransfer);

            if ($quoteResponseTransfer->getIsSuccessful()) {
                return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
            }
        }

        return [
            'quoteForm' => $quoteForm->createView(),
        ];
    }

    /**
     * @param int $idQuote
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(int $idQuote, Request $request)
    {
        $response = $this->executeUpdateAction($idQuote, $request);

        if (!is_array($response)) {
            return $response;
        }

        return $this->view($response, [], '@MultiCartPage/views/cart-update/cart-update.twig');
    }

    /**
     * @param int $idQuote
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function executeUpdateAction(int $idQuote, Request $request)
    {
        $quoteForm = $this->getFactory()
            ->getQuoteForm($idQuote)
            ->handleRequest($request);

        $quoteTransfer = $quoteForm->getData();
        if ($quoteForm->isSubmitted() && $quoteForm->isValid()) {
            $quoteResponseTransfer = $this->getFactory()
                ->getMultiCartClient()
                ->updateQuote($quoteTransfer);

            if ($quoteResponseTransfer->getIsSuccessful()) {
                $this->addSuccessMessage(static::GLOSSARY_KEY_CART_UPDATED_SUCCESS);
                return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
            }
        }

        return [
            'cart' => $quoteTransfer,
            'quoteForm' => $quoteForm->createView(),
        ];
    }

    /**
     * @param int $idQuote
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function setDefaultAction(int $idQuote)
    {
        $quoteTransfer = $this->findQuoteOrFail($idQuote);

        $this->getFactory()
            ->getMultiCartClient()
            ->setDefaultQuote($quoteTransfer);

        return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }

    /**
     * @param int $idQuote
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function duplicateAction(int $idQuote)
    {
        $quoteTransfer = $this->findQuoteOrFail($idQuote);

        $this->getFactory()
            ->getMultiCartClient()
            ->duplicateQuote($quoteTransfer);

        return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }

    /**
     * @param int $idQuote
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function clearAction(int $idQuote)
    {
        $quoteTransfer = $this->findQuoteOrFail($idQuote);

        $quoteResponseTransfer = $this->getFactory()
            ->getMultiCartClient()
            ->clearQuote($quoteTransfer);

        if ($quoteResponseTransfer->getIsSuccessful()) {
            $this->addSuccessMessage('multi_cart_page.cart_clear.success');
        }

        return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }

    /**
     * @param int $idQuote
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(int $idQuote)
    {
        $quoteTransfer = $this->findQuoteOrFail($idQuote);

        $multiCartClient = $this->getFactory()->getMultiCartClient();
        $multiCartClient->deleteQuote($quoteTransfer);

        $customerQuoteTransferList = $multiCartClient->getQuoteCollection()->getQuotes();
        if ($quoteTransfer->getIsDefault() && count($customerQuoteTransferList)) {
            $quoteTransfer = reset($customerQuoteTransferList);

            return $this->redirectResponseInternal(MultiCartPageControllerProvider::ROUTE_MULTI_CART_SET_DEFAULT, [
                MultiCartPageControllerProvider::PARAM_ID_QUOTE => $quoteTransfer->getIdQuote(),
            ]);
        }

        return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }

    /**
     * @param int $idQuote
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function findQuoteOrFail(int $idQuote): QuoteTransfer
    {
        $quoteTransfer = $this->getFactory()
            ->getMultiCartClient()
            ->findQuoteById($idQuote);

        if ($quoteTransfer) {
            return $quoteTransfer;
        }

        throw new NotFoundHttpException();
    }
}
