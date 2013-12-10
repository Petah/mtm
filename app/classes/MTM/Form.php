<?php
/**
 * MTM\Form
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM;

class Form {

    public $components = [];

    public function addTextField($name) {
        return $this->components[] = new Form\TextField($name);
    }

    public function addMultiSelect($name) {
        return $this->components[] = new Form\MultiSelect($name);
    }

}
