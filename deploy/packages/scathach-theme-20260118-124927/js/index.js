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
    
    // Logo text fade on scroll
    const logoText = document.querySelector('.logo-text');
    const firstSection = document.querySelector('#corner-section');
    
    if (logoText && firstSection) {
        window.addEventListener('scroll', function() {
            const firstSectionHeight = firstSection.offsetHeight;
            const scrollPosition = window.scrollY;
            
            // Calculate opacity: fade out as we scroll through the first section
            // Opacity goes from 1 to 0 as we scroll from 0 to firstSectionHeight
            const opacity = Math.max(0, 1 - (scrollPosition / firstSectionHeight));
            
            logoText.style.opacity = opacity;
            
            // Optional: also hide it completely when fully scrolled past
            if (scrollPosition >= firstSectionHeight) {
                logoText.style.visibility = 'hidden';
            } else {
                logoText.style.visibility = 'visible';
            }
        });
    }
});
// Gallery horizontal scrolling functionality
class HorizontalGallery {
    constructor(gallerySelector) {
        this.gallery = document.querySelector(gallerySelector);
        this.scrollContainer = this.gallery.querySelector('.horizontal-scroll-wrapper');
        this.images = this.scrollContainer.querySelectorAll('img');
        this.scrollAmount = 300; // pixels to scroll per click
        
        // Hover delay properties
        this.hoverDelay = 1000; // 1 second delay
        this.hoverTimer = null;
        this.horizontalScrollEnabled = false;
        
        // Initialize global flag for SectionFlicker coordination
        window.galleryHorizontalScrollEnabled = false;
        
        this.init();
    }
    
    init() {
        // Only setup desktop features if not on mobile
        const isMobile = window.innerWidth <= 480;
        
        if (!isMobile) {
            this.setupEventListeners();
            this.setupKeyboardNavigation();
        }
        
        // Touch navigation works for all devices
        this.setupTouchNavigation();
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
        // Setup hover detection for enabling horizontal scroll
        this.setupHoverDetection();
        
        this.scrollContainer.addEventListener('wheel', (e) => {
            // Only handle wheel events if horizontal scrolling is enabled after hover delay
            if (this.horizontalScrollEnabled) {
                e.preventDefault(); // Stop normal page scrolling AND section flicking
                e.stopPropagation(); // Prevent the event from bubbling to SectionFlicker
                
                // Convert vertical wheel movement to horizontal scroll
                const scrollAmount = e.deltaY * 4; // Multiply for sensitivity
                
                this.scrollContainer.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth' // Use 'smooth' for smoother scrolling
                });
            }
            // If horizontalScrollEnabled is false, let the SectionFlicker handle this
            // Don't call preventDefault() so the section navigation works normally
        }, { passive: false });
    }
    
    setupHoverDetection() {
        // Setup hover detection for the gallery images
        this.scrollContainer.addEventListener('mouseenter', () => {
            // Start hover delay timer
            this.hoverTimer = setTimeout(() => {
                this.horizontalScrollEnabled = true;
                window.galleryHorizontalScrollEnabled = true; // Global flag for SectionFlicker
            }, this.hoverDelay);
        });
        
        // Reset on mouse leave
        this.scrollContainer.addEventListener('mouseleave', () => {
            this.horizontalScrollEnabled = false;
            window.galleryHorizontalScrollEnabled = false; // Reset global flag
            if (this.hoverTimer) {
                clearTimeout(this.hoverTimer);
                this.hoverTimer = null;
            }
        });
    }
    
    setupTouchNavigation() {
        // Check if on mobile
        const isMobile = window.innerWidth <= 480;
        
        // On mobile, let native scrolling handle everything
        if (isMobile) {
            return; // Don't add any touch/mouse event handlers on mobile
        }
        
        // Desktop drag-to-scroll functionality
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

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize the main gallery
    const gallery = new HorizontalGallery('#gallery');
    
    // Initialize merch horizontal scrolling
    const merch = new HorizontalMerch('#merch');
    
    // Initialize section flicking ONLY on desktop/tablet (not on mobile)
    // Check if screen width is greater than 480px (mobile breakpoint)
    if (window.innerWidth > 480) {
        const sectionFlicker = new SectionFlicker();
    }
    
    // Re-check on window resize to enable/disable section flicking
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Reload page if crossing the mobile/desktop boundary
            // This ensures proper initialization
            const isMobile = window.innerWidth <= 480;
            const hasSectionFlicker = window.sectionFlickerInstance !== undefined;
            
            if (isMobile && hasSectionFlicker) {
                // Switched to mobile - reload to disable section flicker
                location.reload();
            } else if (!isMobile && !hasSectionFlicker) {
                // Switched to desktop - reload to enable section flicker
                location.reload();
            }
        }, 300);
    });
    
    // Optional: Enable auto-scroll (uncomment the line below)
    // const autoScroll = new GalleryAutoScroll(gallery, 4000);
    
    // All components initialized successfully
});

