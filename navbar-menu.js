//ON-OFF MENU
document.getElementById('menu-on').onclick = ()=>{
    if(document.getElementById('navbar__expand').style.display == "none"){
        document.getElementById('navbar__expand').style.display = "block";
        document.getElementById('content__homepage').style.width="85%";       
    }else{ 
        document.getElementById('navbar__expand').style.display="none"
        document.getElementById('content__homepage').style.width="100%";       
    }
}
document.getElementById('menu-off').onclick = ()=>{
    document.getElementById('navbar__expand').style.display="none";
    document.getElementById('content__homepage').style.width="100%" ;
}
//ACTIVE MENU 
$(function(){
    var url = window.location.href; 
    $("#navbar__expand a").each(function() {
        if(url==this.href) { 
            $(this).closest("li").addClass("active");
        }
    });
});