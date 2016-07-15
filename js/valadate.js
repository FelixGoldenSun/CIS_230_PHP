/**
 * Created by Ben on 11/14/2015.
 */
$(function(){
    var error_explanation = $("#error_explanation");
    var error_explanation_ul = $("#error_explanation ul");

    $("#data_form").submit(function(){
        var input_array = [$("#title"), $("#author"), $("#date_postd"), $("#blog_text"), $("#phone"), $("#service"), $("#message")];
        var errors = 0;

        jQuery.each(input_array, function(i, val ){
            if(val.val() == "" && val.hasClass("error") == false){
                val.parent().addClass("field_with_errors");
                error_explanation_ul.append("<li id=" + 'i' +">" + val + "must not be empty</li>");
                errors += 1;
            }
            else if(val.val() != "" && val.hasClass("error")){
                val.parent().removeClass("field_with_errors");
                $("#" + i).remove();
            }
            else if(val.val() == "" && val.hasClass("error")){
                errors += 1;
            }

        });

        if( errors > 0){
            return false;
        }
        else{
            return true;
        }
    });

});


$(function(){
    var error_explanation = $("#error_explanation");
    var error_explanation_ul = $("#error_explanation ul");

    $("#data_form").submit(function(){
        var errors = 0;
        var title = $("#title");
        var title_div = $("#title_div");
        var author = $("#author");
        var author_div = $("#author_div");
        var article_text = $("#article_text");
        var article_text_div = $("#article_text_div");

        //title
        if(title.val() == '' && !title_div.hasClass("field_with_errors")){
            title_div.addClass("field_with_errors");
            error_explanation_ul.append("<li  id='title_notification'>Title must not be empty</li>");
            errors += 1;
        }
        else if(title.val() != '' && title_div.hasClass("field_with_errors")){
            $("#title_notification").remove();
            title_div.removeClass();
        }
        else if(title.val() == '' && title_div.hasClass("field_with_errors")){
            errors += 1;
        }

        //author
        if(author.val() == '' && !author_div.hasClass("field_with_errors")){
            author_div.addClass("field_with_errors");
            error_explanation_ul.append("<li id='author_notification'>Author must not be empty</li>");
            errors += 1;
        }
        else if(author.val() != '' && author_div.hasClass("field_with_errors")){
            $("#author_notification").remove();
            author_div.removeClass();
        }
        else if(author.val() == '' && author_div.hasClass("field_with_errors")){
            errors += 1;
        }

        //article_text
        if(article_text.val() == '' && !article_text_div.hasClass("field_with_errors")){
            article_text_div.addClass("field_with_errors");
            error_explanation_ul.append("<li id='article_notification'>Article text must not be empty</li>");
            errors += 1;
        }
        else if(article_text.val() != '' && article_text_div.hasClass("field_with_errors")){
            $("#article_notification").remove();
            article_text_div.removeClass();
        }
        else if(article_text.val() == '' && article_text_div.hasClass("field_with_errors")){
            errors += 1;
        }

        if(errors > 0){
            error_explanation.show();
            return false;
        }
        else{
            error_explanation.hide();
            return true;
        }
    });
});