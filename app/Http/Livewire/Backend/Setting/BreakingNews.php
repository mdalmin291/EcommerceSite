<?php

namespace App\Http\Livewire\Backend\Setting;
use App\Models\Backend\Setting\BreakingNews as BreakingNewsInfo;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BreakingNews extends Component
{
    public $news;
    public $is_active=1;
    public $BreakingNewsId;

    public function newsEdit($id)
    {
        $QueryUpdate = BreakingNewsInfo::find($id);
        $this->BreakingNewsId = $QueryUpdate->id;
        $this->news = $QueryUpdate->news;
        $this->is_active = $QueryUpdate->is_active;
		$this->emit('modal', 'breakingNews');
    }
    public function newsDelete($id)
    {
        BreakingNewsInfo::find($id)->delete();

        $this->emit('success', [
            'text' => 'News Deleted Successfully',
        ]);
    }
    public function breakingNewsSave()
    {
        $this->validate([
            'news' => 'required',
            'is_active' => 'required',
        ]);
        if ($this->BreakingNewsId) {
            $Query = BreakingNewsInfo::find($this->BreakingNewsId);
        } else {
            $Query = new BreakingNewsInfo();
            $Query->created_by = Auth::id();
        }

        $Query->news = $this->news;
        $Query->branch_id = Auth::user()->branch_id;
        $Query->is_active = $this->is_active;
        $Query->save();

        $this->reset();
        $this->breakingNewsModal();

        $this->emit('success', [
            'text' => 'News C/U Successfully',
        ]);
    }

    public function breakingNewsModal(){
        $this->reset();
        $this->emit('modal','breakingNews');
    }
    public function render()
    {
        return view('livewire.backend.setting.breaking-news');
    }
}
