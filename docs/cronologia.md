
**11/12/16** Homepage

La homepage è un insieme di elementi che vanno costruiti (slide header, slide freschi, slide confezionati, negozi,...)
ci sarà una pagina di amministrazione per gestire questi widget della home.


**03/01/17** Widget


==========================================================
il widget "slide prodotti" avrà:

- nome (es: "widget prodotti confezionati Magliana")

PARTE 1
- slide con immagini (come home page)

PARTE 2
- titolo
- descrizione
- link alla pagina statica (link pulsante visualizza)
- link al video (facoltativo)

ci dovrà essere un modo per scegliere se ci sono prima (a sx) le slide o la descrizione

==========================================================
lo slide "i confezionati Tiburtina" avrà:

- titolo
- slide con immagini (5 alla volta)




==========================================================
lo slide "header" avrà:

- titolo
- slide header come homepage


==========================================================
il widget "mappa" avrà:

- titolo (es: "mappa home page")
- nome (Celiachiamo Lab)
- indirizzo (Via della Magliana 183)
- lat (14.032233)
- long (7.09324234)
NO QUESTO NON SARA' UN WIDGET MA I CAMPI SARANNO IN TUTTE LE PAGINE ??


==========================================================
il widget "gallery categorie prodotti" avrà:

- titolo
- gallery del tipo (foto piccola, foto grande, link alla pagina)


==========================================================
il widget "ThreeColumnsWidget" avrà:

- nome
- img_1
- titolo_1
- descrizione_1
- link_1 alla pagina statica (link pulsante visualizza)
- img_2
- titolo_2
- descrizione_2
- link_2
- img_3
- titolo_3
- descrizione_3
- link_3



cioè  un tab con 3 elementi dove per ognuno ci può essere foto e descrizione

serve per HOMEPAGE e SERVIZI MAGLIANA (catering servizi a domicilio, corsi)










**05/01/17** Pagine Negozi


===================================================================
Magliana

1. slide 'header'

2. descrizione

3. widget 'elenco elementi'

4. widget 'slide prodotti'

5. widget 'mappa'

6. listing prodotti

7. widget 'gallery categorie prodotti' 

8. link al virtual tour creato dal fotografo

**gli altri negozi avranno questi campi OPPURE MENO**



**08/01/17** Relazione one-one Widget--Slide

se WIDGET hasOne SLIDE allora devo mettere widget_id nella tabella della slide
SICCOME ho già messo la FK slide_id nella tabella dei widget, ALLORA giro la relazione e dico 

SLIDE hasOne WIDGET (è sempre 1 a 1, ma in questo modo la slide_id va nella tabella widget)
