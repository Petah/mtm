<?php
/**
 * MTM\Action\LowController
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Action;

class LowController {

    public static function index() {
        $action = new Action\Render();
        $action->setTitle('Get Cheap Stuff');
        $action->setSubTitle('@todo');
        $action->setData([
            
        ]);
        return $action;
        render('low/index');
    }

}
