<?php 
namespace App;

class Constants {
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    const ROLE_EDITOR = 3;
    const ROLE_MANAGER_SYSTEM = 4;

    const USER_IS_ACTIVE = 1;
    const USER_IS_DEACTIVE = 0;

    const BRAND_STATUS_ACTIVE = 1;
    const BRAND_STATUS_DEACTIVE = 0;

    const PRODUCT_STATUS_ACTIVE = 1;
    const PRODUCT_STATUS_DEACTIVE = 0;

    const PRODUCT_CATEGORY_STATUS_ACTIVE = 1;
    const PRODUCT_CATEGORY_STATUS_DEACTIVE = 0;

    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
}
?>