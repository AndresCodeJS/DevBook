<?php

namespace App\Livewire;

use App\Models\Like;
use Livewire\Component;

class LikePost extends Component
{
    public $post; 
    public $isLiked;

    //Mount se ejecuta cuando se carga el componente
    public function mount(){
        $this->isLiked = $this->post->checkLike(auth()->user());
    }

    public function like(){
        if($this->post->checkLike(auth()->user())){
            $this->post->likes()->where('user_id',auth()->user()->id)->delete();
            $this->isLiked = false;
        }else{
            Like::create([
                "user_id" => auth()->user()->id,
                "post_id" => $this->post->id
            ]);

            $this->isLiked = true;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
