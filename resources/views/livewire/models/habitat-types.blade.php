<div class="habitats">

    <div class="auto-grid-placement auto-grid-item gap-6 p-3 border rounded bg-zinc-100">

        @foreach( $habitats as $key => $habitat )
            <div>
                <div class="flex items-center px-2 py-2 inline-block rounded bg-white focus-within:bg-indigo-900 transition-colors ease-in-out duration-300 @error( "habitats." . $key . ".type" ) bg-red-100 @enderror">
                    <div wire:key="habitats.{{ $key }}" class="input-buttons-combo flex items-center w-full">
                        <input wire:model.lazy="habitats.{{ $key }}.type" type="text" class="w-11/12 z-10 px-3 py-2 rounded focus:bg-indigo-900 focus:text-white transition-colors ease-in-out duration-300"  >
                        <button wire:click="deleteHabitat( {{ $habitat->id }} )" class="symbolic-delete-btn">
                            <svg class="" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path  stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-full bg-red-100">
                    @error( "habitats." . $key . ".type" ) <span class="error-message">{{ $message }}</span> @enderror
                </div>
            </div>

        @endforeach

    </div>
</div>
<!-- HABITAT TYPE -->
