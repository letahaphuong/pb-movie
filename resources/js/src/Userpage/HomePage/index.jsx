import React from "react";
import HomepageSlice from "../../component/HomepageSlice";
import { Col, Row, Tabs } from "antd";
import HomeGridMovie from "../../component/HomeGridMovie";
import { Link } from "react-router-dom";
import ListMovie from "../../component/ListMovie";
import TabPane from "antd/es/tabs/TabPane";

const HomePage = () => {
    return (
        <div className="homepage container pdtb20">
            <HomepageSlice />
            <Row style={{ paddingTop: "30px" }}>
                <Col xl={{ span: 18 }} lg={{ span: 18 }} md={{ span: 22 }}>
                    <Row
                        align={"center"}
                        justify={"space-between"}
                        gutter={[24, 18]}
                    >
                        <Col>
                            <p className="title">Phim lẻ mới nhất</p>
                        </Col>
                        <Col>
                            <Link>Xem tất cả</Link>
                        </Col>
                    </Row>
                    <Row>
                        <HomeGridMovie></HomeGridMovie>
                    </Row>
                    <Row
                        align={"center"}
                        justify={"space-between"}
                        gutter={[24, 18]}
                    >
                        <Col>
                            <p className="title">Phim lẻ mới nhất</p>
                        </Col>
                        <Col>
                            <Link>Xem tất cả</Link>
                        </Col>
                    </Row>
                    <Row>
                        <HomeGridMovie></HomeGridMovie>
                    </Row>
                    <Row
                        align={"center"}
                        justify={"space-between"}
                        gutter={[24, 18]}
                    >
                        <Col>
                            <p className="title">Phim lẻ mới nhất</p>
                        </Col>
                        <Col>
                            <Link>Xem tất cả</Link>
                        </Col>
                    </Row>
                    <Row>
                        <HomeGridMovie></HomeGridMovie>
                    </Row>
                </Col>
                <Col
                    xl={{ span: 6 }}
                    lg={{ span: 6 }}
                    md={{ span: 24 }}
                    className="sidebar"
                >
                    <Tabs className="tab-movie">
                        <TabPane key={1} tab="New Movie">
                            <ListMovie quaitity="4"></ListMovie>
                        </TabPane>
                        <TabPane key={2} tab="Most View">
                            <ListMovie quaitity="4"></ListMovie>
                        </TabPane>
                        <TabPane key={3} tab="Hot Movie">
                            <ListMovie quaitity="4"></ListMovie>
                        </TabPane>
                    </Tabs>
                    <Row gutter={[30]} className="sidebar">
                        <Row
                            style={{ width: "100%" }}
                            align={"space-between"}
                            className="alignCenter"
                        >
                            <Col>
                                <p className="title">Phim Hoạt hình</p>
                            </Col>
                            <Col>
                                <Link>Xem tất cả</Link>
                            </Col>
                        </Row>
                        <Row>
                            <ListMovie quaitity="6"></ListMovie>
                        </Row>
                    </Row>
                </Col>
            </Row>
        </div>
    );
};

export default HomePage;
