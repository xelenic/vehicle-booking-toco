@extends('layouts.admin')

@section('title', 'User Details - Admin Panel')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 playfair">User Details</h1>
            <p class="text-gray-600 mt-2">View user information, roles, and permissions</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                <i class="fas fa-edit mr-2"></i>
                Edit User
            </a>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Users
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                        <p class="text-lg text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                        <p class="text-lg text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Account Status</label>
                        @if($user->email_verified_at)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-2"></i>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-2"></i>
                                Pending Verification
                            </span>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Member Since</label>
                        <p class="text-lg text-gray-900">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Roles -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Roles</h3>
                @if($user->roles->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->roles as $role)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $role->name === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                @if($role->name === 'admin')
                                    <i class="fas fa-crown mr-2"></i>
                                @else
                                    <i class="fas fa-user mr-2"></i>
                                @endif
                                {{ ucfirst($role->name) }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No roles assigned</p>
                @endif
            </div>

            <!-- Permissions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Permissions</h3>
                @if($user->permissions->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        @foreach($user->permissions as $permission)
                            <div class="flex items-center p-2 bg-gray-50 rounded-lg">
                                <i class="fas fa-key text-blue-500 mr-2"></i>
                                <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">No additional permissions assigned</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- User Avatar -->
            <div class="bg-white rounded-xl shadow-lg p-6 text-center">
                <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-white text-3xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <h4 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h4>
                <p class="text-gray-600">{{ $user->email }}</p>
                @if($user->hasRole('admin'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 mt-2">
                        <i class="fas fa-crown mr-1"></i>
                        Administrator
                    </span>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h4>
                <div class="space-y-3">
                    <a href="{{ route('admin.users.edit', $user) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-edit mr-2"></i>
                        Edit User
                    </a>
                    
                    @if(!$user->hasRole('admin'))
                        <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full {{ $user->email_verified_at ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                                <i class="fas {{ $user->email_verified_at ? 'fa-user-slash' : 'fa-user-check' }} mr-2"></i>
                                {{ $user->email_verified_at ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-trash mr-2"></i>
                                Delete User
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Account Statistics -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">Account Statistics</h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Account Created</span>
                        <span class="font-medium">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Last Updated</span>
                        <span class="font-medium">{{ $user->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Roles Count</span>
                        <span class="font-medium">{{ $user->roles->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Permissions Count</span>
                        <span class="font-medium">{{ $user->permissions->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
