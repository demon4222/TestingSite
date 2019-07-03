
export const NOT_DEFINED_QUESTION = 0;
import $ from 'jquery'

$(document).ready(function () {
    $('#all_questions_list').on('change', function () {
        let question = $(this).val();
        let $question_block = $('.question');
        if(question==NOT_DEFINED_QUESTION) {
            $question_block.empty();
            return false;
        }

        location.href = '/questions/'+question+'/edit';
    })
})
