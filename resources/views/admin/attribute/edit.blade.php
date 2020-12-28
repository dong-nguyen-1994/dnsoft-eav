@extends('core::admin.master')

@section('meta_title', __('eav::attribute.edit.page_title'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route($routeNamePrefix.'index') }}">{{ trans('eav::attribute.index.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('eav::attribute.edit.breadcrumb') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('eav::attribute.edit.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route($routeNamePrefix.'update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fs-17 font-weight-600 mb-2">
                            {{ __('eav::attribute.edit.page_title') }}
                        </h4>
                    </div>
                    <div class="text-right">
                        <div class="btn-group">
                            <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>
                            <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('eav::admin.attribute._fields', ['item' => $item])
            </div>
            <div class="card-footer text-right">
                <div class="btn-group">
                    <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>
                    <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                </div>
            </div>
        </div>
    </form>
@stop
