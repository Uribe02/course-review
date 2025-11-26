@php
    use Illuminate\Support\Str;
@endphp

<x-guest-layout>
    <div class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-100">
                <h1 class="text-6xl font-extrabold text-gray-900 mb-2 text-center">
                    Catálogo de Cursos
                </h1>

                <p class="text-center text-gray-500 mb-8 text-lg">Aprende con los mejores instructores</p>

                <!-- Auth controls on home page -->
                <div class="flex justify-center mb-8">
                    @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 mr-4 bg-white border border-gray-300 rounded-md font-medium text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                            Iniciar sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white uppercase tracking-wide shadow-md hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                                Registrarse
                            </a>
                        @endif
                    @else
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white uppercase tracking-wide shadow-md hover:bg-indigo-700">
                            Ir al Dashboard
                        </a>
                    @endguest
                </div>

                {{-- Courses grid --}}
                <div class="mt-6">
                    @if ($courses instanceof Illuminate\Contracts\Pagination\Paginator || $courses instanceof Illuminate\Contracts\Pagination\LengthAwarePaginator || is_iterable($courses))
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
                            @foreach ($courses as $course)
                                        <div class="w-96 bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100 transition duration-300 hover:shadow-xl">
                                            <div class="p-6 h-full flex flex-col justify-between">
                                        <div>
                                                    <h2 class="text-2xl font-bold text-gray-900 mb-3 uppercase">
                                                        <a href="{{ route('courses.show', $course->slug) }}" class="hover:underline">
                                                            {{ $course->title }}
                                                        </a>
                                                    </h2>
                                                    <p class="text-sm text-indigo-600 mb-3">
                                                        <a href="#" class="font-medium text-indigo-600">Instr. {{ $course->instructor }}</a>
                                                    </p>
                                                    <p class="text-gray-600 mb-6 text-sm">
                                                        {{ Str::limit($course->description, 140) }}
                                                    </p>
                                        </div>

                                        <div class="mt-4">
                                            <a href="{{ route('courses.show', $course->slug) }}" class="block w-full text-center px-4 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 font-medium">
                                                Ver Detalles
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-10 flex justify-center">
                            {{ method_exists($courses, 'links') ? $courses->links() : '' }}
                        </div>
                    @else
                        <p class="text-center text-gray-500 mt-8">No hay cursos publicados aún.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>