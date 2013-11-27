<?php
/**
 * MTM\API\PropertyAPI
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\API;
use MTM\DataRenderer;

class LocalityAPI extends BaseAPI {

    const LOCALITY_ALL = 100;

    public $uri = '/v1/Localities.json';
    public $districts = [];
    public $suburbs = [];

    public function get() {
        $localities = [];
        $result = $this->request($this->getURI());
        $data = new DataRenderer($result);

        $selectedDistricts = array_flip($this->getDistricts());

        foreach ($data as $localityData) {
            $locality = [
                'id' => $localityData->localityID->i(),
                'name' => $localityData->name->s(),
            ];
            if ($locality['id'] === static::LOCALITY_ALL) {
                continue;
            }
            foreach ($localityData->districts as $districtData) {
                $id = $districtData->districtID->i();
                $locality['districts'][] = [
                    'id' => $id,
                    'name' => $districtData->name->s(),
                    'selected' => isset($selectedDistricts[$id])
                ];
            }
            $localities[] = $locality;
        }

        return $localities;
    }

    public function getURI() {
        return $this->uri;
    }

    public function setURI($uri) {
        $this->uri = $uri;
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

    public function getSuburbs() {
        return $this->suburbs;
    }

    public function setSuburbs(array $suburbs) {
        $this->suburbs = $suburbs;
        return $this;
    }

    public function addSuburb($suburb) {
        $this->suburbs[] = $suburb;
        return $this;
    }

}
