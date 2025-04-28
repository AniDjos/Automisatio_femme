@extends('welcome')

@section('name', 'Accueil')

@section('content')

    <section class="homee">
        <div class="homee-content">
            <h2>Ministère des affaires sociales et de la microfiance (MASM)</h2>
            <h3>Emancipation de la femme notre devoir !</h3>
            <p>Le groupement des professionnels de la santé est une association qui regroupe les professionnels de la santé de la région de l'ouest du Cameroun.</p>
            <a href="#body-header" class="btnn">En savoir plus</a>
        </div>

        <div class="homee-img">
            <div class="femme">
            <img src="{{ asset('images/FEME.png') }}" alt="Logo" style="width: ;">
            </div>
        </div>

        <div class="femme2">

        </div>

    </section>

    <section id="body-header">
        <div class="body-content">
            <h3>Qui sommes nous ?</h3>
            <p>Le Ministère des Affaires Sociales et de la Microfinance joue un rôle fondamental dans l’élaboration et la mise en œuvre des politiques publiques visant à améliorer les conditions de vie des populations vulnérables et à promouvoir l’inclusion financière. À travers ses différentes initiatives, il travaille à renforcer la protection sociale, à soutenir les groupes défavorisés et à encourager l'autonomisation économique, en particulier celle des femmes et des jeunes. En facilitant l’accès aux services sociaux de base et en développant des programmes de microfinance adaptés, le ministère contribue à la réduction de la pauvreté et à l’amélioration du bien-être des citoyens. Il collabore également avec des partenaires nationaux et internationaux pour financer des projets de développement et accompagner les bénéficiaires dans la gestion efficace de leurs activités génératrices de revenus.</p>
            <p>Dans le domaine de la microfinance, le ministère met en place des mécanismes permettant aux populations exclues du système bancaire classique d’accéder à des financements adaptés à leurs besoins. À travers des structures spécialisées et des programmes de soutien, il favorise la création et le développement des coopératives et des groupements de microfinance, facilitant ainsi l’entrepreneuriat et la résilience économique. L’adoption de solutions numériques pour la gestion de ces initiatives constitue un enjeu majeur, permettant une meilleure traçabilité des fonds, une transparence accrue et un suivi plus efficace des bénéficiaires. Grâce à ces actions, le Ministère des Affaires Sociales et de la Microfinance s’impose comme un acteur clé du développement social et économique, en garantissant un cadre favorable à l’inclusion et à l’épanouissement des populations les plus vulnérables.</p>
        </div>
        <div class="femme3">
            
        </div>
        <div class="femme4">
            
        </div>
    </section>

    <section class="contact">
        <div class="contact-content">
            <h2>NEWSLETTER</h2>
            <form action="" method="get">
                <label for="">Nom</label>
                <input type="text" name="nom" id="">
                <label for="">Prénom</label>
                <input type="text" name="prenom" id="">
                <label for="">Email</label>
                <input type="email" name="email" id="">
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

    </section>


@endsection()
