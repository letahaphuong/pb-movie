<?php

namespace App\Http\common\constants;

class ErrorCodes
{
    const HANDLE_FILE_FAILED = "PBS-0101";
    // Common
    const VALIDATOR = "PBS-0100";
    const DATA_CONSTRAINT = "PBS-0200";
    const DUPLICATE_DATA = "PBS-0300";
    const BAD_REQUEST = "PBS-0400";
    const UNAUTHORIZED = "PBS-0401";
    const FORBIDDEN = "PBS-0403";
    const NOT_FOUND = "PBS-0404";
    const INVALID_EMAIL_OR_PASSWORD = "PBS-1101";
    const METHOD_NOT_ALLOWED = "PBS-0405";
    const NOT_ACCEPTABLE = "PBS-0406";
    const UNSUPPORTED_MEDIA_TYPE = "PBS-0415";
    const PRECONDITION_REQUIRED = "PBS-0428";
    const INTERNAL_SERVER = "PBS-0500";
    const NOT_IMPLEMENTED = "PBS-0501";
    const OBJECT_NOT_FOUND = "PBSv-0600";
    const REPORT = "PBS-0700";
    const SORT_DATA = "PBS-0800";
    const SECURITY = "PBS-0900";

    // Validator exception error code (Default: PBS-0100)
    const INVALID_KEY = "PBS-1100";
    const USER_WAS_LOCKED = "PBS-1102";
    const INVALID_REFRESH_TOKEN = "PBS-1103";
    const EMAIL_ALREADY_USED = "PBS-1103";
    const EMAIL_NOT_ACTIVATED = "PBS-1104";
    const INVALID_EMAIL = "PBS-1105";
    const INVALID_RESET_KEY = "PBS-1106";
    const INVALID_ROLE_TYPE = "PBS-1107";
    const EXPIRED_KEY = "PBS-1108";
    const LIMIT_NUMBER_OF_SEND_KEY = "PBS-1109";
    const INVALID_PASSWORD = "PBS-1110";
    const INVALID_AUTH_PROVIDER = "PBS-1111";
    const INVALID_OLD_PASSWORD = "PBS-1112";
    const INVALID_USER_SITE = "PBS-1113";
    const PHONE_ALREADY_USED = "PBS-1114";
    const INVALID_PHONE = "PBS-1115";
    const INVALID_POSTAL_CODE = "PBS-1116";
    const SPECIAL_CHARACTERS = "PBS-1117";

    // Data Constraint exception error (Default: PBS-0200)

    // Duplicate Data exception error (Default: PBS-0300)
    const USER_ALREADY_IN_GROUP = "PBS-1300";

    // Validator exception error (Default: PBS-0400)

    // Internal server error (Default: PBS-0500)
    const CANNOT_VERIFY_SOCIAL_ACCESS_TOKEN = "PBS-1500";
    const CANNOT_GET_SOCIAL_USER_PROFILE = "PBS-1501";

    // Object not found exception error (Default: PBS-0600)
    const ROLE_NOT_FOUND = "PBS-1602";
    const USER_NOT_FOUND = "PBS-1603";
    const GENDER_NOT_FOUND = "PBS-1604";
    const PERMISSION_TYPE_NOT_FOUND = "PBS-1605";
    const ROLE_TYPE_NOT_FOUND = "PBS-1606";
    const AUTH_PROVIDER_NOT_FOUND = "PBS-1607";
    const MEDIA_NOT_FOUND = "PBS-1608";
    const GROUP_TYPE_NOT_FOUND = "PBS-1609";
    const GROUP_DETAIL_NOT_FOUND = "PBS-1610";
    const TEMPLATE_FORM_NOT_FOUND = "PBS-1611";
    const ASSESSMENT_TYPE_NOT_FOUND = "PBS-1612";
    const NAME_ALREADY_IN_FORM = "PBS-1613";
}



