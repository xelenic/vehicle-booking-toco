<!-- Example: How to integrate Media Manager in any form -->

<!-- Method 1: Using data attributes (Automatic) -->
<div data-media-selector 
     data-input-id="category-image-input"
     data-preview-id="category-image-preview"
     data-button-id="select-category-image-btn"
     data-folder="categories"
     data-multiple="false">
</div>

<!-- Method 2: Using JavaScript (Manual) -->
<script>
// Initialize media selector for any form
const categoryMediaSelector = new MediaSelector({
    inputId: 'category-image-input',
    previewId: 'category-image-preview', 
    buttonId: 'select-category-image-btn',
    folder: 'categories',
    multiple: false,
    onSelect: function(media, allMedia) {
        console.log('Selected media:', media);
        // Custom logic here
    },
    onRemove: function(mediaId, allMedia) {
        console.log('Removed media:', mediaId);
        // Custom logic here
    }
});
</script>

<!-- Method 3: Replace existing file input -->
<script>
// Replace an existing file input with media manager
MediaFormIntegration.replaceFileInput('#existing-file-input', {
    folder: 'slider',
    multiple: false
});
</script>

<!-- Method 4: Add to existing form -->
<script>
// Add media manager to an existing form
MediaFormIntegration.initForm('#my-form', {
    folder: 'uploads',
    multiple: true
});
</script>
