$(document).ready(function(){
    var topics = $("#topics-nav li");
    var topicContent = $(".topiclink");
    var prevTopic = 0;
    console.log(topicContent);
    
    $(window).scroll(function(){
        var i;
        var scroll = $(window).scrollTop();
        for(i = 0; i < topicContent.length; i++){
            var pos = topicContent[i].offsetTop;
            if(pos >= scroll){
                topics[prevTopic].classList.remove("active");
                topics[i].classList.add("active");
                prevTopic = i;
                break;
            }
        }
    });
    
});