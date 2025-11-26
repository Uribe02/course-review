@php
    // Usaremos esto para el guest layout si es necesario
    use Illuminate\Support\Facades\Auth; 
@endphp

<x-guest-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                <h1 class="text-4xl font-extrabold text-indigo-700 mb-4">{{ $course->title }}</h1>
                <p class="text-gray-600 mb-6 text-lg">
                    **Instructor:** {{ $course->instructor }}
                </p>

                <div class="prose max-w-none text-gray-700 mb-8 border-t pt-4">
                    <h2 class="text-2xl font-semibold mb-3 text-gray-800">Descripción</h2>
                    {{ $course->description }}
                </div>
                
                <hr class="my-6">
                
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Dejar una Reseña</h2>
                
                @auth 
                    <div class="bg-indigo-50 p-6 rounded-lg border border-indigo-200">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                        @endif
                        
                        <form action="{{ route('reviews.store', $course->slug) }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="rating" class="block font-medium text-sm text-gray-700">Calificación (1-5)</label>
                                <select id="rating" name="rating" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Seleccione una calificación</option>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} estrellas</option>
                                    @endfor
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="comment" class="block font-medium text-sm text-gray-700">Comentario</label>
                                <textarea id="comment" name="comment" rows="4" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('comment') }}</textarea>
                            </div>
                            
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                                Enviar Reseña
                            </x-primary-button>
                        </form>
                    </div>
                @endauth 

                @guest
                    <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200 text-center">
                        <p class="text-gray-700">
                            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">Inicia sesión</a> para dejar una reseña.
                        </p>
                    </div>
                @endguest
                
                <hr class="my-6">
                
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Reseñas de Usuarios ({{ $course->reviews->count() }})</h2>

                    @forelse ($course->reviews as $review)
                        <div class="border-b pb-4 mb-4">
                            <div class="flex justify-between items-center mb-1">
                                <h3 class="font-semibold text-gray-900">{{ $review->user->name }}</h3>
                                <span class="text-sm font-bold text-indigo-600">
                                    {{ $review->rating }} / 5 estrellas
                                </span>
                            </div>
                            <p class="text-gray-700 italic">{{ $review->comment }}</p>
                            <p class="text-xs text-gray-500 mt-2">Publicado el {{ $review->created_at->format('d M Y') }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 italic">Sé el primero en dejar una reseña.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>