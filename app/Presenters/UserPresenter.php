<?php namespace App\Presenters;

use App\Models\User;
use Robbo\Presenter\Presenter;

class UserPresenter extends Presenter {

    /**
     * Presents name of the user.
     *
     * @return string
     */
    public function presentName() {
        $name = $this->first_name.' ';

        $name .= (is_null($this->middle_name))?'':$this->middle_name.' ';

        $name .= $this->last_name;

        return $name;
    }

    /**
     * Presents actions for the user.
     *
     * @return string
     */
    public function presentActions() {
        return 'Actions';
    }

    /**
     * Presents the status text of the user.
     *
     * @return string
     */
    public function presentStatusText() {
        switch($this->status_id){
            case User::STATUS_ACTIVE:
                return "Active";
                break;
            default:
                return "Inactive";
                break;
        }
    }
}