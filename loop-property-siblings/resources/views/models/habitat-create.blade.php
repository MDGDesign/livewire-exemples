<x-modals.modal >
    <x-slot name="title">
        {{ $title }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="save" class="w-full">
            @csrf
            <div class="w-full">
                <label class="block font-medium tracking-widest text-sm text-gray-700" for="title">
                    Habitat
                </label>
                <input wire:model.defer="habitat_type" autofocus
                       class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"/>
                @error('habitat_type')
                <div class="text-sm text-red-500 ml-1">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="ml-auto mt-4 text-right">
                <button type="submit" class="ml-auto button save-btn">Ajouter</button>
            </div>
        </form>
    </x-slot>
</x-modals.modal>
