<?php

namespace App\Http\Livewire\Features\Dashboard\Components;

use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DashboardMenu extends Component
{
    private $menu;
    public $currentMenu = 'nav-profile-tab';

    public function mount()
    {
        $this->menu = [
            [
                'label' => 'dashboard.menu.profile',
                'icon' => 'fa-regular fa-user-pen',
                'link' => LaravelLocalization::localizeUrl(route('dashboard.profile')),
                'key' => 'nav-profile-tab'
            ],
            [
                'label' => 'dashboard.menu.information',
                'icon' => 'fa-regular fa-circle-info',
                'link' => LaravelLocalization::localizeUrl(route('dashboard.information')),
                'key' => 'nav-information-tab'
            ],
            [
                'label' => 'dashboard.menu.products',
                'icon' => 'fa-regular fa-shop',
                'link' => LaravelLocalization::localizeUrl(route('dashboard.my_products')),
                'key' => 'nav-products-tab',
                'is_for_provider' => true,
            ],
            [
                'label' => 'dashboard.menu.add_product',
                'icon' => 'fa-regular fa-rectangle-history-circle-plus',
                'link' => LaravelLocalization::localizeUrl(route('dashboard.add_product')),
                'key' => 'nav-add-product-tab',
                'is_for_provider' => true,
            ],
            [
                'label' => 'dashboard.menu.notifications',
                'icon' => 'fa-regular fa-bell',
                'link' => LaravelLocalization::localizeUrl('notifications'),
                'key' => 'nav-notification-tab'
            ],
            [
                'label' => 'dashboard.menu.change_password',
                'icon' => 'fa-regular fa-lock',
                'link' => LaravelLocalization::localizeUrl(route('dashboard.change_password')),
                'key' => 'nav-password-tab'
            ],
        ];
    }
    public function render()
    {
        $menuToShow = array_filter($this->menu, fn($menuItem) => true);
        return view('livewire.features.dashboard.components.dashboard-menu', [
            'menu' => $menuToShow,
        ]);
    }
}
