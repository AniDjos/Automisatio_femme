<header class="headerer">
        <a href="#" class="logoo"><img src="{{ asset('images/logo-masm.png') }}" alt=""></a>

        <nav class="navbarre">
            <a href="{{route('App_acceuil')}}"  onclick="changeColor(this)">Accueil</a>
            <a href="{{route('App_groupement')}}"  onclick="changeColor(this)">Nos groupements</a>
            <a href="{{route('App_prestation')}}"  onclick="changeColor(this)">Nos prestations</a>
            <a href="{{route('App_contact')}}"  onclick="changeColor(this)">Contact</a> 
            <a href="{{route('login')}}"  onclick="changeColor(this)">Connexion</a> 
        </nav>

        <div class="social-media">
            <a href="#"><i class='bx bxl-facebook' ></i></a>
            <a href="#"><i class='bx bxl-youtube' ></i></a>
            <a href="#" id="searchIcon"><i class='bx bx-search'></i></a> 
        </div>

        <div class="modal" id="searchModal">
            <div class="modal-content">
                <div class="modal-header">
                    <span>RECHERCHE</span>
                    <button class="close-btn" id="closeModal">&times;</button>
                </div>
                <input type="text" class="search-input" placeholder="Que recherchez-vous ?">
                <button class="search-button">Rechercher</button>
            </div>
        </div>
</header>
<script>
        // Sélection des éléments
        const searchIcon = document.getElementById("searchIcon");
        const searchModal = document.getElementById("searchModal");
        const closeModal = document.getElementById("closeModal");

        // Afficher la modale
        searchIcon.addEventListener("click", () => {
            searchModal.classList.add("show");
        });

        // Fermer la modale
        closeModal.addEventListener("click", () => {
            searchModal.classList.remove("show");
        });

        // Fermer en cliquant à l'extérieur
        searchModal.addEventListener("click", (event) => {
            if (event.target === searchModal) {
                searchModal.classList.remove("show");
            }
        });
        function changeColor(element) {
            element.style.color = "#c2bd35";
        }
</script>