<div class="max-w-2xl mx-auto mb-8">
    <!-- Create Post -->
    <form wire:submit.prevent="submit" class="bg-black/40 backdrop-blur-xl border border-purple-500/20 rounded-3xl p-8 shadow-2xl mb-8">
        <!-- User Avatar and Text Area -->
        <div class="flex items-start space-x-4 mb-6">
            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="flex-1">
                <textarea wire:model="content" 
                          rows="3" 
                          class="w-full bg-gray-800/50 text-white rounded-2xl p-4 border border-purple-400/30 focus:ring-2 focus:ring-purple-400/50 focus:border-purple-400 resize-none transition-all duration-300 text-lg placeholder-purple-300/60" 
                          placeholder="What's on your mind, {{ auth()->user()->name }}? ✨"></textarea>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="flex items-center justify-between pt-4 border-t border-purple-500/20">
            <div class="flex items-center space-x-4">
                <!-- Image Upload Button -->
                <label for="imageUpload" class="flex items-center space-x-2 bg-purple-900/50 hover:bg-purple-800/60 text-purple-200 hover:text-white px-4 py-2 rounded-xl cursor-pointer transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium">Photo</span>
                </label>
                <input id="imageUpload" wire:model="image" type="file" accept="image/*" class="hidden">
                
                <!-- Emoji Button -->
                <div x-data="{ open: false, emojis: ['😊','😍','😎','🥳','😇','😭','😡','🤩','😴','🤔','😜','😱','🥰','😏','😤','😅','😬','😃','😢','😆'] }" class="relative">
                    <button type="button" @click="open = !open" class="flex items-center space-x-2 bg-purple-900/50 hover:bg-purple-800/60 text-purple-200 hover:text-white px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">Feeling</span>
                        <span class="ml-2 text-lg" x-text="$wire.feeling"></span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 left-0 mt-2 w-64 bg-black/90 border border-purple-500/30 rounded-xl shadow-lg p-4 grid grid-cols-6 gap-2">
                        <template x-for="emoji in emojis" :key="emoji">
                            <button type="button" @click="$wire.setFeeling(emoji); open = false" class="text-2xl hover:scale-125 transition-transform duration-150"><span x-text="emoji"></span></button>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Post Button -->
            <button type="submit" 
                    class="bg-gradient-to-r from-purple-500 to-purple-700 hover:from-purple-600 hover:to-purple-800 text-white font-semibold py-3 px-8 rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center space-x-2">
                <span>Post</span>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
        </div>

        <!-- Image Preview -->
        @if($image)
            <div class="mt-4 relative">
                <div class="bg-gray-800/50 rounded-2xl p-4 border border-purple-400/20">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-purple-200 text-sm font-medium flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                            <span>Image attached</span>
                        </span>
                        <button type="button" wire:click="$set('image', null)" class="text-red-400 hover:text-red-300 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                    <div class="text-purple-300 text-xs">{{ $image->getClientOriginalName() }}</div>
                </div>
            </div>
        @endif
    </form>

    <!-- Posts Feed -->
    <div class="space-y-8">
        @foreach($posts as $post)
            <div class="bg-black/40 backdrop-blur-xl border border-purple-500/20 rounded-3xl p-6 shadow-2xl">
                <!-- Post Header -->
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="text-purple-100 font-semibold text-lg">{{ $post->user->name }}</div>
                        <div class="text-purple-400 text-sm flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="relative">
                        <button class="text-purple-300 hover:text-purple-200 p-2 rounded-full hover:bg-purple-800/30 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="mb-4 flex items-center space-x-2">
                    <p class="text-white text-lg leading-relaxed flex-1">{{ $post->content }}</p>
                    @if($post->feeling)
                        <span class="text-2xl">{{ $post->feeling }}</span>
                    @endif
                </div>

                <!-- Post Image -->
                @if($post->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="Post image" 
                             class="rounded-2xl w-full object-cover max-h-96 shadow-lg border border-purple-500/10">
                    </div>
                @endif

                <!-- Engagement Bar -->
                <div class="flex items-center justify-between py-3 border-t border-b border-purple-500/20 mb-4">
                    <div class="flex items-center space-x-6">
                        <!-- Like Button -->
                        <button wire:click="like({{ $post->id }})" 
                                class="flex items-center space-x-2 text-purple-300 hover:text-pink-400 transition-all duration-300 hover:scale-105 group">
                            <div class="p-2 rounded-full group-hover:bg-pink-500/10 transition-all duration-300">
                                <svg class="w-6 h-6 {{ $post->likes->contains(auth()->id()) ? 'text-pink-500' : '' }}" 
                                     fill="{{ $post->likes->contains(auth()->id()) ? 'currentColor' : 'none' }}" 
                                     stroke="currentColor" 
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <span class="font-medium">{{ $post->likes->count() }}</span>
                        </button>

                        <!-- Comment Button -->
                        <button class="flex items-center space-x-2 text-purple-300 hover:text-blue-400 transition-all duration-300 hover:scale-105 group">
                            <div class="p-2 rounded-full group-hover:bg-blue-500/10 transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <span class="font-medium">{{ $post->comments->count() }}</span>
                        </button>

                        <!-- Share Button -->
                        <button class="flex items-center space-x-2 text-purple-300 hover:text-green-400 transition-all duration-300 hover:scale-105 group">
                            <div class="p-2 rounded-full group-hover:bg-green-500/10 transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Comments Section -->
                @if($post->comments->count() > 0)
                    <div class="space-y-3 mb-4">
                        @foreach($post->comments->take(3) as $comment)
                            <div class="flex items-start space-x-3 bg-purple-900/20 rounded-2xl p-4">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span class="text-purple-200 font-semibold text-sm">{{ $comment->user->name }}</span>
                                        <span class="text-purple-400 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-white text-sm">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @endforeach
                        @if($post->comments->count() > 3)
                            <button class="text-purple-300 hover:text-purple-200 text-sm font-medium transition-colors duration-200">
                                View all {{ $post->comments->count() }} comments
                            </button>
                        @endif
                    </div>
                @endif

                <!-- Add Comment -->
                <form wire:submit.prevent="addComment({{ $post->id }})" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold flex-shrink-0">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 relative">
                        <input wire:model="comment" 
                               type="text" 
                               class="w-full bg-gray-800/50 text-purple-100 rounded-full py-3 px-4 pr-12 border border-purple-400/30 focus:ring-2 focus:ring-purple-400/50 focus:border-purple-400 transition-all duration-300" 
                               placeholder="Write a comment...">
                        <button type="submit" 
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-purple-600 hover:bg-purple-700 text-white p-2 rounded-full transition-all duration-300 hover:scale-105">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>