// Section flicking with mouse wheel
class SectionFlicker {
    constructor() {
        this.currentSection = -1; // Start at background (before first section)
        this.isAnimating = false;
        this.sections = document.querySelectorAll('.sections section');
        // Treat music section + footer as one combined section
        this.totalSections = this.sections.length - 1;
        this.pendingDirection = null; // Queue for pending scroll actions
        
        // Store instance globally for tracking
        window.sectionFlickerInstance = this;
        
        this.init();
    }
    
    init() {
        this.setupWheelListener();
        this.setupScrollListener(); // Need this to detect music/footer area
        this.goToSection(this.currentSection); // Start at background
    }
    
    setupWheelListener() {
        window.addEventListener('wheel', (e) => {
            // Skip if wheel is over gallery content and gallery horizontal scrolling is enabled
            const galleryScrollContainer = document.querySelector('.horizontal-scroll-wrapper');
            if (galleryScrollContainer) {
                const rect = galleryScrollContainer.getBoundingClientRect();
                const mouseX = e.clientX;
                const mouseY = e.clientY;
                
                if (mouseX >= rect.left && mouseX <= rect.right && 
                    mouseY >= rect.top && mouseY <= rect.bottom) {
                    
                    // Check if the gallery has horizontal scrolling enabled
                    if (window.galleryHorizontalScrollEnabled) {
                        return; // Let gallery handle this wheel event
                    }
                }
            }
            
            // Skip if wheel is over merch content and merch horizontal scrolling is enabled
            const merchScrollContainer = document.querySelector('.merch-scroll-container');
            if (merchScrollContainer) {
                const rect = merchScrollContainer.getBoundingClientRect();
                const mouseX = e.clientX;
                const mouseY = e.clientY;
                
                if (mouseX >= rect.left && mouseX <= rect.right && 
                    mouseY >= rect.top && mouseY <= rect.bottom) {
                    
                    // Check if the merch has horizontal scrolling enabled
                    if (window.merchHorizontalScrollEnabled) {
                        return; // Let merch handle this wheel event
                    }
                }
            }
            
            // Prevent default scrolling and handle section navigation
            e.preventDefault();
            
            const direction = e.deltaY > 0 ? 'down' : 'up';
            
            // If currently animating, queue the action for later
            if (this.isAnimating) {
                this.pendingDirection = direction;
                return;
            }
            
            this.handleWheelTick(direction);
        }, { passive: false });
    }
    
