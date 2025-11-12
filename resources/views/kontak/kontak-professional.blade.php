@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="Hubungi Kami - PT Swabina Gatra"
    description="Hubungi PT Swabina Gatra untuk informasi layanan, dukungan pelanggan, atau pertanyaan umum. Kami siap membantu Anda."
    :keywords="['hubungi kami', 'kontak', 'contact us', 'support', 'customer service']"
    url="{{ route('kontakkami') }}"
/>
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin: -2rem -50vw 0; padding-left: 50vw; padding-right: 50vw;">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-telephone-fill"></i> Hubungi Kami
        </h1>
        <p class="lead">Kami Siap Membantu Anda</p>
    </div>
</section>

<!-- Contact Information Section (Synchronized) -->
<x-contact-info-cards :companyInfo="$companyInfo" :showTitle="false" />

<!-- Operating Hours Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Operating Hours -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-4">
                        <h5 class="mb-0">
                            <i class="bi bi-clock-fill me-2"></i>Jam Operasional
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0 py-2 border-0">
                                <strong>Senin - Jumat:</strong> 08:00 - 17:00 WIB
                            </div>
                            <div class="list-group-item px-0 py-2 border-0">
                                <strong>Sabtu:</strong> 08:00 - 13:00 WIB
                            </div>
                            <div class="list-group-item px-0 py-2 border-0 text-danger">
                                <strong>Minggu & Hari Libur:</strong> Tutup
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if($faqs && $faqs->count() > 0)
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">
            <i class="bi bi-question-circle me-2 text-primary"></i>Pertanyaan yang Sering Diajukan
        </h2>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-flush" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item border-0 mb-2 shadow-sm rounded">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button 
                                    class="accordion-button py-3 fw-500 @if($index > 2) collapsed @endif" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $index }}" 
                                    aria-expanded="@if($index <= 2)true @else false @endif" 
                                    aria-controls="collapse{{ $index }}">
                                    <i class="bi bi-chevron-right me-2"></i>
                                    @if(is_array($faq->question))
                                        {{ $faq->question['id'] ?? ($faq->question['en'] ?? $faq->question) }}
                                    @else
                                        {{ $faq->question }}
                                    @endif
                                </button>
                            </h2>
                            <div 
                                id="collapse{{ $index }}" 
                                class="accordion-collapse collapse @if($index <= 2) show @endif" 
                                aria-labelledby="heading{{ $index }}" 
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body py-3">
                                    @if(is_array($faq->answer))
                                        {{ $faq->answer['id'] ?? ($faq->answer['en'] ?? $faq->answer) }}
                                    @else
                                        {{ $faq->answer }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5">
                    <p class="text-muted mb-3">Tidak menemukan jawaban yang Anda cari?</p>
                    <a href="{{ route('faq') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-right me-2"></i>Lihat Semua FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">
            <i class="bi bi-chat-dots me-2"></i>Siap Membantu Anda
        </h2>
        <p class="lead mb-4">
            Tim kami siap menjawab pertanyaan dan memberikan solusi terbaik untuk kebutuhan Anda.
        </p>
        @php
            $telp = isset($companyInfo) ? ($companyInfo->no_telp ?? $companyInfo->phone ?? null) : null;
            $email = isset($companyInfo) ? ($companyInfo->email ?? null) : null;
            $telp_clean = $telp ? preg_replace('/[^0-9+]/', '', $telp) : null;
        @endphp
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            @if($telp)
            <a href="tel:{{ $telp_clean }}" class="btn btn-light btn-lg">
                <i class="bi bi-telephone me-2"></i>Hubungi Telepon
            </a>
            @endif
            @if($email)
            <a href="mailto:{{ $email }}" class="btn btn-light btn-lg">
                <i class="bi bi-envelope me-2"></i>Kirim Email
            </a>
            @endif
        </div>
    </div>
</section>

<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: #0d6efd;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.btn-outline-primary:hover {
    transform: scale(1.05);
}
</style>

@endsection
