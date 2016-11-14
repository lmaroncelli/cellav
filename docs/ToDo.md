Quello che sto cercando di fare è "ricostruire il sito" con tecnolgie più nuove e più robuste. Sto implementando un piccolo CMS con   Laravel 5.3 - quello che è attualmente il framework de facto dei programmatori PHP.
Questo credo sia la base necessaria ma non sufficiente per implementare poi le funzionalità che hai richiesto (tour virtaule, upload dei video, integrazione "avanzata" con Facebbok).

In questo nuovo sito ci saranno le pagine listing dei prodotti ? 

In particolare i link in alto verranno mantenuti (non parlo di grafica, parlo di funzionalità di filtro di prodotti in base alle categorie)

I filtri per caratteristiche ci saranno ?

Il discorso delle ricette verrà mantenuto ?

I commenti nella scheda prodotto ?





#Pagine Listing

Le pagine di listing dei prodotti per categoria si possono fare in 2 modi, in entrambi passo dalla route delle pagine

1. prima di cercare tra le pagine verifico se lo slug è lo slug di una categoria e se lo è creo con un template l'elenco dei prodotti di quella categoria (la cosa è poco flessibile, non creo una pagina, e se voglio aggiungere del contenuto devo modificare il template via codice)

2. possibilità di costruire delle pagine listing in cui specifico il filtro categoria e la seleziono; in questo caso il contenuto della pagina è sempre editabile e per ogni listing posso aggiungre il contenuto che voglio

------------------------------------------------------------------------------------------------------

|_| listing attivo

categoria	<select_categorie>

caratteristiche 

|_| caratteritisca 1			|_|  caratteritisca 2			|_|  caratteritisca 3

|_| caratteritisca 4			|_|  caratteritisca 5			|_|  caratteritisca 6 




nel controller avrò della pagina avrò una funzione che, se attivo il listing, mi trova i prodotti

$protti = Protto
			->attivo()
            ->listingCategorie($pagina->listing_categorie) // una lista di id 
			->listingCaratteristiche($pagina->listing_caratteristiche)
      
Dove questi query scope sono definiti sulla model prodotto tipo

 public function scopeListingCategorie($query, $categorie)
    {
    if(!$categorie)
      return $query;
	
	// qui devo prendere i prodotti che hanno ALMENO tutte le categorie elencate in $categorie
    // più semplicemente trovo gli id dei prodotti che che hanno ALMENO tutte le categorie elencate in $categorie
    // e poi faccio una query whereIn

    if(strpos($categorie, ",") !== false)
      return $query->whereIn("categoria_id", explode(",", $categorie));
    else
      return $query->where("categoria_id", $categorie);
    }


La stessa cosa farò per le caratteristiche






========================================================
===================== DA FINIRE ========================
========================================================


1. mettere i campi SEO per title, keyword, description in tutti i form (@include seo_fields ???)






========================================================
======================== ACL  ==========================
========================================================

`role` ENUM('admin','operatore','commerciale','hotel') NOT NULL COLLATE 'utf8_unicode_ci',




Class User


public function hasRole($roles)
    {

    if(is_array($roles))
      $roles_arr = $roles;
    else
      $roles_arr = [$roles];

    foreach($roles_arr as $role_neded)
      {
      if(strtolower($role_neded) === strtolower($this->role))
        return true;
      }

    return false;
    }


// middleware query 

 public function terminate($request, $response) 
    {
    
      //retrieve all executed queries
     
      if (in_array($request->ip(),\Utility::validIP())) {
        
        $queries = DB::getQueryLog();
        echo '<pre style="display:none;">';
          print_r($queries);
      echo "</pre>";
      
      }
    }
  }






  se un elemento lo identifico come

<span data-id="{{$id}}" class="delete_page">

jQuery(".delete_page").click(function(e){
      e.preventDefault();
        var id = jQuery(this).data('id');
       jQuery.post(
              baseUrl+"/admin/menu-categorie-pagine/del_page_menu", 
              id:id
        }).done(function(data){
          // nothing
        });








=============================================================================

Allora:
l'unico filtro che voglio rimanga è "senza lattosio" [OK]

le ricette voglio mantenerle, ma voglio semplificarle, ossia non collegarci nessun prodotto, non ho bisogno di segnalare il grado di difficoltà, ecc ecc. Non mi interessano i filtri "senza questo, senza quello" nelle ricette. [OK]

Sostanzialmente voglio che diventino semplicemente un elenco di antipasti, pane&pizza, primi piatti e così via

Non mi interessa mantenere gli attuali commenti nè in relazione agli attuali prodotti nè in relazione alle attuali ricette. Se è un problema inserire i commenti nei prodotti e nelle ricette non si tratta di una funzionalità fondamentale, ne faccio tranquillamente a meno. Se si possono mettere commenti che appaiono solamente previa mia approvazione bene, altrimenti bene uguale e avanti senza commenti.
Non ho capito cosa intendi quando mi chiedi se voglio mantenere pagine listing dei prodotti.
E' normale che voglia mantenere una lista di prodotti quando si clicca sulla macrocategoria "farina" o "dolci&biscotti" (solo per fare due esempi), ma non credo sia quello che mi chiedevi.
Dell'attuale sito mi interessa mantenere per motivi SEO solamente alcune url. Relativamente a queste url non farò infatti neanche grandi modifiche sui testi presenti.
In generale quindi l'url rewriting è fondamentale, soprattutto per non perdere il traffico attuale.
Relativamente alla direzione di sviluppo io creerei un sito parallelo, in una cartella schermata con noindex e nofollow, e lavorerei lì sopra.

Cmq il 19 ed il 20 Novembre sono a Rimini per una fiera, se vuoi mi vesto da Wanda Nara e ci incontriamo...

