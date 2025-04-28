@extends('welcome')

@section('name', 'Accueil')

@section('content')

    <section class="accueil">
        <div class="acc-img">
            <img src="{{ asset('images/menu-ministere.png') }}" alt="">
            
        </div>
    </section>

    <section class="prestation">
        <div class="prestation-header">
            <h2>Nos prestations</h2>


            <ul class="accordion">
                <li>
                    <input type="radio" name="accordion" id="first">
                    <label for="first">MINISTERE</label>
                    <div class="content">
                        <p>
                            <ul>
                                <li>Maintenance informatique</li>
                                <li>Consultation sur place de documents</li>
                                <li>Gestion du processus de planification du Ministère</li>
                                <li>Délivrance d’attestation de service fait;</li>
                                <li>Délivrance d’attestation de bonne fin d’exécution</li>
                                <li>Délivrance d’agrément aux fournisseurs</li>
                                <li>Délivrance d’attestation de fin de stage</li>
                                <li>Offre de stage</li>
                                <li>Signature de contrat de partenariat avec les ONG intervenant dans les domaines d’action du Ministère</li>
                            </ul>
                        </p>
                    </div>
                </li>

                <li class="accordion">
                    <input type="radio" name="accordion" id="second">
                    <label for="second">FAMILLE ET AFFAIRES SOCIALES</label>
                    <div class="content">
                        <p>
                            <ul>
                                <li>Délivrance d’agréments de crédit délégué</li>
                                <li>Secours immédiats</li>
                                <li>Consultation de statistiques et documents relatifs à la femme, au genre et à la protection sociale</li>
                                <li>Appui à l’installation des personnes handicapées</li>
                                <li>Appui aux écoliers, élèves et étudiants</li>
                                <li>Appui à la réalisation des infrastructures socio-communautaires</li>
                                <li>Appui aux personnes indigentes en difficultés</li>
                                <li>appui aux cas sociaux en fin d’apprentissage</li>
                                <li>Appui aux communautés sinistrées</li>
                                <li>Appui aux naissances multiples</li>
                                <li>Appui aux comités RBC dans la sensibilisation et la mobilisation de fonds</li>
                                <li>Appui aux comités pour la rédaction de microprojets</li>
                                <li>Fourniture d’aides techniques (tricycles, cannes blanches, cannes anglaises, fauteuils roulants)</li>
                                <li>Délivrance de certificat d’indigence</li>
                                <li>Assistance aux victimes de violences faites aux femmes et aux filles</li>
                                <li>Appui technique aux organisations de la société civile</li>
                                <li>Appui en matériels aux groupements féminins</li>
                                <li>Autorisation d’ouverture des crèches garderies</li>
                                <li>Suivi et appui des CAPE dans leur fonctionnement</li>
                                <li>Délivrance d’autorisation d’ouverture des CAPE</li>
                            </ul>
                        </p>
                    </div>
                </li>

                <li class="accordion">
                    <input type="radio" name="accordion" id="third">
                    <label for="third">CENTRE DE PROMOTION SOCIAL</label>
                    <div class="content">
                        <p>
                            <ul>
                                <li>Appui conseil aux couples en difficultés</li>
                                <li>Suivi des enfants de 00 à 5 ans de mère détenus en milieu carcéral</li>
                                <li>Prise en charge des enfants en danger moral</li>
                                <li>Prise en charge psychosociale des enfants en conflit avec la loi depuis son arrestation jusqu’à sa mise en liberté</li>
                                <li>Exonération des frais de scolarité à travers l’établissement des titres d’exonération</li>
                                <li>Placement du bébé abandonné dans un ménage ou dans une structure de placement</li>
                                <li>Prise en charge psychosociale du bébé abandonné en séjour à l’hôpital</li>
                                <li>Assistance à la personne indigente</li>
                                <li>Assistance psycho sociale des malades</li>
                                <li>Intégration, insertion et réinsertion sociale des déficients visuels</li>
                                <li>Formation en informatique adaptée</li>
                                <li>Appui en fournitures brailles et aide technique</li>
                                <li>Réhabilitation et réadaptation des aveugles tardifs ; formation professionnelle des aveugles en tissage de natte en jonc et fabrication des fauteuils en ficelle</li>
                                <li>Préparation de savon artisanal, éducation civique et formation macramé</li>
                                <li>Formation en tissage, en agro-élevage</li>
                                <li>Enfance malheureuse</li>
                                <li>Secours immédiats</li>
                                <li>Secours indigents</li>
                                <li>Secours sinistres</li>
                                <li>Suivi des personnes de troisième âge et des personnes handicapées</li>
                                <li>Suivi des enfants/femmes victimes de violences de tout genre</li>
                                <li>Exonération des frais scolaires</li>
                                <li>Secours à l’enfance malheureuse</li>
                            </ul>
                        </p>
                    </div>
                </li>

                <li class="accordion">
                    <input type="radio" name="accordion" id="fifth">
                    <label for="fifth"  >MICROFINANCE</label>
                    <div class="content">
                        <p>
                            <ul>
                                <li>Constitution en faveur du bénéficiaire d’une petite épargne sur chaque remboursement</li>
                                <li>Encadrement et suivi l’exécution des activités des groupements en vue d’un bon remboursement</li>
                                <li>Mise en place les micro crédit</li>
                                <li>Sensibilisation et formation des potentiels bénéficiaires sur des notions essentielles de solidarité développement des AGR et de gestion du crédit</li>
                                <li>Organisation des potentiels bénéficiaires en groupement de 03 à 15 personnes</li>
                            </ul>
                        </p>
                    </div>
                </li>
            </ul>

        </div>

        <div class="femme6">

        </div>
        <div class="femme7">
            
        </div>
    </section>


@endsection()