/**
 * Media Manager Modal Class
 * Handles single and multiple image selection with upload functionality
 */
class MediaManagerModal {
    constructor() {
        this.selectedImages = [];
        this.selectionCallback = null;
        this.multipleMode = false;
        this.maxSelections = 1;
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadFolders();
        this.testConnection();
    }

    async testConnection() {
        try {
            console.log('Testing connection...');
            const response = await fetch('/admin/media', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (response.ok) {
                console.log('Media manager connection successful');
            } else {
                console.error('Test connection failed:', response.status);
            }
        } catch (error) {
            console.error('Test connection error:', error);
        }
    }

    bindEvents() {
        // Modal controls
        document.getElementById('close-media-modal').addEventListener('click', () => this.close());
        document.getElementById('close-modal-btn').addEventListener('click', () => this.close());
        document.getElementById('cancel-upload').addEventListener('click', () => this.close());
        
        // Tab switching
        document.getElementById('upload-tab').addEventListener('click', () => this.switchTab('upload'));
        document.getElementById('library-tab').addEventListener('click', () => this.switchTab('library'));
        
        // Upload form
        document.getElementById('file-input').addEventListener('change', (e) => this.handleFileSelection(e));
        
        // Library search and filter
        document.getElementById('library-search').addEventListener('input', debounce(() => this.loadLibraryImages(), 300));
        document.getElementById('library-folder-filter').addEventListener('change', () => this.loadLibraryImages());
        
        // Selection
        document.getElementById('select-image-btn').addEventListener('click', () => this.confirmSelection());
        
        // Close on backdrop click
        document.getElementById('media-manager-modal').addEventListener('click', (e) => {
            if (e.target.id === 'media-manager-modal') this.close();
        });
    }

    open(callback, options = {}) {
        this.selectionCallback = callback;
        this.selectedImages = [];
        this.multipleMode = options.multiple || false;
        this.maxSelections = options.maxSelections || (this.multipleMode ? 10 : 1);
        
        // Update UI based on mode
        this.updateModeUI();
        
        document.getElementById('media-manager-modal').classList.add('show');
        this.switchTab('upload');
        this.updateSelectButton();
    }

    close() {
        document.getElementById('media-manager-modal').classList.remove('show');
        this.selectedImages = [];
        this.selectionCallback = null;
        this.multipleMode = false;
        this.maxSelections = 1;
        this.updateSelectButton();
        this.resetForm();
    }

    updateModeUI() {
        const modalTitle = document.querySelector('.media-manager-title');
        const selectButton = document.getElementById('select-image-btn');
        
        if (this.multipleMode) {
            modalTitle.textContent = 'Media Manager - Select Multiple Images';
            selectButton.innerHTML = '<i class="fas fa-check mr-2"></i>Select Images';
        } else {
            modalTitle.textContent = 'Media Manager';
            selectButton.innerHTML = '<i class="fas fa-check mr-2"></i>Select Image';
        }
    }

    updateSelectButton() {
        const selectButton = document.getElementById('select-image-btn');
        const hasSelection = this.selectedImages.length > 0;
        
        if (this.multipleMode) {
            selectButton.disabled = !hasSelection;
            if (hasSelection) {
                selectButton.innerHTML = `<i class="fas fa-check mr-2"></i>Select Images (${this.selectedImages.length})`;
            } else {
                selectButton.innerHTML = '<i class="fas fa-check mr-2"></i>Select Images';
            }
        } else {
            selectButton.disabled = !hasSelection;
        }
    }

    switchTab(tab) {
        // Update tab buttons
        document.querySelectorAll('.media-manager-tab-button').forEach(btn => {
            btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        
        const activeTab = document.getElementById(`${tab}-tab`);
        if (activeTab) {
            activeTab.classList.add('active', 'border-blue-500', 'text-blue-600');
            activeTab.classList.remove('border-transparent', 'text-gray-500');
        }
        
        // Update tab content
        document.querySelectorAll('.media-manager-tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        const activeContent = document.getElementById(`${tab}-tab-content`);
        if (activeContent) {
            activeContent.classList.remove('hidden');
        }
        
        // Load library images if switching to library tab
        if (tab === 'library') {
            this.loadLibraryImages();
        }
    }

    async handleUpload(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        
        // Add default values
        formData.append('folder', 'uploads');
        formData.append('alt_text', '');
        formData.append('title', '');
        
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('/admin/media', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showNotification('Image uploaded successfully!', 'success');
                this.resetForm();
                
                // Auto-select the uploaded image and close modal
                if (this.selectionCallback && data.media) {
                    const uploadedMedia = {
                        id: data.media.id,
                        url: data.media.url,
                        name: data.media.original_name
                    };
                    
                    if (this.multipleMode) {
                        this.selectedImages.push(uploadedMedia);
                        this.selectionCallback(this.selectedImages);
                    } else {
                        this.selectedImages = [uploadedMedia];
                        this.selectionCallback(uploadedMedia);
                    }
                    this.close();
                } else {
                    // Switch to library tab to show the uploaded image
                    this.switchTab('library');
                    this.loadLibraryImages();
                }
            } else {
                this.showNotification('Upload failed: ' + (data.message || 'Unknown error'), 'error');
            }
        } catch (error) {
            console.error('Upload error:', error);
            this.showNotification('Upload failed. Please try again.', 'error');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    async handleFileSelection(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('file-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);

        // Show upload progress
        document.getElementById('upload-progress').classList.remove('hidden');
        document.getElementById('progress-bar').style.width = '0%';
        document.getElementById('upload-status').textContent = 'Uploading...';

        // Start upload
        await this.uploadFile(file);
    }

    async uploadFile(file) {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('folder', 'uploads');
        formData.append('alt_text', '');
        formData.append('title', '');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        try {
            const xhr = new XMLHttpRequest();
            
            // Track upload progress
            xhr.upload.addEventListener('progress', (e) => {
                if (e.lengthComputable) {
                    const percentComplete = (e.loaded / e.total) * 100;
                    document.getElementById('progress-bar').style.width = percentComplete + '%';
                    document.getElementById('upload-status').textContent = `Uploading... ${Math.round(percentComplete)}%`;
                }
            });

            xhr.onload = () => {
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    
                    if (data.success) {
                        document.getElementById('upload-status').textContent = 'Upload complete!';
                        document.getElementById('progress-bar').style.width = '100%';
                        
                        // Auto-select the uploaded image and close modal
                        setTimeout(() => {
                            if (this.selectionCallback && data.media) {
                                const uploadedMedia = {
                                    id: data.media.id,
                                    url: data.media.url,
                                    name: data.media.original_name
                                };
                                
                                if (this.multipleMode) {
                                    this.selectedImages.push(uploadedMedia);
                                    this.selectionCallback(this.selectedImages);
                                } else {
                                    this.selectedImages = [uploadedMedia];
                                    this.selectionCallback(uploadedMedia);
                                }
                                this.close();
                            }
                        }, 500);
                    } else {
                        this.showUploadError(data.message || 'Upload failed');
                    }
                } else {
                    this.showUploadError('Upload failed');
                }
            };

            xhr.onerror = () => {
                this.showUploadError('Upload failed');
            };

            xhr.open('POST', '/admin/media');
            xhr.send(formData);

        } catch (error) {
            console.error('Upload error:', error);
            this.showUploadError('Upload failed');
        }
    }

    showUploadError(message) {
        document.getElementById('upload-status').textContent = message;
        document.getElementById('upload-status').classList.add('text-red-500');
        document.getElementById('progress-bar').classList.add('bg-red-500');
        document.getElementById('progress-bar').classList.remove('bg-blue-600');
    }

    async loadLibraryImages() {
        const search = document.getElementById('library-search').value;
        const folder = document.getElementById('library-folder-filter').value;
        
        this.showLibraryLoading();
        
        try {
            const params = new URLSearchParams();
            if (search) params.append('search', search);
            if (folder) params.append('folder', folder);
            
            const url = `/admin/media/selection${params.toString() ? '?' + params.toString() : ''}`;
            console.log('Fetching URL:', url);
            
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin',
                cache: 'no-cache'
            });
            
            console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Response data:', data);
            
            if (data.success && data.media) {
                this.renderLibraryGrid(data.media);
            } else {
                this.showLibraryError(data.message || 'Invalid response format');
            }
        } catch (error) {
            console.error('Error loading library images:', error);
            this.showLibraryError(`Failed to load images: ${error.message}`);
        }
    }

    renderLibraryGrid(media) {
        const grid = document.getElementById('library-grid');
        
        if (media.length === 0) {
            this.showLibraryEmptyState();
            return;
        }
        
        grid.innerHTML = media.map(item => `
            <div class="media-manager-item relative group border-2 border-transparent hover:border-blue-300 rounded-lg overflow-hidden" 
                 data-id="${item.id}" onclick="mediaManagerModal.selectImage(${item.id}, '${item.url}', '${item.original_name}')">
                <div class="aspect-square bg-gray-100">
                    <img src="${item.url}" alt="${item.alt_text || item.original_name}" 
                         class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                </div>
                <div class="p-2 bg-white">
                    <p class="text-xs font-medium text-gray-900 truncate">${item.original_name}</p>
                </div>
            </div>
        `).join('');
        
        this.hideLibraryLoading();
        this.hideLibraryEmptyState();
    }

    selectImage(id, url, name) {
        const selectedItem = document.querySelector(`[data-id="${id}"]`);
        const imageData = { id, url, name };
        
        if (this.multipleMode) {
            // Multiple selection mode
            const existingIndex = this.selectedImages.findIndex(img => img.id === id);
            
            if (existingIndex > -1) {
                // Deselect if already selected
                this.selectedImages.splice(existingIndex, 1);
                selectedItem.classList.remove('selected', 'border-blue-500', 'bg-blue-50');
                selectedItem.classList.add('border-transparent');
            } else {
                // Select if not at max limit
                if (this.selectedImages.length < this.maxSelections) {
                    this.selectedImages.push(imageData);
                    selectedItem.classList.remove('border-transparent');
                    selectedItem.classList.add('selected', 'border-blue-500', 'bg-blue-50');
                } else {
                    // Show limit reached message
                    this.showNotification(`Maximum ${this.maxSelections} images can be selected`, 'warning');
                    return;
                }
            }
        } else {
            // Single selection mode
            // Remove previous selection
            document.querySelectorAll('.media-manager-item').forEach(item => {
                item.classList.remove('selected', 'border-blue-500', 'bg-blue-50');
                item.classList.add('border-transparent');
            });
            
            // Add selection to clicked item
            selectedItem.classList.remove('border-transparent');
            selectedItem.classList.add('selected', 'border-blue-500', 'bg-blue-50');
            
            this.selectedImages = [imageData];
        }
        
        this.updateSelectButton();
    }

    confirmSelection() {
        if (this.selectedImages.length > 0 && this.selectionCallback) {
            if (this.multipleMode) {
                this.selectionCallback(this.selectedImages);
            } else {
                this.selectionCallback(this.selectedImages[0]);
            }
            this.close();
        }
    }

    async loadFolders() {
        try {
            const response = await fetch('/admin/media/folders', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin',
                cache: 'no-cache'
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            const select = document.getElementById('library-folder-filter');
            select.innerHTML = '<option value="">All Folders</option>';
            
            if (data.folders) {
                data.folders.forEach(folder => {
                    const option = document.createElement('option');
                    option.value = folder;
                    option.textContent = folder;
                    select.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error loading folders:', error);
        }
    }

    resetForm() {
        document.getElementById('upload-form').reset();
        document.getElementById('file-preview').classList.add('hidden');
        document.getElementById('upload-progress').classList.add('hidden');
        document.getElementById('progress-bar').style.width = '0%';
        document.getElementById('progress-bar').classList.remove('bg-red-500');
        document.getElementById('progress-bar').classList.add('bg-blue-600');
        document.getElementById('upload-status').textContent = 'Uploading...';
        document.getElementById('upload-status').classList.remove('text-red-500');
    }

    showLibraryLoading() {
        document.getElementById('library-loading').classList.remove('hidden');
        document.getElementById('library-grid').classList.add('hidden');
        document.getElementById('library-empty-state').classList.add('hidden');
    }

    hideLibraryLoading() {
        document.getElementById('library-loading').classList.add('hidden');
        document.getElementById('library-grid').classList.remove('hidden');
    }

    showLibraryEmptyState() {
        document.getElementById('library-empty-state').classList.remove('hidden');
        document.getElementById('library-grid').classList.add('hidden');
        document.getElementById('library-loading').classList.add('hidden');
    }

    hideLibraryEmptyState() {
        document.getElementById('library-empty-state').classList.add('hidden');
    }

    showLibraryError(message) {
        this.hideLibraryLoading();
        this.hideLibraryEmptyState();
        document.getElementById('library-grid').innerHTML = `
            <div class="col-span-full text-center py-8">
                <i class="fas fa-exclamation-triangle text-2xl text-red-400 mb-2"></i>
                <p class="text-red-500">${message}</p>
            </div>
        `;
    }

    showNotification(message, type) {
        const notification = document.createElement('div');
        let bgColor = 'bg-blue-500';
        if (type === 'success') bgColor = 'bg-green-500';
        else if (type === 'error') bgColor = 'bg-red-500';
        else if (type === 'warning') bgColor = 'bg-yellow-500';
        
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white ${bgColor}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
}

/**
 * Utility function for debouncing
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in milliseconds
 * @returns {Function} Debounced function
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Initialize media manager modal when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize media manager modal
    window.mediaManagerModal = new MediaManagerModal();

    // Global function to open media manager (for use in forms)
    window.openMediaManager = function(callback, options = {}) {
        window.mediaManagerModal.open(callback, options);
    };

    // Auto-initialize all media manager elements
    initializeMediaManagerElements();
});

function initializeMediaManagerElements() {
    // Find all elements with data-media-manager attribute
    document.querySelectorAll('[data-media-manager]').forEach(element => {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            
            const inputId = this.dataset.inputId;
            const previewId = this.dataset.previewId;
            const multiple = this.dataset.multiple === 'true';
            const maxSelections = parseInt(this.dataset.maxSelections) || (multiple ? 10 : 1);
            
            window.openMediaManager(function(result) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                
                if (multiple) {
                    // Multiple images
                    input.innerHTML = result.map(img => 
                        `<input type="hidden" name="${input.dataset.name || 'images[]'}" value="${img.id}">`
                    ).join('');
                    preview.innerHTML = result.map(img => 
                        `<div class="relative">
                            <img src="${img.url}" alt="${img.name}" class="w-full h-32 object-cover rounded-lg" data-id="${img.id}">
                            <button type="button" onclick="removeGalleryImage(this)" 
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>`
                    ).join('');
                } else {
                    // Single image
                    input.value = result.id;
                    preview.innerHTML = `
                        <div class="relative w-48 h-32">
                            <img src="${result.url}" alt="${result.name}" class="w-full h-full object-cover rounded-lg">
                            <button type="button" onclick="removeSingleImage()" 
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">${result.name}</p>
                    `;
                }
            }, {
                multiple: multiple,
                maxSelections: maxSelections
            });
        });
    });
}

// Helper functions for removing images
window.removeSingleImage = function() {
    const preview = document.getElementById('single-image-preview');
    const input = document.getElementById('single-image-input');
    
    if (preview && input) {
        input.value = '';
        preview.innerHTML = `
            <div class="w-48 h-32 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center">
                <span class="text-gray-500">No image selected</span>
            </div>
        `;
    }
};

window.removeGalleryImage = function(button) {
    const imageContainer = button.closest('.relative');
    if (imageContainer) {
        imageContainer.remove();
        // Update hidden inputs
        updateGalleryHiddenInputs();
    }
};

function updateGalleryHiddenInputs() {
    const preview = document.getElementById('gallery-images-preview');
    const container = document.getElementById('gallery-images-input');
    
    if (preview && container) {
        const images = preview.querySelectorAll('img');
        container.innerHTML = Array.from(images).map(img => 
            `<input type="hidden" name="gallery_images[]" value="${img.dataset.id || ''}">`
        ).join('');
    }
}
