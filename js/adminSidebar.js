$(document).ready(function(){
    $("#sidebarMenu li").on('click', function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
    })
});
