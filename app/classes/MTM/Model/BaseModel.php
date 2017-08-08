<?php
/**
 * MTM\Model\BaseModel
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Model;

class BaseModel {

    public $dataStore;
    public $id;

    public function __construct($dataStore) {
        $this->setDataStore($dataStore);
    }

    public function save() {
        return $this->getDataStore()->saveModel($this);
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
        return $this;
    }

    public function getDataStore() {
        return $this->dataStore;
    }

    public function setDataStore($dataStore) {
        $this->dataStore = $dataStore;
        return $this;
    }

}
