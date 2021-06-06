<?php

namespace Platform\Cart\Http\Controllers;

use Platform\Base\Events\BeforeEditContentEvent;
use Platform\Cart\Http\Requests\CartRequest;
use Platform\Cart\Repositories\Interfaces\CartInterface;
use Platform\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Platform\Cart\Tables\CartTable;
use Platform\Base\Events\CreatedContentEvent;
use Platform\Base\Events\DeletedContentEvent;
use Platform\Base\Events\UpdatedContentEvent;
use Platform\Base\Http\Responses\BaseHttpResponse;
use Platform\Cart\Forms\CartForm;
use Platform\Base\Forms\FormBuilder;

class CartController extends BaseController
{
    /**
     * @var CartInterface
     */
    protected $cartRepository;

    /**
     * @param CartInterface $cartRepository
     */
    public function __construct(CartInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @param CartTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(CartTable $table)
    {
        page_title()->setTitle(trans('plugins/cart::cart.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/cart::cart.create'));

        return $formBuilder->create(CartForm::class)->renderForm();
    }

    /**
     * @param CartRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(CartRequest $request, BaseHttpResponse $response)
    {
        $cart = $this->cartRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(CART_MODULE_SCREEN_NAME, $request, $cart));

        return $response
            ->setPreviousUrl(route('cart.index'))
            ->setNextUrl(route('cart.edit', $cart->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $cart = $this->cartRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $cart));

        page_title()->setTitle(trans('plugins/cart::cart.edit') . ' "' . $cart->name . '"');

        return $formBuilder->create(CartForm::class, ['model' => $cart])->renderForm();
    }

    /**
     * @param int $id
     * @param CartRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, CartRequest $request, BaseHttpResponse $response)
    {
        $cart = $this->cartRepository->findOrFail($id);

        $cart->fill($request->input());

        $this->cartRepository->createOrUpdate($cart);

        event(new UpdatedContentEvent(CART_MODULE_SCREEN_NAME, $request, $cart));

        return $response
            ->setPreviousUrl(route('cart.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $cart = $this->cartRepository->findOrFail($id);

            $this->cartRepository->delete($cart);

            event(new DeletedContentEvent(CART_MODULE_SCREEN_NAME, $request, $cart));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $cart = $this->cartRepository->findOrFail($id);
            $this->cartRepository->delete($cart);
            event(new DeletedContentEvent(CART_MODULE_SCREEN_NAME, $request, $cart));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
