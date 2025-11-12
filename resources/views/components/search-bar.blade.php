{{-- Search Bar Component --}}
{{-- Usage: <x-search-bar /> --}}

<div class="search-bar-wrapper">
    <form action="{{ route('search') }}" method="GET" class="search-form" role="search">
        <div class="input-group">
            <input 
                type="search" 
                class="form-control search-input" 
                name="q" 
                placeholder="Cari layanan, berita, atau informasi..." 
                aria-label="Cari di website"
                autocomplete="off"
                value="{{ request('q') }}"
                id="searchInput"
            >
            <button class="btn btn-primary search-button" type="submit" aria-label="Cari">
                <i class="bi bi-search"></i>
                <span class="d-none d-md-inline ms-1">Cari</span>
            </button>
        </div>
        
        {{-- Search Suggestions (AJAX) --}}
        <div class="search-suggestions" id="searchSuggestions" style="display: none;">
            <div class="suggestions-list"></div>
        </div>
    </form>
</div>

<style>
.search-bar-wrapper {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}

.search-form {
    position: relative;
}

.search-input {
    padding: 0.75rem 1rem;
    border-radius: 50px 0 0 50px;
    border: 2px solid #e0e0e0;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: var(--primary-color, #0056b3);
    box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.15);
    outline: none;
}

.search-button {
    border-radius: 0 50px 50px 0;
    padding: 0.75rem 1.5rem;
    border: none;
    background: var(--primary-color, #0056b3);
    color: white;
    transition: all 0.3s ease;
}

.search-button:hover {
    background: var(--primary-hover, #004494);
    transform: translateY(-1px);
}

.search-suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    margin-top: 0.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
}

.suggestions-list {
    padding: 0.5rem 0;
}

.suggestion-item {
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: background 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.suggestion-item:hover {
    background: #f8f9fa;
}

.suggestion-item i {
    color: var(--primary-color, #0056b3);
    font-size: 1.1rem;
}

.suggestion-title {
    font-weight: 500;
    color: #333;
    margin: 0;
}

.suggestion-category {
    font-size: 0.85rem;
    color: #666;
    margin: 0;
}

@media (max-width: 768px) {
    .search-bar-wrapper {
        max-width: 100%;
    }
    
    .search-input {
        font-size: 0.9rem;
        padding: 0.6rem 0.8rem;
    }
    
    .search-button {
        padding: 0.6rem 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    const suggestionsList = searchSuggestions.querySelector('.suggestions-list');
    let searchTimeout;

    // AJAX search suggestions
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            searchSuggestions.style.display = 'none';
            return;
        }
        
        searchTimeout = setTimeout(() => {
            fetch(`/api/search/suggestions?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        renderSuggestions(data);
                        searchSuggestions.style.display = 'block';
                    } else {
                        searchSuggestions.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Search error:', error);
                    searchSuggestions.style.display = 'none';
                });
        }, 300);
    });

    // Render suggestions
    function renderSuggestions(suggestions) {
        suggestionsList.innerHTML = '';
        
        suggestions.forEach(item => {
            const div = document.createElement('div');
            div.className = 'suggestion-item';
            div.innerHTML = `
                <i class="bi ${getIconForCategory(item.category)}"></i>
                <div>
                    <p class="suggestion-title">${item.title}</p>
                    <p class="suggestion-category">${item.category}</p>
                </div>
            `;
            
            div.addEventListener('click', () => {
                window.location.href = item.url;
            });
            
            suggestionsList.appendChild(div);
        });
    }

    // Get icon based on category
    function getIconForCategory(category) {
        const icons = {
            'layanan': 'bi-briefcase',
            'berita': 'bi-newspaper',
            'faq': 'bi-question-circle',
            'tentang': 'bi-info-circle'
        };
        return icons[category] || 'bi-file-text';
    }

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
            searchSuggestions.style.display = 'none';
        }
    });
});
</script>
