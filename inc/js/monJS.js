

//document ready
$(function(){


    /*===============================================================================
    ================== FONCTION AJAX POUR LE PSEUDO / Page Inscription.php============
    ==================================================================================*/
    $('#inscription #pseudo').on('focus', function(e){
       $('#pseudo').parent().find('.alert').remove();
       $('#pseudo').parent().removeClass('has-error');
    });
  
    $('#inscription #pseudo').on('focusout', function(e){
        //event sur la saisie dans l'input pseudo
        //je déclanche une requete ajax
        val = $(this).val();
        /* $.ajax({
            url: "inc/ajax.php",
            type: 'post',
            data: 'pseudo=' + val
          })    */ 
          $.post(
            'inc/ajax.php', // Le fichier cible côté serveur.
            {
                pseudo : val // Nous supposons que ce formulaire existe dans le DOM.
            },
            AfficheError, // Nous renseignons uniquement le nom de la fonction de retour.
            'text' // Format des données reçues.
        );
        
        function AfficheError(libre){
            //si j'ai une erreur : libre = nondispso, j'affiche un message 
            if(libre == "nondispo") {
                msg = '<div class="alert alert-danger">Pseudo non dispo !</div>';
                $('#pseudo').parent().addClass('has-error');
            } else {
                msg ='<div class="alert alert-success">pseudo dispo !</div>';
                $('#pseudo').parent().addClass('has-success');
            }

            $('#pseudo').parent().append(msg);
            // Du code pour gérer le retour de l'appel AJAX.
        }
    });

    /* ======================================================================================================
    ======  FONCTIONS pour la gestion des catégories dans le formulaire gestion_boutique  ====================
    ====================================================================================================== */
    $('#selectCateg').on("change", function(){
        if($(this).val()=='nouvelleCat'){
            $('.ajout-categ').show();
            $('.ajout-categ').val('');
        }else {
            $('.ajout-categ').hide();
            $('.ajout-categ').val($(this).val());
        }
    });

    
    

     /* ======================================================================================================
    ======  FONCTIONS POUR LE FORMULAIRE PROFIL  ========================================================
    ====================================================================================================== */

    $('.updateMembre').on('click', function(){
        //par défaut je cache tous les input et bouton saved
        toggoleInputButton();

        
        //je selectionne la balie "div" qui encadre le bouton sur le quel j'ai cliqué
        var div = $(this).parent();
        //puis j'affiche l'input et la disquette pour cette balise "li"
        div.find('.inputMembre, .savedMembre').show();
        //je masque l'info et le bouton stylo pour cette balise "li"
        div.find('.infoMembre , .updateMembre').hide();

        //traitement spécial pour les label des boutons radio
        if(div.find('.labelRadio')){
            div.find('.labelRadio').show()
        }

    })

    
    $('.savedMembre').on('click', function(){
        var div = $(this).parent();
        var spanInfo = div.find('.infoMembre');
        //je test si la valeur saisie est différente de la valeur initialle
        var previousVal = spanInfo.html();
        //je selectionne l'input concerné
        var input = div.find('.inputMembre');
        //je récupère la valeur de l'attribut 'name' de l'input
        var champMAJ = input.attr('name');
        //traitement spécial pour le bouton radio
        if(champMAJ == 'civilite'){
            //je récupère la valeur du radio checked
            var input = div.find('.inputMembre:checked');
            var valeurMAJ = input.val();
            if(previousVal=='Homme'){
                var newInfoCivilite= "Femme";
                previousVal="m";
            }else{
                var newInfoCivilite= "Homme";
                previousVal="f";
            }
        }else{
            //je récupère la valeur de l'input
            var valeurMAJ = input.val();
        }
        
        //je supprime les "alert"
        $('.alert').hide();
        div.removeClass('has-error');

        //je vérifie que la valeur de l'input n'est pas vide
        if(valeurMAJ.length == 0){
            var divAlert = $('<div class="alert alert-danger">vous devez saisir votre '+champMAJ+' !</div>').hide();
            div.append(divAlert);
            divAlert.fadeIn(800);
            div.addClass('has-error');
            input.val(previousVal).focus();
        }else if(previousVal == valeurMAJ){
            //je ne fais rien
            toggoleInputButton();
        }else{
            //sinon j'envoie en ajax
            $.post('./inc/ajax.php','action=majmembre&val='+valeurMAJ+'&champ='+champMAJ,function(resultatUpdate){
                if(resultatUpdate.validation == 'ok'){
                    //si ok, je veux afficher un message de succes de la MAJ du champ
                    //et mettre à jour  et afficher l'info(s) affichée(s) à l'écran
                    //masquer l'input et le bouton disquette
                    var divAlert = $('<div class="alert alert-success">le '+champMAJ+' à été mit à jour !</div>').hide();
                    div.append(divAlert);
                    divAlert.fadeIn(800);
                    //traitement spécial pour l'info de la civilite
                    if(champMAJ=='civilite'){
                        spanInfo.html(newInfoCivilite);
                    }else if(champMAJ == 'pseudo'){
                        //spécifique pour le pseudo, je met à jour le message de bienvenue
                        $('.infoPseudo').html(valeurMAJ);
                        spanInfo.html(valeurMAJ);
                    }else{
                        spanInfo.html(valeurMAJ);
                    }
                    
                    
                    toggoleInputButton();
                }
                else{
                    //le pseuso n'est pas dispo
                    var divAlert = $('<div class="alert alert-danger">Pseudo non disponible !</div>').hide();
                    div.append(divAlert);
                    divAlert.fadeIn(800);
                    div.addClass('has-error');
                    input.val(previousVal).focus();
                }
            },'json');
        }
    }); //fin click bouton savedMembre


    function toggoleInputButton(){
        $('.inputMembre, .savedMembre').hide();
        $('.infoMembre , .updateMembre').show();
        //je cache aussi les label des bouton radio
        $('.labelRadio').hide();
    }




     /* ======================================================================================================
    ======  FONCTIONS POUR LE FORMULAIRE DE COMMENTAIRE  ========================================================
    ====================================================================================================== */

    $('.updateCommentaire').on('click', function(){
        //je récupère l'id du commentaire
        var idCommentaire = $(this).attr('id');
        console.log(idCommentaire);
        //je remonte sur le "<TR>" puis la class "msgCommentaire" pour récupérer le message du commentaire
        var commentaire = $(this).parent().parent().find('.msgCommentaire').html();
        //je prépare 
        //je met le commentaire dans le formulaire Modal
        $('.getCommentaire').html(commentaire);
        $('#inputIdCommentaire').val(idCommentaire);
    });//fin du click boutton updanteCommentaire
});//fin du document Ready
