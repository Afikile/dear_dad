<!-- resources/views/replies/partials/reply.blade.php -->

<div class="mb-4 p-4 border rounded {{ $reply->parent_id ? 'ml-6 bg-gray-50' : 'bg-white' }}">
    <p><strong>{{ $reply->user->name ?? 'Anonymous' }}</strong> said:</p>
    <p class="text-gray-700">{{ $reply->body }}</p>
    <p class="text-xs text-gray-500">Replied on {{ $reply->created_at->format('F j, Y') }}</p>

    <!-- Display replies to this reply (nested replies) -->
    @if ($reply->children->isNotEmpty())
        <div class="mt-4 ml-6">
            @foreach ($reply->children as $childReply)
                @include('replies.partials.reply', ['reply' => $childReply])
            @endforeach
        </div>
    @endif

    <!-- Reply Form for this specific reply (nested reply) -->
    @auth
    <form action="{{ route('replies.store', $letter->id) }}" method="POST" class="mt-6">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $reply->id }}">
        <textarea 
            name="body" 
            class="w-full p-2 border rounded mt-2" 
            rows="3" 
            placeholder="Reply to this message..." 
            required
        ></textarea>
        
        <!-- Display validation error for 'body' -->
        @error('body')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
        
        <button 
            type="submit" 
            class="bg-blue-600 text-white px-4 py-2 rounded mt-2 hover:bg-blue-700 transition duration-300"
        >
            Submit Reply
        </button>
    </form>
    @else
        <p class="text-gray-600 mt-6">You must <a href="{{ route('login') }}" class="text-blue-500">log in</a> to reply.</p>
    @endauth
</div>
