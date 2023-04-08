<?php

namespace App\Http\Livewire\Models;

use App\Models\Habitat;
use App\Models\Planet;
use LivewireUI\Modal\ModalComponent;

/**
  This is a modal compoment
*/


class HabitatCreate extends ModalComponent
{
    public $habitat_type;
    # The title in the modal
    public $title;

    public $planet_id;

    public $rules = [
        "habitat_type"    => "required|regex:/^[\pL\s\-']+$/u|unique:habitats,type|max:50"
    ];

    protected $validationAttributes = [
        "habitat_type" => "Le type d'habitat"
    ];


    public function save()
    {
        $this->validate();

        $habitat = Habitat::create([
            "type"  => ucfirst( strtolower( $this->habitat_type )),
        ]);

        if( $this->planet_id )
        {
            Planet::find( $this->planet_id )->habitats()->attach( $habitat->id );
            # main view
            $this->emit( "updateHabitats", $habitat->id );
        }else{
            # Other view
            $this->emit( "updateHabitatTypes" );
        }

        $this->reset( "habitat_type" );
        $this->closeModal();
    }


    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '3xl';
    }


    public function render()
    {
        return view('livewire.models.habitat-create');
    }
}
