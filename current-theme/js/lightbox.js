// Lightbox Gallery Functionality
(function() {
    let currentImageIndex = 0;
    let galleryImages = [];
    let savedScrollPosition = 0; // Store gallery scroll position
    let isRestoring = false; // Flag to prevent interference during restoration
    
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
        // Get gallery scroll container and all gallery images
        const galleryScrollContainer = document.querySelector('.horizontal-scroll-wrapper');
        if (!galleryScrollContainer) return;
        
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
            img.parentElement.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default behavior
                e.stopPropagation(); // Stop event bubbling
                
                // Save scroll position immediately before any processing
                const galleryScrollContainer = document.querySelector('.horizontal-scroll-wrapper');
                if (galleryScrollContainer) {
                    savedScrollPosition = galleryScrollContainer.scrollLeft;
                }
                
                currentImageIndex = index;
                openLightbox();
            });
        });
        
        // Open lightbox
        function openLightbox() {
            // Immediately lock the gallery scroll position
            const galleryScrollContainer = document.querySelector('.horizontal-scroll-wrapper');
            if (galleryScrollContainer) {
                // Force the position to stay where it is
                galleryScrollContainer.style.scrollBehavior = 'auto';
                galleryScrollContainer.scrollLeft = savedScrollPosition;
            }
            
            // Disable section flicker during lightbox
            if (window.sectionFlickerInstance) {
                window.sectionFlickerInstance.isAnimating = true;
            }
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
            showImage();
        }
        
        // Close lightbox
        function closeLightbox() {
            isRestoring = true; // Set flag to prevent interference
            
            modal.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
            lightboxImage.classList.remove('loaded');
            
            // Re-enable section flicker after restoration is complete
            if (window.sectionFlickerInstance) {
                setTimeout(() => {
                    window.sectionFlickerInstance.isAnimating = false;
                }, 500);
            }
            
            // Restore gallery scroll position with multiple attempts for reliability
            const restoreScrollPosition = () => {
                const galleryScrollContainer = document.querySelector('.horizontal-scroll-wrapper');
                if (galleryScrollContainer && savedScrollPosition !== undefined) {
                    // Disable any scroll events temporarily
                    const originalScrollBehavior = galleryScrollContainer.style.scrollBehavior;
                    galleryScrollContainer.style.scrollBehavior = 'auto';
                    
                    galleryScrollContainer.scrollLeft = savedScrollPosition;
                    
                    // Restore original scroll behavior
                    setTimeout(() => {
                        galleryScrollContainer.style.scrollBehavior = originalScrollBehavior;
                    }, 50);
                }
            };
            
            // Try multiple times to ensure it works
            setTimeout(restoreScrollPosition, 50);
            setTimeout(restoreScrollPosition, 150);
            setTimeout(() => {
                restoreScrollPosition();
                isRestoring = false; // Clear flag after restoration
            }, 300);
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
        document.addEventListener('DOMContentLoaded', function() {
            // Add a small delay to ensure gallery images are fully loaded
            setTimeout(initLightbox, 100);
        });
    } else {
        // DOM is already ready
        setTimeout(initLightbox, 100);
    }
})();
