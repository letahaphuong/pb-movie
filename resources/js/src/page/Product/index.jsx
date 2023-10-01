import React from "react";
import ProductGrid from "../../component/ProductGrid";
import { useLocation, useParams } from "react-router";
import { Col, Row } from "antd";
import ListMovie from "../../component/ListMovie";
const Product = () => {
    const { id } = useParams();
    const localState = useLocation().state;
    const product = [
        {
            title: "Phim Lẻ",
            path: "phimle",
        },
        {
            title: "Phim Bộ",
            path: "phimbo",
        },
        {
            title: "Phim Chiếu Rạp",
            path: "phimchieurap",
        },
    ];

    return (
        <div className="container">
            <h2>
                {localState.item !== undefined ? localState.item.title : id}
            </h2>
            <Row>
                <Col xl={{ span: 18 }} lg={{ span: 18 }} md={{ span: 22 }}>
                    <ProductGrid />
                </Col>
                <Col
                    xl={{ span: 6 }}
                    lg={{ span: 6 }}
                    md={{ span: 24 }}
                    className="sidebar"
                >
                    <ListMovie quantity="7" />
                </Col>
            </Row>
        </div>
    );
};

export default Product;
