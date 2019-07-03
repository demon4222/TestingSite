import {
    QUESTION_TYPE_MULTIPLE_ANSWER,
    QUESTION_TYPE_ONE_ANSWER,
    QUESTION_TYPE_SINGLE
} from "../../public/js/admin/questionType";
import $ from 'jquery'

$(document).ready(function () {

    let answersIterator = $('.answers').find('.answer-block').length;

    function generateInput(questionType, answersIterator) {
        let $input = $("<input id=\"is_correct_ch\" class='is-correct' name=\"answer[" + answersIterator + "][isCorrect]\">");
        $input.attr('type', questionType === QUESTION_TYPE_ONE_ANSWER ? 'radio' : 'checkbox');
        return $("<div class=\"input-group-prepend\">")
            .append($("<div class=\"input-group-text\">").append($input));
    }

    $(document).on('change', 'input[type="radio"]', function () {
        $('input[type="radio"]').not(this).prop('checked', false)
    });

    $('#add-answer').on('click', function () {

        let questionType = parseInt($("#questionTypeSelect").val());

        let $inputs = $('.answers').find('.answer-block');
        if (questionType === QUESTION_TYPE_SINGLE && $inputs.length >= 1) {
            alert('Возможно добавить только один ответ!');
            return false;
        }

        let $newAnswer = $("<div class='answer-block'>");
        $newAnswer.append($('<label>').html('Ответ'));

        let $inputGroup = $("<div class=\"input-group mb-3\">");
        if ([QUESTION_TYPE_ONE_ANSWER, QUESTION_TYPE_MULTIPLE_ANSWER].indexOf(questionType) !== -1) {
            let $prepend = generateInput(questionType, answersIterator);
            $inputGroup.append($prepend)
        }
        $inputGroup.append($("<input name='answer[" + answersIterator + "][text]' class='form-control answer-field'>"))
        $newAnswer.append($inputGroup);
        let $deleteBtn = $("<button class='mb-2'>").html('Remove').on('click', function () {
            let $this = $(this);
            $this.parents('.answer-block').remove()
        });
        $newAnswer.append($deleteBtn);
        $(".answers").append($newAnswer)
        ++answersIterator;
    });

    $('#save').on('click', function () {
        let questionType = parseInt($("#questionTypeSelect").val());

        let $question = $('#question_text_field');
        if($question.val()==''){
            alert('Введите вопрос!');
            return false;
        }

        let $inputs = $('.answer-field');
        if($inputs.length<1){
            alert('Добавьте ответ!');
            return false;
        }
        $inputs.each(function () {
            let $this = $(this);
            if($this.val()==''){
                alert('Заполните все поля');
                return false;
            }
        })

        if (questionType === QUESTION_TYPE_ONE_ANSWER) {
            let $radios = $('input[type="radio"]:checked');
            if($radios.length<1){
                alert('Отметьте один правильный ответ');
                return false;
            }
        }

        $('#question_form').submit();
    });


    (function () {
        let $questionTypeSelect = $("#questionTypeSelect");
        let previousValue = parseInt($questionTypeSelect.val());
        $questionTypeSelect
            .on('change', function (event) {
                let $this = $(this);
                let currentValue = parseInt($this.val());

                if (currentValue === QUESTION_TYPE_SINGLE) {
                    let $inputs = $('.answers').find('.answer-block');
                    if ($inputs.length > 0) {
                        if (!confirm('Сменить тип?')) {
                            event.preventDefault();
                            $this.val(previousValue);
                            return false;
                        } else {
                            $inputs.not(':first').remove();
                        }
                    }
                }

                $('.answers .answer-block .input-group .input-group-prepend').remove();
                if (currentValue !== QUESTION_TYPE_SINGLE) {
                    $('.answers .answer-block .input-group').each(function () {
                        let $this = $(this);
                        let [fullMatch, index] = $this.find('.form-control').attr('name').match(/answer\[(\d+)]\[text]/)
                        $this.prepend(generateInput(currentValue, index))
                    })
                }

                previousValue = currentValue;
            })
    })();


});


