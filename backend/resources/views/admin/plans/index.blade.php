@extends('layouts.auth')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a href="{{ route('admin.plans.create') }}" class="btn btn-primary btn-xs m-0">
                    Novo plano
                 </a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Planos</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">Lista de planos</h3>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
                    <div class="box">
                        <div class="box-body content-to-be-update">
                            <table cellspacing="0" class="table table-bordered table-hover data-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Slug</th>
                                        <th>Quantidade</th>
                                        <th>Medida</th>
                                        <th>Registrado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($plans as $key => $value)
                                        <tr>
                                            <td>{!! $value->id !!}</td>
                                            <td>{!! $value->slug !!}</td>
                                            <td>{!! $value->qty !!}</td>
                                            <td>{!! $value->measure !!}</td>
                                            <td>{!! $value->created_at !!}</td>
                                            <td>
                                                <a href="{{ route('admin.plans.edit', $value->id) }}" class="btn btn-info btn-xs">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                </a>
                                                <a href="{{ route('admin.plans.destroy', $value->id) }}" data-id="{{  $value->id }}" data-method="post" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        Vazio
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer clearfix">
            {!! $plans->links() !!}
        </div>
    </div>
</div>
@endsection
