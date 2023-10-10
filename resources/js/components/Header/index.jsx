import { Col, Row } from "antd";
import React from "react";
import Logo from "../Logo";
import Search from "antd/es/input/Search";
import HeaderMenu from "../Menu";

const Header = () => {
  return (
    <div className="header ">
      <Row className="container">
        <Col span={3}>
          <Logo title="PBmovie"></Logo>
        </Col>
        <Col span={4}>
          <Search />
        </Col>
        <Col span={17}>
          <HeaderMenu />
        </Col>
      </Row>
    </div>
  );
};

export default Header;
