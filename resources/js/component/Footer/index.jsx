import { Col, Row } from "antd";
import React from "react";

const Footer = () => {
  return (
    <div className="footer">
      <Row className=" container">
        <Col span={7}>
          <h2 className="logo">PBMovie</h2>
          <p>Email: mvbox@gmail.com</p>
          <p>Số điện thoại: 61121316313113</p>
          <p>Địa chỉ: Số 42 Hoàng Diệu, Hải Châu, Đà Nẵng</p>
        </Col>
        <Col span={3}>
          <ul>
            <li>Phim lẻ mới</li>
            <li>Phim bộ</li>
            <li>Phim chiếu rạp</li>
            <li>Phim lẻ mới</li>
          </ul>
        </Col>
        <Col span={4}>
          <ul>
            <li>Phim Hàn Quốc</li>
            <li>Phim Nhật Bản</li>
            <li>Phim Úc</li>
            <li>Phim lẻ mới</li>
          </ul>
        </Col>
        <Col span={4}>
          <ul>
            <li>Phim lẻ mới</li>
            <li>Phim bộ</li>
            <li>Phim chiếu rạp</li>
            <li>Phim lẻ mới</li>
          </ul>
        </Col>
        <Col span={3}>
          <ul>
            <li>Phim lẻ mới</li>
            <li>Phim bộ</li>
            <li>Phim chiếu rạp</li>
            <li>Phim lẻ mới</li>
          </ul>
        </Col>
        <Col span={3}>
          <ul>
            <li>Phim lẻ mới</li>
            <li>Phim bộ</li>
            <li>Phim chiếu rạp</li>
            <li>Phim lẻ mới</li>
          </ul>
        </Col>
      </Row>
    </div>
  );
};

export default Footer;
