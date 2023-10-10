import { Col, Row } from "antd";
import React from "react";
import MovieCard from "../Card";

const HomeGridMovie = (props) => {
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
    ];
    return (
        <Row gutter={[24, 18]}>
            {data.slice(0, 8).map((item) => {
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
    );
};

export default HomeGridMovie;
