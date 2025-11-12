<nav class="professional-nav sticky-top">
    <div class="container">
        <div class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto justify-content-center">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">
                            <i class="bi bi-house-fill me-1"></i> Beranda
                        </a>
                    </li>
                    
                    <!-- Layanan (Services) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-briefcase-fill me-1"></i> Layanan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('swaacademy') }}">
                                <i class="bi bi-mortarboard me-2"></i>Swa Academy
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('facility-management') }}">
                                <i class="bi bi-building me-2"></i>Facility Management
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('digitalsolution') }}">
                                <i class="bi bi-cpu me-2"></i>Digital Solution
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('swatour') }}">
                                <i class="bi bi-airplane me-2"></i>Swa Tour Organizer
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('swasegar') }}">
                                <i class="bi bi-cup-straw me-2"></i>Swasegar AMDK
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- Tentang Kami (About) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-info-circle me-1"></i> Tentang Kami
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('sekilas') }}">
                                <i class="bi bi-file-text me-2"></i>Sekilas Perusahaan
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('jejaklangkah') }}">
                                <i class="bi bi-diagram-3 me-2"></i>Jejak Langkah
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('sertif') }}">
                                <i class="bi bi-award me-2"></i>Sertifikat & Penghargaan
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('memilihkami') }}">
                                <i class="bi bi-hand-thumbs-up me-2"></i>Mengapa Memilih Kami
                            </a></li>
                        </ul>
                    </li>
                    
                    <!-- Berita (News) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('berita*') ? 'active' : '' }}" href="{{ route('berita') }}">
                            <i class="bi bi-newspaper me-1"></i> Berita
                        </a>
                    </li>
                    
                    <!-- FAQ -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">
                            <i class="bi bi-question-circle me-1"></i> FAQ
                        </a>
                    </li>
                    
                    <!-- Kontak (Contact) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kontakkami') ? 'active' : '' }}" href="{{ route('kontakkami') }}">
                            <i class="bi bi-envelope me-1"></i> Kontak
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
