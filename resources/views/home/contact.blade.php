@extends('welcome')

@section('name', 'Contact')

@section('content')

    <section class="contacter">
        <div class="contact-content">
            <h2>Contactez-nous</h2>
            <p>Envoyer un message au Ministère des Affaires Sociales et de la Microfinance du Bénin en remplissant le formulaire ci-dessous.</p>
            <form action="" method="get">
                <label for="">Nom*</label>
                <input type="text" name="nom" id="">
                <label for="">Email*</label>
                <input type="email" name="prenom" id="">
                <label for="">Object*</label>
                <input type="email" name="email" id="">
                <label for="">Message*</label>
                <textarea name="message" id="" cols="30" rows="5"></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>

        <div class="contact-img">
            <h2>Toute l’actualité du Ministere en temps réel sur nos réseaux sociaux. <br>
                <a href="#"><i class='bx bxl-facebook' ></i></a>
                <a href="#"><i class='bx bxl-youtube' ></i></a>
                <a href="#"><i class='bx bx-search' ></i></a> 
            </h2>
        </div>

        <div class="femme5">

        </div>
    </section>

    <section class="geo">
        <h1>Geo-(MASM)</h1>
        <div id="map"></div>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>

        var map = L.map('map').setView([12.6395, 8.0029], 15); 


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        
        L.marker([12.6395, 8.0029]).addTo(map)
            .bindPopup('Ministère des Affaires Sociales et de la Microfinance')
            .openPopup();
    </script>
    </section>
    
@endsection()