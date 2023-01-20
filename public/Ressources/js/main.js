/*import classe */
import Formulaire from './Formulaire.js';

(function() {

    
    /*instance classe pour tous les formulaire*/
    let elForms = document.querySelectorAll('form');
    for (let i = 0, l = elForms.length; i < l; i++) {
            new Formulaire(elForms[i]); 
            
    }

    /* Gestion clique menu profil utilisateur */
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


    /**
     * Gestion évènement change sur le input de recherche (barre de navigation)
    */
    let search = document.querySelector('#formSearch');
    let inputSearch = search.recherche;
    search.addEventListener('change', function(){
        if (inputSearch.value != ''){
            console.log(inputSearch.value);
            search.submit();
        }
    })

})();
   
    

   

