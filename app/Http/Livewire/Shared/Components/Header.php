<?php

namespace App\Http\Livewire\Shared\Components;

use App\Models\Category;
use App\Models\Provider;
use App\Models\User;
use Livewire\Component;

class Header extends Component
{
    public $categories = [];
    public $type;
    public $linkedProvider = null;
    public $userProfilePhotoPath = null;

    public function mount()
    {
        $this->linkedProvider = Provider::query()
            ->where('user_id', auth()->id())
            ->first();

        if (auth()->check()) {
            if (empty(auth()->user()?->profile_photo_path)) {
                $filename = 'profile-photos/' . auth()->id() . '.png';
                \Avatar::create(auth()->user()->username)->save(public_path('storage/'.$filename));
                $temp = User::query()
                    ->find(auth()->id())
                    ->first();
                \Debugbar::log($temp->toArray());
                $temp->profile_photo_path = $filename;
                $temp->save();
                $this->userProfilePhotoPath = '/storage/' . $filename;
            } else {
                $this->userProfilePhotoPath = '/storage/' . auth()->user()?->profile_photo_path;
            }
        }

        if($this->type === 1) {
            $this->categories = Category::with('descendants')
                ->whereNull('parent_id')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.shared.components.header');
    }
}
