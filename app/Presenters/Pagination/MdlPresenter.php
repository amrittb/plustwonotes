<?php namespace App\Presenters\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;

class MdlPresenter extends BootstrapThreePresenter{

    /**
     * Renders the pagination.
     *
     * @return string
     */
    public function render(){
        if( ! $this->hasPages())
            return '';

        return sprintf(
            '<ul class="pagination">%s %s %s</ul>',
            $this->getPreviousButton(),
            $this->getLinks(),
            $this->getNextButton()
        );
    }

    /**
     * Active Page Wrapper.
     *
     * @param string $text
     * @return string
     */
    protected function getActivePageWrapper($text){
        return '<li class="pagination__link mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent">'.$text.'</li>';
    }

    /**
     * Disabled Text wrapper
     *
     * @param string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text){
        return '<li disabled>'.$text.'</li>';
    }

    /**
     * Page Link Wrapper.
     *
     * @param string $url
     * @param int $page
     * @param null $rel
     * @return string
     */
    public function getPageLinkWrapper($url,$page,$rel = null){
        if($page == $this->currentPage()){
            return $this->getActivePageWrapper($page);
        }
        return '<li><a href="'.$url.'" class="pagination__link mdl-js-ripple-effect mdl-js-button mdl-button">'.$page.'</a></li>';
    }
}