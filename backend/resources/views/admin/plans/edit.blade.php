@extends('layouts.auth')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.plans.index') }}">Planos</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
          </ol>
        </div>
      </div>
    </div>
</section>
@endsection

@section('content')
<div class="container-fluid">
    <form method="post" action="{{ route('admin.plans.update', $plan->id) }}">
        @method('put')
        @csrf
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar plano {{ $plan->id }}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input name="price"
                        type="text"
                        id="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('measure', \App\Helper::maskMoney($plan->price)) }}"
                        data-mask
                    />
                    @error('price')
                        <span class="error invalid-feedback">{{ $errors->first('price') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="measure">Medida</label>
                    <select class="form-control select2 @error('measure') is-invalid @enderror" id="measure" name="measure" value="{{ old('measure', $plan->measure) }}">
                        @foreach($measures as $measure)
                            <option value="{{ $measure }}">{{ $measure }}</option>
                        @endforeach
                    </select>
                    @error('measure')
                        <span class="error invalid-feedback">{{ $errors->first('measure') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="qty">Quantidade</label>
                    <input name="qty" type="number" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty', $plan->qty) }}" />
                    @error('qty')
                        <span class="error invalid-feedback">{{ $errors->first('qty') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input @error('is_better') is-invalid @enderror" id="is_better" name="is_better" @checked(old('is_better', $plan->is_better))>
                        <label class="custom-control-label" for="is_better">É melhor?</label>
                    </div>
                    @error('is_better')
                        <span class="error invalid-feedback">{{ $errors->first('is_better') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="feature_ids">Funcionalidades</label>
                    <div class="@error('feature_ids') select2-danger @enderror @error('feature_ids') is-invalid @enderror">
                        {{ html()
                            ->multiselect(
                                'feature_ids[]',
                                $features->pluck('name', 'id'),
                                $plan->features->pluck('id')
                            )
                            ->class('form-control select2')
                        }}
                    </div>
                    @error('feature_ids')
                        <span class="error invalid-feedback">{{ $errors->first('feature_ids') }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="app_ids">Apps de conteúdo</label>
                    <div class="@error('app_ids') select2-danger @enderror @error('app_ids') is-invalid @enderror">
                        {{ html()
                            ->multiselect(
                                'app_ids[]',
                                $contentApps->pluck('name', 'id'),
                                $plan->contentApps->pluck('id')
                            )
                            ->class('form-control select2')
                        }}
                    </div>
                    @error('app_ids')
                        <span class="error invalid-feedback">{{ $errors->first('app_ids') }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success float-right">Salvar</button>
            </div>
        </div>
    </form>
</div>
@endsection

