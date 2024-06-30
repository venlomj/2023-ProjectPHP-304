<?php

namespace App\Http\Livewire\Trainer;

use App\Models\Group;
use App\Models\GroupMember;
use Livewire\Component;
use Livewire\WithPagination;

class GroupReview extends Component
{
    public $group = '%';
    public $loading =  'Even geduld, a.u.b. ...';
    use WithPagination;

    public $perPage = 6;

    public function render()
    {
        $allGroups = Group::has('group_members')->orderBy('name')->get();
        $groups = GroupMember::with('group')->with('member')
            ->where('group_id', 'like', $this->group)->paginate($this->perPage);
        return view('livewire.trainer.group-review', compact('groups', 'allGroups'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Groep bekijken',
                'title' => 'Groep bekijken',
            ]);
    }
}
