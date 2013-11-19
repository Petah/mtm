<?php
/**
 * MTM\Action\RootController
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Action;

class RootController {

    public static function index() {
        render('index');
    }

    public static function notFound() {
        render('404');
    }

}
