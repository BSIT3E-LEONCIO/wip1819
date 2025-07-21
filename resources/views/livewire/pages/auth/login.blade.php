<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
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
                Hi Love! ✨
            </h1>
            <p class="text-pink-200/80 text-sm">Sign in to your magical account</p>
        </div>

        <!-- Login Card -->
        <div class="bg-gray-900/70 backdrop-blur-xl border border-pink-500/20 rounded-3xl p-8 shadow-2xl">
            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form wire:submit="login" class="space-y-6">
                <!-- Email Address -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-pink-200">
                        ✉️ {{ __('Email Address') }}
                    </label>
                    <div class="relative">
                        <input wire:model="form.email" 
                               id="email" 
                               type="email" 
                               name="email" 
                               required 
                               autofocus 
                               autocomplete="username"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-pink-400/30 rounded-2xl text-pink-100 placeholder-pink-300/50 focus:border-pink-400 focus:ring-2 focus:ring-pink-400/20 focus:outline-none transition-all duration-300"
                               placeholder="Enter your cute email..." />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <span class="text-pink-400">💕</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-rose-400" />
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-pink-200">
                        🔒 {{ __('Password') }}
                    </label>
                    <div class="relative">
                        <input wire:model="form.password" 
                               id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-pink-400/30 rounded-2xl text-pink-100 placeholder-pink-300/50 focus:border-pink-400 focus:ring-2 focus:ring-pink-400/20 focus:outline-none transition-all duration-300"
                               placeholder="Your secret password..." />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <span class="text-pink-400">🌸</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-rose-400" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember" class="flex items-center space-x-3 cursor-pointer">
                        <input wire:model="form.remember" 
                               id="remember" 
                               type="checkbox" 
                               class="w-5 h-5 bg-gray-800/50 border-2 border-pink-400/30 rounded-lg text-pink-500 focus:ring-pink-400/20 focus:ring-2 transition-all duration-300">
                        <span class="text-sm text-pink-200">{{ __('Remember me') }} 💭</span>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center space-x-2">
                        <span>{{ __('Sign In') }}</span>
                        <span>✨</span>
                    </button>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" 
                               wire:navigate
                               class="text-sm text-pink-300 hover:text-pink-200 transition-colors duration-300 flex items-center justify-center space-x-1">
                                <span>{{ __('Forgot your password?') }}</span>
                                <span>🔮</span>
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            <!-- Decorative Elements -->
            <div class="mt-8 pt-6 border-t border-pink-500/20">
                <div class="text-center text-pink-300/60 text-sm">
                    <span>Don't have an account? </span>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           wire:navigate
                           class="text-pink-300 hover:text-pink-200 font-medium transition-colors duration-300">
                            Create one here! 🌟
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer Decoration -->
        <div class="text-center mt-8">
            <div class="flex justify-center space-x-2 text-2xl mb-4">
                <span class="animate-bounce">🦄</span>
                <span class="animate-bounce" style="animation-delay: 0.1s">💖</span>
                <span class="animate-bounce" style="animation-delay: 0.2s">🌙</span>
                <span class="animate-bounce" style="animation-delay: 0.3s">⭐</span>
            </div>
            <p class="text-pink-200/60 text-xs">Made with 💕 for amazing people like you!</p>
        </div>
    </div>
</div>
