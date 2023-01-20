const elBtnGrille = document.querySelector('.vue-grille-btn'); 
const elBtnListe = document.querySelector('.vue-liste-btn');
const liste = document.querySelector('ol.liste-vue');
const elBtnTri = document.querySelector('a.vue-filtre');
const elAsideTri = document.querySelector('aside.afficheTri');



  elBtnListe.addEventListener ('click', function (e) {
    e.preventDefault();
    elBtnGrille.classList.remove('active');
    elBtnListe.classList.add('active');
    liste.classList.remove('vue-grille-article');
    liste.classList.add('vue-liste-article');
  });

  elBtnGrille.addEventListener ('click', function (e) {
    e.preventDefault();
    elBtnGrille.classList.add('active');
    elBtnListe.classList.remove('active');
    liste.classList.remove('vue-liste-article');
    liste.classList.add('vue-grille-article');
  });

  elBtnTri.addEventListener ('click', function (e) {
    e.preventDefault(elAsideTri);
    if(elAsideTri.classList.contains('deploi')){
      elAsideTri.classList.remove('deploi');
      elBtnTri.classList.remove('active');
    }else{
      elAsideTri.classList.add('deploi');
    }
    
  });