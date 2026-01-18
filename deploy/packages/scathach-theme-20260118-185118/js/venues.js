// Venues Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Hamburger Menu Toggle
    const hamburger = document.querySelector('.hamburger');
    const headerNav = document.querySelector('.header-nav');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    
    if (hamburger) {
        hamburger.addEventListener('click', function() {
            this.classList.toggle('active');
            if (window.innerWidth <= 768) {
                // On mobile, toggle the overlay menu
                mobileMenuOverlay.classList.toggle('active');
            } else {
                // On desktop, toggle the header nav
                headerNav.classList.toggle('active');
            }
        });
    }

    // Close mobile menu when clicking on a link
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
        });
    });

    // Close mobile menu when clicking outside
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                hamburger.classList.remove('active');
                this.classList.remove('active');
            }
        });
    }

    // Header scroll effect
    const header = document.querySelector('.blog-header');
    
    function handleScroll() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', handleScroll);

    // Sidebar show interactions
    const sidebarShows = document.querySelectorAll('.sidebar-show');
    const featuredShow = document.querySelector('.featured-show');
    const featuredImage = document.querySelector('.featured-venue-image');
    const featuredDate = document.querySelector('.show-date');
    const featuredVenueName = document.querySelector('.featured-venue-name');
    const venueLocation = document.querySelector('.venue-location');
    const showDescription = document.querySelector('.show-description');
    const showTime = document.querySelector('.show-time');
    const ticketPrice = document.querySelector('.ticket-price');
    const ticketLink = document.querySelector('.tickets-link');

    // Add click handlers to sidebar shows
    sidebarShows.forEach(show => {
        show.addEventListener('click', function() {
            // Remove active class from all shows
            sidebarShows.forEach(s => s.classList.remove('active'));
            // Add active class to clicked show
            this.classList.add('active');

            // Get show data from data attributes
            const showData = {
                image: this.getAttribute('data-image'),
                date: this.getAttribute('data-date'),
                venue: this.getAttribute('data-venue'),
                location: this.getAttribute('data-location'),
                description: this.getAttribute('data-description'),
                time: this.getAttribute('data-time'),
                price: this.getAttribute('data-price'),
                ticketLink: this.getAttribute('data-ticket-link')
            };
            
            updateFeaturedShow(showData);
            
            // On mobile, scroll to featured show section after clicking
            if (window.innerWidth <= 768) {
                const featuredShow = document.querySelector('.featured-show');
                if (featuredShow) {
                    featuredShow.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Check if there's a hash in the URL to select a specific show
    setTimeout(() => {
        if (window.location.hash) {
            const showId = window.location.hash.substring(1); // Remove the # symbol (e.g., "show-123")
            // Look for the show in the sidebar by data-show-id
            const showElement = document.querySelector(`[data-show-id="${showId}"]`);
            
            if (showElement) {
                console.log('Clicking show element:', showId);
                // Trigger the click event
                showElement.click();
                
                // Scroll the sidebar to make the selected show visible
                const sidebar = document.querySelector('.shows-sidebar');
                if (sidebar) {
                    setTimeout(() => {
                        showElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }, 200);
                }
            } else {
                console.log('Show element not found:', showId);
            }
        }
    }, 300);

    function updateFeaturedShow(showData) {
        // Add loading class for smooth transition
        featuredShow.style.opacity = '0.5';
        
        setTimeout(() => {
            if (featuredImage) featuredImage.src = showData.image;
            if (featuredImage) featuredImage.alt = showData.venue;
            if (featuredDate) featuredDate.textContent = showData.date;
            if (featuredVenueName) featuredVenueName.textContent = showData.venue;
            if (venueLocation) venueLocation.textContent = showData.location;
            if (showDescription) showDescription.textContent = showData.description;
            if (showTime) showTime.textContent = showData.time;
            if (ticketPrice) ticketPrice.textContent = showData.price;
            if (ticketLink && showData.ticketLink) {
                ticketLink.href = showData.ticketLink;
                ticketLink.setAttribute('target', '_blank');
            }
            
            // Restore opacity
            featuredShow.style.opacity = '1';
        }, 200);
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Animate cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe cards for animation
    document.querySelectorAll('.past-show-card, .benefit-item').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });

    // Add hover effect to ticket links
    document.querySelectorAll('.tickets-link, .partnership-cta').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});

// Sidebar scroll functionality
function scrollSidebar(direction) {
    const sidebar = document.querySelector('.shows-sidebar');
    const scrollAmount = 120; // Adjust scroll distance as needed
    
    if (direction === 'up') {
        sidebar.scrollBy({
            top: -scrollAmount,
            behavior: 'smooth'
        });
    } else if (direction === 'down') {
        sidebar.scrollBy({
            top: scrollAmount,
            behavior: 'smooth'
        });
    }
}
