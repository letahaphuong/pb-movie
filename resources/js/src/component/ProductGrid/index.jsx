import { Col, Row } from "antd";
import React, { useState } from "react";
import MovieCard from "../Card";

const index = () => {
    const data = [
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },

        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },

        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },

        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
        {
            img: "https://phimmoiyyy.net/wp-content/uploads/2023/08/One-Piece.jpg",
            title: "The Fellowship of The Ring",
            desc: "Aquaman",
        },
    ];
    const [currentPage, setCurrentPage] = useState(1);
    const itemsPerPage = 16;
    // Tính số trang dựa trên số lượng phần tử và số phần tử trên mỗi trang
    const totalPages = Math.ceil(data.length / itemsPerPage);

    // Tạo mảng các phần tử để hiển thị trên trang hiện tại
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentItems = data.slice(startIndex, endIndex);

    const changePage = (pageNumber) => {
        setCurrentPage(pageNumber);
    };
    return (
        <div>
            <Row gutter={[24, 18]}>
                {currentItems.map((item) => {
                    return (
                        <Col span={6}>
                            <MovieCard
                                datatype="grid"
                                img={item.img}
                                title={item.title}
                                desc={item.desc}
                            ></MovieCard>
                        </Col>
                    );
                })}
            </Row>
            <div className="pagination">
                {Array.from({ length: totalPages }, (_, index) => (
                    <button
                        key={index}
                        onClick={() => changePage(index + 1)}
                        className={currentPage === index + 1 ? "active" : ""}
                    >
                        {index + 1}
                    </button>
                ))}
            </div>
        </div>
    );
};

export default index;
