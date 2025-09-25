// Sparkle Effect Script
function createSparkles(num) {
    const container = document.querySelector('.sparkle-container');
    if (!container) return;
    container.innerHTML = '';
    for (let i = 0; i < num; i++) {
        const sparkle = document.createElement('div');
        sparkle.className = 'sparkle';
        sparkle.style.top = Math.random() * 100 + 'vh';
        sparkle.style.left = Math.random() * 100 + 'vw';
        sparkle.style.animationDelay = (Math.random() * 2) + 's';
        container.appendChild(sparkle);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    createSparkles(60); // Number of sparkles
});
// Gallery horizontal scrolling functionality
class HorizontalGallery {
    constructor(gallerySelector) {
        this.gallery = document.querySelector(gallerySelector);
        this.scrollContainer = this.gallery.querySelector('.horizontal-scroll-wrapper');
        this.images = this.scrollContainer.querySelectorAll('img');
        this.scrollAmount = 300; // pixels to scroll per click
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.setupTouchNavigation();
        this.setupKeyboardNavigation();
    }
    
    createNavigationButtons() {
        // Create navigation container
        const navContainer = document.createElement('div');
        navContainer.className = 'gallery-nav';
        
        // Create left arrow button
        const leftBtn = document.createElement('button');
        leftBtn.className = 'gallery-nav-btn gallery-nav-left';
        leftBtn.innerHTML = '←';
        leftBtn.setAttribute('aria-label', 'Scroll left');
        
        // Create right arrow button
        const rightBtn = document.createElement('button');
        rightBtn.className = 'gallery-nav-btn gallery-nav-right';
        rightBtn.innerHTML = '→';
        rightBtn.setAttribute('aria-label', 'Scroll right');
        
        navContainer.appendChild(leftBtn);
        navContainer.appendChild(rightBtn);
        
        // Insert navigation after the scroll container
        this.gallery.appendChild(navContainer);
        
        this.leftBtn = leftBtn;
        this.rightBtn = rightBtn;
        
        // Update button states
        this.updateButtonStates();
    }
    
    setupEventListeners() {
        // Image click to focus/center
        this.images.forEach((img, index) => {
            img.addEventListener('click', () => {
                this.scrollToImage(index);
            });
        });
        
        // Mouse wheel horizontal scrolling
        this.setupMouseWheelScrolling();
    }
    
    setupMouseWheelScrolling() {
        this.scrollContainer.addEventListener('wheel', (e) => {
            // Check if the mouse is over the scroll container (content area)
            const rect = this.scrollContainer.getBoundingClientRect();
            const mouseX = e.clientX;
            const mouseY = e.clientY;
            
            // Check if mouse is within scroll container bounds
            if (mouseX >= rect.left && mouseX <= rect.right && 
                mouseY >= rect.top && mouseY <= rect.bottom) {
                
                e.preventDefault(); // Stop normal page scrolling
                
                // Convert vertical wheel movement to horizontal scroll
                const scrollAmount = e.deltaY * 4; // Multiply for sensitivity
                
                this.scrollContainer.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth' // Use 'smooth' for smoother scrolling
                });
                
                // Update button states after wheel scroll
                setTimeout(() => {
                    // Button state update removed since no buttons
                }, 10);
            }
        }, { passive: false });
    }
    
    setupTouchNavigation() {
        let startX = 0;
        let scrollLeft = 0;
        let isDown = false;
        
        this.scrollContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            this.scrollContainer.style.cursor = 'grabbing';
            startX = e.pageX - this.scrollContainer.offsetLeft;
            scrollLeft = this.scrollContainer.scrollLeft;
        });
        
        this.scrollContainer.addEventListener('mouseleave', () => {
            isDown = false;
            this.scrollContainer.style.cursor = 'grab';
        });
        
        this.scrollContainer.addEventListener('mouseup', () => {
            isDown = false;
            this.scrollContainer.style.cursor = 'grab';
        });
        
        this.scrollContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - this.scrollContainer.offsetLeft;
            const walk = (x - startX) * 2;
            this.scrollContainer.scrollLeft = scrollLeft - walk;
        });
        
        // Touch events for mobile
        this.scrollContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].pageX - this.scrollContainer.offsetLeft;
            scrollLeft = this.scrollContainer.scrollLeft;
        });
        
        this.scrollContainer.addEventListener('touchmove', (e) => {
            if (!startX) return;
            const x = e.touches[0].pageX - this.scrollContainer.offsetLeft;
            const walk = (x - startX) * 2;
            this.scrollContainer.scrollLeft = scrollLeft - walk;
        });
    }
    
    setupKeyboardNavigation() {
        // Add tabindex to make gallery focusable
        this.scrollContainer.setAttribute('tabindex', '0');
        
        this.scrollContainer.addEventListener('keydown', (e) => {
            switch(e.key) {
                case 'ArrowLeft':
                    e.preventDefault();
                    this.scrollLeft();
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    this.scrollRight();
                    break;
                case 'Home':
                    e.preventDefault();
                    this.scrollToStart();
                    break;
                case 'End':
                    e.preventDefault();
                    this.scrollToEnd();
                    break;
            }
        });
    }
    
    scrollLeft() {
        this.scrollContainer.scrollBy({
            left: -this.scrollAmount,
            behavior: 'smooth'
        });
    }
    
    scrollRight() {
        this.scrollContainer.scrollBy({
            left: this.scrollAmount,
            behavior: 'smooth'
        });
    }
    
    scrollToImage(index) {
        const img = this.images[index];
        const scrollLeft = img.offsetLeft - (this.scrollContainer.clientWidth / 2) + (img.clientWidth / 2);
        
        this.scrollContainer.scrollTo({
            left: scrollLeft,
            behavior: 'smooth'
        });
    }
    
    scrollToStart() {
        this.scrollContainer.scrollTo({
            left: 0,
            behavior: 'smooth'
        });
    }
    
    scrollToEnd() {
        this.scrollContainer.scrollTo({
            left: this.scrollContainer.scrollWidth - this.scrollContainer.clientWidth,
            behavior: 'smooth'
        });
    }
    
    updateButtonStates() {
        // Disable left button if at start
        if (this.scrollContainer.scrollLeft <= 0) {
            this.leftBtn.disabled = true;
        } else {
            this.leftBtn.disabled = false;
        }
        
        // Disable right button if at end
        if (this.scrollContainer.scrollLeft >= this.scrollContainer.scrollWidth - this.scrollContainer.clientWidth - 1) {
            this.rightBtn.disabled = true;
        } else {
            this.rightBtn.disabled = false;
        }
    }
}

