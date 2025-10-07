@extends('layouts.admin')

@section('title', 'Media Manager')
@section('page-title', 'Media Manager')
@section('page-description', 'Manage your images and media files')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Actions -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Media Manager</h1>
            <p class="text-gray-600">Upload and manage your images</p>
        </div>
        <div class="flex space-x-4">
            <button id="upload-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-upload mr-2"></i>
                Upload New Image
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" id="search-input" placeholder="Search images..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <select id="folder-filter" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Folders</option>
                </select>
            </div>
            <div>
                <button id="refresh-btn" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Media Grid -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div id="media-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <!-- Media items will be loaded here -->
        </div>
        
        <!-- Loading indicator -->
        <div id="loading" class="text-center py-8 hidden">
            <i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i>
            <p class="text-gray-500 mt-2">Loading images...</p>
        </div>
        
        <!-- Empty state -->
        <div id="empty-state" class="text-center py-12 hidden">
            <i class="fas fa-images text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No images found</h3>
            <p class="text-gray-500">Upload your first image to get started</p>
        </div>
        
        <!-- Pagination -->
        <div id="pagination" class="mt-6 flex justify-center hidden">
            <!-- Pagination will be loaded here -->
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div id="upload-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[10000] hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Upload New Image</h3>
                    <button id="close-upload-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="upload-form" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="file-input" class="block text-sm font-medium text-gray-700 mb-2">Select Image</label>
                            <input type="file" id="file-input" name="file" accept="image/*" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="folder-input" class="block text-sm font-medium text-gray-700 mb-2">Folder</label>
                            <select id="folder-input" name="folder" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="uploads">uploads</option>
                                <option value="packages">packages</option>
                                <option value="categories">categories</option>
                                <option value="slider">slider</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="alt-text-input" class="block text-sm font-medium text-gray-700 mb-2">Alt Text</label>
                            <input type="text" id="alt-text-input" name="alt_text" placeholder="Describe the image"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="title-input" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" id="title-input" name="title" placeholder="Image title"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" id="cancel-upload" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Image Details Modal -->
<div id="image-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[10000] hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Image Details</h3>
                    <button id="close-image-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div id="image-details-content">
                    <!-- Image details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Media Selection Modal (for use in forms) -->
<div id="media-selection-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[10000] hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Select Image</h3>
                    <button id="close-selection-modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                <div class="mb-4">
                    <div class="flex gap-4">
                        <input type="text" id="selection-search" placeholder="Search images..." 
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <select id="selection-folder-filter" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Folders</option>
                        </select>
                    </div>
                </div>
                
                <div id="selection-grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <!-- Selection items will be loaded here -->
                </div>
            </div>
            
            <div class="p-6 border-t bg-gray-50">
                <div class="flex justify-end space-x-3">
                    <button id="cancel-selection" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                        Cancel
                    </button>
                    <button id="confirm-selection" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700" disabled>
                        Select Image
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
class MediaManager {
    constructor() {
        this.currentPage = 1;
        this.selectedImage = null;
        this.selectionCallback = null;
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadMedia();
        this.loadFolders();
    }

    bindEvents() {
        // Upload modal
        document.getElementById('upload-btn').addEventListener('click', () => this.openUploadModal());
        document.getElementById('close-upload-modal').addEventListener('click', () => this.closeUploadModal());
        document.getElementById('cancel-upload').addEventListener('click', () => this.closeUploadModal());
        
        // Image modal
        document.getElementById('close-image-modal').addEventListener('click', () => this.closeImageModal());
        
        // Selection modal
        document.getElementById('close-selection-modal').addEventListener('click', () => this.closeSelectionModal());
        document.getElementById('cancel-selection').addEventListener('click', () => this.closeSelectionModal());
        document.getElementById('confirm-selection').addEventListener('click', () => this.confirmSelection());
        
        // Search and filters
        document.getElementById('search-input').addEventListener('input', debounce(() => this.loadMedia(), 300));
        document.getElementById('folder-filter').addEventListener('change', () => this.loadMedia());
        document.getElementById('refresh-btn').addEventListener('click', () => this.loadMedia());
        
        // Selection search and filters
        document.getElementById('selection-search').addEventListener('input', debounce(() => this.loadSelectionMedia(), 300));
        document.getElementById('selection-folder-filter').addEventListener('change', () => this.loadSelectionMedia());
        
        // Upload form
        document.getElementById('upload-form').addEventListener('submit', (e) => this.handleUpload(e));
        
        // Close modals on backdrop click
        document.getElementById('upload-modal').addEventListener('click', (e) => {
            if (e.target.id === 'upload-modal') this.closeUploadModal();
        });
        document.getElementById('image-modal').addEventListener('click', (e) => {
            if (e.target.id === 'image-modal') this.closeImageModal();
        });
        document.getElementById('media-selection-modal').addEventListener('click', (e) => {
            if (e.target.id === 'media-selection-modal') this.closeSelectionModal();
        });
    }

