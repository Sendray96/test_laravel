<?php

namespace App\Http\ViewComposers;
use App\Esterno;
use Illuminate\View\View;

class CollabComposer
{
    /**
     * Create a new profile composer.
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('esterni', Esterno::tipo('collaboratore')->get());
    }
}
