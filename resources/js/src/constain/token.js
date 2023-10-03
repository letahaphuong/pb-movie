import Cookies from "js-cookie";
import jwtDecode from "jwt-decode";

export const TOKEN = {
    ACCESS_TOKEN: Cookies.get("access_token"),
    REFRESH_TOKEN: Cookies.get("refresh_token"),
    ROLE: Cookies.get("access_token")
        ? jwtDecode(Cookies.get("access_token")).role
        : null,
};
