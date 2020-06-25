let questions = [];
let template_question = `
    <div class="question" data-key="">
        <div class="input-group">
            <input type="text" class="form-control text-question" placeholder="Введите вопрос">
            <div class="input-group-append">
                <span class="input-group-text add-answer">Добавить ответ</span>
            </div>
        </div>
        <div class="answers">
            
        </div>
    </div>
`;
let template_answer = `
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" title="Правильный" class="checkbox-answer">
            </div>
        </div>
        <input type="text" class="form-control text-answer" placeholder="Введите ответ">
    </div>
`;
$(document).ready(function () {
    $('body').on('click', '.add-answer',function(){
        let key_question = $(this).parent().parent().parent().attr('data-key');
        let obj_last_answer = $(this).parent().parent().parent().find('>.answers > div').last();
        let key_prev_last_answer = 0;
        if(obj_last_answer.length != 0){
            key_prev_last_answer = parseInt($(obj_last_answer).attr('data-key')) + 1;
        }
        $(this).parent().parent().parent().find('>.answers').append(template_answer);
        obj_last_answer = $(this).parent().parent().parent().find('>.answers > div').last();
        $(obj_last_answer).attr('data-key', key_prev_last_answer);
        $(obj_last_answer).find('.text-answer').attr("name", "questions["+ key_question +"][answer]["+ key_prev_last_answer +"][text]")
        $(obj_last_answer).find('.checkbox-answer').attr("name", "questions["+ key_question +"][answer]["+ key_prev_last_answer +"][correct]");
    })
    $('body').on('click', '.add-question', function(){
        if(questions.length == 0){
            questions[0] = 0;
            $('.questions').append(template_question);
            $('.questions > div').last().attr("data-key", 0);
            $('.questions > div').last().find('.text-question').attr("name", "questions["+ 0 +"][text]");
        }else{
            let value = questions[questions.length - 1] + 1;
            questions[questions.length] = value;
            $('.questions').append(template_question);
            $('.questions > div').last().attr("data-key", value);
            $('.questions > div').last().find('.text-question').attr("name", "questions["+ value +"][text]");

        }
    });
});
