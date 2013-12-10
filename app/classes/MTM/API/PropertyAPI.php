<?php
/**
 * MTM\API\PropertyAPI
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\API;

use MTM\DataRenderer;
use MTM\Request;

class PropertyAPI extends BaseAPI {

    public $uri = '/v1/Search/Property/Residential.json';
    //?bedrooms_min=3&district=$d&price_max=300000&page=$i
    public $page = 1;
    public $pageSize = 25;
    public $roomsDesired = 4;
    public $roomsMin = 3;
    public $priceDesired = 400000;
    public $priceMax = 500000;
    public $sizeDesired = 1000;
    public $sizeMin = 500;
    public $districts = [];

    public function get() {
        $query = buildQuery([
            'page' => $this->getPage(),
            'bedrooms_min' => $this->getRoomsMin(),
            'price_max' => $this->getPriceMax(),
            'district' => implode(',', $this->getDistricts()),
        ]);
        $result = $this->request($this->getURI() . '?' . $query);
        // @todo validate result
        $data = new DataRenderer($result);

        $properties = [];
        foreach ($data->list as $property) {
            $icon = '';
            $total = 0;

            if ($property->bedrooms->i() >= $this->getRoomsDesired()) {
                $icon .= 'g';
                $total += 1;
            } elseif ($property->bedrooms->i() >= $this->getRoomsMin()) {
                $icon .= 'b';
                $total += 0.5;
            } else {
                $icon .= 'r';
            }

            $price = preg_replace('/[^0-9.]/', '', $property->priceDisplay->s());
            if ($price) {
                if ($price <= $this->getPriceDesired()) {
                    $icon .= 'g';
                    $total += 1;
                } elseif ($price <= $this->getPriceMax()) {
                    $icon .= 'b';
                    $total += 0.5;
                } else {
                    $icon .= 'r';
                }
            } else {
                $icon .= 'w';
            }

            if (!$property->landArea->i()) {
                $icon .= 'w';
            } elseif ($property->landArea->i() >= $this->getSizeDesired()) {
                $icon .= 'g';
                $total += 1;
            } elseif ($property->landArea->i() >= $this->getSizeMin()) {
                $icon .= 'b';
                $total += 0.5;
            } else {
                $icon .= 'r';
            }

            if ($total == 1) {
                $icon .= 'w';
            } elseif ($total = 2) {
                $icon .= 'b';
            } elseif ($total = 3) {
                $icon .= 'g';
            } else {
                $icon .= 'r';
            }

            $properties[] = [
                'id' => $property->listingID->i(),
                'title' => $property->title->s(),
                'price' => $property->priceDisplay->s(),
                'lat' => $property->geographicLocation->latitude->f(),
                'lng' => $property->geographicLocation->longitude->f(),
                'icon' => $icon,
            ];
        }

        return [
            'page' => $data->page->i(),
            'pageSize' => $data->pageSize->i(),
            'totalCount' => $data->totalCount->i(),
            'properties' => $properties,
        ];
    }

    // <editor-fold defaultstate="collapsed" desc="Getters and setters">
    public function getPage() {
        return $this->page;
    }

    public function setPage($page) {
        $this->page = $page;
        return $this;
    }

    public function getPageSize() {
        return $this->pageSize;
    }

    public function setPageSize($pageSize) {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function getURI() {
        return $this->uri;
    }

    public function setURI($uri) {
        $this->uri = $uri;
    }

    public function getRoomsMin() {
        return $this->roomsMin;
    }

    public function setRoomsMin($roomsMin) {
        $this->roomsMin = $roomsMin;
    }

    public function getRoomsDesired() {
        return $this->roomsDesired;
    }

    public function setRoomsDesired($roomsDesired) {
        $this->roomsDesired = $roomsDesired;
        return $this;
    }

    public function getPriceMax() {
        return $this->priceMax;
    }

    public function setPriceMax($priceMax) {
        $this->priceMax = $priceMax;
        return $this;
    }

    public function getPriceDesired() {
        return $this->priceDesired;
    }

    public function setPriceDesired($priceDesired) {
        $this->priceDesired = $priceDesired;
        return $this;
    }

    public function getSizeMin() {
        return $this->sizeMin;
    }

    public function setSizeMin($sizeMin) {
        $this->sizeMin = $sizeMin;
        return $this;
    }

    public function getSizeDesired() {
        return $this->sizeDesired;
    }

    public function setSizeDesired($sizeDesired) {
        $this->sizeDesired = $sizeDesired;
        return $this;
    }

    public function getDistricts() {
        return $this->districts;
    }

    public function setDistricts(array $districts) {
        $this->districts = $districts;
        return $this;
    }

    public function addDistrict($district) {
        $this->districts[] = $district;
        return $this;
    }
    // </editor-fold>

}
