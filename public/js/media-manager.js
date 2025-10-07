/**
 * Media Manager Component
 * A reusable component for integrating media selection into forms
 */
class MediaSelector {
    constructor(options = {}) {
        this.options = {
            inputId: options.inputId || 'media-input',
            previewId: options.previewId || 'media-preview',
            buttonId: options.buttonId || 'select-media-btn',
            folder: options.folder || 'uploads',
            multiple: options.multiple || false,
            onSelect: options.onSelect || null,
            onRemove: options.onRemove || null,
            ...options
        };
        
        this.selectedMedia = [];
        this.init();
    }

    init() {
        this.createElements();
        this.bindEvents();
    }

    createElements() {
        // Create hidden input for storing selected media IDs
        let hiddenInput = document.getElementById(this.options.inputId);
        if (!hiddenInput) {
            hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.id = this.options.inputId;
            hiddenInput.name = this.options.inputId.replace('-input', '');
            document.body.appendChild(hiddenInput);
        }

        // Create preview container
        let previewContainer = document.getElementById(this.options.previewId);
        if (!previewContainer) {
            previewContainer = document.createElement('div');
            previewContainer.id = this.options.previewId;
            previewContainer.className = 'media-preview-container';
            document.body.appendChild(previewContainer);
        }

        // Create select button
        let selectButton = document.getElementById(this.options.buttonId);
        if (!selectButton) {
            selectButton = document.createElement('button');
            selectButton.type = 'button';
            selectButton.id = this.options.buttonId;
            selectButton.className = 'bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200';
            selectButton.innerHTML = '<i class="fas fa-images mr-2"></i>Select Image';
            document.body.appendChild(selectButton);
        }
    }

    bindEvents() {
        const selectButton = document.getElementById(this.options.buttonId);
        if (selectButton) {
            selectButton.addEventListener('click', () => this.openMediaSelection());
        }
    }

    openMediaSelection() {
        if (typeof window.openMediaSelection === 'function') {
            window.openMediaSelection((selectedMedia) => {
                this.handleMediaSelection(selectedMedia);
            });
        } else {
            console.error('Media selection modal not available. Make sure the media manager is loaded.');
        }
    }

    handleMediaSelection(media) {
        if (this.options.multiple) {
            // Check if media is already selected
            const exists = this.selectedMedia.find(item => item.id === media.id);
            if (!exists) {
                this.selectedMedia.push(media);
            }
        } else {
            this.selectedMedia = [media];
        }

        this.updatePreview();
        this.updateHiddenInput();

        if (this.options.onSelect) {
            this.options.onSelect(media, this.selectedMedia);
        }
    }

    updatePreview() {
        const previewContainer = document.getElementById(this.options.previewId);
        if (!previewContainer) return;

        if (this.selectedMedia.length === 0) {
            previewContainer.innerHTML = `
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500">No image selected</p>
                </div>
            `;
            return;
        }

        if (this.options.multiple) {
            previewContainer.innerHTML = `
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    ${this.selectedMedia.map(media => `
                        <div class="relative group">
                            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                                <img src="${media.url}" alt="${media.name}" class="w-full h-full object-cover">
                            </div>
                            <button type="button" onclick="mediaSelector.removeMedia(${media.id})" 
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                            <div class="mt-2">
                                <p class="text-sm font-medium text-gray-900 truncate">${media.name}</p>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;
        } else {
            const media = this.selectedMedia[0];
            previewContainer.innerHTML = `
                <div class="relative group">
                    <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                        <img src="${media.url}" alt="${media.name}" class="w-full h-full object-cover">
                    </div>
                    <button type="button" onclick="mediaSelector.removeMedia(${media.id})" 
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="mt-2">
                        <p class="text-sm font-medium text-gray-900">${media.name}</p>
                    </div>
                </div>
            `;
        }
    }

    updateHiddenInput() {
        const hiddenInput = document.getElementById(this.options.inputId);
        if (hiddenInput) {
            if (this.options.multiple) {
                hiddenInput.value = this.selectedMedia.map(media => media.id).join(',');
            } else {
                hiddenInput.value = this.selectedMedia.length > 0 ? this.selectedMedia[0].id : '';
            }
        }
    }

    removeMedia(mediaId) {
        this.selectedMedia = this.selectedMedia.filter(media => media.id !== mediaId);
        this.updatePreview();
        this.updateHiddenInput();

        if (this.options.onRemove) {
            this.options.onRemove(mediaId, this.selectedMedia);
        }
    }

