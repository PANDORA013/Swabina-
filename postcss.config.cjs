const purgecss = require('@fullhuman/postcss-purgecss').default;

module.exports = {
  plugins: [
    purgecss({
      content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './public/assets/js/**/*.js',
      ],
      safelist: {
        standard: [
          // Bootstrap show/hide classes
          /^(show|hide|collapse|collapsing|fade|active|disabled)/,
          // Animation classes
          /^(animate-|transition-)/,
          // Dynamic classes
          /^(hover-|focus-|group-)/,
          // Carousel
          /^(carousel|slide|prev|next)/,
          // Modal
          /^(modal|backdrop|fade|show)/,
          // Dropdown
          /^(dropdown|dropup|dropstart|dropend)/,
          // Tooltip/Popover
          /^(tooltip|popover|bs-)/,
          // Alert
          /^(alert|alert-)/,
          // Badge
          /^(badge|badge-)/,
          // Button
          /^(btn|btn-)/,
          // Card
          /^(card|card-)/,
          // Form
          /^(form|form-)/,
          // List
          /^(list|list-)/,
          // Pagination
          /^(pagination|page-)/,
          // Spinner
          /^(spinner|spinner-)/,
          // Toast
          /^(toast|toast-)/,
          // Offcanvas
          /^(offcanvas|offcanvas-)/,
          // Navbar
          /^(navbar|navbar-)/,
          // Breadcrumb
          /^(breadcrumb|breadcrumb-)/,
          // Grid
          /^(row|col|container|container-fluid)/,
          // Spacing
          /^(m|p|mt|mb|ml|mr|pt|pb|pl|pr|mx|my|px|py|ms|me|ps|pe)/,
          // Display
          /^(d-|display-)/,
          // Flex
          /^(flex|justify|align|order)/,
          // Text
          /^(text-|fw-|fs-|lh-)/,
          // Background
          /^(bg-)/,
          // Border
          /^(border|rounded)/,
          // Shadow
          /^(shadow)/,
          // Opacity
          /^(opacity-)/,
          // Position
          /^(position|top|bottom|left|right|start|end)/,
          // Z-index
          /^(z-)/,
          // Overflow
          /^(overflow)/,
          // Visibility
          /^(visible|invisible)/,
          // Width/Height
          /^(w-|h-|min-|max-)/,
          // Float
          /^(float)/,
          // Clearfix
          /^(clearfix)/,
          // Custom classes
          /^(hover-lift|feature-card|section-title|page-header|company-info)/,
        ],
      },
      defaultExtractor: (content) => {
        const broadMatches = content.match(/[^<>"'`\s]*[^<>"'`\s:]/g) || [];
        const innerMatches = content.match(/(?:^|[^\\])['"`]([^'"`]*?)['"`]/g) || [];
        return broadMatches.concat(
          innerMatches.map((match) => match.slice(1, -1))
        );
      },
    }),
  ],
};
