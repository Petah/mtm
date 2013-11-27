<?php
/**
 * MTM\Request
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM;

class Request {

    public $url;
    public $input;

    public function getURL() {
        return $this->url;
    }

    public function setURL($url) {
        $this->url = $url;
        return $this;
    }

    public function hasInput($key = null) {
        if ($key !== null) {
            if (!empty($this->input[$key])) {
                return $this->input[$key];
            }
            return null;
        }
        return !empty($this->input);
    }

    public function getInput($key = null) {
        if ($key !== null) {
            if (isset($this->input[$key])) {
                return $this->input[$key];
            }
            return null;
        }
        return $this->input;
    }

    public function setInput(array $input) {
        $this->input = $input;
        return $this;
    }

}
