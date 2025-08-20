// Smooth scroll to section function
function scrollToSection(sectionId) {
  const element = document.getElementById(sectionId);
  if (element) {
    element.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
  }
}

// Intersection Observer for fade-in animations
function initializeAnimations() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, observerOptions);

  // Add fade-in class to elements and observe them
  const animatedElements = document.querySelectorAll('.highlight-card, .platform-card, .feature-item, .support-content');
  animatedElements.forEach((el, index) => {
    el.classList.add('fade-in');
    el.style.transitionDelay = `${index * 0.1}s`;
    observer.observe(el);
  });
}

// Handle CTA button clicks
function initializeCTAButtons() {
  const demoButtons = document.querySelectorAll('.btn');
  
  demoButtons.forEach(button => {
    if (button.textContent.includes('Request Demo') || button.textContent.includes('Get Pricing')) {
      button.addEventListener('click', function() {
        // Show a simple modal or notification
        showNotification('Thank you for your interest! We will contact you soon.');
      });
    }
  });
}

// Simple notification system
function showNotification(message) {
  // Remove existing notification if any
  const existingNotification = document.querySelector('.notification');
  if (existingNotification) {
    existingNotification.remove();
  }

  // Create notification element
  const notification = document.createElement('div');
  notification.className = 'notification';
  notification.innerHTML = `
    <div class="notification-content">
      <i class="fas fa-check-circle"></i>
      <span>${message}</span>
      <button class="notification-close" onclick="closeNotification(this)">
        <i class="fas fa-times"></i>
      </button>
    </div>
  `;

  // Add notification styles
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    background: var(--color-success);
    color: white;
    padding: 16px 20px;
    border-radius: var(--radius-base);
    box-shadow: var(--shadow-lg);
    transform: translateX(100%);
    transition: transform var(--duration-normal) var(--ease-standard);
    max-width: 400px;
  `;

  const notificationContent = notification.querySelector('.notification-content');
  notificationContent.style.cssText = `
    display: flex;
    align-items: center;
    gap: 12px;
  `;

  const closeButton = notification.querySelector('.notification-close');
  closeButton.style.cssText = `
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    padding: 4px;
    margin-left: auto;
  `;

  // Add to body
  document.body.appendChild(notification);

  // Trigger animation
  setTimeout(() => {
    notification.style.transform = 'translateX(0)';
  }, 100);

  // Auto-hide after 5 seconds
  setTimeout(() => {
    closeNotification(closeButton);
  }, 5000);
}

function closeNotification(button) {
  const notification = button.closest('.notification');
  if (notification) {
    notification.style.transform = 'translateX(100%)';
    setTimeout(() => {
      notification.remove();
    }, 300);
  }
}

// Add hover effects for cards
function initializeCardHoverEffects() {
  const cards = document.querySelectorAll('.highlight-card, .platform-card');
  
  cards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-8px)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });
}

// Handle feature item hover effects
function initializeFeatureHoverEffects() {
  const featureItems = document.querySelectorAll('.feature-item');
  
  featureItems.forEach(item => {
    item.addEventListener('mouseenter', function() {
      const icon = this.querySelector('i');
      if (icon) {
        icon.style.transform = 'scale(1.2)';
        icon.style.transition = 'transform var(--duration-fast) var(--ease-standard)';
      }
    });
    
    item.addEventListener('mouseleave', function() {
      const icon = this.querySelector('i');
      if (icon) {
        icon.style.transform = 'scale(1)';
      }
    });
  });
}

// Navbar scroll effect (if needed for future enhancements)
function initializeScrollEffects() {
  let lastScrollTop = 0;
  
  window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Add scroll-based effects here if needed
    // For example, changing header appearance on scroll
    
    lastScrollTop = scrollTop;
  });
}

// Initialize contact form handling (placeholder)
function initializeContactForm() {
  const contactItems = document.querySelectorAll('.contact-item');
  
  contactItems.forEach(item => {
    item.addEventListener('click', function() {
      const emailItem = this.querySelector('span');
      if (emailItem && emailItem.textContent.includes('@')) {
        // Handle email click
        window.location.href = `mailto:${emailItem.textContent}`;
      } else if (emailItem && emailItem.textContent.includes('+')) {
        // Handle phone click
        window.location.href = `tel:${emailItem.textContent.replace(/\s/g, '')}`;
      }
    });
    
    // Add hover effect for contact items
    item.style.cursor = 'pointer';
    item.addEventListener('mouseenter', function() {
      this.style.opacity = '0.8';
      this.style.transition = 'opacity var(--duration-fast) var(--ease-standard)';
    });
    
    item.addEventListener('mouseleave', function() {
      this.style.opacity = '1';
    });
  });
}

// Performance optimization: Lazy load animations
function initializeLazyAnimations() {
  const supportIcons = document.querySelectorAll('.support-icon-item');
  
  supportIcons.forEach((icon, index) => {
    icon.addEventListener('mouseenter', function() {
      this.style.transform = 'scale(1.1) rotate(5deg)';
      this.style.transition = 'transform var(--duration-normal) var(--ease-standard)';
    });
    
    icon.addEventListener('mouseleave', function() {
      this.style.transform = 'scale(1) rotate(0deg)';
    });
  });
}

// Add stagger animation to grid items
function initializeStaggerAnimations() {
  const highlightCards = document.querySelectorAll('.highlight-card');
  const platformCards = document.querySelectorAll('.platform-card');
  
  // Stagger highlight cards
  highlightCards.forEach((card, index) => {
    card.style.animationDelay = `${index * 0.1}s`;
  });
  
  // Stagger platform cards
  platformCards.forEach((card, index) => {
    card.style.animationDelay = `${index * 0.15}s`;
  });
}

// Initialize all functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  // Initialize all features
  initializeAnimations();
  initializeCTAButtons();
  initializeCardHoverEffects();
  initializeFeatureHoverEffects();
  initializeScrollEffects();
  initializeContactForm();
  initializeLazyAnimations();
  initializeStaggerAnimations();
  
  // Add a small delay to ensure smooth initial load
  setTimeout(() => {
    document.body.style.opacity = '1';
    document.body.style.transition = 'opacity var(--duration-normal) var(--ease-standard)';
  }, 100);
});

// Handle window resize for responsive adjustments
window.addEventListener('resize', function() {
  // Add any resize-specific logic here if needed
  console.log('Window resized');
});

// Add keyboard navigation support
document.addEventListener('keydown', function(e) {
  // Handle escape key to close notifications
  if (e.key === 'Escape') {
    const notification = document.querySelector('.notification');
    if (notification) {
      const closeButton = notification.querySelector('.notification-close');
      if (closeButton) {
        closeNotification(closeButton);
      }
    }
  }
});

// Export functions for potential external use
window.scrollToSection = scrollToSection;
window.showNotification = showNotification;
window.closeNotification = closeNotification;