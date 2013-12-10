<?php
/**
 * MTM\Action\LowController
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Action;
use MTM\API\LowAPI;

class LowController extends BaseController {

    public function index() {
        $lowAPI = new LowAPI($this->getRequest());

        if ($this->request->hasInput()) {
            // @todo form validation
            $categories = $this->request->getInput('categories');
            $categories = $categories ? explode(',', $categories) : [];
            $lowAPI->setSelectedCategories($categories);
            $lowAPI->setPriceDesired($this->request->getInput('price-desired'));
            $lowAPI->setPriceMax($this->request->getInput('price-max'));
            $lowAPI->setSearchTerms($this->request->getInput('search'));

            die(json_encode($lowAPI->get(), JSON_PRETTY_PRINT));
        }

        $this->addScript('js/twig.js');
        $this->addScript('js/low.js');
        $this->addStyleSheet('css/low.css');
        $this->render('low/index', [
            'lowAPI' => $lowAPI,
        ]);
    }

}
