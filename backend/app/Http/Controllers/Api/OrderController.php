<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusNameEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateOrderFormRequest;
use App\Http\Requests\Api\Order\StoreOrderFormRequest;
use App\Models\Customer;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('api.orders.index', [
            'orders' => Order::query()
                ->with([
                    'customer',
                    'plan'
                ])
                ->paginate(),
        ]);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderFormRequest $request)
    {
        $customer = Customer::create($request->all());
        $order = Order::create([
            'customer_id' => $customer->id,
            'plan_id' => $request->plan_id
        ]);
        $success = false;

        if ($order) {
            $success = true;
        }

        return response()->json(['success' => $success]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('api.orders.edit', [
            'order' => Order::query()->findOrFail($id),
            'statusName' => [
                StatusNameEnum::IN_PROGRESS => StatusNameEnum::IN_PROGRESS_LABEL,
                StatusNameEnum::DONE => StatusNameEnum::DONE_LABEL,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderFormRequest $request, string $id)
    {
        $order = Order::query()->findOrFail($id);
        $updated = $order->update([
            'status_name' => $request->status_name,
        ]);

        if ($updated) {
            return redirect()->route('api.orders.index')
                ->withFlashSuccess('Plano atualizado com sucesso');
        }

        return redirect()->route('api.orders.index')
            ->withFlashDanger('Erro ao atualizar plano');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::query()
            ->findOrFail($id);
        if ($order->delete()) {
            return redirect()->route('api.orders.index')
                ->withFlashSuccess('Pedido removido com sucesso');
        }
        return redirect()->route('api.orders.index')
            ->withFlashDanger('Erro ao remover o pedido');
    }
}
