$(document).ready(function(){
    var nav = $('nav');
    nav.find('a').on('click',function(){
        var id=$(this).attr('href');
        $('html, body').animate({scrollTop:$(id).offset().top},1000);
        return false;
    });
});
$(document).ready(function(){
   $(window).scroll(function(e){
     if($(window).scrollTop()>730)
    {
        $(".hs2").css("opacity", 1 - $(window).scrollTop() / 1050);   
    }else if($(window).scrollTop()>350){
        $('.s1 video').addClass('blurvid1');
        $('.s1 video').removeClass('blurvid2');
        $(".hs1").css("opacity", 1 - $(window).scrollTop() / 320);
        $(".hs2").css("opacity", 0 + $(window).scrollTop() / 550);
    }else if($(window).scrollTop()>220){
        $('.s1 video').addClass('blurvid2');
    }
    else{
        $(".hs1").css("opacity", 1 - $(window).scrollTop() / 320);
        $('.s1 video').removeClass('blurvid1');
        $('.s1 video').removeClass('blurvid2');
    }
   });
})