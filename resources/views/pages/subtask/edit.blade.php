@extends('templates.main')
@section('title', 'Tasks')
@section('content')
    <!-- Header-->
    <header class="px-5">
        <div class="container px-5 bg-light rounded-3 pb-4">
            <div class="p-1  text-center">
                <div class="m-4 m-lg-5">
                    <h4 class="fw-bold">Edit SubTask Details</h4>
                </div>
            </div>
            <div class="container px-5">
                <form action="{{ route('task.sub.update', ['task' => $task->id, 'sub' => $sub->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <dv class="row p-4 m-4">
                         <div class="col-md-12">
                            @component('components.inputs.form-input')
                                @slot('title', 'Title')
                                @slot('name', 'title')
                                @slot('id', 'title')
                                @slot('value', $sub->title)
                                @slot('placeholder', 'Enter a title')
                                @slot('type', 'text')
                            @endcomponent
                        </div>
                        <div class="col-md-12">
                            @component('components.inputs.form-textarea')
                                @slot('title', 'Content')
                                @slot('name', 'content')
                                @slot('id', 'content')
                                @slot('value', $sub->content)
                                @slot('placeholder', 'Enter a content')
                                @slot('rows', 3)
                            @endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('components.inputs.form-select')
                                @slot('title', 'Status')
                                @slot('name', 'status')
                                @slot('id', 'status')
                                @slot('value', $sub->status)
                                @slot('placeholder', 'Enter a status')
                                @slot('options', taskStatusType())
                            @endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('components.inputs.form-image')
                                @slot('title', 'Task Image')
                                @slot('name', 'task_image')
                                @slot('id', 'task-image')
                                @slot('value', $sub->file->path ?? old('task_image'))
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