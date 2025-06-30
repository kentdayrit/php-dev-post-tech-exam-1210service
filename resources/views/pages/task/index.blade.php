@extends('templates.main')
@section('title', 'Tasks')
@section('content')
    <header class="pt-5 pb-1">
        <div class="container px-5 bg-light rounded-3 pb-4">
            <div class="p-4 text-center">
                <h4 class="fw-bold">Task List</h4>
                <a class="btn btn-primary" type="button" href="{{ route('task.create') }}">Add New Task</a>
            </div>
            <div class="container">
                <form action="{{ route('task.index') }}" method="GET">
                    <input type="hidden" name="page_limit" value="{{ $filter['page_limit'] }}">
                    <dv class="row">
                        <div class="col-md-4">
                            @component('components.inputs.form-primary-input')
                                @slot('title', 'Date')
                                @slot('name', 'date')
                                @slot('id', 'date')
                                @slot('value', old('date', $filter['date']))
                                @slot('placeholder', 'Search By Name')
                                @slot('type', 'date')
                            @endcomponent
                        </div>
                        <div class="col-md-4">
                            @component('components.inputs.form-primary-select')
                                @slot('title', 'Status')
                                @slot('name', 'status')
                                @slot('id', 'status')
                                @slot('value', $filter['status'])
                                @slot('placeholder', 'All')
                                @slot('options', taskStatusType())
                            @endcomponent
                        </div>
                        <div class="col-md-4">  
                            @component('components.inputs.form-primary-select')
                                @slot('title', 'Order By')
                                @slot('name', 'order_by')
                                @slot('id', 'order-by')
                                @slot('value', $filter['order_by'])
                                @slot('options', taskOrderByOptions())
                            @endcomponent
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <section class="pt-2 pb-2">
        <div class="container px-5">
            <form action="{{ route('task.index') }}" method="GET">
                <input type="hidden" name="order_by" value="{{ $filter['order_by'] }}">
                <input type="hidden" name="status" value="{{ $filter['status'] }}">
                <input type="hidden" name="date" value="{{ $filter['date'] }}">

                <div class="row mb-5">
                    <div class="d-flex justify-content-between bd-highlight mb-3">
                        <div class="col-md-4">
                            @component('components.inputs.form-input-btn')
                                @slot('type', 'text')
                                @slot('name', 'search')
                                @slot('id', 'search')
                                @slot('value', $filter['search'] ?? null)
                                @slot('placeholder', 'Search By Name')
                                @slot('btnType', 'submit')
                                @slot('btnLabel', 'Search')
                            @endcomponent
                        </div>
                        <div class="col-md-2 ms-auto">
                            @component('components.inputs.form-select-btn')
                                @slot('name', 'page_limit')
                                @slot('id', 'page-limit')
                                @slot('value', $filter['page_limit'])
                                @slot('btnType', 'submit')
                                @slot('btnLabel', 'Show')
                                @slot('options', pageLimiterOption())
                            @endcomponent
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">    
                @forelse ($data as $item)
                    <div class="col-md-4 mb-5 mt-5">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="text-center">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4">
                                            <i class="bi bi-journal-text"></i></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex flex-row mb-3">
                                        <div class="ps-2">
                                            {!! taskStatusBadge($item->status) !!}
                                        </div>
                                        <div class="ps-1">
                                            {!! taskIsPublishedBadge($item->is_published) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="fs-4 fw-bold text-truncate" style="max-width: 100%;">{{ $item->title }}</label>
                                    <p class="mb-0 text-truncate">{{ $item->content }}</p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <span>{{ date('M d, Y', strtotime($item->created_at)) }}</span>
                                        <div class="my-auto">
                                            <a href="{{ route('task.show', ['task' => $item->id]) }}" class="btn btn-primary text-light"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('task.edit', ['task' => $item->id]) }}" class="btn btn-warning text-light"><i class="bi bi-pencil-square"></i></a>
                                            <a href="javascript::void(0)" data-url="{{ route('task.destroy', ['task' => $item->id]) }}" type="button" data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger text-light delete-btn"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center p-5">
                        <p class="text-secondary">No Task Available</p>
                    </div>
                @endforelse   
            </div>
            @component('components.tables.pageable-footer')
                @slot('data', $data)
            @endcomponent
        </div>
    </section>
    @include('components.modals.delete-modal')
    
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const url = button.getAttribute('data-url');
                    console.log(url);
                    
                    document.getElementById('delete-form').action = url;
                });
            });
        });
    </script>
@endsection
