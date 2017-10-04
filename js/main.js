var app= new App();
app.readEven();

app.searchEvenDay();

app.$add.click(function(){
    
app.$add_evenement.slideToggle(200);
    
});

app.$add_evenement.submit(function(event){

    event.preventDefault();

    var title = app.$add_title.val();
    var description = app.$add_description.val();

    var datedebut = app.$add_datedebut.datepicker("getDate");
    var datefin = app.$add_datefin.datepicker("getDate");

    var evenement = new Evenement(title,description, datedebut,datefin);
    evenement.displayNot();
    evenement.alertDayEven();

    app.addEvenement(evenement); 
});

$(document).on("click", ".event_light", function(){
    // app.$infos_evenement.fadeIn(300);
    var index = $(".event_light").index( $(this)); 
    var infos = app.evenements[ index];
    app.currentPostit = infos;
    infos.$dom1.show();
 
})

$(document).on("click", ".close1", function(){ 
    var index = $(".close1").index($(this));
    var close1 = app.evenements[index];
    app.currentPostit = close1;
    close1.$dom1.hide();  
})

$(document).on("click",".close" , function(event){
    event.stopPropagation();
    var index = $(".close").index($(this));
    var close = app.evenements[index];
    app.removeEven(index);
})
window.onbeforeunload = function(){
    app.saveEven();
}