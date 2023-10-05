import React from "react";
import { Link } from "react-router-dom";
import { MENU_URL, URL_API } from "../../constain/Link";

const HeaderMenu = () => {
    const Menudata = [
        {
            title: "Phim Lẻ",
            path: "theloai/phimle",
        },
        {
            title: "Phim Bộ",
            path: "theloai/phimbo",
        },
        {
            title: "Phim chiếu rạp",
            path: "theloai/phimchieurap",
        },
        {
            title: "Thể Loại",
            path: "#",
            data: [
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
                {
                    title: "Thiếu nhi",
                    path: "/categories/Thieunhi",
                },
            ],
        },
        {
            title: "Quốc Gia",
            path: "#",
            data: [
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
                {
                    title: "Nhật Bản",
                    path: "nation/nhatban",
                },
            ],
        },
        {
            title: "Đăng Nhập",
            path: MENU_URL.LOGIN,
        },
        {
            title: "Đăng Ký",
            path: MENU_URL.REGISTER,
        },
    ];

    return (
        <ul className="menu">
            {Menudata.map((item) => {
                return (
                    <li className="menutext display-inline">
                        <Link to={item.path} state={{ item }}>
                            {item.title}
                        </Link>
                    </li>
                );
            })}
        </ul>
    );
};

export default HeaderMenu;
