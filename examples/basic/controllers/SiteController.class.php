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

    public function Forms() {
        $data = array();
        $this->view->Forms($data);
    }

    public function Post() {
        $input = Phap\Input::post();
        $rules = array(
            'name' => 'required',
            'email' => 'email');
        $validator = Phap\Validator::make($input, $rules);
        if ($validator->fails()) {
            Phap\Redirect::to(ROOTPATH . 'forms')->with_input($input)->with_errors($validator->errors());
        }
        else {
            $data = array();
            $this->view->Post($data);
        }
    }

}
