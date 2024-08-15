<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Traits\Common;

class UserList extends Component
{
    use Common;
    
    public $list = [];
    public $keyword = '';
    public $paginate = [];
    public $paginationPaging = [];

    public function mount()
    {
        $this->paginate['page'] = 1;
        $this->paginate['pageSize'] = 25;
    }

    public function archive($userid)
    {       
        $user = User::where('Id', $userid);
        
        if ($user) {
            $user->update([
                'Status' => 2,
            ]);
        }
        return redirect()->to('/users')->with(['mmessage'=> 'User has been archived', 'mword'=> 'Success']);    
    }
    
    public function setPage($page = 1)
    {
        $this->paginate['page'] = $page;
    }

    public function goToFirstPage()
    {
        $this->paginate['page'] = 1;
    }

    public function goToLastPage()
    {
        $this->paginate['page'] = $this->paginationPaging['totalPage'];
    }

    public function render()
    {
        $this->list = $this->getUsers();

        return view('livewire.users.user-list');
    }

    private function getUsers($paginate = true)
    {
        $users = User::query()
            ->where('Status', 1)
            ->where(function ($query) {
                $query->where('Fname', 'like', '%' . $this->keyword . '%')
                    ->orWhere('Lname', 'like', '%' . $this->keyword . '%');
            })
            ->get();

        if ($paginate) {
            $totalItems = $users->count();
    
            $this->paginationPaging['totalPage'] = ceil($users->count() / $this->paginate['pageSize']);
            $this->paginationPaging['totalRecord'] = $totalItems;
            $this->paginationPaging['currentPage'] = $this->paginate['page'];
            $this->paginationPaging['nextPage'] = $this->paginate['page'] < $this->paginationPaging['totalPage'] ? $this->paginate['page'] + 1 : $this->paginationPaging['totalPage'];
            $this->paginationPaging['prevPage'] = $this->paginate['page'] > 1 ? $this->paginate['page'] - 1 : 1;
    
            $startItem = ($this->paginate['page'] - 1) * $this->paginate['pageSize'] + 1;
            $endItem = min($this->paginate['page'] * $this->paginate['pageSize'], $totalItems);
    
            $this->paginationPaging['startItem'] = $startItem;
            $this->paginationPaging['endItem'] = $endItem;
    
            $paginatedMembers = $users->slice(($this->paginate['page'] - 1) * $this->paginate['pageSize'], $this->paginate['pageSize']);
    
            return $paginatedMembers;
        }

        return $users;
    }
}
