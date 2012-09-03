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

}
