<?php
class SiteView extends Phap\View {

    public function index($data) {
        $data['page'] = 'home';
        $this->render(
            $data,
            'templates/Site_index.mustache');
    }

    public function APTAIDCR($data) {
        $data['page'] = 'aptaidcr';
        $this->render(
            $data,
            'templates/Site_APTAIDCR.mustache');
    }

    public function Forms($data) {
        $data['page'] = 'forms';
        $this->render(
            $data,
            'templates/Site_Forms.mustache');
    }

    public function Post($data) {
        $data['page'] = 'post';
        $this->render(
            $data,
            'templates/Site_Post.mustache');
    }

}
