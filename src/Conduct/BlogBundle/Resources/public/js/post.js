/**
 * Created with JetBrains PhpStorm.
 * User: festool
 * Date: 4/1/15
 * Time: 10:15 PM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){

   $('[name="conduct_blogbundle_comment"]').submit(function(e){
       e.preventDefault();

       postForm($(this), function(response){
            console.log(response);
           console.log('callback');
           $('.comments_container').append(response.markup);
       });

       return false;
   });
});