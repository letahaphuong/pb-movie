import React from "react";
import { Col, Row } from "antd";
import MovieCard from "../Card";

const ListMovie = (prop) => {
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
        <Row gutter={[24]}>
            {data.slice(0, prop.quaitity).map((item) => {
                return (
                    <Col span={24}>
                        <MovieCard
                            datatype="list"
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

export default ListMovie;
