<?php

namespace App\Http\Livewire\Models;

use App\Models\Habitat;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
    To manage the different instances of value an habitat can have
    Modify or delete
    See CreateHabitat for adding new habitats
*/

class HabitatTypes extends Component
{

    public Habitat $habitat;

    public string $type;

    public Collection $habitats;

    # Any language letters and a few chacarters. No number or no other characters except the mentionned ones.
    protected $rules = [
        "habitats.*.type"   => "required|regex:/^[\pL\s\-']+$/u|unique:habitats,type|max:50",     # Collection of types: Use this one for sake of redability
        # "habitats.*"        => "required|regex:/^[\pL\s\-']+$/u|unique:habitats,type|max:50",   # Collection of types: Or this key 
        # "type"              => "required|regex:/^[\pL\s\-']+$/u|unique:habitats,type|max:50",   # Single types: use this key if you want one single general error page message 
    ];

    protected $messages = [
        'type.required' => ":attribute ne peut être vide.",
        'type.regex'    => ":attribute comporte des caractères non valide.",
        'type.unique'   => ":attribute existe déjà.",
        'type.max'      => ":attribute ne peut avoir que 50 caractères maximum.",
    ];

    protected $validationAttributes = [
        'habitats.*.type' => "Le type d'habitat"
    ];

    protected $listeners = [
        "updateHabitatTypes"
    ];


  
  
    public function mount()
    {
        $this->habitats = Habitat::orderBy( "type", "ASC" )->get();
    }

  
  
    # Called from emit from create new habitats
    public function updateHabitatTypes()
    {
        $this->mount();
    }


  
    public function deleteHabitat( $id )
    {
        try {
            $this->habitats->find( $id )->delete();
        }catch( QueryException $e )
        {
            $this->emit( "notify", "error", "Your message");
        }

        $this->mount();
    }

  
  
    # The updated() method runs before the updatedHabitats()
    # Probably simpler in a one property component context
   /* public function updated( $full_key, $value )
    {
        # dd( $full_key, $value ); # => habitats.0.type, the current value updated
        
        # $index = explode( ".", $full_key, -1 )[1];
        # dd( $index );
        $this->validateOnly( $full_key );
        # $this->habitats[$index]->save();
        # $this->emit( "notify", "success", "Le type d'habitat a été modifié avec success" );
    }*/

  
  
    # Same as updated() method except for the parameters order and the $key value are different
    public function updatedHabitats( $type_value, $key )
    {
        # dd( $type_value, $key ); # => the current value updated, 0.type
      
        $this->validateOnly( "habitats." . $key );
        $index = explode( ".", $key, -1 )[0];
      
        $this->habitats[$index]->save();

        $this->mount();
        $this->emit( "notify", "success", "Le type d'habitat a été modifié avec success" );
    }



    public function render()
    {
        return view('livewire.models.habitat-types');
    }
}