// Auto-scroll functionality (optional)
class GalleryAutoScroll {
    constructor(galleryInstance, interval = 3000) {
        this.gallery = galleryInstance;
        this.interval = interval;
        this.autoScrollTimer = null;
        this.isPaused = false;
        
        this.setupAutoScroll();
    }
    
    setupAutoScroll() {
        // Pause auto-scroll on hover
        this.gallery.scrollContainer.addEventListener('mouseenter', () => {
            this.pause();
        });
        
        this.gallery.scrollContainer.addEventListener('mouseleave', () => {
            this.resume();
        });
        
        // Pause on focus (keyboard navigation)
        this.gallery.scrollContainer.addEventListener('focus', () => {
            this.pause();
        });
        
        this.gallery.scrollContainer.addEventListener('blur', () => {
            this.resume();
        });
        
        this.start();
    }
    
    start() {
        this.autoScrollTimer = setInterval(() => {
            if (!this.isPaused) {
                // Check if we're at the end, if so, go back to start
                if (this.gallery.scrollContainer.scrollLeft >= 
                    this.gallery.scrollContainer.scrollWidth - this.gallery.scrollContainer.clientWidth - 1) {
                    this.gallery.scrollToStart();
                } else {
                    this.gallery.scrollRight();
                }
            }
        }, this.interval);
    }
    
    pause() {
        this.isPaused = true;
    }
    
    resume() {
        this.isPaused = false;
    }
    
    stop() {
        if (this.autoScrollTimer) {
            clearInterval(this.autoScrollTimer);
        }
    }
}

// Initialize gallery when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize the main gallery
    const gallery = new HorizontalGallery('#gallery');
    
    // Initialize section flicking
    const sectionFlicker = new SectionFlicker();
    
    // Optional: Enable auto-scroll (uncomment the line below)
    // const autoScroll = new GalleryAutoScroll(gallery, 4000);
    
    console.log('Gallery and section flicker initialized successfully');
});

// Section flicking with mouse wheel
class SectionFlicker {
    constructor() {
        this.currentSection = -1; // Start at background (before first section)
        this.isAnimating = false;
        this.sections = document.querySelectorAll('.sections section');
        this.totalSections = this.sections.length;
        
        this.init();
    }
    
    init() {
        this.setupWheelListener();
        this.goToSection(this.currentSection); // Start at background
    }
    
