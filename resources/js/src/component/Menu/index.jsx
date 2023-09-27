import React from "react";
import { Link } from "react-router-dom";

const HeaderMenu = () => {
    const Menudata = [
        {
            title: "Phim Lẻ",
            path: "/product/phimle",
        },
        {
            title: "Phim Bộ",
            path: "/product/phimbo",
        },
        {
            title: "Phim chiếu rạp",
            path: "/product/phimchieurap",
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
            path: "/login",
        },
        {
            title: "Đăng Ký",
            path: "/register",
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
