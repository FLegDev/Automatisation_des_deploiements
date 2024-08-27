<?php
/*
  Template Name: Demande d'échantillons gratuits
*/
	get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
	<h1><?php the_title(); ?></h1>
    <div class="content">
    	<?php the_content(); ?>
    </div>
	<div class="container-fluid boite_form ">
<h2 class="offset-2 col-8 field">Demandez votre échantillon</h2>
<div class="container row col-12 field">
<div class="col-6 sib-NAME-area field">
    <input type="text" class="sib-NAME-area" placeholder="Nom *"name="NAME" >
</div>
<div class="sib-ENSEIGNE-area col-6 field"> 
    <input type="text" class="enseigne" placeholder="Enseigne *" name="enseigne" required="required" > 
</div>
<div class="sib-email-area col-12 field">
  
    <input type="email" class="sib-email-area e-mail" placeholder="email *" name="email" required="required">
</div>
<div class="sib-NUMERO_RUE_MAGASIN-area col-3 field"> 
    <input type="text" class="sib-NUMERO_RUE_MAGASIN-area" placeholder="N° de Rue" name="NUMERO_RUE_MAGASIN" required="required" pattern="[0-9]+([.|,][0-9]+)?" > 
</div >
<div class="sib-ADRESSE-area col-6 field">
    <input type="text" class="sib-ADRESSE-area" placeholder="Nom de voie *" name="ADRESSE" placeholder="1" required="required" > 
</div>

<div class="col-3 sib-CODE_POSTAL_MAGASIN-area field"> 
    <input type="text" class="sib-CODE_POSTAL_MAGASIN-area" placeholder="CP *" name="CODE_POSTAL_MAGASIN" required="required" pattern="[0-9]+([.|,][0-9]+)?" > 
</div>
<div class="container field col-12 cgu">
    <input type="checkbox" name="terms" required="required ">J'accepte les <a href="https://www.corak.fr/mentions-legales/">CGU</a>
<div >
    <input type="submit" class="sib-default-btn" id="lp_button" value="Valider">
</div>
<p class="note_conformite field"> ** Vos informations seront utilisées dans le but de vous envoyer vos échantillons de masques.</p>
</div>
<?php
	get_footer();}
?>