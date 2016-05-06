<?php namespace App\Http\ViewComposers;

use App\Http\ViewComposers\Contracts\ViewComposerInterface;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class RolesComposer implements ViewComposerInterface {

    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view) {
        JavaScript::put(['roles' => Role::all()]);
    }
}