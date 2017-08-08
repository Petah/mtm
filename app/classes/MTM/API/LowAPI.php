<?php
/**
 * MTM\API\LowAPI
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\API;

use MTM\DataRenderer;

class LowAPI extends BaseAPI {

    const LOCALITY_ALL = 100;

    private $categoriesURI = '/v1/Categories.json';
    private $closingURI = '/v1/Listings/Closing.json';
    private $selectedCategories = [];
    private $searchTerms = [];
    private $priceDesired = 1;
    private $priceMax = 100;
    private $rows = 250;

    public function get() {
        $result = $this->request($this->getURI());
        $data = new DataRenderer($result);
        $listings = [];
        foreach ($data->list as $listing) {
            yield $listing;
        }
    }

    public function getURI() {
        $query = buildQuery([
            'rows' => $this->getRows(),
        ]);
        return $this->getClosingURI() . '?' . $query;
    }

    public function getCategories() {
        $categories = [];
        $result = $this->request($this->getCategoriesURI());
        $data = new DataRenderer($result);

        $selectedDistricts = array_flip($this->getSelectedCategories());

        foreach ($data->subCategories as $categoryData) {
            $category = [
                'value' => $categoryData->number->s(),
                'name' => $categoryData->name->s(),
            ];
            foreach ($categoryData->subCategories as $subCategoryData) {
                $number = $subCategoryData->number->s();
                $category['options'][] = [
                    'value' => $number,
                    'name' => $subCategoryData->name->s(),
                    'selected' => isset($selectedDistricts[$number])
                ];
            }
            $categories[] = $category;
        }

        return $categories;
    }

    public function getCategoriesURI() {
        return $this->categoriesURI;
    }

    public function setCategoriesURI($categoriesURI) {
        $this->categoriesURI = $categoriesURI;
        return $this;
    }

    public function getClosingURI() {
        return $this->closingURI;
    }

    public function setClosingURI($closingURI) {
        $this->closingURI = $closingURI;
        return $this;
    }

    public function getSelectedCategories() {
        return $this->selectedCategories;
    }

    public function setSelectedCategories($selectedCategories) {
        $this->selectedCategories = $selectedCategories;
        return $this;
    }

    public function getSearchTerms() {
        return $this->searchTerms;
    }

    public function setSearchTerms($searchTerms) {
        $this->searchTerms = $searchTerms;
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

    public function getRows() {
        return $this->rows;
    }

    public function setRows($rows) {
        $this->rows = $rows;
        return $this;
    }

}