    setupScrollListener() {
        // Track scroll position to keep currentSection in sync
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            // Debounce scroll events
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                // Only update if not currently animating (to avoid conflicts with programmatic scrolling)
                if (!this.isAnimating) {
                    this.syncCurrentSection();
                }
            }, 150); // Increased debounce time for stability
        });
    }
    
    syncCurrentSection() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const viewportHeight = window.innerHeight;
        
        // Determine which section we're closest to based on scroll position
        let newSection = -1; // Default to background
        
        // Check if we're at or past the music section position
        const musicSectionStart = viewportHeight * this.sections.length;
        if (scrollTop >= musicSectionStart - (viewportHeight / 2)) {
            // We're in the music+footer area - treat as last section
            newSection = this.totalSections - 1;
        } else {
            // Normal section detection for other sections
            for (let i = 0; i < this.totalSections - 1; i++) {
                const sectionStart = viewportHeight * (i + 1);
                if (scrollTop >= sectionStart - (viewportHeight / 2)) {
                    newSection = i;
                }
            }
        }
        
        // Update current section if it changed
        this.currentSection = newSection;
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
        
        // Reset animation lock with shorter timeout for better responsiveness
        setTimeout(() => {
            this.isAnimating = false;
            
            // Process any pending scroll action
            if (this.pendingDirection) {
                const direction = this.pendingDirection;
                this.pendingDirection = null;
                // Execute the pending scroll after a brief delay
                setTimeout(() => {
                    if (!this.isAnimating) {
                        this.handleWheelTick(direction);
                    }
                }, 50);
            }
        }, 400); // Reduced from 800ms for better responsiveness
    }
    
    goToSection(sectionIndex) {
        let scrollTarget;
        
        if (sectionIndex < 0) {
            // Go to background (top of page)
            scrollTarget = 0;
        } else if (sectionIndex >= this.totalSections - 1) {
            // Last section (music + footer combined) - scroll to show music section
            // This will be at the actual music section position (last real section)
            scrollTarget = window.innerHeight * this.sections.length;
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

// Merch initialization moved to main DOMContentLoaded block above

// Merch horizontal scrolling functionality
class HorizontalMerch {
    constructor(merchSelector) {
        this.merch = document.querySelector(merchSelector);
        this.scrollContainer = this.merch.querySelector('.merch-scroll-container');
        this.items = this.scrollContainer.querySelectorAll('.merch-item');
        this.scrollAmount = 300; // pixels to scroll per click
        
        // Hover delay properties
        this.hoverDelay = 1000; // 1 second delay
        this.hoverTimer = null;
        this.horizontalScrollEnabled = false;
        
        // Initialize global flag for SectionFlicker coordination
        window.merchHorizontalScrollEnabled = false;
        
        this.init();
    }
    
    init() {
        // Only setup desktop features if not on mobile
        const isMobile = window.innerWidth <= 480;
        
        if (!isMobile) {
            this.setupEventListeners();
            this.setupTouchNavigation();
        }
        // On mobile, let native scrolling handle everything
    }
    
    setupEventListeners() {
        this.setupMouseWheelScrolling();
        this.setupHoverDetection();
    }
    
    setupMouseWheelScrolling() {
        // Add wheel event to the scroll container specifically
        this.scrollContainer.addEventListener('wheel', (e) => {
            // Only handle wheel events if horizontal scrolling is enabled after hover delay
            if (!this.horizontalScrollEnabled) {
                return; // Allow normal vertical scrolling
            }
            
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
            // Don't call preventDefault() so the section navigation works normally
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
    
    setupHoverDetection() {
        // Setup hover detection for the merch items
        this.scrollContainer.addEventListener('mouseenter', () => {
            // Start hover delay timer
            this.hoverTimer = setTimeout(() => {
                this.horizontalScrollEnabled = true;
                window.merchHorizontalScrollEnabled = true; // Global flag for SectionFlicker
            }, this.hoverDelay);
        });
        
        // Reset on mouse leave
        this.scrollContainer.addEventListener('mouseleave', () => {
            this.horizontalScrollEnabled = false;
            window.merchHorizontalScrollEnabled = false; // Reset global flag
            if (this.hoverTimer) {
                clearTimeout(this.hoverTimer);
                this.hoverTimer = null;
            }
        });
    }
}

// Mobile Menu Functions
function toggleMobileMenu() {
    const toggleButton = document.querySelector('.mobile-menu-toggle');
    const overlay = document.getElementById('mobileMenuOverlay');
    
    if (overlay.classList.contains('active')) {
        closeMobileMenu();
    } else {
        openMobileMenu();
    }
}

function openMobileMenu() {
    const toggleButton = document.querySelector('.mobile-menu-toggle');
    const overlay = document.getElementById('mobileMenuOverlay');
    
    toggleButton.classList.add('active');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent scrolling
}

function closeMobileMenu() {
    const toggleButton = document.querySelector('.mobile-menu-toggle');
    const overlay = document.getElementById('mobileMenuOverlay');
    
    toggleButton.classList.remove('active');
    overlay.classList.remove('active');
    document.body.style.overflow = ''; // Restore scrolling
}

// Close mobile menu when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('mobileMenuOverlay');
    
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            closeMobileMenu();
        }
    });
    
    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });
});

// Accordion functionality
document.addEventListener('DOMContentLoaded', function() {
    const accordionPanels = document.querySelectorAll('.accordion-panel');
    const horizontalAccordion = document.querySelector('.horizontal-accordion');
    
    if (!accordionPanels.length || !horizontalAccordion) return;
    
    // Function to check if we're on mobile
    function isMobile() {
        return window.innerWidth <= 768;
    }
    
    // Function to update the accordion container class
    function updateAccordionState() {
        const hasExpanded = Array.from(accordionPanels).some(p => p.classList.contains('expanded'));
        if (hasExpanded) {
            horizontalAccordion.classList.add('has-expanded');
        } else {
            horizontalAccordion.classList.remove('has-expanded');
        }
    }
    
    // Function to expand a panel
    function expandPanel(panel) {
        accordionPanels.forEach(p => p.classList.remove('expanded'));
        panel.classList.add('expanded');
        updateAccordionState();
        console.log('Panel expanded:', panel.querySelector('h3')?.textContent);
    }
    
    // Function to collapse all panels
    function collapseAll() {
        accordionPanels.forEach(p => p.classList.remove('expanded'));
        updateAccordionState();
        console.log('All panels collapsed');
    }
    
    if (isMobile()) {
        // Mobile: Click/Tap to toggle
        accordionPanels.forEach(panel => {
            // Use click event for mobile
            panel.addEventListener('click', function(e) {
                // Don't interfere with link clicks
                if (e.target.closest('.accordion-link')) {
                    return;
                }
                
                e.preventDefault();
                e.stopPropagation();
                
                // Toggle behavior
                if (this.classList.contains('expanded')) {
                    collapseAll();
                } else {
                    expandPanel(this);
                }
            });
        });
        
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!horizontalAccordion.contains(e.target)) {
                collapseAll();
            }
        });
        
    } else {
        // Desktop: Hover behavior
        accordionPanels.forEach(panel => {
            panel.addEventListener('mouseenter', function() {
                expandPanel(this);
            });
        });
        
        // Reset when mouse leaves the entire accordion
        horizontalAccordion.addEventListener('mouseleave', function() {
            collapseAll();
        });
    }
    
    // Re-initialize on window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            collapseAll();
        }, 250);
    });
});

