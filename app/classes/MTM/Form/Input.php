<?php
/**
 * MTM\Form\Input
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Form;

class Input {

    public $name;
    public $label;
    public $value;
    public $type;
    public $text;
    public $description;

    public function __construct($name) {
        $this->name = $name;
    }

    public function __toString() {
        return $this->render();
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

}
