
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-black via-purple-900 to-black py-8">
    <div class="max-w-3xl mx-auto">
        <!-- Profile Info with PFP beside name/email -->
        <div class="flex items-center gap-8 pb-4">
            @if(Auth::user()->avatar_url)
                <img src="{{ asset(str_starts_with(Auth::user()->avatar_url, '/storage/') ? Auth::user()->avatar_url : 'storage/' . Auth::user()->avatar_url) }}" class="w-24 h-24 rounded-full border-4 border-purple-500 shadow-lg object-cover bg-black" alt="Profile Picture">
            @else
                <div class="w-24 h-24 rounded-full flex items-center justify-center bg-purple-900 border-4 border-purple-500 shadow-lg text-white text-3xl font-bold">
                    {{ Auth::user()->initials() }}
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold text-white">{{ Auth::user()->name }}</h1>
                <p class="text-purple-300">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <!-- Tabs -->
        <div class="mt-8">
            <div class="flex space-x-4 border-b border-purple-800 mb-6">
                <button class="tab-btn px-4 py-2 text-white font-semibold border-b-2 border-purple-500" onclick="showTab('posts')">Posts</button>
                <button class="tab-btn px-4 py-2 text-white font-semibold" onclick="showTab('pictures')">Pictures</button>
            </div>
            <div id="tab-posts">
                @livewire('profile.posts', ['user' => Auth::user()])
            </div>
            <div id="tab-pictures" class="hidden">
                @livewire('profile.pictures', ['user' => Auth::user()])
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal removed for now -->
</div>
<script>
    function showTab(tab) {
        document.getElementById('tab-posts').classList.add('hidden');
        document.getElementById('tab-pictures').classList.add('hidden');
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('border-b-2', 'border-purple-500'));
        if(tab === 'posts') {
            document.getElementById('tab-posts').classList.remove('hidden');
            document.querySelectorAll('.tab-btn')[0].classList.add('border-b-2', 'border-purple-500');
        } else {
            document.getElementById('tab-pictures').classList.remove('hidden');
            document.querySelectorAll('.tab-btn')[1].classList.add('border-b-2', 'border-purple-500');
        }
    }
</script>
@endsection