    clear() {
        this.selectedMedia = [];
        this.updatePreview();
        this.updateHiddenInput();
    }

    setMedia(mediaArray) {
        this.selectedMedia = Array.isArray(mediaArray) ? mediaArray : [mediaArray];
        this.updatePreview();
        this.updateHiddenInput();
    }

    getSelectedMedia() {
        return this.selectedMedia;
    }
}

/**
 * Form Integration Helper
 * Provides easy integration with existing forms
 */
class MediaFormIntegration {
    static initForm(formSelector, options = {}) {
        const form = document.querySelector(formSelector);
        if (!form) {
            console.error('Form not found:', formSelector);
            return;
        }

        const defaultOptions = {
            inputId: 'media-input',
            previewId: 'media-preview',
            buttonId: 'select-media-btn',
            folder: 'uploads',
            multiple: false,
            ...options
        };

        // Create media selector
        const mediaSelector = new MediaSelector(defaultOptions);

        // Add media selector elements to form
        const mediaSection = document.createElement('div');
        mediaSection.className = 'media-section mb-6';
        mediaSection.innerHTML = `
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Media Selection</h3>
                
                <div id="${defaultOptions.previewId}" class="mb-4">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
                        <p class="text-gray-500">No image selected</p>
                    </div>
                </div>
                
                <div class="flex space-x-4">
                    <button type="button" id="${defaultOptions.buttonId}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-images mr-2"></i>Select Image
                    </button>
                    <button type="button" onclick="mediaSelector.clear()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>Clear
                    </button>
                </div>
            </div>
        `;

        // Insert media section before submit buttons
        const submitButtons = form.querySelector('.flex.justify-end, .submit-buttons, [type="submit"]');
        if (submitButtons) {
            form.insertBefore(mediaSection, submitButtons);
        } else {
            form.appendChild(mediaSection);
        }

        return mediaSelector;
    }

    static replaceFileInput(fileInputSelector, options = {}) {
        const fileInput = document.querySelector(fileInputSelector);
        if (!fileInput) {
            console.error('File input not found:', fileInputSelector);
            return;
        }

        const defaultOptions = {
            inputId: fileInput.id + '-media',
            previewId: fileInput.id + '-preview',
            buttonId: fileInput.id + '-btn',
            folder: 'uploads',
            multiple: fileInput.multiple || false,
            ...options
        };

        // Hide original file input
        fileInput.style.display = 'none';

        // Create media selector
        const mediaSelector = new MediaSelector(defaultOptions);

        // Create replacement UI
        const replacementDiv = document.createElement('div');
        replacementDiv.className = 'media-replacement';
        replacementDiv.innerHTML = `
            <div id="${defaultOptions.previewId}" class="mb-4">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500">No image selected</p>
                </div>
            </div>
            
            <div class="flex space-x-4">
                <button type="button" id="${defaultOptions.buttonId}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-images mr-2"></i>Select Image
                </button>
                <button type="button" onclick="mediaSelector.clear()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-trash mr-2"></i>Clear
                </button>
            </div>
        `;

        // Insert replacement after file input
        fileInput.parentNode.insertBefore(replacementDiv, fileInput.nextSibling);

        // Update form submission to include media data
        const form = fileInput.closest('form');
        if (form) {
            form.addEventListener('submit', (e) => {
                const selectedMedia = mediaSelector.getSelectedMedia();
                if (selectedMedia.length > 0) {
                    // Add media data to form
                    const mediaData = selectedMedia.map(media => ({
                        id: media.id,
                        url: media.url,
                        name: media.name
                    }));
                    
                    const mediaInput = document.createElement('input');
                    mediaInput.type = 'hidden';
                    mediaInput.name = fileInput.name + '_media';
                    mediaInput.value = JSON.stringify(mediaData);
                    form.appendChild(mediaInput);
                }
            });
        }

        return mediaSelector;
    }
}

// Global media selector instance (for backward compatibility)
let globalMediaSelector = null;

// Auto-initialize if data attributes are present
document.addEventListener('DOMContentLoaded', function() {
    // Initialize media selectors with data attributes
    document.querySelectorAll('[data-media-selector]').forEach(element => {
        const options = {
            inputId: element.dataset.inputId || 'media-input',
            previewId: element.dataset.previewId || 'media-preview',
            buttonId: element.dataset.buttonId || 'select-media-btn',
            folder: element.dataset.folder || 'uploads',
            multiple: element.dataset.multiple === 'true'
        };
        
        globalMediaSelector = new MediaSelector(options);
    });
});
