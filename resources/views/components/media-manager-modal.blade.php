<!-- Media Manager Popup Modal -->
<div id="media-manager-modal" class="media-manager-modal">
    <div class="media-manager-modal-content">
        <!-- Modal Header -->
        <div class="media-manager-header">
            <div class="flex justify-between items-center">
                <h3 class="media-manager-title">Media Manager</h3>
                <button id="close-media-modal" class="media-manager-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        
        <!-- Tab Navigation -->
        <div class="media-manager-tabs">
            <nav class="media-manager-tab-nav" aria-label="Tabs">
                <button id="upload-tab" class="media-manager-tab-button active">
                    <i class="fas fa-upload mr-2"></i>Upload New Image
                </button>
                <button id="library-tab" class="media-manager-tab-button">
                    <i class="fas fa-images mr-2"></i>Select from Library
                </button>
            </nav>
        </div>
            
        <!-- Tab Content -->
        <!-- Upload Tab Content -->
        <div id="upload-tab-content" class="media-manager-tab-content">
                    <div class="max-w-md mx-auto">
                        <div class="mb-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-2">Upload New Image</h4>
                            <p class="text-sm text-gray-600">Upload a new image to your media library</p>
                        </div>
                        
                        <form id="upload-form" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <div class="media-manager-upload-area" id="upload-drop-zone">
                                    <div class="text-center">
                                        <i class="fas fa-cloud-upload-alt media-manager-upload-icon"></i>
                                        <div class="media-manager-upload-text">
                                            <label for="file-input" class="media-manager-upload-button">
                                                Upload a file
                                                <input id="file-input" name="file" type="file" accept="image/*" required class="sr-only">
                                            </label>
                                            <span class="ml-2">or drag and drop</span>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                    </div>
                                </div>
                                <div id="file-preview" class="mt-4 hidden">
                                    <div class="media-manager-preview">
                                        <img id="preview-image" src="" alt="Preview" class="media-manager-preview-image">
                                        <button type="button" onclick="mediaManagerModal.removePreview()" class="media-manager-preview-remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="media-manager-preview-name" id="preview-name"></div>
                                </div>
                                <div id="upload-progress" class="mt-4 hidden">
                                    <div class="bg-gray-200 rounded-full h-2">
                                        <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                                    </div>
                                    <p id="upload-status" class="text-sm text-gray-600 mt-2 text-center">Uploading...</p>
                                </div>
                            </div>
                            
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" id="cancel-upload" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
        </div>
        
        <!-- Library Tab Content -->
        <div id="library-tab-content" class="media-manager-tab-content hidden">
                <div class="media-manager-search-container">
                    <input type="text" id="library-search" placeholder="Search images..." 
                           class="media-manager-search">
                    <select id="library-folder-filter" class="media-manager-folder-filter">
                        <option value="">All Folders</option>
                    </select>
                </div>
                
                <div id="library-grid" class="media-manager-grid">
                    <!-- Library images will be loaded here -->
                </div>
                
                <!-- Loading indicator -->
                <div id="library-loading" class="media-manager-loading hidden">
                    <div class="media-manager-spinner"></div>
                    <span>Loading images...</span>
                </div>
                
                <!-- Empty state -->
                <div id="library-empty-state" class="media-manager-empty hidden">
                    <div class="media-manager-empty-icon">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="media-manager-empty-text">No images found</div>
                    <div class="media-manager-empty-subtext">Try uploading some images first</div>
                </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="media-manager-footer">
            <button id="close-modal-btn" class="media-manager-button media-manager-button-secondary">
                Close
            </button>
            <button id="select-image-btn" class="media-manager-button media-manager-button-primary" disabled>
                <i class="fas fa-check mr-2"></i>Select Image
            </button>
        </div>
    </div>
</div>


<script>
class MediaManagerModal {
    constructor() {
        this.selectedImage = null;
        this.selectionCallback = null;
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

    open(callback) {
        this.selectionCallback = callback;
        this.selectedImage = null;
        document.getElementById('media-manager-modal').classList.add('show');
        this.switchTab('upload');
        document.getElementById('select-image-btn').disabled = true;
    }

    close() {
        document.getElementById('media-manager-modal').classList.remove('show');
        this.selectedImage = null;
        this.selectionCallback = null;
        document.getElementById('select-image-btn').disabled = true;
        this.resetForm();
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
                    this.selectionCallback(uploadedMedia);
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
                                this.selectionCallback(uploadedMedia);
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
        // Remove previous selection
        document.querySelectorAll('.media-manager-item').forEach(item => {
            item.classList.remove('selected', 'border-blue-500', 'bg-blue-50');
            item.classList.add('border-transparent');
        });
        
        // Add selection to clicked item
        const selectedItem = document.querySelector(`[data-id="${id}"]`);
        selectedItem.classList.remove('border-transparent');
        selectedItem.classList.add('selected', 'border-blue-500', 'bg-blue-50');
        
        this.selectedImage = { id, url, name };
        document.getElementById('select-image-btn').disabled = false;
    }

    confirmSelection() {
        if (this.selectedImage && this.selectionCallback) {
            this.selectionCallback(this.selectedImage);
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
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg ${
            type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
}

// Utility function for debouncing
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

// Initialize media manager modal
const mediaManagerModal = new MediaManagerModal();

// Global function to open media manager (for use in forms)
window.openMediaManager = function(callback) {
    mediaManagerModal.open(callback);
};
</script>
