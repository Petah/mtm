<?php
/**
 * MTM\Action\RootController
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Action;

class RootController extends BaseController {

    public function index() {
        $this->render('index');
    }

    public function notFound() {
        $this->render('404');
    }

}