    async loadMedia() {
        const search = document.getElementById('search-input').value;
        const folder = document.getElementById('folder-filter').value;
        
        this.showLoading();
        
        try {
            const params = new URLSearchParams({
                page: this.currentPage,
                ...(search && { search }),
                ...(folder && { folder })
            });
            
            const response = await fetch(`/admin/media?${params}`);
            const data = await response.json();
            
            this.renderMedia(data.media);
            this.renderPagination(data.pagination);
        } catch (error) {
            console.error('Error loading media:', error);
            this.showError('Failed to load images');
        }
    }

    async loadSelectionMedia() {
        const search = document.getElementById('selection-search').value;
        const folder = document.getElementById('selection-folder-filter').value;
        
        try {
            const params = new URLSearchParams({
                ...(search && { search }),
                ...(folder && { folder })
            });
            
            const response = await fetch(`/admin/media/selection?${params}`);
            const data = await response.json();
            
            this.renderSelectionGrid(data.media);
        } catch (error) {
            console.error('Error loading selection media:', error);
        }
    }

    async loadFolders() {
        try {
            const response = await fetch('/admin/media/folders');
            const data = await response.json();
            
            this.populateFolderSelects(data.folders);
        } catch (error) {
            console.error('Error loading folders:', error);
        }
    }

    populateFolderSelects(folders) {
        const selects = ['folder-filter', 'selection-folder-filter'];
        
        selects.forEach(selectId => {
            const select = document.getElementById(selectId);
            const currentValue = select.value;
            
            // Clear existing options except "All Folders"
            select.innerHTML = '<option value="">All Folders</option>';
            
            folders.forEach(folder => {
                const option = document.createElement('option');
                option.value = folder;
                option.textContent = folder;
                select.appendChild(option);
            });
            
            // Restore previous selection
            select.value = currentValue;
        });
    }

    renderMedia(media) {
        const grid = document.getElementById('media-grid');
        
        if (media.length === 0) {
            this.showEmptyState();
            return;
        }
        
        grid.innerHTML = media.map(item => `
            <div class="relative group cursor-pointer" data-id="${item.id}">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                    <img src="${item.url}" alt="${item.alt_text || item.original_name}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                </div>
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 rounded-lg flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex space-x-2">
                        <button onclick="mediaManager.viewImage(${item.id})" class="bg-white text-gray-800 px-3 py-1 rounded text-sm hover:bg-gray-100">
                            <i class="fas fa-eye mr-1"></i> View
                        </button>
                        <button onclick="mediaManager.deleteImage(${item.id})" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="text-sm font-medium text-gray-900 truncate">${item.original_name}</p>
                    <p class="text-xs text-gray-500">${this.formatFileSize(item.size)}</p>
                </div>
            </div>
        `).join('');
        
        this.hideLoading();
        this.hideEmptyState();
    }

    renderSelectionGrid(media) {
        const grid = document.getElementById('selection-grid');
        
        grid.innerHTML = media.map(item => `
            <div class="relative group cursor-pointer border-2 border-transparent hover:border-blue-500 rounded-lg overflow-hidden" 
                 data-id="${item.id}" onclick="mediaManager.selectImage(${item.id}, '${item.url}', '${item.original_name}')">
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
    }

    renderPagination(pagination) {
        const container = document.getElementById('pagination');
        
        if (pagination.last_page <= 1) {
            container.classList.add('hidden');
            return;
        }
        
        container.classList.remove('hidden');
        
        let html = '<nav class="flex items-center space-x-2">';
        
        // Previous button
        if (pagination.current_page > 1) {
            html += `<button onclick="mediaManager.goToPage(${pagination.current_page - 1})" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</button>`;
        }
        
        // Page numbers
        for (let i = 1; i <= pagination.last_page; i++) {
            if (i === pagination.current_page) {
                html += `<span class="px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md">${i}</span>`;
            } else {
                html += `<button onclick="mediaManager.goToPage(${i})" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">${i}</button>`;
            }
        }
        
        // Next button
        if (pagination.current_page < pagination.last_page) {
            html += `<button onclick="mediaManager.goToPage(${pagination.current_page + 1})" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</button>`;
        }
        
