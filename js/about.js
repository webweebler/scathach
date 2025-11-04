// About Page JavaScript - Fixed Height with Wheel Navigation
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.horizontal-section');
    const totalSections = sections.length;
    let currentSection = 0;
    let isAnimating = false;
    
    function showSection(index) {
        if (isAnimating || index < 0 || index >= totalSections) return;
        
        isAnimating = true;
        
        // Hide all sections
        sections.forEach((section, i) => {
            section.classList.remove('active', 'visible');
            const image = section.querySelector('.section-image');
            if (image) {
                image.classList.remove('image-revealed');
            }
        });
        
        // Show current section
        const activeSection = sections[index];
        activeSection.classList.add('active', 'visible');
        
        // Animate image after delay
        const image = activeSection.querySelector('.section-image');
        if (image) {
            setTimeout(() => {
                image.classList.add('image-revealed');
            }, 400);
        }
        
        currentSection = index;
        
        // Reset animation lock
        setTimeout(() => {
            isAnimating = false;
        }, 800);
    }
    
    // Initialize first section
    showSection(0);
    
    // Wheel event for section navigation
    let wheelTimeout;
    window.addEventListener('wheel', (e) => {
        e.preventDefault();
        
        clearTimeout(wheelTimeout);
        wheelTimeout = setTimeout(() => {
            if (e.deltaY > 0) {
                // Scroll down - next section
                showSection(currentSection + 1);
            } else {
                // Scroll up - previous section
                showSection(currentSection - 1);
            }
        }, 50);
    }, { passive: false });
    
    // Keyboard navigation
    window.addEventListener('keydown', (e) => {
        switch(e.key) {
            case 'ArrowDown':
            case ' ': // Spacebar
                e.preventDefault();
                showSection(currentSection + 1);
                break;
            case 'ArrowUp':
                e.preventDefault();
                showSection(currentSection - 1);
                break;
        }
    });
    
    // Touch support for mobile
    let touchStartY = 0;
    window.addEventListener('touchstart', (e) => {
        touchStartY = e.touches[0].clientY;
    });
    
    window.addEventListener('touchend', (e) => {
        const touchEndY = e.changedTouches[0].clientY;
        const diff = touchStartY - touchEndY;
        
        if (Math.abs(diff) > 50) { // Minimum swipe distance
            if (diff > 0) {
                // Swipe up - next section
                showSection(currentSection + 1);
            } else {
                // Swipe down - previous section
                showSection(currentSection - 1);
            }
        }
    });
});

// CSS animations for stacked sections
const style = document.createElement('style');
style.textContent = `
    .horizontal-section {
        transform: scale(0.9);
        transition: all 0.5s ease;
    }
    
    .horizontal-section.active {
        transform: scale(1);
    }
    
    .section-text h2,
    .section-text p {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .horizontal-section.visible .section-text h2 {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.2s;
    }
    
    .horizontal-section.visible .section-text p {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.4s;
    }
    
    .section-image {
        opacity: 0;
        transform: translateX(-50px);
        transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        overflow: hidden;
    }
    
    .section-image.image-revealed {
        opacity: 1;
        transform: translateX(0);
    }
    
    /* Even sections - slide from right */
    .horizontal-section:nth-child(even) .section-image {
        transform: translateX(50px);
    }
    
    .horizontal-section:nth-child(even) .section-image.image-revealed {
        transform: translateX(0);
    }
    
    .section-image img {
        transition: transform 0.3s ease;
    }
    
    .section-image.image-revealed img {
        transform: scale(1);
    }
`;
document.head.appendChild(style);