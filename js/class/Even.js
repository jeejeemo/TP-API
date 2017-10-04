class Evenement{

        constructor (title, description,datedebut,datefin  ){

            this.title = title;
            this.description = description;
            this.datedebut = datedebut;
            this.datefin = datefin;
            this.$dom = null;
            // this.$alert1 = (".alert-danger");
        }
        displayNot(){
        
            var formatDateDebut = new Date(this.datedebut);
            var formatDateFin = new Date(this.datefin);   
            var datedebut = formatDateDebut.toLocaleDateString(this.datedebut);
            var datefin = formatDateFin.toLocaleDateString(this.datefin);
            
            var div = "<div class = 'event_light'>";
            div += "<div class='close'> X </div>";
            div += "<h4>"+ this.title + "</h4>";
            //div += "<h4>"+ this.description +"</h4>";
            div += "<i> du "+ datedebut + " au " + datefin + "</i>";
            div += "</div>";
            this.$dom = $(div);
            $("body").append(this.$dom);

            var div1 = "<div class = 'event_infos'>";
            div1 += "<div class='close1'> X </div>";
            div1 += "<h4>"+ this.title + "</h4>";
            div1 += "<h5>"+ this.description +"</h5>";
            div1 += "<i> du <br> "+ datedebut + "<br> au <br>" + datefin + "</i>";
            div1 += "</div>";
            this.$dom1 = $(div1);
            $("body").append(this.$dom1);

            var dateJour = new Date();
            if(this.datedebut.getTime() <= dateJour.getTime() && this.datefin.getTime() >= dateJour.getTime()){
                this.$dom.css('backgroundColor','green');
            }    
            else if(this.datefin.getTime() < dateJour.getTime()){
                this.$dom.css('backgroundColor','red');
               
            }
        
        }
        alertDayEven(){
            
            var dateJour = new Date();
            var dateJourJ3 = new Date();

            if(this.datedebut.getTime() <= dateJour.getTime() && this.datefin.getTime() >= dateJour.getTime()){
                app.$alert1.show();
            }    
            else if(this.datefin.getTime() < dateJour.getTime()){
                app.$alert2.show();
               
            }else if(this.datedebut.getTime < dateJourJ3.setDate(dateJour.getDate()-3)){
                    alerte("dans moins de 3 jrs");
            }
            
        }    
        
    
            
          
        destroy(){
            app.$alert1.remove();
            app.$alert2.remove();
            this.$dom.remove();
            this.$dom1.remove();
            
            
        }
    } 