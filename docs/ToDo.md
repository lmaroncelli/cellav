Quello che sto cercando di fare è "ricostruire il sito" con tecnolgie più nuove e più robuste. Sto implementando un piccolo CMS con Laravel 5.3 - quello che è attualmente il framework de facto dei programmatori PHP.
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



