<?php

namespace App\Http\Livewire\Features\Dashboard\Pages;

use App\Traits\HasAlert;
use App\Traits\HasToast;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Questions extends Component
{

    use WithPagination, HasAlert, HasToast;

    public $provider;

    public $sortingValues = [
        'newest',
        'oldest'
    ];

    public $page = 1;
    public $sorting = 'newest';

    protected $queryString = [
        'page' => ['except' => 1],
        'sorting' => ['except' => ''],
    ];

    public function mount()
    {
        $this->provider = auth()->user()->provider()->first();
    }

    public function handleSorting($target)
    {
        if (in_array($target, $this->sortingValues) && strval($this->sorting) !== strval($target)) {
            $this->sorting = $target;
        } else {
            $this->sorting = '';
        }
        $this->resetPage();
    }

    public function getOrderAndDirectionForSorting()
    {
        $result = null;
        try {
            $temp = explode('-', $this->sorting);
            $orderBy = $temp[0];
            $orderDirection = sizeof($temp) > 1 ? $temp[1] : null;
            if (in_array($orderBy, ['oldest', 'newest'])) {
                $result = [
                    'orderBy' => 'created_at',
                    'direction' => $orderBy === 'newest' ? 'desc' : 'asc'
                ];
            }
        } catch (Exception $e) {
            \Debugbar::log($e->getMessage());
        }

        return $result;
    }

    public function paginationView()
    {
        return 'livewire.shared.components.paginator';
    }

    public function render()
    {
        if (empty($this->provider)) {
            return view('livewire.features.dashboard.pages.questions')
                ->extends('livewire.layouts.app')
                ->layoutData(['title' => 'dashboard.questions.title']);
        } else {
            $sortingResult = $this->getOrderAndDirectionForSorting();
            \Debugbar::log($sortingResult);
            $questions = $this->provider->questions()
                ->with(['product', 'user'])
                ->when(($sortingResult), function ($query) use ($sortingResult) {
                    $query->orderBy($sortingResult['orderBy'], $sortingResult['direction']);
                })
                ->paginate(15);

            return view('livewire.features.dashboard.pages.questions', [
                'questions' => $questions,
                'from' => $questions->firstItem(),
                'to' => $questions->lastItem(),
                'total' => $questions->total(),
            ])
                ->extends('livewire.layouts.app')
                ->layoutData(['title' => 'dashboard.questions.title']);
        }
    }
}
