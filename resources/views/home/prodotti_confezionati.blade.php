<div id="confezionati" class="content-section-b content-section-confezionati">
    <div class="container">
        <div class="row row_prodotti_confezionati">

            <div class="col-sm-6 wow fadeInLeftBig text-center" data-animation-delay="200">
                <h3 class="section-heading">
                    Prodotti confezionati
                </h3>
                <div class="sub-title lead3">
                   TUTTO IL MEGLIO
                </div>
                <p class="lead">
                    In his igitur partibus duabus nihil erat, quod Zeno commuta rest gestiret. 
            Sed virtutem ipsam inchoavit, nihil ampliusuma. Scien tiam pollicentur, 
            uam non erat mirum sapientiae lorem cupido
            patria esse cariorem. Quae qui non vident, nihilamane umquam magnum ac cognitione.
                </p>
                <p>
                    <a class="btn btn-embossed btn-primary" href="#" role="button">
                        APPROFONDISCI
                    </a>
                </p>
                <h4>Video di accoglienza</h4>
                <p class="video_confezionati">
                  <a class="popup-youtube" href="https://www.youtube.com/embed/hrqf_OwWqXs">
                    <img src="{{ url('frontend_new/assets/img/th_acc_1.jpg') }}" alt="Prodotti confezionati">
                  </a>
                  <a class="popup-youtube" href="https://www.youtube.com/embed/hrqf_OwWqXs">
                    <img src="{{ url('frontend_new/assets/img/th_acc_2.jpg') }}" alt="Prodotti confezionati">
                  </a>
                </p>
            </div>

             <div class="col-sm-6 wow fadeInRightBig">
                <div class="owl-carousel" id="owlc">
                    @foreach ($slide_confezionati->immagini as $count => $immagine)
                      <a class="image-link" href="{{ url('images/'.$immagine->nome) }}">
                          <div class="item">
                              <img  class="img-responsive" src="{{ url('images/'.$immagine->nome) }}"/>
                              </img>
                          </div>
                      </a>
                     @endforeach
                </div>
            </div>


        </div>{{-- / row --}}
    </div> {{-- container --}}
</div> {{-- content-section-b --}}