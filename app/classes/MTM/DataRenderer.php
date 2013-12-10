<?php
/**
 * MTM\DataRenderer
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM;
use DateTime;
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

    /**
     * Escape HTML.
     *
     * @return string
     */
    public function h() {
        return htmlspecialchars($this->data);
    }

    /**
     * Escape HTML attribute.
     *
     * @return string
     */
    public function ha() {
        return htmlspecialchars($this->data, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Return string.
     *
     * @return string
     */
    public function s() {
        return (string) $this->data;
    }

    /**
     * Return float.
     *
     * @param bool $loose Remove non numeric charaters (exlcuding . and -).
     * @return float
     */
    public function f($loose = false) {
        if ($loose) {
            return (float) preg_replace('/[^0-9.-]/', '', $this->data);
        }
        return (float) $this->data;
    }

    /**
     * Return integer.
     *
     * @return int
     */
    public function i() {
        return (int) $this->data;
    }

    /**
     * Return boolean.
     *
     * @return bool
     */
    public function b() {
        return (bool) $this->data;
    }

    /**
     * Return DateTime.
     *
     * @return bool
     */
    public function d() {
        if (preg_match('@/Date\(([0-9]+)\)/@', $this->data, $matches)) {
            return (new DateTime('@' . floor($matches[1] / 1000)))->format('Y-m-d H:i:s');
        }
        return (new DateTime($this->data))->format('Y-m-d H:i:s');
    }

    /**
     * Return JSON.
     *
     * @return string
     */
    public function j() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    /**
     * Return decimal formatted as money.
     *
     * @param int $decimalPlaces
     * @return string
     */
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

    /**
     * Return number formatted with thousand separators.
     *
     * @param int $decimalPlaces
     * @return string
     */
    public function n($decimalPlaces = 0) {
        return number_format($this->data, $decimalPlaces);
    }

}
