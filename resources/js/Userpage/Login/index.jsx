import React, { useEffect } from "react";
import { useForm, Controller } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { Col, Row } from "antd";
import { Link, useNavigate } from "react-router-dom";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import { useDispatch, useSelector } from "react-redux";
import { Login } from "../../redux/features/authSlice";
import { toast } from "react-toastify";

function LoginForm() {
    const { isLogin } = useSelector((state) => state.authem);
    const authemData = useSelector((state) => state.authem.authemData);
    const dispatch = useDispatch();
    const schema = yup.object().shape({
        user_name: yup
            .string()

            .required("Vui lòng nhập user_name"),
        password: yup.string().required("Vui lòng nhập mật khẩu"),
    });
    const {
        control,
        handleSubmit,
        formState: { errors },
    } = useForm({
        resolver: yupResolver(schema),
    });
    const navigate = useNavigate();
    const MySwal = withReactContent(Swal);
    // Sử dụng useEffect để theo dõi sự thay đổi của isLogin
    useEffect(() => {
        if (Object.keys(authemData).length > 0) {
            if (isLogin) {
                toast.success("Đăng nhập thành công");
                setTimeout(() => navigate("/"), 1000);
            } else {
                toast.info("Đăng nhập thất bại");
            }
        }
    }, [isLogin, authemData]);

    const onSubmit = (datas) => {
        console.log(datas);
        dispatch(Login(datas));
    };
    if (isLogin) {
        return <h2 style={{ color: "red" }}> Bạn Đã Đăng Nhập </h2>;
    } else {
        return (
            <Row align={"center "}>
                <Col className="authem_form pdbt20" span={6}>
                    <h3>Đăng nhập</h3>
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <div>
                            <Controller
                                name="user_name"
                                control={control}
                                render={({ field }) => (
                                    <input
                                        {...field}
                                        type="text"
                                        placeholder="Tên Đăng Nhập"
                                    />
                                )}
                            />
                            <p>{errors.user_name?.message}</p>
                        </div>
                        <div>
                            <Controller
                                name="password"
                                control={control}
                                render={({ field }) => (
                                    <input
                                        {...field}
                                        type="password"
                                        placeholder="Mật khẩu"
                                    />
                                )}
                            />
                            <p>{errors.password?.message}</p>
                        </div>
                        <button type="submit">Đăng nhập</button>
                        <Link style={{ textAlign: "right" }} to="/register">
                            {" "}
                            Đăng Ký
                        </Link>
                    </form>
                </Col>
            </Row>
        );
    }
}

export default LoginForm;
