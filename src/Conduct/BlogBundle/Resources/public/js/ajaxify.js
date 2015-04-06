/**
 * Created with JetBrains PhpStorm.
 * User: festool
 * Date: 4/1/15
 * Time: 9:50 PM
 * To change this template use File | Settings | File Templates.
 */

function postForm($form, callback)
{
    var values = {};
    $.each($form.serializeArray(), function(i, field){
       values[field.name] = field.value;
    });

    $.ajax({
       type : $form.attr('method'),
       url: $form.attr('action'),
        data: values,
        success : function(data){
            callback(data);
        }
    });
}


