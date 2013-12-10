<?php
/**
 * MTM\Form\TextField
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Form;

class TextField extends Input {

    public function render() {
        return "
            <div>
                <label>{$this->getLabel()}</label>
                <input class='form-control' name='{$this->getName()}' value='{$this->getValue()}'>
                <p class='help-block'>{$this->getDescription()}</p>
            </div>
        ";
    }

}