    setupWheelListener() {
        window.addEventListener('wheel', (e) => {
            // Skip if currently animating
            if (this.isAnimating) {
                e.preventDefault();
                return;
            }
            
            // Skip if wheel is over gallery content (let gallery handle it)
            const galleryScrollContainer = document.querySelector('.horizontal-scroll-wrapper');
            if (galleryScrollContainer) {
                const rect = galleryScrollContainer.getBoundingClientRect();
                const mouseX = e.clientX;
                const mouseY = e.clientY;
                
                if (mouseX >= rect.left && mouseX <= rect.right && 
                    mouseY >= rect.top && mouseY <= rect.bottom) {
                    return; // Let gallery handle this wheel event
                }
            }
            
            e.preventDefault();
            
            const direction = e.deltaY > 0 ? 'down' : 'up';
            this.handleWheelTick(direction);
        }, { passive: false });
    }
    
    handleWheelTick(direction) {
        this.isAnimating = true;
        
        if (direction === 'down') {
            // Move to next section
            if (this.currentSection < this.totalSections - 1) {
                this.currentSection++;
            }
        } else {
            // Move to previous section (or background)
            if (this.currentSection > -1) {
                this.currentSection--;
            }
        }
        
        this.goToSection(this.currentSection);
        
        // Reset animation lock
        setTimeout(() => {
            this.isAnimating = false;
        }, 600); // Slightly longer than scroll animation
    }
    
    goToSection(sectionIndex) {
        let scrollTarget;
        
        if (sectionIndex < 0) {
            // Go to background (top of page)
            scrollTarget = 0;
        } else {
            // Go to specific section
            // Each section is positioned at 100vh + (sectionIndex * 100vh)
            scrollTarget = window.innerHeight * (sectionIndex + 1);
        }
        
        window.scrollTo({
            top: scrollTarget,
            behavior: 'smooth'
        });
    }
    
    // Public method to jump to a specific section
    jumpToSection(index) {
        if (index >= -1 && index < this.totalSections) {
            this.currentSection = index;
            this.goToSection(index);
        }
    }
    
    // Get current section info
    getCurrentSection() {
        return {
            index: this.currentSection,
            name: this.currentSection < 0 ? 'background' : `section-${this.currentSection}`,
            isBackground: this.currentSection < 0
        };
    }
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize existing gallery
    const gallery = new HorizontalGallery('#gallery');
    
    // Initialize merch horizontal scrolling
    const merch = new HorizontalMerch('#merch');
    
    // Initialize scroll manager
    const scrollManager = new SectionScrollManager();
});

// Merch horizontal scrolling functionality
class HorizontalMerch {
    constructor(merchSelector) {
        this.merch = document.querySelector(merchSelector);
        this.scrollContainer = this.merch.querySelector('.merch-scroll-container');
        this.items = this.scrollContainer.querySelectorAll('.merch-item');
        
        this.init();
    }
    
    init() {
        this.setupMouseWheelScrolling();
        this.setupTouchNavigation();
    }
    
    setupMouseWheelScrolling() {
        // Add wheel event to the scroll container specifically
        this.scrollContainer.addEventListener('wheel', (e) => {
            // Check if there's horizontal scroll available
            const canScrollLeft = this.scrollContainer.scrollLeft > 0;
            const canScrollRight = this.scrollContainer.scrollLeft < 
                (this.scrollContainer.scrollWidth - this.scrollContainer.clientWidth);
            
            // Only prevent vertical scrolling if we're directly over the scroll container
            // and there's horizontal scroll capability
            if (canScrollLeft || canScrollRight) {
                e.preventDefault(); // Stop normal page scrolling
                e.stopPropagation(); // Stop event from bubbling up
                
                // Convert vertical wheel movement to horizontal scroll
                const scrollAmount = e.deltaY * 2.5;
                
                this.scrollContainer.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }, { passive: false });
        
        // Allow normal vertical scrolling for the merch section areas outside the scroll container
        // by not adding any wheel event listeners to the parent merch section
    }
    
    setupTouchNavigation() {
        let startX = 0;
        let scrollLeft = 0;
        let isDown = false;
        
        this.scrollContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            this.scrollContainer.style.cursor = 'grabbing';
            startX = e.pageX - this.scrollContainer.offsetLeft;
            scrollLeft = this.scrollContainer.scrollLeft;
        });
        
        this.scrollContainer.addEventListener('mouseleave', () => {
            isDown = false;
            this.scrollContainer.style.cursor = 'grab';
        });
        
        this.scrollContainer.addEventListener('mouseup', () => {
            isDown = false;
            this.scrollContainer.style.cursor = 'grab';
        });
        
        this.scrollContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - this.scrollContainer.offsetLeft;
            const walk = (x - startX) * 2; // Scroll speed multiplier
            this.scrollContainer.scrollLeft = scrollLeft - walk;
        });
        
        // Set initial cursor
        this.scrollContainer.style.cursor = 'grab';
    }
}