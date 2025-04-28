<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestionApp Dashboard</title>
    <style>
    /* Variables CSS */
    :root {
        --primary: #9b87f5;
        --primary-foreground: #ffffff;
        --background: #ffffff;
        --foreground: #222222;
        --muted: #f1f1f1;
        --muted-foreground: #888888;
        --border: #e5e5e5;
        --destructive: #ea384c;
        --accent: #e5deff;
        --sidebar-width: 16rem;
        --sidebar-width-collapsed: 5rem;
        --topbar-height: 4rem;
    }

    /* Thème sombre */
    body.dark {
        --background: #121212;
        --foreground: #ffffff;
        --muted: #1e1e1e;
        --muted-foreground: #aaaaaa;
        --border: #333333;
        --primary: #bb86fc;
        --primary-foreground: #ffffff;
        --destructive: #cf6679;
        --accent: #2a2a2a;
    }

    body.dark .menu-link:hover {
        background-color: var(--accent);
        color: var(--primary);
    }

    body.dark .dropdown-link:hover {
        background-color: var(--accent);
    }

    /* Styles généraux */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    body {
        background-color: var(--background);
        color: var(--foreground);
    }

    /* Mise en page principale */
    .dashboard {
        display: flex;
        width: 100%;
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        width: var(--sidebar-width);
        background-color: var(--background);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: width 0.3s ease;
        z-index: 30;
    }

    .sidebar.collapsed {
        width: var(--sidebar-width-collapsed);
    }

    .sidebar-header {
        display: flex;
        height: var(--topbar-height);
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid var(--border);
        padding: 0 1rem;
    }

    .sidebar-logo {
        font-size: 1.25rem;
        font-weight: bold;
        color: var(--primary);
    }

    .toggle-button {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toggle-button:hover {
        background-color: var(--muted);
    }

    .chevron-icon {
        width: 1.25rem;
        height: 1.25rem;
        transition: transform 0.3s ease;
    }

    .sidebar.collapsed .chevron-icon {
        transform: rotate(180deg);
    }

    .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        overflow-y: auto;
        height: calc(100vh - var(--topbar-height));
        padding: 1rem 0.5rem;
    }

    .menu-group {
        margin-bottom: 1rem;
    }

    .menu-button {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        cursor: pointer;
        color: var(--foreground);
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .menu-button:hover {
        background-color: var(--accent);
    }

    .menu-button.active {
        background-color: var(--primary);
        color: var(--primary-foreground);
    }

    .menu-button-content {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .menu-icon {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
    }

    .submenu {
        padding-left: 2.25rem;
        margin-top: 0.25rem;
        display: none;
    }

    .submenu.open {
        display: block;
    }

    .submenu-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        text-decoration: none;
        color: var(--foreground);
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .submenu-item:hover {
        background-color: var(--accent);
    }

    .submenu-icon {
        width: 1rem;
        height: 1rem;
    }

    /* Contenu principal */
    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
        margin-left: var(--sidebar-width-collapsed);
    }


    /* Menu item */
    .menu-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    /* Lien du menu */
    .menu-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        /* Espacement entre l'icône et le texte */
        text-decoration: none;
        color: var(--foreground);
        font-size: 1rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
    }

    /* Icône du menu */
    .menu-icon {
        width: 1.5rem;
        height: 1.5rem;
        flex-shrink: 0;
    }

    /* Texte du menu */
    .menu-text {
        flex-grow: 1;
    }

    /* Effet au survol */
    .menu-link:hover {
        background-color: var(--accent);
        color: var(--primary);
    }

    /* Barre supérieure */
    .topbar {
        position: fixed;
        top: 0;
        right: 0;
        height: var(--topbar-height);
        width: calc(100% - var(--sidebar-width));
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.5rem;
        border-bottom: 1px solid var(--border);
        background-color: var(--background);
        transition: width 0.3s ease;
        z-index: 20;
    }

    .topbar.collapsed {
        width: calc(100% - var(--sidebar-width-collapsed));
    }

    .search-container {
        position: relative;
    }

    .search-input {
        padding: 0.5rem 0.5rem 0.5rem 2.5rem;
        border-radius: 0.375rem;
        border: 1px solid var(--border);
        background-color: var(--background);
        font-size: 0.875rem;
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        color: var(--muted-foreground);
    }

    .user-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .notification-btn {
        position: relative;
        padding: 0.5rem;
        border-radius: 50%;
        background: none;
        border: none;
        cursor: pointer;
    }

    .notification-btn:hover {
        background-color: var(--muted);
    }

    .notification-indicator {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        width: 0.5rem;
        height: 0.5rem;
        border-radius: 50%;
        background-color: var(--destructive);
    }

    .bell-icon {
        width: 1.25rem;
        height: 1.25rem;
    }

    /* Profil utilisateur */
    .profile-menu {
        position: relative;
    }

    .profile-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        border: none;
        background: none;
        cursor: pointer;
    }

    .profile-button:hover {
        background-color: var(--muted);
    }

    .profile-avatar {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        overflow: hidden;
        background-color: var(--primary);
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-info {
        display: none;
    }

    @media (min-width: 640px) {
        .profile-info {
            display: block;
            text-align: left;
        }
    }

    .profile-name {
        font-size: 0.875rem;
        font-weight: 500;
    }

    .profile-role {
        font-size: 0.75rem;
        color: var(--muted-foreground);
    }

    .profile-dropdown {
        position: absolute;
        top: calc(100% + 0.5rem);
        right: 0;
        width: 14rem;
        background-color: var(--background);
        border: 1px solid var(--border);
        border-radius: 0.375rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 50;
        display: none;
    }

    .profile-dropdown.open {
        display: block;
    }

    .dropdown-header {
        padding: 0.5rem;
        border-bottom: 1px solid var(--border);
    }

    .dropdown-email {
        font-size: 0.75rem;
        color: var(--muted-foreground);
    }

    .dropdown-menu {
        list-style: none;
        padding: 0.25rem;
    }

    .dropdown-item {
        margin-bottom: 0.25rem;
    }

    .dropdown-link {
        display: flex;
        width: 100%;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.5rem;
        border-radius: 0.375rem;
        text-decoration: none;
        color: var(--foreground);
        font-size: 0.875rem;
    }

    .dropdown-link:hover {
        background-color: var(--muted);
    }

    .dropdown-icon {
        width: 1rem;
        height: 1rem;
    }

    .dropdown-separator {
        border-top: 1px solid var(--border);
        margin: 0.25rem 0;
    }

    .logout-button {
        display: flex;
        width: 100%;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.5rem;
        border-radius: 0.375rem;
        background: none;
        border: none;
        cursor: pointer;
        color: var(--destructive);
        font-size: 0.875rem;
        text-align: left;
    }

    .logout-button:hover {
        background-color: var(--muted);
    }

    /* Contenu du tableau de bord */
    .dashboard-content {
        padding: 1.5rem;
        margin-top: var(--topbar-height);
    }

    .dashboard-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        .dashboard-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .dashboard-cards {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .dashboard-card {
        padding: 1.5rem;
        border-radius: 0.5rem;
        border: 1px solid var(--border);
        background-color: var(--background);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .card-label {
        color: var(--muted-foreground);
    }

    .card-value {
        font-size: 1.875rem;
        font-weight: 700;
        margin-top: 0.5rem;
    }

    .card-trend {
        font-size: 0.75rem;
        margin-top: 0.5rem;
    }

    .trend-up {
        color: #22c55e;
    }

    .trend-down {
        color: var(--destructive);
    }

    .dashboard-panels {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-top: 2rem;
    }

    @media (min-width: 1024px) {
        .dashboard-panels {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .dashboard-panel {
        border-radius: 0.5rem;
        border: 1px solid var(--border);
        background-color: var(--background);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .panel-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .panel-title {
        font-weight: 500;
    }

    .panel-content {
        height: 100%;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
    }

    .activity-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        margin-right: 1rem;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background-color: rgba(155, 135, 245, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-size: 0.875rem;
        font-weight: 500;
    }

    .activity-time {
        font-size: 0.75rem;
        color: var(--muted-foreground);
    }

    .task-list {
        padding: 1.5rem;
    }

    .task-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .task-item:last-child {
        margin-bottom: 0;
    }

    .task-checkbox {
        width: 1rem;
        height: 1rem;
        border-radius: 0.25rem;
    }

    .task-label {
        font-size: 0.875rem;
    }

    /* Pour petits écrans */
    @media (max-width: 767px) {
        .sidebar:not(.collapsed) {
            transform: translateX(0);
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .topbar,
        .main-content {
            width: 100%;
            margin-left: 0;
        }
    }
    </style>
</head>

<body>
    @auth
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h1 class="sidebar-logo" id="logo">MicroGuest</h1>
                <button class="toggle-button" id="toggle-sidebar">
                    <svg class="chevron-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
            </div>
            <nav class="nav-menu">

                <!-- dashboard -->
                <div class="menu-item">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="menu-icon" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                        </svg>
                        <span class="menu-text">Tableau de bord</span>
                    </a>
                </div>

                <!-- Groupement -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('groupement')">
                        <span class="menu-button-content">
                            <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="menu-text">Groupement</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="groupement-submenu">
                        <a href="{{ route('groupements.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14"></path>
                                <path d="M5 12h14"></path>
                            </svg>
                            <span>Ajouter</span>
                        </a>
                        <a href="{{ route('groupements.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste Groupement</span>
                        </a>
                        <a href="#" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="2"></rect>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="12" y1="2" x2="12" y2="22"></line>
                            </svg>
                            <span>Rapport</span>
                        </a>
                    </div>
                </div>

                <!-- Membre -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('membre')">
                        <span class="menu-button-content">
                            <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span class="menu-text">Membre</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="membre-submenu">
                        <a href="{{ route('membres.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter</span>
                        </a>
                        <a href="{{ route('membres.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste Membre</span>
                        </a>
                        <a href="#" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="2"></rect>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="12" y1="2" x2="12" y2="22"></line>
                            </svg>
                            <span>Rapport</span>
                        </a>
                    </div>
                </div>

                <!-- Quartier -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('quartier')">
                        <span class="menu-button-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="submenu-icon" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7" />
                                <path d="M9 22V12h6v10" />
                                <path d="M5 22V12H2v10h3zM22 22v-6h-3v6h3z" />
                            </svg>


                            <span class="menu-text">Quartier</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="quartier-submenu">
                        <a href="{{ route('quartier.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter un quartier</span>
                        </a>
                        <a href="{{ route('quartier.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste des quartiers</span>
                        </a>
                    </div>
                </div>


                <!-- CPS -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('cps')">
                        <span class="menu-button-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="submenu-icon" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M7 21v-2a4 4 0 0 1 3-3.87" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>

                            <span class="menu-text">Gestion des CPS</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="cps-submenu">
                        <a href="{{ route('cps.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter un CPS</span>
                        </a>
                        <a href="{{ route('cps.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste des CPS</span>
                        </a>
                        <a href="" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="2"></rect>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="12" y1="2" x2="12" y2="22"></line>
                            </svg>
                            <span>Rapport</span>
                        </a>
                    </div>
                </div>

                <!-- Agrement -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('agrement')">
                        <span class="menu-button-content">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>

                            <span class="menu-text">Agrément</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="agrement-submenu">
                        <a href="{{ route('agrement.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter un agrement</span>
                        </a>
                        <a href="{{ route('agrement.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste Membre</span>
                        </a>
                        <a href="" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="2"></rect>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="12" y1="2" x2="12" y2="22"></line>
                            </svg>
                            <span>Rapport</span>
                        </a>
                    </div>
                </div>

                <!-- Filière -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('filiere')">
                        <span class="menu-button-content">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="6" cy="6" r="3" />
                                <circle cx="6" cy="18" r="3" />
                                <circle cx="18" cy="12" r="3" />
                                <line x1="6" y1="9" x2="6" y2="15" />
                                <line x1="9" y1="6" x2="15" y2="12" />
                                <line x1="9" y1="18" x2="15" y2="12" />
                            </svg>
                            <span class="menu-text">Filière</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="filiere-submenu">
                        <a href="{{ route('filiere.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter une filière</span>
                        </a>
                        <a href="{{ route('filiere.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste des Filières</span>
                        </a>
                    </div>
                </div>

                <!-- Equipement -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('equipement')">
                        <span class="menu-button-content">
                            <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span class="menu-text">Equipement</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="equipement-submenu">
                        <a href="{{ route('equipement.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter</span>
                        </a>
                        <a href="{{ route('equipement.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste Membre</span>
                        </a>
                        <a href="" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="2"></rect>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="12" y1="2" x2="12" y2="22"></line>
                            </svg>
                            <span>Rapport</span>
                        </a>
                    </div>
                </div>

                <!-- Appui -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('appui')">
                        <span class="menu-button-content">
                            <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 16l4-4-4-4"></path>
                                <path d="M7 8l-4 4 4 4"></path>
                                <line x1="9" y1="14" x2="15" y2="8"></line>
                            </svg>
                            <span class="menu-text">Appui</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="appui-submenu">
                        <a href="{{ route('appuis.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14"></path>
                                <path d="M5 12h14"></path>
                            </svg>
                            <span>Ajouter un appui</span>
                        </a>
                        <a href="{{ route('appuis.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste Appui</span>
                        </a>
                        <a href="#" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="2"></rect>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="12" y1="2" x2="12" y2="22"></line>
                            </svg>
                            <span>Rapport</span>
                        </a>
                    </div>
                </div>

                <!-- departement -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('departement')">
                        <span class="menu-button-content">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 10l9-7 9 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>

                            <span class="menu-text">Département</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="departement-submenu">
                        <a href="{{ route('departements.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter</span>
                        </a>
                        <a href="{{ route('departements.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste département</span>
                        </a>
                    </div>
                </div>

                <!-- commune -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('commune')">
                        <span class="menu-button-content">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 6-9 13-9 13s-9-7-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>

                            <span class="menu-text">Commune</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="commune-submenu">
                        <a href="{{ route('communes.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter</span>
                        </a>
                        <a href="{{ route('communes.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste des communes</span>
                        </a>
                    </div>
                </div>

                <!-- arrondissement -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('arrondissement')">
                        <span class="menu-button-content">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 2 7 12 12 22 7 12 2" />
                                <polyline points="2 17 12 22 22 17" />
                                <polyline points="2 12 12 17 22 12" />
                            </svg>

                            <span class="menu-text">Arrondisement</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="arrondissement-submenu">
                        <a href="{{ route('arrondissements.create') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter un arrondissement</span>
                        </a>
                        <a href="{{ route('arrondissements.index') }}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste des arrondissement</span>
                        </a>
                    </div>
                </div>

                <!-- Utilisateur -->
                <div class="menu-group">
                    <button class="menu-button" onclick="toggleMenu('utilisateur')">
                        <span class="menu-button-content">
                            <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M12 11v3"></path>
                                <path d="M9 14h6"></path>
                            </svg>
                            <span class="menu-text">Utilisateur</span>
                        </span>
                        <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="submenu" id="utilisateur-submenu">
                        <a href="{{ route('utilisateurs.create')}}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            <span>Ajouter</span>
                        </a>
                        <a href="{{ route('utilisateurs.index')}}" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                            <span>Liste Utilisateur</span>
                        </a>
                        <a href="#" class="submenu-item">
                            <svg class="submenu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                </path>
                            </svg>
                            <span>Paramètres</span>
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Contenu principal -->
        <div class="main-content" id="main-content">
            <!-- Barre supérieure -->
            <header class="topbar" id="topbar">
                <div class="search-container">
                    <h2></h2>
                </div>
                <div class="user-actions">

                    <button class="notification-btn">
                        <svg class="bell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="notification-indicator"></span>
                    </button>
                    <div class="profile-menu" id="profile-menu">
                        <button class="profile-button" onclick="toggleProfileMenu()">
                            <div class="profile-avatar">
                                <img src="https://randomuser.me/api/portraits/men/43.jpg" alt="Profile">
                            </div>
                            <div class="profile-info">
                                <p class="profile-name">{{ Auth::user()->name }}</p>
                                <p class="profile-role">{{ Auth::user()->role ?? 'Utilisateur' }}</p>
                            </div>
                            <svg class="menu-icon" id="profile-chevron" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="profile-dropdown" id="profile-dropdown">
                            <div class="dropdown-header">
                                <p class="profile-name">{{ Auth::user()->nom }}</p>
                                <p class="dropdown-email">{{ Auth::user()->email }}</p>
                            </div>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                    <a href="#" class="dropdown-link">
                                        <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        Mon profil
                                    </a>
                                </li>
                                <li class="dropdown-item dropdown-separator"></li>
                                <li class="dropdown-item">
                                    <a href="{{ route('logout') }}" class="dropdown-link">
                                        <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
@endauth()
<script>
    // Gestionnaire pour le collapse de la sidebar
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const topbar = document.getElementById('topbar');
    const toggleButton = document.getElementById('toggle-sidebar');
    const logo = document.getElementById('logo');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
        topbar.classList.toggle('collapsed');

        // Changer le texte du logo quand la sidebar est collapse
        if (sidebar.classList.contains('collapsed')) {
            logo.textContent = 'MG';
        } else {
            logo.textContent = 'MicroGuest';
        }
    });

    // Gestionnaire pour les menus dropdown
    function toggleMenu(menuId) {
        const submenu = document.getElementById(`${menuId}-submenu`);
        submenu.classList.toggle('open');
    }

    // Gestionnaire pour le menu profil
    function toggleProfileMenu() {
        const profileDropdown = document.getElementById('profile-dropdown');
        const profileChevron = document.getElementById('profile-chevron');

        profileDropdown.classList.toggle('open');

        if (profileDropdown.classList.contains('open')) {
            profileChevron.style.transform = 'rotate(180deg)';
        } else {
            profileChevron.style.transform = 'rotate(0)';
        }
    }

    // Fermer les menus quand on clique ailleurs
    document.addEventListener('click', (event) => {
        const profileMenu = document.getElementById('profile-menu');
        const profileDropdown = document.getElementById('profile-dropdown');

        if (!profileMenu.contains(event.target) && profileDropdown.classList.contains('open')) {
            profileDropdown.classList.remove('open');
            document.getElementById('profile-chevron').style.transform = 'rotate(0)';
        }
    });

    // Responsive: Cache la sidebar sur mobile par défaut
    function handleResize() {
        if (window.innerWidth < 768) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('collapsed');
            topbar.classList.add('collapsed');
            logo.textContent = 'MG';
        }
    }

    // Initialisation
    handleResize();
    window.addEventListener('resize', handleResize);
    </script>
</body>

</html>