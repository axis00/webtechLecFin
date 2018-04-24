$(document).ready(function(){
    
    var topicOffset = $("#term-topics").offset().top;

    $(window).scroll(function(){
        
        if($(window).scrollTop() >= topicOffset){
            $("#term-topics").addClass("fixed-nav");
        }else{
            $("#term-topics").removeClass("fixed-nav"); 
        }
        
    }); 
});