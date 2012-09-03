<?php
class FourZeroFourModel extends Phap\Model {

    /* ***** public methods ***** */

    public function getIndex() {
        $page = $_SERVER['PATH_INFO'];
        return array(
            'title' => "Siden blev ikke fundet",
            'header' => "Siden $page blev ikke fundet",
            'content' => $this->getMarkdown('static/markdown/FourZeroFour_content.markdown')
        );
    }

}
