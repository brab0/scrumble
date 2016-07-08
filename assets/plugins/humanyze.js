//! moment.js
//! version : 0.0.1-Snapshot
//! authors : rmdb
//! license : MIT

$.fn.humanyze = function() {    
    $(this).each(function(){
        var deg = Math.floor((Math.random() * 5) + 1) + "deg";
        var sinal = "";
        
        if(Math.floor((Math.random() * 2) + 1) === 1){
            sinal = "-";            
        }
        
        $(this).css("-ms-transform", "rotate("+sinal+deg+")").css("-webkit-transform", "rotate("+sinal+deg+")").css("transform", "rotate("+sinal+deg+")");    
    });    
};