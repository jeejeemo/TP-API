class App {

    constructor(){
        this.currentPostit = null;
        this.$add_evenement = $("#add_evenement");
        this.$add_title = $("#add_title");
        this.$add_description = $("#add_description");
        this.$add_datedebut = $("#add_datedebut");
        this.$add_datefin = $("#add_datefin");
        this.$add = $("#add");
        this.$close = $(".close")

        this.$container_evenement = $("#container_evenement");
        this.$infos_evenement = $(".event_infos");
        this.$contain_event_close = $("#contain_event_close");
        this.event_light = $("#event_light");
        this.$alert1 = $(".alert-danger");
        this.$alert2 = $(".alert-warning");

        this.evenements=[];


        this.initPickers()

    }
    
        addEvenement(evenement){
            this.evenements.push(evenement);
        }

        initPickers(){
            
            var options = {
                dayNames : ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                dayNamesMin : ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
                monthNames : ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
                monthNamesShort : ["Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
                firstDay : 1,
                dateFormat : "dd/mm/yy",
            };
    
            this.$add_datedebut.datepicker( options );
            this.$add_datefin.datepicker( options );
            
        }
        
        removeEven(index){
            var even = this.evenements[index];
            even.$dom.fadeOut(300, function(){
                
                even.destroy();
                
            })
            this.evenements.splice(index, 1); 

        }

        saveEven(){
            // var evenJson = JSON.stringify( this.evenements );
            // localStorage.setItem("events", evenJson);
            
        }

        readEven(){
            var that = this ;
            $.ajax({
                url : "http://localhost/APITP/events",
                method : "get",
                dataType : "json",
                success: function ( data ){
                    for( var data_even of evens){
                        var even= new Evenement (data_even.title, data_even.description,new Date(data_even.datedebut),new Date(data_even.datefin));
                        even.id = data_even.id;
                        that.addEvenement(even);
                        even.displayNot();
                        
                    }
                }
            
          
        }
        searchEvenDay(){
            for(var even of this.evenements ){
                even.alertDayEven();
            }
        }

        
      
        
        
             
}