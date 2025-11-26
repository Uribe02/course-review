@php
    use Illuminate\Support\Str;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Curso: ') . $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('courses.index') }}" class="text-indigo-600 hover:text-indigo-900 mb-4 inline-block">&larr; Volver al Dashboard</a>

                <form method="POST" action="{{ route('courses.update', $course) }}" class="mt-4">
                    @csrf
                    @method('PUT') 

                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Título del Curso')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $course->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label for="slug" :value="__('Slug (URL Amigable)')" />
                        <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug" :value="old('slug', $course->slug)" required />
                        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="instructor" :value="__('Nombre del Instructor')" />
                        <x-text-input id="instructor" class="block mt-1 w-full" type="text" name="instructor" :value="old('instructor', $course->instructor)" required />
                        <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Descripción Detallada')" />
                        <textarea id="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="description" required>{{ old('description', $course->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Actualizar Curso') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>