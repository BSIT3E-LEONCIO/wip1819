<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen w-full bg-gradient-to-br from-purple-900 via-pink-900 to-rose-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Cute Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full mb-4 shadow-lg p-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-pink-300 to-purple-300 bg-clip-text text-transparent mb-2">
                Join Our Magic! ✨
            </h1>
            <p class="text-pink-200/80 text-sm">Create your enchanted account</p>
        </div>

        <!-- Registration Card -->
        <div class="bg-gray-900/70 backdrop-blur-xl border border-pink-500/20 rounded-3xl p-8 shadow-2xl">
            <form wire:submit="register" class="space-y-6">
                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-pink-200">
                        👤 {{ __('Full Name') }}
                    </label>
                    <div class="relative">
                        <input wire:model="name" 
                               id="name" 
                               type="text" 
                               name="name" 
                               required 
                               autofocus 
                               autocomplete="name"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-pink-400/30 rounded-2xl text-pink-100 placeholder-pink-300/50 focus:border-pink-400 focus:ring-2 focus:ring-pink-400/20 focus:outline-none transition-all duration-300"
                               placeholder="Your beautiful name..." />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <span class="text-pink-400">🌟</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-rose-400" />
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-pink-200">
                        ✉️ {{ __('Email Address') }}
                    </label>
                    <div class="relative">
                        <input wire:model="email" 
                               id="email" 
                               type="email" 
                               name="email" 
                               required 
                               autocomplete="username"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-pink-400/30 rounded-2xl text-pink-100 placeholder-pink-300/50 focus:border-pink-400 focus:ring-2 focus:ring-pink-400/20 focus:outline-none transition-all duration-300"
                               placeholder="Your magical email..." />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <span class="text-pink-400">💕</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-400" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-pink-200">
                        🔒 {{ __('Password') }}
                    </label>
                    <div class="relative">
                        <input wire:model="password" 
                               id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-pink-400/30 rounded-2xl text-pink-100 placeholder-pink-300/50 focus:border-pink-400 focus:ring-2 focus:ring-pink-400/20 focus:outline-none transition-all duration-300"
                               placeholder="Create a secret password..." />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <span class="text-pink-400">🌸</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-400" />
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-pink-200">
                        🔐 {{ __('Confirm Password') }}
                    </label>
                    <div class="relative">
                        <input wire:model="password_confirmation" 
                               id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-pink-400/30 rounded-2xl text-pink-100 placeholder-pink-300/50 focus:border-pink-400 focus:ring-2 focus:ring-pink-400/20 focus:outline-none transition-all duration-300"
                               placeholder="Confirm your password..." />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <span class="text-pink-400">🦄</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-rose-400" />
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4 pt-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center space-x-2">
                        <span>{{ __('Create Account') }}</span>
                        <span>✨</span>
                    </button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" 
                           wire:navigate
                           class="text-sm text-pink-300 hover:text-pink-200 transition-colors duration-300 flex items-center justify-center space-x-1">
                            <span>{{ __('Already have an account?') }}</span>
                            <span>🔮</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer Decoration -->
        <div class="text-center mt-8">
            <div class="flex justify-center space-x-2 text-2xl mb-4">
                <span class="animate-bounce">🌙</span>
                <span class="animate-bounce" style="animation-delay: 0.1s">⭐</span>
                <span class="animate-bounce" style="animation-delay: 0.2s">🦄</span>
                <span class="animate-bounce" style="animation-delay: 0.3s">💖</span>
            </div>
            <p class="text-pink-200/60 text-xs">Ready to start your magical journey? 🌟</p>
        </div>
    </div>
</div>
