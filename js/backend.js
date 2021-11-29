$(function(){
   'use strict';
    $('[placeholder]').focus(function(){
        $(this).attr('data', $(this).attr('placeholder'));
        $(this).attr('placeholder' ,'');
    }).blur(function(){
        $(this).attr( 'placeholder', $(this).attr('data'));

    });

  
    
});