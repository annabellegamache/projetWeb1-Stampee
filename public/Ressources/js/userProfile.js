
(function() {

    /**
     * Gestion clique menu profil utilisateur  
    */ 
    let bntProfile = document.querySelector('[data-js-profile]');
    let elProfileMenu = document.querySelector('[data-js-profile-menu]');
    let bntLogOut = document.querySelector('[data-js-deconnexion]');
   
    /**
     * Gestion évènement clique sur le bouton profil
    */
    bntProfile.addEventListener('click', function(e) {
        e.preventDefault();
        setTimeout(function() {
            if (elProfileMenu.classList.contains('show')){
                elProfileMenu.classList.remove('show');
            }else{
                elProfileMenu.classList.add('show');  
            }
        }, 100);
    }); 

    /**
     * Gestion évènement clique sur le bouton déconnexion
    */
    bntLogOut.addEventListener('click', function(e) {
          e.preventDefault();
          
          setTimeout(function() {
                elProfileMenu.classList.remove('show');   
            }, 100);
          window.location.assign("Utilisateur/deconnexion")
    });


    /* 
    * Gestion chargement de page 
        1- navigation des tabs page
        2- set date constrainte on input value
    */
    window.onload = (event) => {
        /*tabs*/
        let panel = document.querySelector('.tabsnav');
        let panelId = panel.dataset.panel;
        let elInputNav = document.getElementById(panelId);
        resetTabsNav();
        elInputNav.checked = true;
        let panelContent = document.querySelector('div.' + panelId);
        panelContent.style.display = 'block';
        /*input date debut constraint*/
        let currentDate = new Date().toISOString().slice(0, -8); //yyyy-MM-ddThh:mm
        document.querySelector("#enc_date_debut").min = currentDate;  
      };

     
    /**
    * Gestion event change au input date debut pour forcer le minimium de la date de fin
    */
       document.querySelector("#enc_date_debut").addEventListener('change', function(){
        /*input date fin constraint*/
        let minDateFutur = document.querySelector("#enc_date_debut").value;
        //console.log(minDateFutur);
        document.querySelector("#enc_date_fin").min = minDateFutur;
       })

    /**
    * Gestion event select timbre pour ajouter Enchere
    */
   
   document.querySelector("#timbreId").addEventListener('change', function(){
        let idTimbre = document.querySelector("#timbreId").value;
        document.querySelector("#enchereTimbreId").value = idTimbre;
        //console.log(document.querySelector("#enchereTimbreId").value);
   })
        
  
        
    /* Gestion clique tabs publication utilisateur */
     let navTabs = document.querySelectorAll('label.labelnav');
     for (let i = 0; i < navTabs.length; i++) {

            navTabs[i].addEventListener('click', function(e) {
                e.preventDefault();  
                let panelNb = navTabs[i].getAttribute('for');
                let panel = document.querySelector('div.' + panelNb);


                resetTabsNav();
                let checkedPanel  = document.querySelector('input#' + panelNb)
                checkedPanel.checked = true;

                if(panelNb == 'option3'){
                    document.getElementById("turnAround").submit();
                    return
                }else{
                    panel.style.display = 'block';
                }
            });
     }
          
  
    /**
    * Fontions qui enlève l'attribut checked à tous les éléments de la navigation des tabs
    */
     
    function resetTabsNav(){

        let checkedPanels =document.querySelectorAll('.tabsnav input[type=radio]');
        
         /* enlever attribut checked */
         for (let i = 0; i < checkedPanels.length; i++) {
            checkedPanels[i].chekced = false;  
        }

        let panels = document.querySelectorAll('.tab-content');
       
        /* display tabs content none*/
        for (let i = 0; i < panels.length; i++) {
            panels[i].style.display = 'none';
            
        }
    }



    /**
       * Gestion event change au element du formulaire  timbre pour rendre le bouton modifier cliquable
    */
         let elForms = document.querySelectorAll("form.updateDeleteForm");
         //console.log(elForms);

         for (let i = 0; i < elForms.length; i++) {
            let elFormInputs = elForms[0].querySelectorAll('input');
            let btnModifier = elForms[0].querySelector('button.modifier');
            
            for (let j = 0; j < elFormInputs.length; j++) {
                elFormInputs[j].addEventListener('change', function(){
                   // console.log('disable');
                    btnModifier.disabled = false;
                })
                
             }
            
         }

})();
   
    

   

