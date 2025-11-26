<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-medium text-sm text-white uppercase tracking-wide shadow-md hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition duration-150']) }}>
    {{ $slot }}
</button>
