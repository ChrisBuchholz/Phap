<?php
class FourZeroFourController extends Phap\Controller {

    /* ***** public methods ***** */

    public function __construct(FourZeroFourModel $model,
                                FourZeroFourView $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function index() {
        $data = $this->model->getIndex();
        $this->view->index($data);
    }

}
