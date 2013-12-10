<?php
/**
 * MTM\Form\MultiSelect
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Form;

class MultiSelect extends Input {

    public $optionGroups;

    public function render() {
        $result = "
            <input id='{$this->getName()}' type='hidden' name='{$this->getName()}' />
            <select id='{$this->getName()}-select' multiple='multiple' data-input='{$this->getName()}' class='form-control array-input'>
        ";
        foreach ($this->getOptionGroups() as $optionGroup) {
            $result .= "<optgroup label='{$optionGroup->name->ha()}'>";
            foreach ($optionGroup->options as $option) {
                $selected = $option->selected->b() ? "selected='selected'" : null;
                $result .= "<option value='{$option->value->ha()}' $selected>{$option->name->h()}</option>";
            }
            $result .= "</optgroup>";
        }
        return $result . "
            </select>
        ";
    }

    public function getOptionGroups() {
        return $this->optionGroups;
    }

    public function setOptionGroups($optionGroups) {
        $this->optionGroups = $optionGroups;
        return $this;
    }

}
