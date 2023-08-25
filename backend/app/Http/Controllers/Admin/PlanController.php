<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MeasureEnum;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Plan\StorePlanFormRequest;
use App\Http\Requests\Admin\Plan\UpdatePlanFormRequest;
use App\Models\App;
use App\Models\Plan;
use App\Models\PlanFeature;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.plans.index', [
            'plans' => Plan::query()
                ->with([
                    // 'features',
                    // 'contentApps'
                ])
                ->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plans.create', [
            'measures' => [
                MeasureEnum::GIGA->value
            ],
            'features' => PlanFeature::query()->get(),
            'contentApps' => App::query()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanFormRequest $request)
    {
        $plan = Plan::create([
            'price' => Helper::unmask($request->price),
            'qty' => $request->qty,
            'measure' => $request->measure,
            'is_better' => $request->is_better ? true : false,
        ]);
        if ($plan) {
            $plan->features()->attach($request->feature_ids);
            $plan->contentApps()->attach($request->app_ids);
            return redirect()->route('admin.plans.index')
                ->withFlashSuccess('Plano cadastrado com sucesso');
        }
        return redirect()->route('admin.plans.index')
            ->withFlashDanger('Erro ao cadastrar o novo plano');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.plans.edit', [
            'plan' => Plan::query()->findOrFail($id),
            'measures' => [
                MeasureEnum::GIGA->value
            ],
            'features' => PlanFeature::query()->get(),
            'contentApps' => App::query()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanFormRequest $request, string $id)
    {
        $plan = Plan::query()->findOrFail($id);
        $updated = $plan->update([
            'price' => Helper::unmask($request->price),
            'qty' => $request->qty,
            'measure' => $request->measure,
            'is_better' => isset($request->is_better) ? true : false,
        ]);

        if ($updated) {
            if ($request->has('feature_ids')) {
                $plan->features()->sync($request->get('feature_ids'));
            }
            if ($request->has('app_ids')) {
                $plan->contentApps()->sync($request->get('app_ids'));
            }
            return redirect()->route('admin.plans.index')
                ->withFlashSuccess('Plano atualizado com sucesso');
        }
        return redirect()->route('admin.plans.index')
            ->withFlashDanger('Erro ao atualizar plano');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plan::query()->findOrFail($id);
        $plan->orders()->delete();
        $plan->features()->detach();
        $plan->contentApps()->detach();
        if ($plan->delete()) {
            return redirect()->route('admin.plans.index')
                ->withFlashSuccess('Plano removido com sucesso');
        }
        return redirect()->route('admin.plans.index')
            ->withFlashDanger('Erro ao remover plano');
    }
}
