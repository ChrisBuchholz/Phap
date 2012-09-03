<?php
class SiteModel extends Phap\Model {

    public function getIndex() {
        return array('content' => 'index');
    }

    public function APTAIDCR($data) {
        return array(
            'content' => 'another page that takes an id cool right',
            'id' => $data['id']);
    }

}
