<footer class="bg-dark text-center text-lg-start text-white ">
    <div class="container p-4">
    <div class="row my-4">
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <div class="">
                <img src="{{ asset('assets/annonce/logo2.png')}}" width="50%" loading="lazy"/>
            </div>
            <p class="text-start lien_footer"> L'utilisation de ce site Internet implique l'acceptation des Conditions générales et du règlement sur le Respect de la vie privée.</p>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4 mt-4">Electro</h5>
        <ul class="list-unstyled">
            <li class="mb-4 p-2 lien">
                <a href="{{ route('propos') }}" class="lien_footer">A propos</a>
            </li>
            <li class="mb-4 p-2 lien">
                <a href="index.php?p=politique" class="lien_footer">Politique de confidentialité</a>
            </li>
            <li class="mb-4 p-2 lien">
                <a href="index.php?p=info" class="lien_footer">Informations legale</a>
            </li>
        </ul>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4 mt-4">Contact</h5>
        <h5 class="mb-4 lien p-2"><a href="{{route('contact')}}" class="lien_footer">Contactez nous</a></h5>
        <ul class="list-unstyled d-flex flex-row justify-content-center">
            <li>
            <a class="text-white me-4 px-2" target="_blank" href="https://www.facebook.com/Electroshop225/">
                <i class="fa-brands fa-facebook fa-3x"></i>
            </a>
            </li>
            <li>
            <a class="text-white me-4 px-2" target="_blank" href="https://www.instagram.com/noirchron/?hl=fr">
                <i class="fa-brands fa-instagram fa-3x"></i>
            </a>
            </li>
            <li>
            <a class="text-white me-4 ps-2" target="_blank" href="https://www.youtube.com/channel/UCmOdMKDU5hcf-LULmYREJgQ">
                <i class="fa-brands fa-youtube fa-3x"></i>
            </a>
            </li>
        </ul>
        </div>
    </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); font-size:1.4em">
    Toutes les marques apparaissants sur <a href="index.php" class="text-white ">ElectroShopping.ci</a> sont la propriété de leurs propriétaires respectifs.
    </div>
</footer>
