@extends('core::admin.master')

@section('meta_title', __('eav::attribute.index.page_title'))

@section('page_title', __('eav::attribute.index.page_title'))

@section('page_subtitle', __('eav::attribute.index.page_subtitle'))

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ trans('dashboard::message.index.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item active">{{ trans('eav::attribute.index.breadcrumb') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('eav::attribute.index.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="mb-2">
                    <div class="row">
                        <div class="col-12 text-sm-center form-inline">
                            <div class="form-group mr-2">
                                @admincan($routeNamePrefix.'create')
                                <a id="demo-btn-addrow" class="btn btn-primary" href="{{ route($routeNamePrefix.'create') }}"><i class="mdi mdi-plus-circle mr-2"></i> Add New</a>
                                @endadmincan
                            </div>
                            <form action="">
                                <div class="form-group">
                                    <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                    <input type="submit" value="Search" class="btn btn-secondary ml-5">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
                        <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('eav::attribute.name') }}</th>
                            <th>{{ __('eav::attribute.slug') }}</th>
                            <th>{{ __('eav::attribute.input_type') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <a href="{{ route($routeNamePrefix.'edit', $item->id) }}">
                                        {{ $item->name }}
                                    </a>
                                </td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ get_attribute_input_type_label($item->input_type) }}</td>
                                <td class="text-right">
                                    @admincan($routeNamePrefix.'edit')
                                    <a href="{{ route($routeNamePrefix.'edit', $item->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                                        <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                                    </a>
                                    @endadmincan

                                    @admincan($routeNamePrefix.'destroy')
                                    <button-delete url-delete="{{ route($routeNamePrefix.'destroy', $item->id) }}"></button-delete>
                                    @endadmincan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@stop
