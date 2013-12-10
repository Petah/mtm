<?php
/**
 * MTM\Action\BaseController
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Action;
use MTM\DataRenderer;
use MTM\Form;
use MTM\Request;

class BaseController {

    public $request;
    public $scripts = [
        '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
        '//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js',
        'js/mtm.js',
    ];
    public $styleSheets = [
        '//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css',
        '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css',
        'css/mtm.css',
    ];

    public function render($view, $data = [], $layout = 'default') {
        $form = new Form();
        $scripts = $this->getScripts();
        $styleSheets = $this->getStyleSheets();
        $data = new DataRenderer($data);
        include ROOT . '/app/views/layouts/' . $layout . '.php';
    }

    public function getRequest() {
        return $this->request;
    }

    public function setRequest(Request $request) {
        $this->request = $request;
        return $this;
    }

    public function getScripts() {
        return $this->scripts;
    }

    public function setScripts(array $scripts) {
        $this->scripts = $scripts;
        return $this;
    }

    public function addScript($script) {
        $this->scripts[] = $script;
        return $this;
    }

    public function getStyleSheets() {
        return $this->styleSheets;
    }

    public function setStyleSheets(array $styleSheets) {
        $this->styleSheets = $styleSheets;
        return $this;
    }

    public function addStyleSheet($styleSheet) {
        $this->styleSheets[] = $styleSheet;
        return $this;
    }

}
