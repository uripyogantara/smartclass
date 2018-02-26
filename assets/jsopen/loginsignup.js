// JavaScript Document
$(document).ready(function() 
{
$(".sign_up").click(function(){
    var id = $(this).data("id");
    $(".sidebar").fadeIn().find(".sidebar-content").animate({"right":0}, 200);   
});
$(".sidebar, .sign_in").click(function(){
    $(".sidebar-content").animate({"right":"-400px"},200,function(){
        $(".sidebar").fadeOut();   
    })   
});
$(".sidebar-content").click(function(e){ 
    e.stopPropagation();
});


});