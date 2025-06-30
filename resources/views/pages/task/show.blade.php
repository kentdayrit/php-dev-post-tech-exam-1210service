@extends('templates.main')
@section('title', 'Task Details')
@section('content')
    <header class="pt-5 pb-1">
        <div class="container px-lg-5 px-md-3 px-sm-1 bg-light rounded-3 pb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="p-1 text-center">
                            <div class="m-4 m-lg-5">
                                <h4 class="fw-bold">Task Details</h4>
                            </div>
                        </div>            
                    </div>
                    <div class="row">
                        <div class="container px-lg-5 px-md-3 px-sm-1">
                            <form>
                                <div class="row p-md-4 m-md-4">
                                    <div class="col-md-12">
                                        @component('components.inputs.form-input')
                                            @slot('title', 'Title')
                                            @slot('name', 'title')
                                            @slot('id', 'title')
                                            @slot('value', $task->title)
                                            @slot('placeholder', 'Enter a title')
                                            @slot('isDisabled', true)
                                            @slot('type', 'text')
                                        @endcomponent
                                    </div>
                                    <div class="col-md-12">
                                        @component('components.inputs.form-textarea')
                                            @slot('title', 'Content')
                                            @slot('name', 'content')
                                            @slot('id', 'content')
                                            @slot('value', $task->content)
                                            @slot('placeholder', 'Enter a content')
                                            @slot('isDisabled', true)
                                            @slot('rows', 3)
                                        @endcomponent
                                    </div>
                                    <div class="col-md-6">
                                        @component('components.inputs.form-select')
                                            @slot('title', 'Status')
                                            @slot('name', 'status')
                                            @slot('id', 'status')
                                            @slot('value', $task->status)
                                            @slot('placeholder', 'Enter a status')
                                            @slot('isDisabled', true)
                                            @slot('options', taskStatusType())
                                        @endcomponent
                                    </div>
                                    <div class="col-md-6">
                                        @component('components.inputs.form-image')
                                            @slot('title', 'Task Image')
                                            @slot('name', 'file')
                                            @slot('id', 'file')
                                            @slot('value', $task->file->path ?? null)
                                            @slot('isDisabled', true)
                                        @endcomponent
                                    </div>
                                </div>
                            </form>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="text-center">
                            <div class="m-4 m-lg-5">
                                <h4 class="fw-bold">SubTask List</h4>
                                <a class="btn btn-primary" type="button" href="{{ route('task.sub.create', ['task' => $task->id]) }}">Add New SubTask</a>
                            </div>
                        </div>            
                    </div>

                    <div class="row">    
                        @forelse ($subTasks as $item)
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
                                                    <a href="{{ route('task.sub.show', ['task' => $task->id, 'sub' => $item->id]) }}" class="btn btn-primary text-light"><i class="bi bi-eye"></i></a>
                                                    <a href="{{ route('task.sub.edit', ['task' => $task->id, 'sub' => $item->id]) }}" class="btn btn-warning text-light"><i class="bi bi-pencil-square"></i></a>
                                                    <a href="javascript::void(0)" data-url="{{ route('task.sub.destroy', ['task' => $task->id, 'sub' => $item->id]) }}" type="button" data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger text-light delete-btn"><i class="bi bi-trash"></i></a>
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
                    <div class="row">
                        @component('components.tables.pageable-footer')
                            @slot('data', $subTasks)
                        @endcomponent
                    </div>     
                </div>
            </div>
        </div>
    </header>
@endsection