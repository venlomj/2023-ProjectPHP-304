<?php

namespace App\Http\Livewire\Trainer;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupUser;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class DistributionList extends Component
{
    public $orderBy = 'max_age';
    public $orderAsc = true;
    public $showDetails = false;
    public $selectedGroup;
    public $showDetailTable = false;

    public function showGroups(GroupMember $group)
    {
        $this->selectedGroup = $group;
        $group->group_id = $group->group->id;
        $group->member_id = $group->member->id;
        //dump($this->selectedGroup->toArray());
        $this->showDetailTable = true;
    }

//    public function getSelectedGroup()
//    {
//        return json_encode([])
//    }


    // resort the groups by the given column
    public function resort($column)
    {
        if ($this->orderBy === $column) {
            $this->orderAsc = !$this->orderAsc;
        } else {
            $this->orderAsc = true;
        }
        $this->orderBy = $column;
    }

    public function render()
    {
        $groups = Group::with('group_users')
            ->with('group_users.user')
            ->with('group_users.user.orders')
            ->with('group_users.user.orders.orderlines')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->get();

        foreach($groups as $group){
            $group->number_orders = 0;
            $group->number_products = 0;
            foreach($group->group_users as $group_user) {
                foreach($group_user->user->orders as $order) {
                    $group->number_orders ++;
                    foreach($order->orderlines as $orderline) {
                        $group->number_products  ++;
                    }
                }
            }
        }
        return view('livewire.trainer.distribution-list', compact('groups'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Beheer de verdeellijst',
                'title' => 'Verdeellijst',
            ]);
    }
}
