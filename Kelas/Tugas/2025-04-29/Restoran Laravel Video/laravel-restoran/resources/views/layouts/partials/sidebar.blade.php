<div class="col-lg-3 col-md-4 sidebar-container">
    <div class="sidebar-sticky">
        <div class="sidebar-header">
            <h5 class="sidebar-title">
                <i class="fas fa-utensils me-2"></i>Kategori Menu
            </h5>
        </div>

        <div class="category-list">
            @foreach ($kategoris as $kategori)
                <a href="{{ url('kategori/' . $kategori->idkategori) }}" class="category-item">
                    <div class="category-icon">
                        @switch($kategori->kategori)
                            @case('Appetizer')
                                <i class="fas fa-seedling"></i>
                            @break

                            @case('Main Course')
                                <i class="fas fa-hamburger"></i>
                            @break

                            @case('Dessert')
                                <i class="fas fa-ice-cream"></i>
                            @break

                            @case('Beverage')
                                <i class="fas fa-glass-cheers"></i>
                            @break

                            @default
                                <i class="fas fa-utensils"></i>
                        @endswitch
                    </div>
                    <span class="category-name">{{ $kategori->kategori }}</span>
                    <i class="fas fa-chevron-right category-arrow"></i>
                </a>
            @endforeach
        </div>

    </div>
</div>
