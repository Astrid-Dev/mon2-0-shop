<?php

namespace App\Http\Livewire\Features\Dashboard\Pages;

use App\Traits\HasAlert;
use App\Traits\HasToast;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class MyQuestions extends Component
{
    use WithPagination, HasAlert, HasToast;

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

    protected $listeners = [
        'onDeleteQuestion'
    ];

    public function onDeleteQuestion($data)
    {
        $questionId = $data['questionId'];
        auth()->user()->questions()
            ->where('id', $questionId)
            ->delete();

        $this->showSuccessToast(__('dashboard.my_questions.on_delete_success'));
    }

    public function shouldDeleteQuestion($questionId)
    {
        $this->askConfirmation(
            message: __('dashboard.my_questions.delete_confirmation'),
            listener: [
                'onConfirm' => [
                    'callback' => 'onDeleteQuestion',
                    'data' => [
                        'questionId' => $questionId,
                    ]
                ]
            ],
            buttons: [
                'confirm' => __('helpers.choices.yes_continue'),
                'deny' => __('helpers.choices.no')
            ]
        );
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
        $sortingResult = $this->getOrderAndDirectionForSorting();
        \Debugbar::log($sortingResult);
        $questions = auth()->user()->questions()
            ->with(['product'])
            ->when(($sortingResult), function ($query) use ($sortingResult) {
                $query->orderBy($sortingResult['orderBy'], $sortingResult['direction']);
            })
            ->paginate(15);

        return view('livewire.features.dashboard.pages.my-questions', [
            'questions' => $questions,
            'from' => $questions->firstItem(),
            'to' => $questions->lastItem(),
            'total' => $questions->total(),
        ])
            ->extends('livewire.layouts.app')
            ->layoutData(['title' => 'dashboard.my_questions.title']);
    }
}
