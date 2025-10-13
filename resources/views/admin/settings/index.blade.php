@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
                    <p class="mt-2 text-gray-600">Manage your application settings</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.settings.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Add Setting
                    </a>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($groups->count() > 0)
            <!-- Tab Navigation -->
            <div class="bg-white rounded-t-2xl shadow-lg">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                        @foreach($groups as $index => $group)
                            <button type="button" 
                                    onclick="switchTab('{{ $group }}')"
                                    class="tab-button py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 {{ $index === 0 ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                                    id="tab-{{ $group }}">
                                <i class="fas fa-{{ $group === 'general' ? 'cog' : ($group === 'contact' ? 'address-book' : ($group === 'social' ? 'share-alt' : ($group === 'seo' ? 'search' : ($group === 'email' ? 'envelope' : ($group === 'payment' ? 'credit-card' : 'cog'))))) }} mr-2"></i>
                                {{ ucfirst(str_replace('_', ' ', $group)) }}
                            </button>
                        @endforeach
                    </nav>
                </div>
            </div>

            <!-- Settings Form -->
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tab Content -->
                @foreach($groups as $index => $group)
                    <div class="tab-content bg-white rounded-b-2xl shadow-lg p-8 {{ $index === 0 ? '' : 'hidden' }}" id="content-{{ $group }}">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold text-gray-900 capitalize">{{ str_replace('_', ' ', $group) }} Settings</h2>
                            <p class="text-gray-600 text-sm mt-1">Manage your {{ str_replace('_', ' ', $group) }} configuration</p>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            @forelse($settings[$group] as $setting)
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <label for="settings[{{ $setting->key }}]" class="block text-sm font-semibold text-gray-700">
                                            {{ $setting->label }}
                                            @if($setting->description)
                                                <span class="text-gray-500 font-normal">({{ $setting->description }})</span>
                                            @endif
                                        </label>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.settings.edit', $setting) }}" 
                                               class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.settings.destroy', $setting) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 text-sm"
                                                        onclick="return confirm('Are you sure you want to delete this setting?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    @if($setting->type === 'textarea')
                                        <textarea name="settings[{{ $setting->key }}]" 
                                                  id="settings[{{ $setting->key }}]"
                                                  rows="3"
                                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                  placeholder="Enter {{ strtolower($setting->label) }}">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                                    @elseif($setting->type === 'boolean')
                                        <div class="flex items-center">
                                            <input type="checkbox" 
                                                   name="settings[{{ $setting->key }}]" 
                                                   id="settings[{{ $setting->key }}]"
                                                   value="1"
                                                   {{ old('settings.'.$setting->key, $setting->value) ? 'checked' : '' }}
                                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="settings[{{ $setting->key }}]" class="ml-3 text-sm text-gray-700">
                                                Enable {{ $setting->label }}
                                            </label>
                                        </div>
                                    @elseif($setting->type === 'number')
                                        <input type="number" 
                                               name="settings[{{ $setting->key }}]" 
                                               id="settings[{{ $setting->key }}]"
                                               value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Enter {{ strtolower($setting->label) }}">
                                    @elseif($setting->type === 'image')
                                        <div class="space-y-3">
                                            <input type="text" 
                                                   name="settings[{{ $setting->key }}]" 
                                                   id="settings[{{ $setting->key }}]"
                                                   value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="Enter image URL or path">
                                            @if($setting->value)
                                                <div class="mt-2">
                                                    <img src="{{ $setting->value }}" alt="{{ $setting->label }}" class="h-20 w-20 object-cover rounded-lg">
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <input type="text" 
                                               name="settings[{{ $setting->key }}]" 
                                               id="settings[{{ $setting->key }}]"
                                               value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Enter {{ strtolower($setting->label) }}">
                                    @endif
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-8 text-gray-500">
                                    <i class="fas fa-cog text-4xl mb-4"></i>
                                    <p>No settings found in this group.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach

                <!-- Save Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Save All Settings
                    </button>
                </div>
            </form>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <i class="fas fa-cog text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Settings Found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first setting.</p>
                <a href="{{ route('admin.settings.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Add First Setting
                </a>
            </div>
        @endif
    </div>
</div>

<script>
function switchTab(group) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active state from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById('content-' + group).classList.remove('hidden');
    
    // Add active state to selected tab button
    const activeButton = document.getElementById('tab-' + group);
    activeButton.classList.remove('border-transparent', 'text-gray-500');
    activeButton.classList.add('border-blue-500', 'text-blue-600');
}
</script>
@endsection
