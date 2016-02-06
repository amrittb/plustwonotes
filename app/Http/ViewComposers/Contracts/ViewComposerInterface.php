<?php

namespace App\Http\ViewComposers\Contracts;

use Illuminate\Contracts\View\View;

interface ViewComposerInterface{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view);
}