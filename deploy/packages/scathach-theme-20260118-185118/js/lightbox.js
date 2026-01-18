// Lightbox Gallery Functionality
(function() {
    let currentImageIndex = 0;
    let galleryImages = [];
    
    // Create lightbox HTML structure
    function createLightbox() {
        const lightboxHTML = `
            <div class="lightbox-modal" id="lightboxModal">
                <button class="lightbox-close" id="lightboxClose">&times;</button>
                <button class="lightbox-nav lightbox-prev" id="lightboxPrev">&#10094;</button>
                <button class="lightbox-nav lightbox-next" id="lightboxNext">&#10095;</button>
                <div class="lightbox-content">
                    <div class="lightbox-loader" id="lightboxLoader"></div>
                    <img class="lightbox-image" id="lightboxImage" alt="">
                </div>
                <div class="lightbox-counter" id="lightboxCounter"></div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', lightboxHTML);
    }
    
    // Initialize lightbox
    function initLightbox() {
        // Get all gallery images
        const galleryWrapper = document.querySelector('.gallery-img-wrapper');
        if (!galleryWrapper) return;
        
        const allWrappers = document.querySelectorAll('.gallery-img-wrapper img');
        galleryImages = Array.from(allWrappers);
        
        if (galleryImages.length === 0) return;
        
        // Create lightbox structure
        createLightbox();
        
        // Get lightbox elements
        const modal = document.getElementById('lightboxModal');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxClose = document.getElementById('lightboxClose');
        const lightboxPrev = document.getElementById('lightboxPrev');
        const lightboxNext = document.getElementById('lightboxNext');
        const lightboxCounter = document.getElementById('lightboxCounter');
        const lightboxLoader = document.getElementById('lightboxLoader');
        
        // Add click event to each gallery image
        galleryImages.forEach((img, index) => {
            img.parentElement.addEventListener('click', function() {
                currentImageIndex = index;
                openLightbox();
            });
        });
        
        // Open lightbox
        function openLightbox() {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
            showImage();
        }
        
        // Close lightbox
        function closeLightbox() {
            modal.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
            lightboxImage.classList.remove('loaded');
        }
        
        // Show current image
        function showImage() {
            const img = galleryImages[currentImageIndex];
            lightboxImage.classList.remove('loaded');
            lightboxLoader.style.display = 'block';
            
            // Load image
            const tempImg = new Image();
            tempImg.onload = function() {
                lightboxImage.src = img.src;
                lightboxImage.alt = img.alt || 'Gallery image';
                lightboxLoader.style.display = 'none';
                setTimeout(() => {
                    lightboxImage.classList.add('loaded');
                }, 10);
            };
            tempImg.src = img.src;
            
            // Update counter
            lightboxCounter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
            
            // Update navigation buttons visibility
            lightboxPrev.style.display = currentImageIndex === 0 ? 'none' : 'block';
            lightboxNext.style.display = currentImageIndex === galleryImages.length - 1 ? 'none' : 'block';
        }
        
        // Navigate to previous image
        function prevImage() {
            if (currentImageIndex > 0) {
                currentImageIndex--;
                showImage();
            }
        }
        
        // Navigate to next image
        function nextImage() {
            if (currentImageIndex < galleryImages.length - 1) {
                currentImageIndex++;
                showImage();
            }
        }
        
        // Event listeners
        lightboxClose.addEventListener('click', closeLightbox);
        lightboxPrev.addEventListener('click', prevImage);
        lightboxNext.addEventListener('click', nextImage);
        
        // Close on background click
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLightbox();
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!modal.classList.contains('active')) return;
            
            switch(e.key) {
                case 'Escape':
                    closeLightbox();
                    break;
                case 'ArrowLeft':
                    prevImage();
                    break;
                case 'ArrowRight':
                    nextImage();
                    break;
            }
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLightbox);
    } else {
        initLightbox();
    }
})();
