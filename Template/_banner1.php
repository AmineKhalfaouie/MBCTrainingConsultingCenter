<!-- banner1 section -->
<section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-12 mx-auto">
                <h1 class="text-white text-center">Discover Progress Succeed.</h1>

                <h6 class="text-center">International consulting agency</h6>

                <form method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bi-search" id="basic-addon1"></span>
                        <input name="keyword" type="search" class="form-control" id="keyword"
                             placeholder="Education, Career, Immigration ..." aria-label="Search" 
                             onclick="openSearchOverlay()" readonly>
                    </div>
                </form>

                <!-- Search Overlay -->
                <div id="searchOverlay" class="search-overlay">
                    <div class="search-overlay-content">
                        <div class="search-header">
                            <div class="search-input-wrapper">
                                <i class="bi bi-search search-icon"></i>
                                <input type="text" id="searchInput" placeholder="Search services..." autocomplete="off">
                                <button class="close-search" onclick="closeSearchOverlay()">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Search Results -->
                        <div class="search-results">
                            <div class="recent-searches">
                                <h6 class="recent-title">Recent</h6>
                                <?php foreach ($offer->getData() as $item) : ?>
                                    <div class="search-item">
                                        <i class="bi bi-clock"></i>
                                        <a href="<?php printf('offer.php?item_id=%s', $item['item_id']); ?>"><img src="<?php echo $item['item_image'] ?? 'images/offers/visa qatar.jpg'; ?>" alt="<?php echo $item['item_name'] ?? 'Uknown'; ?>" style="width: 60px; height: 70px;"></a>
                                        <span><?php echo $item['item_name'] ?? 'Uknown'; ?></span>
                                        <div class="search-item-actions">
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Footer with keyboard shortcuts -->
                        <div class="search-footer">
                            <div class="keyboard-shortcuts">
                                <span class="shortcut">
                                    <kbd>←</kbd> to select
                                </span>
                                <span class="shortcut">
                                    <kbd>↑</kbd> <kbd>↓</kbd> to navigate
                                </span>
                                <span class="shortcut">
                                    <kbd>esc</kbd> to close
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Overlay Styles -->
<style>
/* Search Overlay */
.search-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
    z-index: 9999;
    display: none;
    align-items: flex-start;
    justify-content: center;
    padding-top: 80px;
}

.search-overlay.active {
    display: flex;
}

.search-overlay-content {
    background: white;
    border-radius: 12px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    width: 90%;
    max-width: 600px;
    max-height: 500px;
    overflow: hidden;
    border: 1px solid #e9ecef;
}

.search-header {
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
}

.search-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
}

.search-icon {
    position: absolute;
    left: 12px;
    color: #6c757d;
    font-size: 18px;
    z-index: 2;
}

#searchInput {
    width: 100%;
    padding: 12px 50px 12px 40px;
    border: 2px solid #13547a;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s ease;
    background: white;
}

#searchInput:focus {
    border-color: #13547a;
    box-shadow: 0 0 0 3px rgba(19, 84, 122, 0.1);
}

.close-search {
    position: absolute;
    right: 12px;
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    z-index: 2;
}

.close-search:hover {
    background: #f8f9fa;
    color: #495057;
}

.search-results {
    max-height: 300px;
    overflow-y: auto;
}

.recent-searches {
    padding: 20px;
}

.recent-title {
    color: #13547a;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.search-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom: 4px;
}

.search-item:hover {
    background: #f8f9fa;
}

.search-item.active {
    background: #13547a;
    color: white;
}

.search-item i:first-child {
    color: #6c757d;
    font-size: 14px;
}

.search-item.active i:first-child {
    color: rgba(255, 255, 255, 0.8);
}

.search-item span {
    flex: 1;
    font-size: 14px;
}

.search-item-actions {
    display: flex;
    gap: 8px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.search-item:hover .search-item-actions {
    opacity: 1;
}

.search-item-actions i {
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.search-item-actions i:hover {
    background: rgba(0, 0, 0, 0.1);
}

.search-item.active .search-item-actions i:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Footer with keyboard shortcuts */
.search-footer {
    padding: 12px 20px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.keyboard-shortcuts {
    display: flex;
    gap: 20px;
    justify-content: center;
    font-size: 12px;
    color: #6c757d;
}

.shortcut {
    display: flex;
    align-items: center;
    gap: 4px;
}

kbd {
    background: #e9ecef;
    border: 1px solid #adb5bd;
    border-radius: 3px;
    padding: 2px 6px;
    font-size: 11px;
    font-family: monospace;
    color: #495057;
}

/* Make original search input clickable */
#keyword {
    cursor: pointer;
}

#keyword:focus {
    cursor: text;
}

/* Responsive Design */
@media (max-width: 768px) {
    .search-overlay-content {
        width: 95%;
        margin: 0 10px;
    }

    .search-overlay {
        padding-top: 50px;
    }

    .keyboard-shortcuts {
        flex-direction: column;
        gap: 8px;
        align-items: center;
    }
}
</style>

