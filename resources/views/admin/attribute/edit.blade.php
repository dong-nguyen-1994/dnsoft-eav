@extends('core::admin.master')

@section('meta_title', __('catalog::product.create.page_title'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('catalog.admin.product-set.index') }}">{{ __('catalog::product.index.page_title') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('catalog::product.create.page_title') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('catalog::product.create.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <form role="form" action="{{ route('catalog.admin.product.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('catalog::product.create.page_title') }}</h3>

                        </div>

                        @include('eav::admin.attribute._fields', ['item' => $item])

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('core::button.save') }}</button>
                            <button class="btn btn-secondary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

{{--@section('content')--}}
{{--    <form action="{{ route('catalog.admin.product.store') }}" method="POST" enctype="multipart/form-data">--}}
{{--        @csrf--}}

{{--        <div class="card mb-4">--}}
{{--            <div class="card-header">--}}
{{--                <div class="d-flex justify-content-between align-items-center">--}}
{{--                    <div>--}}
{{--                        <h6 class="fs-17 font-weight-600 mb-0">--}}
{{--                            {{ __('catalog::product.create.page_title') }}--}}
{{--                        </h6>--}}
{{--                    </div>--}}
{{--                    <div class="text-right">--}}
{{--                        <div class="btn-group">--}}
{{--                            <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>--}}
{{--                            <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                @include('catalog::admin.product._fields', ['item' => $item])--}}
{{--            </div>--}}
{{--            <div class="card-footer text-right">--}}
{{--                <div class="btn-group">--}}
{{--                    <button class="btn btn-success" type="submit">{{ __('core::button.save') }}</button>--}}
{{--                    <button class="btn btn-primary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--@stop--}}
