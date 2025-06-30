@extends('templates.main')
@section('title', 'Tasks')
@section('content')
    <!-- Header-->
    <header class="pt-5 pb-1">
        <div class="container px-lg-5 px-md-3 px-sm-1 bg-light rounded-3 pb-4">
            <div class="p-1  text-center">
                <div class="m-4 m-lg-5">
                    <h4 class="fw-bold">Edit Task Details</h4>
                </div>
            </div>
            <div class="container">
                <form action="{{ route('task.update', ['task' => $task->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <dv class="row">
                         <div class="col-md-12">
                            @component('components.inputs.form-input')
                                @slot('title', 'Title')
                                @slot('name', 'title')
                                @slot('id', 'title')
                                @slot('value', $task->title)
                                @slot('placeholder', 'Enter a title')
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
                                @slot('options', taskStatusType())
                            @endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('components.inputs.form-image')
                                @slot('title', 'Task Image')
                                @slot('name', 'task_image')
                                @slot('id', 'task-image')
                                @slot('value', $task->file->path ?? old('task_image'))
                            @endcomponent
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary" name="is_published" value="1" type="submit">Published</button>
                        <button class="btn btn-warning" type="submit" name="is_published" value="0">Draft</button>
                    </div>
                </form>
            </div>
        </div>
    </header>
@endsection