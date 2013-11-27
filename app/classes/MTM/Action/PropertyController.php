<?php
/**
 * MTM\Action\PropertyController
 *
 * @author David Neilsen <petah.p@gmail.com>
 */
namespace MTM\Action;

use MTM\API\PropertyAPI;
use MTM\API\LocalityAPI;

class PropertyController extends BaseController {

    public function index() {
        $localityAPI = new LocalityAPI($this->getRequest());
        $propertyAPI = new PropertyAPI($this->getRequest());

        $properties = [];
        if ($this->request->hasInput()) {
            // @todo form validation
            $districts = explode(',', $this->request->getInput('districts'));
            $localityAPI->setDistricts($districts);

            $propertyAPI->setDistricts($districts);
            $properties = $propertyAPI->get();
        }
        
        $localities = $localityAPI->get();
        render('property/index', [
            'localityAPI' => $localityAPI,
            'propertyAPI' => $propertyAPI,
            'localities' => $localities,
            'properties' => $properties,
        ]);
    }

    public function icon() {
        $images = [
            'r' => imagecreatefrompng(ROOT . '/public/images/red-4.png'),
            'g' => imagecreatefrompng(ROOT . '/public/images/green-4.png'),
            'b' => imagecreatefrompng(ROOT . '/public/images/blue-4.png'),
            'w' => imagecreatefrompng(ROOT . '/public/images/white-4.png'),
        ];

        $icon = imagecreatetruecolor(32, 37);

        // Prepare transparent image
        imagesavealpha($icon, true);
        imagealphablending($icon, false);
        $color = imagecolorallocatealpha($icon, 255, 255, 255, 127);
        imagefilledrectangle($icon, 0, 0, 32, 37, $color);

        // @todo validation of type
        $type = $this->request->getInput('type');

        imagecopy($icon, $images[$type[0]], 0, 0, 0, 0, 16, 18);
        imagecopy($icon, $images[$type[1]], 16, 0, 16, 0, 16, 19);
        imagecopy($icon, $images[$type[2]], 0, 18, 0, 18, 16, 18);
        imagecopy($icon, $images[$type[3]], 16, 18, 16, 18, 16, 19);

        header('Content-Type: image/png');

        imagepng($icon);

        imagedestroy($icon);
        foreach ($images as $image) {
            imagedestroy($image);
        }
    }

}
