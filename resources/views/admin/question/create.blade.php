@extends('layouts.app')

@push('scripts')
    <script src="{{asset('js/question-create.js')}}"></script>
@endpush

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form id="question_form" action="{{action('Admin\QuestionController@store', $test)}}"
                              method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Тип вопроса</label>
                                <select name="type_id" class="form-control" id="questionTypeSelect"
                                >
                                    <option value="1">Один вариант ответа</option>
                                    <option value="2">Много вариантов ответов</option>
                                    <option value="3">Текстовый ответ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Введите вопрос</label>
                                <input name="text" id="question_text_field" required type="text"
                                       class="form-control">
                            </div>

                            <div class="answers">

                            </div>

                            <div id="butt-block" class="mb-3">
                                <input id="add-answer" type="button" class="btn btn-primary"
                                       value="Добавить ответ">
                            </div>
                            <input type="button" id="save" class="btn btn-success" value="Сохранить">
                        </form>
                        <a class="btn btn-danger" style="float: right" href="{{action('Admin\TestController@edit', $test)}}">Назад к тесту</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
