@props([
    'type' => 'search',
    'nameInput',
    'label',
    'dataArray',
    'class' => 'col-span-2'
])

<div class="custom-select-wrapper text-white {{ $class }}" data-select-{{ $type }} data-name="{{ $nameInput }}" id="{{ $nameInput . '_wrapper' }}">

    <label for="{{ $nameInput . '_input' }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
        {{ $label }}
    </label>

    @if ($type === 'tag')
        <div class="custom-select-tags flex flex-wrap gap-2 bg-gray-50 border border-gray-300 rounded-lg p-2 dark:bg-gray-600 dark:border-gray-500"></div>
    @endif

    <input
        type="text"
        id="{{ $nameInput . '_input' }}"
        class="custom-select-input bg-gray-50 border border-gray-300 rounded-lg p-2 dark:bg-gray-600 dark:border-gray-500 w-full"
        placeholder="Cari {{ strtolower($label) }}..."
        autocomplete="off"
    >

    <ul class="custom-select-dropdown absolute z-10 mt-1 bg-white border border-gray-300 rounded-lg max-h-60 overflow-auto w-full hidden dark:bg-gray-700 dark:border-gray-600">
        @foreach ($dataArray as $data)
            <li class="p-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600"
                data-id="{{ $data->id }}"
                data-nama="{{ $data->nama }}">
                {{ $data->nama }}
            </li>
        @endforeach
    </ul>

    <div class="custom-select-hidden"></div>
</div>
