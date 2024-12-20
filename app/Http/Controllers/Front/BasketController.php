<?php

namespace App\Http\Controllers\Front;

use App\Models\Basket;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class BasketController extends BaseController
{
    public function __construct(private readonly Basket $basket) {}

    public function index(Request $request): View
    {
        $title = __('Корзина');
        $basketId = $request->cookie('basket_id');

        if (!is_null($basketId)) {
            $basket = $this->basket->findOrFail($basketId);
        }

        return view('front.baskets.index', [
            'title' => $title,
            'basket' => $basket ?? null,
        ]);
    }

    public function checkout(): View
    {
        $title = __('Оформить заказ');

        return view('front.baskets.checkout', [
            'title' => $title,
        ]);
    }

    public function add(Request $request, $id): RedirectResponse
    {
        $basketId = $request->cookie('basket_id');
        $quantity = $request->input('quantity', 1);

        $basket = $this->basket->get($basketId);
        $result = $basket->addProduct($id, $quantity);

        if (!$result) {
            return back()
                ->withCookie(cookie('basket_id', $basket->id, time() + 24 * 60 * 60))
                ->with(['error' => 'Такого количества нет на складе']);
        }

        return back()->withCookie(cookie('basket_id', $basket->id, time() + 24 * 60 * 60));
    }

    public function plus(Request $request, $id): RedirectResponse
    {
        $basketId = $request->cookie('basket_id');
        $basket = $this->basket->get($basketId);
        $basket->increase($id);

        return redirect()
            ->route('baskets.index')
            ->withCookie(cookie('basket_id', $basket->id, time() + 24 * 60 * 60));
    }

    public function minus(Request $request, $id): RedirectResponse
    {
        $basketId = $request->cookie('basket_id');
        $basket = $this->basket->get($basketId);
        $isEmpty = $basket->decrease($id);

        if (!$isEmpty) {
            Cookie::queue(Cookie::forget('basket_id'));
        }

        return redirect()
            ->route('baskets.index')
            ->withCookie(cookie('basket_id', $basket->id, time() + 24 * 60 * 60));
    }

    public function remove(Request $request, $id): RedirectResponse
    {
        $basketId = $request->cookie('basket_id');
        $basket = $this->basket->get($basketId);
        $isEmpty = $basket->removeProduct($id);

        if ($isEmpty) {
            Cookie::queue(Cookie::forget('basket_id'));
        }

        return redirect()
            ->route('baskets.index')
            ->with(['success' => __('Успешно удалено')]);
    }

    public function clear(Request $request): RedirectResponse
    {
        $basketId = $request->cookie('basket_id');
        $basket = $this->basket->get($basketId);
        $basket->delete();
        Cookie::queue(Cookie::forget('basket_id'));

        return redirect()
            ->route('baskets.index')
            ->with(['success' => __('Успешно удалено')]);
    }

}
