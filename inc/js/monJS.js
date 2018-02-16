

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
    ======  FONCTIONS POUR LA GESTION DES COMMANDES  ========================================================
    ====================================================================================================== */

    $(".detailCmd").on('click', function(e){
        //je récupère la valeur de l'attribut "data" du bouton sur la ligne commande. J'y ai inseré dynamiquement en php le numéro de l'id_commande qui fait référence à l'attribut "id"  du tableau détail commande.
        var idTab = $(this).attr('data');
        //je peux donc sélectionner en JQ ce tableau spécifique et l'afficher
       // $('#'+idTab).toggle();
        //puis je masque le bouton 'plus' pour afficher le bouton 'moins'
        $(this).find('span').toggle();
        $( '#'+idTab  ).toggle( 'blind', 500 );
        
    });


     /* ======================================================================================================
    ======  FONCTIONS POUR LE FORMULAIRE PROFIL  ========================================================
    ====================================================================================================== */

    $('.updateMembre').on('click', function(){
        //par défaut je cache tous les input et bouton saved
        $('.inputMembre, .savedMembre').hide();
        $('.infoMembre , .updateMembre').show();

        //je selectionne la balie "li" qui encadre le bouton sur le quel j'ai cliqué
        var li = $(this).parent();
        //puis j'affiche l'input et la disquette pour cette balise "li"
        li.find('.inputMembre, .savedMembre').show();
        //je masque l'info et le bouton stylo pour cette balise "li"
        li.find('.infoMembre , .updateMembre').hide();
    })

    
    $('.savedMembre').on('click', function(){
        var li = $(this).parent();
        var spanInfo = li.find('.infoMembre');
        //je selectionne l'input concerné
        var input = li.find('.inputMembre');
        //je récupère la valeur de l'input
        var valeurMAJ = input.val();
        //je récupère la valeur de l'attribut 'name' de l'input
        var champMAJ = input.attr('name');
        var idMembre = $('.idm').val();

        $.post('./inc/ajax.php','action=majmembre&val='+valeurMAJ+'&champ='+champMAJ+'&id='+idMembre,function(resutatUpdate){
            if(resutatUpdate.validation == 'ok'){
                //si ok, je veux afficher un message de succes de la MAJ du champ
                //et mettre à jour  et afficher l'info(s) affichée(s) à l'écran
                //masquer l'input et le bouton disquette
                $('.inputMembre, .savedMembre').hide();
                $('.infoMembre , .updateMembre').show();
                console.log( $(this).parent());
                li.append('<p class="text text-success">le '+champMAJ+' à été mit à jour !</p>');
                spanInfo.html(valeurMAJ);
            }
            else{
                alert('pb ');
            }
        },'json');
        
    });


});
