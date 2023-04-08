<?php

<div class="form-row auto-grid-placement">
    <x-form.field class="col-span-full">
        <div class="flex">
            <x-form.label for=""><h4>Habitat</h4></x-form.label>
            <!-- Livewire call for the modal -->
            <x-form.btn-add-new-value
                modal="models.habitat-create"
                title="Add a new habitat"
                class="add-modal">+</x-form.btn-add-new-value>
        </div>
        <!-- Displays the habitat types with edit and delete -->
        @livewire( "models.habitat-types" )
    </x-form.field>
</div>
