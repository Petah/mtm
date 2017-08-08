<?php
/**
 * MTM\Model\LowModel
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Model;

class LowModel extends BaseModel {

    private $selectedCategories = [];
    private $searchTerms = [];
    private $priceDesired = 1;
    private $priceMax = 100;

    public function matchListing($listing) {
        $selectedCategories = $this->getSelectedCategories();
        if (!empty($selectedCategories)) {
            $match = false;
            foreach ($selectedCategories as $selectedCategory) {
                if (strpos($listing->category->s(), $selectedCategory) === 0) {
                    $match = true;
                    break;
                }
            }
            if (!$match) {
                return false;
            }
        }

        $searchTerms = $this->getSearchTerms();
        if ($searchTerms) {
            if (score($listing->title->s(), $searchTerms) < 0.5) {
                return false;
            }
        }

        $priceMax = $this->getPriceMax();
        if ($priceMax && $listing->priceDisplay->f(true) > $priceMax) {
            return false;
        }

        return true;
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

    public static function iterateAll($dataStore) {
        return $dataStore->iterateModels(__CLASS__);
    }

    public function __sleep() {
        return [
            'selectedCategories',
            'searchTerms',
            'priceDesired',
            'priceMax',
        ];
    }

}
