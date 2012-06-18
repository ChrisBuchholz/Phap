<?php
class SiteController extends Phap\Controller {

    /* ***** public methods ***** */

    public function __construct(SiteModel $model, SiteView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function index() {
        $data = $this->model->getIndex();
        $this->view->index($data);
    }

    public function APTAIDCR($id) {
        $data = $this->model->APTAIDCR(array('id' => $id));
        $this->view->APTAIDCR($data);
    }

}
