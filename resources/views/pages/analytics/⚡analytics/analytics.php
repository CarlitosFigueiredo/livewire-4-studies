<?php

use App\Analytics;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

new #[Title('Analytics')] class extends Component
{
    public string $period = 'month';

    #[Url()]
    public int $postsPage = 1;

    #[Computed]
    public function views()
    {
        return Analytics::period($this->period)->views();
    }

    #[Computed]
    public function visitors()
    {
        return Analytics::period($this->period)->visitors();
    }

    #[Computed]
    public function avgTime()
    {
        return Analytics::period($this->period)->avgTime();
    }

    #[Computed]
    public function topPosts()
    {
        return Analytics::period($this->period)->topPosts(page: $this->postsPage);
    }

    #[Computed]
    public function topCountries()
    {
        return Analytics::period($this->period)->topCountries();
    }

    public function updating($property)
    {
        if ($property === 'period') {

            $this->reset('postsPage');

            $this->renderIsland('posts');
        }
    }

    public function loadMorePosts()
    {
        $this->postsPage++;
    }
}
