@extends('layouts.app')

@push('scripts')
    <script src="{{asset('js/question-edit.js')}}"></script>
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
                    <div class="card-header text-center"><h4>{{$question->text}}</h4></div>
                    <div class="card-body">
                        <form id="question_form" action="{{action('Admin\QuestionController@update', $question)}}"
                              method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Тип вопроса</label>
                                <select name="type_id" class="form-control" id="questionTypeSelect"
                                >
                                    @if($question->type_id==1)
                                        <option selected value="1">Один вариант ответа</option>
                                    @else
                                        <option value="1">Один вариант ответа</option>
                                    @endif
                                    @if($question->type_id==2)
                                        <option selected value="2">Много вариантов ответов</option>
                                    @else
                                        <option value="2">Много вариантов ответов</option>
                                    @endif
                                    @if($question->type_id==3)
                                        <option selected value="3">Текстовый ответ</option>
                                    @else
                                        <option value="3">Текстовый ответ</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Введите вопрос</label>
                                <input name="text" id="question_text_field" required type="text"
                                       class="form-control" value="{{$question->text}}">
                            </div>

                            <div class="answers">
                                @foreach($question->answers as $answer)
                                    <div class="answer-block">
                                        <label>Ответ</label>
                                        <div class="input-group mb-3">
                                            @if($question->type_id!=3)
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        @if($question->type_id==1)
                                                            @if($answer->is_correct)
                                                                <input checked id="is_correct_ch" class="is-correct"
                                                                       name="]"
                                                                       type="radio">
                                                            @else
                                                                <input id="is_correct_ch" class="is-correct" name=""
                                                                       type="radio">
                                                            @endif
                                                        @elseif($question->type_id==2)
                                                            @if($answer->is_correct)
                                                                <input checked id="is_correct_ch" class="is-correct"
                                                                       name=""
                                                                       type="checkbox">
                                                            @else
                                                                <input id="is_correct_ch" class="is-correct" name=""
                                                                       type="checkbox">
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                            <input name="" value="{{$answer->text}}"
                                                   class="form-control answer-field"></div>
                                        <button class="mb-2 del-btn">Удалить</button>
                                    </div>
                                @endforeach
                            </div>

                            <div id="butt-block" class="mb-3">
                                <input id="update" type="submit" class="btn btn-primary"
                                       value="Обновить">
                                <input id="add-answer" type="button" class="btn btn-success"
                                       value="Добавить ответ">
                            </div>
                        </form>
                        <form action="{{action('Admin\QuestionController@destroy', $question)}}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Удалить вопрос">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
