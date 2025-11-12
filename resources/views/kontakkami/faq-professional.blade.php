@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="FAQ - Pertanyaan yang Sering Diajukan - PT Swabina Gatra"
    description="Temukan jawaban atas pertanyaan umum tentang layanan PT Swabina Gatra. FAQ lengkap untuk membantu Anda memahami layanan kami."
    :keywords="['faq swabina', 'pertanyaan umum', 'tanya jawab', 'frequently asked questions', 'help']"
    url="{{ route('faq') }}"
/>
<x-structured-data type="faq" :data="$faqs" />
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin: -2rem -50vw 0; padding-left: 50vw; padding-right: 50vw;">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-question-circle-fill"></i> FAQ
        </h1>
        <p class="lead">Pertanyaan yang Sering Diajukan</p>
    </div>
</section>

<!-- Search FAQ Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="input-group input-group-lg mb-3">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control border-start-0 border-end-0" 
                                   id="searchFaq" 
                                   placeholder="Cari pertanyaan Anda..."
                                   onkeyup="searchFaq()">
                            <button class="btn btn-outline-secondary border-start-0" type="button" onclick="clearSearch()">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        
                        <!-- Category Filter Tabs -->
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-sm btn-primary category-filter active" data-category="all" onclick="filterCategory('all')">
                                <i class="bi bi-grid-fill me-1"></i>Semua
                            </button>
                            <button class="btn btn-sm btn-outline-primary category-filter" data-category="layanan" onclick="filterCategory('layanan')">
                                <i class="bi bi-briefcase me-1"></i>Layanan
                            </button>
                            <button class="btn btn-sm btn-outline-primary category-filter" data-category="umum" onclick="filterCategory('umum')">
                                <i class="bi bi-info-circle me-1"></i>Umum
                            </button>
                            <button class="btn btn-sm btn-outline-primary category-filter" data-category="teknis" onclick="filterCategory('teknis')">
                                <i class="bi bi-tools me-1"></i>Teknis
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Content Section -->
<section class="py-5">
    <div class="container">
        @if($faqs->count() > 0)
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item border-0 shadow-sm mb-3 faq-item" 
                         data-question="{{ strtolower($faq->pertanyaan) }}" 
                         data-answer="{{ strtolower($faq->jawaban) }}"
                         data-category="umum">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }} fw-bold" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $index }}" 
                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                    aria-controls="collapse{{ $index }}">
                                <span class="badge bg-primary rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                    {{ $index + 1 }}
                                </span>
                                {{ $faq->pertanyaan }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" 
                             class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                             aria-labelledby="heading{{ $index }}" 
                             data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted ps-5" style="text-align: justify; line-height: 1.8;">
                                {{ $faq->jawaban }}
                                
                                <!-- Helpful Buttons -->
                                <div class="mt-4 pt-3 border-top">
                                    <p class="text-muted small mb-2">Apakah jawaban ini membantu?</p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-success helpful-btn" onclick="markHelpful({{ $index }}, true)">
                                            <i class="bi bi-hand-thumbs-up me-1"></i>Ya, Membantu
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger helpful-btn" onclick="markHelpful({{ $index }}, false)">
                                            <i class="bi bi-hand-thumbs-down me-1"></i>Tidak Membantu
                                        </button>
                                    </div>
                                    <div id="thanks-{{ $index }}" class="alert alert-success mt-2" style="display: none;">
                                        <i class="bi bi-check-circle me-1"></i> Terima kasih atas feedback Anda!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="text-center py-5" style="display: none;">
                    <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 text-muted">Tidak Ada Hasil</h4>
                    <p class="text-muted">Coba kata kunci lain atau <a href="{{ route('kontakkami') }}">hubungi kami</a></p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <!-- Quick Links -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="bi bi-link-45deg text-primary"></i> Tautan Cepat
                            </h5>
                            <div class="d-grid gap-2">
                                <a href="{{ route('kontakkami') }}" class="btn btn-outline-primary btn-sm text-start">
                                    <i class="bi bi-envelope me-2"></i>Hubungi Kami
                                </a>
                                <a href="{{ route('berita') }}" class="btn btn-outline-primary btn-sm text-start">
                                    <i class="bi bi-newspaper me-2"></i>Berita
                                </a>
                                <a href="{{ route('facility-management') }}" class="btn btn-outline-primary btn-sm text-start">
                                    <i class="bi bi-briefcase me-2"></i>Layanan Kami
                                </a>
                                <a href="{{ route('sekilas') }}" class="btn btn-outline-primary btn-sm text-start">
                                    <i class="bi bi-info-circle me-2"></i>Tentang Kami
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Stats -->
                    <div class="card border-0 shadow-sm mb-4 bg-light">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">
                                <i class="bi bi-bar-chart-fill text-info"></i> Statistik FAQ
                            </h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small">Total FAQ:</span>
                                <span class="badge bg-primary" id="totalFaq">{{ $faqs->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Ditampilkan:</span>
                                <span class="badge bg-success" id="visibleFaq">{{ $faqs->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="card border-0 shadow-sm bg-primary text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-headset" style="font-size: 3rem;"></i>
                            <h5 class="card-title mt-3 mb-2">Butuh Bantuan?</h5>
                            <p class="card-text small mb-3">Tim kami siap membantu Anda</p>
                            @php
                                $whatsapp = isset($companyInfo) ? ($companyInfo->whatsapp ?? null) : null;
                            @endphp
                            @if($whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" class="btn btn-light btn-sm" target="_blank">
                                <i class="bi bi-whatsapp me-1"></i>Chat WhatsApp
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 5rem;"></i>
            <h3 class="mt-4 text-muted">Belum Ada FAQ</h3>
            <p class="text-muted">FAQ akan ditampilkan di sini</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Masih Ada Pertanyaan?</h2>
                <p class="lead mb-4">Tim kami siap membantu menjawab pertanyaan Anda</p>
                @php
                    $whatsapp = isset($companyInfo) ? ($companyInfo->whatsapp ?? null) : null;
                @endphp
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('kontakkami') }}" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                    @if($whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" class="btn btn-outline-light btn-lg px-4" target="_blank">
                        <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.accordion-button:not(.collapsed) {
    background-color: #0d6efd;
    color: white;
}

.accordion-button:not(.collapsed)::after {
    filter: brightness(0) invert(1);
}

.accordion-button:not(.collapsed) .badge {
    background-color: white !important;
    color: #0d6efd !important;
}

.accordion-button {
    padding: 1.25rem 1.5rem;
    transition: all 0.3s ease;
}

.accordion-button:hover {
    background-color: #f8f9fa;
}

.accordion-item {
    transition: all 0.3s ease;
    border-radius: 0.5rem !important;
    overflow: hidden;
}

.accordion-item:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
}

.hero-section {
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
}

.sticky-top {
    position: -webkit-sticky;
    position: sticky;
}

.category-filter {
    transition: all 0.3s ease;
}

.category-filter:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.helpful-btn {
    transition: all 0.2s ease;
}

.helpful-btn:hover {
    transform: scale(1.05);
}

.input-group input:focus {
    box-shadow: none;
    border-color: #0d6efd;
}

.card {
    transition: all 0.3s ease;
}

#noResults {
    animation: fadeIn 0.5s;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.faq-item {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}
</style>
@endsection

@section('scripts')
<script>
let currentCategory = 'all';

function searchFaq() {
    const searchInput = document.getElementById('searchFaq').value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('noResults');
    let hasResults = false;
    let visibleCount = 0;

    faqItems.forEach(item => {
        const question = item.getAttribute('data-question');
        const answer = item.getAttribute('data-answer');
        const category = item.getAttribute('data-category');
        
        const matchesSearch = question.includes(searchInput) || answer.includes(searchInput);
        const matchesCategory = currentCategory === 'all' || category === currentCategory;
        
        if ((matchesSearch || searchInput === '') && matchesCategory) {
            item.style.display = 'block';
            hasResults = true;
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    // Update visible count
    document.getElementById('visibleFaq').textContent = visibleCount;

    // Show/hide no results message
    if (noResults) {
        noResults.style.display = hasResults ? 'none' : 'block';
    }

    // Collapse all accordions when searching
    if (searchInput !== '') {
        const accordionButtons = document.querySelectorAll('.accordion-button:not(.collapsed)');
        accordionButtons.forEach(button => {
            button.click();
        });
    }
}

function clearSearch() {
    document.getElementById('searchFaq').value = '';
    searchFaq();
}

function filterCategory(category) {
    currentCategory = category;
    
    // Update button states
    document.querySelectorAll('.category-filter').forEach(btn => {
        btn.classList.remove('btn-primary', 'active');
        btn.classList.add('btn-outline-primary');
    });
    
    event.target.classList.remove('btn-outline-primary');
    event.target.classList.add('btn-primary', 'active');
    
    // Trigger search to apply filter
    searchFaq();
}

function markHelpful(index, isHelpful) {
    // Hide buttons
    const buttons = document.querySelectorAll(`#collapse${index} .helpful-btn`);
    buttons.forEach(btn => btn.style.display = 'none');
    
    // Show thank you message
    const thanksMsg = document.getElementById(`thanks-${index}`);
    thanksMsg.style.display = 'block';
    
    // Auto hide after 3 seconds
    setTimeout(() => {
        thanksMsg.style.display = 'none';
        buttons.forEach(btn => btn.style.display = 'inline-block');
    }, 3000);
    
    // You can send this data to server via AJAX if needed
    console.log(`FAQ ${index} marked as ${isHelpful ? 'helpful' : 'not helpful'}`);
}

// Reset search on page load
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchFaq').value = '';
    
    // Add smooth scroll to accordions
    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', function() {
            setTimeout(() => {
                if (!this.classList.contains('collapsed')) {
                    this.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }, 350);
        });
    });
});
</script>
@endsection
