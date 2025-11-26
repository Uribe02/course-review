@php
    use Illuminate\Support\Str;
@endphp

<x-guest-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-indigo-700 mb-8 text-center">
                Plataforma de Reseñas de Cursos
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($courses as $course)
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 transition duration-300 hover:shadow-xl">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">
                                <a href="{{ route('courses.show', $course->slug) }}" class="text-indigo-600 hover:underline">
                                    {{ $course->title }}
                                </a>
                            </h2>
                            <p class="text-sm text-gray-500 mb-4">
                                Instructor: <span class="font-medium text-gray-600">{{ $course->instructor }}</span>
                            </p>
                            <p class="text-gray-700 mb-6">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            <a href="{{ route('courses.show', $course->slug) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</x-guest-layout>