// Search Overlay Functions
function openSearchOverlay() {
    document.getElementById('searchOverlay').classList.add('active');
    document.getElementById('searchInput').focus();
    document.body.style.overflow = 'hidden';
    
    // Add active class to first search item by default
    const searchItems = document.querySelectorAll('.search-item');
    if (searchItems.length > 0) {
        // Remove active class from all items first
        searchItems.forEach(item => {
            item.classList.remove('active');
        });
        // Add active class to first item
        searchItems[0].classList.add('active');
    }
}

function closeSearchOverlay() {
    document.getElementById('searchOverlay').classList.remove('active');
    document.body.style.overflow = 'auto';
    document.getElementById('searchInput').value = '';
}

// Close overlay when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const searchOverlay = document.getElementById('searchOverlay');
    if (searchOverlay) {
        searchOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                closeSearchOverlay();
            }
        });
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'k') {
        e.preventDefault();
        openSearchOverlay();
    }

    if (e.key === 'Escape') {
        closeSearchOverlay();
    }
});

// Handle search item clicks and hover effects
document.addEventListener('DOMContentLoaded', function() {
    const searchItems = document.querySelectorAll('.search-item');
    searchItems.forEach(item => {
        // Click event
        item.addEventListener('click', function() {
            const text = this.querySelector('span').textContent;
            document.getElementById('keyword').value = text;
            closeSearchOverlay();
        });
        
        // Mouse enter event - add active class
        item.addEventListener('mouseenter', function() {
            // Remove active class from all other items
            searchItems.forEach(otherItem => {
                otherItem.classList.remove('active');
            });
            // Add active class to current item
            this.classList.add('active');
        });
        
        // Mouse leave event - keep active class on last hovered item
        item.addEventListener('mouseleave', function() {
            // Don't remove active class - keep it on the last hovered item
        });
    });
});

// Make the original search input trigger the overlay
document.addEventListener('DOMContentLoaded', function() {
    const keywordInput = document.getElementById('keyword');
    if (keywordInput) {
        keywordInput.addEventListener('click', function(e) {
            e.preventDefault();
            openSearchOverlay();
        });
    }
});

// Search functionality with real-time filtering
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase();
            const searchItems = document.querySelectorAll('.search-item');

            searchItems.forEach(item => {
                const text = item.querySelector('span').textContent.toLowerCase();
                if (text.includes(query)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});

// Handle Enter key press in search input
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const searchTerm = this.value.trim();
                if (searchTerm) {
                    // You can add your search logic here
                    console.log('Searching for:', searchTerm);
                    closeSearchOverlay();
                }
            }
        });
    }
});
 