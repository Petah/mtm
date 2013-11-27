<?php
/**
 * MTM\Action\BaseController
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Action;
use MTM\Request;

class BaseController {

    public $request;

    public function getRequest() {
        return $this->request;
    }

    public function setRequest(Request $request) {
        $this->request = $request;
        return $this;
    }

}
