<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusNameEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateOrderFormRequest;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::query()
                ->with([
                    'customer',
                    'plan'
                ])
                ->paginate(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.orders.edit', [
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
            return redirect()->route('admin.orders.index')
                ->withFlashSuccess('Plano atualizado com sucesso');
        }

        return redirect()->route('admin.orders.index')
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
            $order->customer()->delete();
            return redirect()->route('admin.orders.index')
                ->withFlashSuccess('Pedido removido com sucesso');
        }
        return redirect()->route('admin.orders.index')
            ->withFlashDanger('Erro ao remover o pedido');
    }
}
