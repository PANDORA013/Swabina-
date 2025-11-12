<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display search results page
     */
    public function index(Request $request)
    {
        $query = $request->input('q');
        $results = [];
        $totalResults = 0;

        if ($query && strlen($query) >= 2) {
            $results = $this->performSearch($query);
            $totalResults = array_sum(array_map('count', $results));
        }

        return view('search.results', [
            'query' => $query,
            'results' => $results,
            'totalResults' => $totalResults
        ]);
    }

    /**
     * API endpoint for search suggestions (AJAX)
     */
    public function suggestions(Request $request)
    {
        $query = $request->input('q');
        $suggestions = [];

        if ($query && strlen($query) >= 2) {
            // Search Berita
            $berita = Berita::where('judul', 'LIKE', "%{$query}%")
                ->orWhere('konten', 'LIKE', "%{$query}%")
                ->limit(3)
                ->get(['id', 'judul', 'slug'])
                ->map(function ($item) {
                    return [
                        'title' => $item->judul,
                        'category' => 'Berita',
                        'url' => route('berita') . '#' . $item->slug
                    ];
                });

            // Search FAQ
            $faq = Faq::where('question', 'LIKE', "%{$query}%")
                ->orWhere('answer', 'LIKE', "%{$query}%")
                ->limit(3)
                ->get(['id', 'question'])
                ->map(function ($item) {
                    return [
                        'title' => $item->question,
                        'category' => 'FAQ',
                        'url' => route('faq') . '#faq-' . $item->id
                    ];
                });

            // Search Layanan (static data)
            $layanan = $this->searchLayanan($query);

            // Merge results
            $suggestions = array_merge(
                $berita->toArray(),
                $faq->toArray(),
                $layanan
            );

            // Limit total suggestions
            $suggestions = array_slice($suggestions, 0, 8);
        }

        return response()->json($suggestions);
    }

    /**
     * Perform comprehensive search
     */
    private function performSearch($query)
    {
        $results = [
            'layanan' => $this->searchLayanan($query),
            'berita' => $this->searchBerita($query),
            'faq' => $this->searchFaq($query),
            'tentang' => $this->searchTentang($query)
        ];

        return $results;
    }

    /**
     * Search in layanan (services)
     */
    private function searchLayanan($query)
    {
        $layanan = [
            [
                'name' => 'Facility Management',
                'description' => 'Layanan pengelolaan fasilitas profesional untuk gedung dan perkantoran',
                'keywords' => ['facility', 'management', 'gedung', 'perkantoran', 'pengelolaan'],
                'url' => route('layananfm')
            ],
            [
                'name' => 'Digital Solution',
                'description' => 'Solusi teknologi digital untuk transformasi bisnis Anda',
                'keywords' => ['digital', 'teknologi', 'solution', 'transformasi', 'it'],
                'url' => route('layananteknologi')
            ],
            [
                'name' => 'SWA Academy',
                'description' => 'Pelatihan dan pengembangan SDM profesional',
                'keywords' => ['academy', 'training', 'pelatihan', 'sdm', 'pengembangan'],
                'url' => route('layananss')
            ],
            [
                'name' => 'SWA Tour Organizer',
                'description' => 'Layanan travel dan tour organizer profesional',
                'keywords' => ['tour', 'travel', 'organizer', 'wisata', 'perjalanan'],
                'url' => route('layanandownstream')
            ],
            [
                'name' => 'Swasegar AMDK',
                'description' => 'Air minum dalam kemasan berkualitas tinggi',
                'keywords' => ['amdk', 'air minum', 'swasegar', 'minuman', 'water'],
                'url' => route('swasegar')
            ]
        ];

        return collect($layanan)->filter(function ($item) use ($query) {
            $searchIn = strtolower($item['name'] . ' ' . $item['description'] . ' ' . implode(' ', $item['keywords']));
            return str_contains($searchIn, strtolower($query));
        })->map(function ($item) {
            return [
                'title' => $item['name'],
                'description' => $item['description'],
                'category' => 'Layanan',
                'url' => $item['url']
            ];
        })->values()->toArray();
    }

    /**
     * Search in berita (news)
     */
    private function searchBerita($query)
    {
        return Berita::where('judul', 'LIKE', "%{$query}%")
            ->orWhere('konten', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => $item->judul,
                    'description' => strip_tags(substr($item->konten, 0, 150)) . '...',
                    'category' => 'Berita',
                    'url' => route('berita') . '#' . $item->slug,
                    'date' => $item->created_at ? $item->created_at->format('d M Y') : null
                ];
            })
            ->toArray();
    }

    /**
     * Search in FAQ
     */
    private function searchFaq($query)
    {
        return Faq::where('question', 'LIKE', "%{$query}%")
            ->orWhere('answer', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => $item->question,
                    'description' => strip_tags(substr($item->answer, 0, 150)) . '...',
                    'category' => 'FAQ',
                    'url' => route('faq') . '#faq-' . $item->id
                ];
            })
            ->toArray();
    }

    /**
     * Search in tentang kami pages
     */
    private function searchTentang($query)
    {
        $pages = [
            [
                'title' => 'Sekilas Perusahaan',
                'description' => 'Profil dan informasi umum PT Swabina Gatra',
                'keywords' => ['sekilas', 'profil', 'perusahaan', 'tentang'],
                'url' => route('sekilas')
            ],
            [
                'title' => 'Visi Misi & Budaya',
                'description' => 'Visi, misi, dan budaya perusahaan PT Swabina Gatra',
                'keywords' => ['visi', 'misi', 'budaya', 'nilai'],
                'url' => route('visimisibudaya')
            ],
            [
                'title' => 'Jejak Langkah',
                'description' => 'Sejarah dan perjalanan PT Swabina Gatra',
                'keywords' => ['jejak', 'sejarah', 'perjalanan', 'history'],
                'url' => route('jejaklangkah')
            ],
            [
                'title' => 'Sertifikat & Penghargaan',
                'description' => 'Sertifikat dan penghargaan yang diraih PT Swabina Gatra',
                'keywords' => ['sertifikat', 'penghargaan', 'award', 'ISO'],
                'url' => route('sertifikatpenghargaan')
            ],
            [
                'title' => 'Mengapa Memilih Kami',
                'description' => 'Alasan mengapa memilih PT Swabina Gatra sebagai partner',
                'keywords' => ['memilih', 'keunggulan', 'kelebihan'],
                'url' => route('memilihkami')
            ]
        ];

        return collect($pages)->filter(function ($item) use ($query) {
            $searchIn = strtolower($item['title'] . ' ' . $item['description'] . ' ' . implode(' ', $item['keywords']));
            return str_contains($searchIn, strtolower($query));
        })->map(function ($item) {
            return [
                'title' => $item['title'],
                'description' => $item['description'],
                'category' => 'Tentang Kami',
                'url' => $item['url']
            ];
        })->values()->toArray();
    }
}