        html += '</nav>';
        container.innerHTML = html;
    }

    async handleUpload(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        submitBtn.textContent = 'Uploading...';
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
                this.closeUploadModal();
                this.loadMedia();
                this.showSuccess('Image uploaded successfully!');
                e.target.reset();
            } else {
                this.showError('Upload failed: ' + (data.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Upload error:', error);
            this.showError('Upload failed. Please try again.');
        } finally {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    }

    async viewImage(id) {
        try {
            const response = await fetch(`/admin/media/${id}`);
            const data = await response.json();
            
            const content = document.getElementById('image-details-content');
            content.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <img src="${data.url}" alt="${data.alt_text || data.original_name}" class="w-full rounded-lg">
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Filename</label>
                            <p class="text-sm text-gray-900">${data.original_name}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Size</label>
                            <p class="text-sm text-gray-900">${this.formatFileSize(data.size)}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Folder</label>
                            <p class="text-sm text-gray-900">${data.folder}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Uploaded</label>
                            <p class="text-sm text-gray-900">${new Date(data.created_at).toLocaleDateString()}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">URL</label>
                            <div class="flex">
                                <input type="text" value="${data.url}" readonly class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md text-sm">
                                <button onclick="navigator.clipboard.writeText('${data.url}')" class="px-3 py-2 bg-gray-500 text-white rounded-r-md hover:bg-gray-600">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('image-modal').classList.remove('hidden');
        } catch (error) {
            console.error('Error loading image details:', error);
            this.showError('Failed to load image details');
        }
    }

    async deleteImage(id) {
        if (!confirm('Are you sure you want to delete this image? This action cannot be undone.')) {
            return;
        }
        
        try {
            const response = await fetch(`/admin/media/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.loadMedia();
                this.showSuccess('Image deleted successfully!');
            } else {
                this.showError('Delete failed: ' + (data.message || 'Unknown error'));
            }
        } catch (error) {
            console.error('Delete error:', error);
            this.showError('Delete failed. Please try again.');
        }
    }

    openUploadModal() {
        document.getElementById('upload-modal').classList.remove('hidden');
    }

    closeUploadModal() {
        document.getElementById('upload-modal').classList.add('hidden');
    }

    closeImageModal() {
        document.getElementById('image-modal').classList.add('hidden');
    }

    openSelectionModal(callback) {
        this.selectionCallback = callback;
        this.loadSelectionMedia();
        this.loadFolders();
        document.getElementById('media-selection-modal').classList.remove('hidden');
    }

    closeSelectionModal() {
        document.getElementById('media-selection-modal').classList.add('hidden');
        this.selectedImage = null;
        this.selectionCallback = null;
        document.getElementById('confirm-selection').disabled = true;
    }

    selectImage(id, url, name) {
        // Remove previous selection
        document.querySelectorAll('#selection-grid > div').forEach(item => {
            item.classList.remove('border-blue-500', 'bg-blue-50');
            item.classList.add('border-transparent');
        });
        
        // Add selection to clicked item
        const selectedItem = document.querySelector(`#selection-grid [data-id="${id}"]`);
        selectedItem.classList.remove('border-transparent');
        selectedItem.classList.add('border-blue-500', 'bg-blue-50');
        
        this.selectedImage = { id, url, name };
        document.getElementById('confirm-selection').disabled = false;
    }

    confirmSelection() {
        if (this.selectedImage && this.selectionCallback) {
            this.selectionCallback(this.selectedImage);
            this.closeSelectionModal();
        }
    }

    goToPage(page) {
        this.currentPage = page;
        this.loadMedia();
    }

    showLoading() {
        document.getElementById('loading').classList.remove('hidden');
        document.getElementById('media-grid').classList.add('hidden');
        document.getElementById('empty-state').classList.add('hidden');
    }

    hideLoading() {
        document.getElementById('loading').classList.add('hidden');
        document.getElementById('media-grid').classList.remove('hidden');
    }

    showEmptyState() {
        document.getElementById('empty-state').classList.remove('hidden');
        document.getElementById('media-grid').classList.add('hidden');
        document.getElementById('loading').classList.add('hidden');
    }

    hideEmptyState() {
        document.getElementById('empty-state').classList.add('hidden');
    }

    showSuccess(message) {
        this.showNotification(message, 'success');
    }

    showError(message) {
        this.showNotification(message, 'error');
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

    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
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

// Initialize media manager
const mediaManager = new MediaManager();

// Global function to open media selection (for use in forms)
window.openMediaSelection = function(callback) {
    mediaManager.openSelectionModal(callback);
};
</script>
@endsection
