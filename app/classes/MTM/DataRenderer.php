<?php
/**
 * MTM\DataRenderer
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM;
use Iterator;

class DataRenderer implements Iterator {

    public $data;

    public function __construct($data) {
        if (is_array($data)) {
            $this->data = array_change_key_case($data, CASE_LOWER);
        } else {
            $this->data = $data;
        }
    }

    public function rewind() {
        if (is_array($this->data)) {
            return reset($this->data);
        }
        return null;
    }

    public function current() {
        if (is_array($this->data)) {
            return new DataRenderer(current($this->data));
        }
        return null;
    }

    public function key() {
        if (is_array($this->data)) {
            return key($this->data);
        }
        return null;
    }

    public function next() {
        if (is_array($this->data)) {
            return next($this->data);
        }
        return null;
    }

    public function valid() {
        if (is_array($this->data)) {
            return key($this->data) !== null;
        }
        return false;
    }

    public function __get($name) {
        $name = strtolower($name);
        if (isset($this->data[$name])) {
            return new static($this->data[$name]);
        }
        return new static(null);
    }

    public function __call($name, $arguments) {
        return new static(call_user_func_array([$this->data, $name], $arguments));
    }

    public function h() {
        return htmlspecialchars($this->data);
    }

    public function ha() {
        return htmlspecialchars($this->data, ENT_QUOTES, 'UTF-8');
    }

    public function s() {
        return (string) $this->data;
    }

    public function d() {
        return (float) $this->data;
    }

    public function i() {
        return (int) $this->data;
    }

    public function b() {
        return (bool) $this->data;
    }

    public function j() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function m($decimalPlaces = 0) {
        $amount = $this->data;
        $negitive = $amount < 0;
        if ($negitive === true) {
            $amount *= -1;
        }

        if ($decimalPlaces == 0) {
            $amount = ($negitive === true ? '- $ ' : '$ ') . number_format($amount, $decimalPlaces);
        } elseif (is_numeric($amount)) {
            $result = rtrim('$ ' . number_format($amount, $decimalPlaces), '0');
            $parts = explode('.', $result);
            if (sizeof($parts) == 1) {
                $parts[1] = str_repeat('0', $decimalPlaces);
            }
            $amount = ($negitive === true ? '- ' : '') . $parts[0] . ($decimalPlaces > 0 ? '.' : '') . str_pad($parts[1], $decimalPlaces, '0', STR_PAD_RIGHT);
        }
        return $amount;
    }

    public function n($decimalPlaces = 0) {
        return number_format($this->data, $decimalPlaces);
    }

}
