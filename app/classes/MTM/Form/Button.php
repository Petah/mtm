<?php
/**
 * MTM\Form\Button
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Form;

class Button extends Input {

    public $type = 'submit';

    public function render() {
        return "
            <button type='{$this->getType()}' class='btn btn-default'>
                <span class='glyphicon glyphicon-floppy-disk'></span>
                {$this->getText()}
            </button>
        ";
    }

}
