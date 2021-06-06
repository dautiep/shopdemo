<?php

namespace Platform\CartDetail\Http\Controllers;

use Platform\Base\Events\BeforeEditContentEvent;
use Platform\CartDetail\Http\Requests\CartDetailRequest;
use Platform\CartDetail\Repositories\Interfaces\CartDetailInterface;
use Platform\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Platform\CartDetail\Tables\CartDetailTable;
use Platform\Base\Events\CreatedContentEvent;
use Platform\Base\Events\DeletedContentEvent;
use Platform\Base\Events\UpdatedContentEvent;
use Platform\Base\Http\Responses\BaseHttpResponse;
use Platform\CartDetail\Forms\CartDetailForm;
use Platform\Base\Forms\FormBuilder;

class CartDetailController extends BaseController
{
    /**
     * @var CartDetailInterface
     */
    protected $cartDetailRepository;

    /**
     * @param CartDetailInterface $cartDetailRepository
     */
    public function __construct(CartDetailInterface $cartDetailRepository)
    {
        $this->cartDetailRepository = $cartDetailRepository;
    }

    /**
     * @param CartDetailTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(CartDetailTable $table)
    {
        page_title()->setTitle(trans('plugins/cart-detail::cart-detail.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/cart-detail::cart-detail.create'));

        return $formBuilder->create(CartDetailForm::class)->renderForm();
    }

    /**
     * @param CartDetailRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(CartDetailRequest $request, BaseHttpResponse $response)
    {
        $cartDetail = $this->cartDetailRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(CART_DETAIL_MODULE_SCREEN_NAME, $request, $cartDetail));

        return $response
            ->setPreviousUrl(route('cart-detail.index'))
            ->setNextUrl(route('cart-detail.edit', $cartDetail->id))
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
        $cartDetail = $this->cartDetailRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $cartDetail));

        page_title()->setTitle(trans('plugins/cart-detail::cart-detail.edit') . ' "' . $cartDetail->name . '"');

        return $formBuilder->create(CartDetailForm::class, ['model' => $cartDetail])->renderForm();
    }

    /**
     * @param int $id
     * @param CartDetailRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, CartDetailRequest $request, BaseHttpResponse $response)
    {
        $cartDetail = $this->cartDetailRepository->findOrFail($id);

        $cartDetail->fill($request->input());

        $this->cartDetailRepository->createOrUpdate($cartDetail);

        event(new UpdatedContentEvent(CART_DETAIL_MODULE_SCREEN_NAME, $request, $cartDetail));

        return $response
            ->setPreviousUrl(route('cart-detail.index'))
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
            $cartDetail = $this->cartDetailRepository->findOrFail($id);

            $this->cartDetailRepository->delete($cartDetail);

            event(new DeletedContentEvent(CART_DETAIL_MODULE_SCREEN_NAME, $request, $cartDetail));

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
            $cartDetail = $this->cartDetailRepository->findOrFail($id);
            $this->cartDetailRepository->delete($cartDetail);
            event(new DeletedContentEvent(CART_DETAIL_MODULE_SCREEN_NAME, $request, $cartDetail));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
