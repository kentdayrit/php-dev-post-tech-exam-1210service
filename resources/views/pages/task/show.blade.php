@extends('templates.main')
@section('title', 'Task Details')
@section('content')
    <!-- Header-->
    <header class="px-5">
        <div class="container px-5 bg-light rounded-3 pb-4">
            <div class="p-1  text-center">
                <div class="m-4 m-lg-5">
                    <h4 class="fw-bold">Task Details</h4>
                </div>
            </div>
            <div class="container px-5">
                <form>
                    <dv class="row p-4 m-4">
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
    </header>
@endsection