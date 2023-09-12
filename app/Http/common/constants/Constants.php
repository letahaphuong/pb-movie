<?php

// Regex for acceptable logins
const SYSTEM = "system";
const ANONYMOUS_USER = "anonymoususer";
const USER_ID_LOG_NAME = "userId";
const USER_ID_HEADER_NAME = "X-UserId";
const REQUEST_ID_HEADER_NAME = "X-RequestId";
const DEFAULT_LANG_KEY = "ja";
const REQUEST_ID_LENGTH = 6;
const PASSWORD_MIN_LENGTH = 8;
const EMAIL_PATTERN = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
const PHONE_PATTERN = "^\\d+$";
const POSTAL_CODE_PATTERN = "^\\d{3}-\\d{4}$";

const ACCESS_CONTROL_EXPOSE_HEADERS = "Access-Control-Expose-Headers";

const NAME_PATTERN = '/^[a-zA-Z\sàáảãạăắằẳẵặâấầẩẫậèéẻẽẹêếềểễệđìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ]+$/';

