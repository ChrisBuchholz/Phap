<?php
class FourZeroFourView extends Phap\View {

    public function index($data) {
        $data['page'] = 'fourzerofour';
        $this->render(
            $data,
            'templates/FourZeroFour_index.mustache');
    }

}
