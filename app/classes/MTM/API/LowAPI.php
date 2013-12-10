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

    public function get() {
        $result = $this->request($this->getClosingURI());
        $data = new DataRenderer($result);
        $listings = [];
        $selectedCategories = $this->getSelectedCategories();
        foreach ($data->list as $listing) {
            $match = false;
            foreach ($selectedCategories as $selectedCategory) {
                if (strpos($listing->category->s(), $selectedCategory) === 0) {
                    $match = true;
                    break;
                }
            }
            $searchTerms = $this->getSearchTerms();
            if ($searchTerms && score($listing->title->s(), $searchTerms) > 0.5) {
                $match = true;
            }
            $priceMax = $this->getPriceMax();
            if ($priceMax && $listing->priceDisplay->f(true) > $priceMax) {
                $match = false;
            }
            if ($match) {
                $listings[] = [
                    'id' => $listing->listingID->i(),
                    'title' => $listing->title->s(),
                    'image' => $listing->pictureHref->s(),
                    'price' => $listing->priceDisplay->s(),
                    'endDate' => $listing->endDate->d(),
                ];
            }
        }
        return $listings;
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


}
