<?php
switch (gethostname()) {
    case 'Emily13': {
        define('BASE_URL', 'http://localhost/Users/Dave/OneDrive/Scripts/mtm/public/');
        define('BASE_PATH', '/Users/Dave/OneDrive/Scripts/mtm/public/');
        break;
    }
    default: {
        define('BASE_URL', 'http://localhost:81/Users/David/SkyDrive/Scripts/mtm/public/');
        define('BASE_PATH', '/Users/David/SkyDrive/Scripts/mtm/public/');
    }
}
