<?php
/**
 * MTM\Action\LowController
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Action;
use MTM\API\LowAPI;
use MTM\Model\LowModel;

class LowController extends BaseController {

    public function index() {
        $lowAPI = new LowAPI();

        if ($this->request->hasInput()) {
            // @todo form validation
            $lowModel = $this->createLowModel();
            $result = [];
            foreach ($lowAPI->get() as $listing) {
                if ($lowModel->matchListing($listing)) {
                    $result[] = [
                        'id' => $listing->listingID->i(),
                        'title' => $listing->title->s(),
                        'image' => $listing->pictureHref->s(),
                        'price' => $listing->priceDisplay->s(),
                        'endDate' => $listing->endDate->d(),
                    ];
                }
            }
            $this->json($result);
            return;
        }

        $this->addScript('js/twig.js');
        $this->addScript('js/low.js');
        $this->addStyleSheet('css/low.css');
        $this->render('low/index', [
            'lowAPI' => $lowAPI,
        ]);
    }

    public function save() {
        if ($this->request->hasInput()) {
            // @todo form validation
            $lowModel = $this->createLowModel();
            $lowModel->save();
        }
        $this->redirect(BASE_URL . 'low');
    }

    private function createLowModel() {
        $lowModel = new LowModel($this->getDataStore());
        $categories = $this->request->getInput('categories');
        $categories = $categories ? explode(',', $categories) : [];
        $lowModel->setSelectedCategories($categories);
        $lowModel->setPriceDesired($this->request->getInput('price-desired'));
        $lowModel->setPriceMax($this->request->getInput('price-max'));
        $lowModel->setSearchTerms($this->request->getInput('search'));
        return $lowModel;
    }

}
