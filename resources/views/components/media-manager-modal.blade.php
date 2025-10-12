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


