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

    // Show data for dynamic content switching
    const showsData = {
        'mar-22': {
            image: 'images/scathachGalleryPic2.jpg',
            date: 'March 22, 2026',
            venue: 'The Mystic Hall',
            location: 'Cork, Ireland',
            description: 'An intimate acoustic evening in Cork\'s most mystical venue. Experience our Celtic melodies in their purest form, surrounded by ancient stone walls and candlelight.',
            time: 'Doors: 7:30 PM • Show: 8:30 PM',
            price: '€30-€50'
        },
        'apr-05': {
            image: 'images/scathachGalleryPic3.jpg',
            date: 'April 5, 2026',
            venue: 'Ancient Grounds Festival',
            location: 'Galway, Ireland',
            description: 'Join us at Ireland\'s premier Celtic music festival for a spectacular outdoor performance. Feel the energy of thousands as we celebrate our heritage under the stars.',
            time: 'Gates: 2:00 PM • Show: 9:00 PM',
            price: '€45-€85'
        },
        'apr-18': {
            image: 'images/WhatsApp Image 2025-05-20 at 20.29.23_b3d09b57.jpg',
            date: 'April 18, 2026',
            venue: 'The Emerald Theatre',
            location: 'Limerick, Ireland',
            description: 'A grand theatrical performance featuring our full ensemble with traditional Irish dancers and visual storytelling that brings ancient legends to life.',
            time: 'Doors: 6:45 PM • Show: 7:45 PM',
            price: '€40-€70'
        },
        'may-10': {
            image: 'images/WhatsApp Image 2025-05-20 at 20.29.24_8b78d2fb.jpg',
            date: 'May 10, 2026',
            venue: 'Celtic Legends Venue',
            location: 'Belfast, Northern Ireland',
            description: 'Cross the border for an unforgettable night of Celtic fusion in Belfast\'s premier music venue. Experience the unity of Irish music traditions.',
            time: 'Doors: 7:15 PM • Show: 8:15 PM',
            price: '€38-€65'
        },
        'may-24': {
            image: 'images/WhatsApp Image 2025-05-20 at 20.29.25_f7706e0d.jpg',
            date: 'May 24, 2026',
            venue: 'Highland Music Festival',
            location: 'Edinburgh, Scotland',
            description: 'Take our Celtic sound to the Scottish Highlands for a festival celebrating the shared heritage of Celtic nations. Mountains, music, and magic await.',
            time: 'Gates: 1:00 PM • Show: 8:30 PM',
            price: '£42-£78'
        },
        'jun-07': {
            image: 'images/WhatsApp Image 2025-05-20 at 20.29.26_e783617a.jpg',
            date: 'June 7, 2026',
            venue: 'The Dragon\'s Den',
            location: 'Cardiff, Wales',
            description: 'Complete our Celtic nations tour in the heart of Wales. Experience the fire of Welsh music tradition blended with our unique Scáthach sound.',
            time: 'Doors: 7:00 PM • Show: 8:00 PM',
            price: '£35-£60'
        }
    };

    // Add click handlers to sidebar shows
    sidebarShows.forEach(show => {
        show.addEventListener('click', function() {
            // Remove active class from all shows
            sidebarShows.forEach(s => s.classList.remove('active'));
            // Add active class to clicked show
            this.classList.add('active');

            // Get show data
            const showId = this.getAttribute('data-show-id');
            if (showsData[showId]) {
                updateFeaturedShow(showsData[showId]);
                
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
            }
        });
    });

    function updateFeaturedShow(showData) {
        // Add loading class for smooth transition
        featuredShow.style.opacity = '0.5';
        
        setTimeout(() => {
            featuredImage.src = showData.image;
            featuredImage.alt = showData.venue;
            featuredDate.textContent = showData.date;
            featuredVenueName.textContent = showData.venue;
            venueLocation.textContent = showData.location;
            showDescription.textContent = showData.description;
            showTime.textContent = showData.time;
            ticketPrice.textContent = showData.price;
            
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
