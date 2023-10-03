import React, { useEffect, useState } from "react";
import { useForm, Controller } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import * as yup from "yup";
import { Col, DatePicker, Row } from "antd";
import { useDispatch, useSelector } from "react-redux";
import { Register } from "../../redux/features/authSlice";
import { useNavigate } from "react-router";
import { toast } from "react-toastify";
import { MENU_URL } from "../../constain/Link";
const schema = yup.object().shape({
    user_name: yup.string().required("Vui lòng nhập tên đăng nhập"),
    email: yup
        .string()
        .email("Email không hợp lệ")
        .required("Vui lòng nhập email"),
    password: yup
        .string()
        .required("Vui lòng nhập mật khẩu")
        .min(6, "Mật khẩu phải có ít nhất 6 ký tự"),
    repassword: yup
        .string()
        .oneOf([yup.ref("password"), null], "Mật khẩu không khớp")
        .required("Vui lòng xác nhận mật khẩu"),
    full_name: yup.string().required("Vui lòng nhập họ và tên"),
});

const InputField = ({ name, control, placeholder, type, error }) => (
    <div>
        <Controller
            name={name}
            control={control}
            render={({ field }) => (
                <input {...field} type={type} placeholder={placeholder} />
            )}
        />
        <p>{error?.message}</p>
    </div>
);

const RegistrationForm = () => {
    const { register } = useSelector((state) => state.authem);
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const {
        control,
        handleSubmit,
        formState: { errors },
    } = useForm({
        resolver: yupResolver(schema),
    });
    const [selectedDate, setSelectedDate] = useState(null);
    useEffect(() => {
        console.log(register);
        if (register !== undefined) {
            if (
                register.message !== undefined &&
                register.error_code === undefined
            ) {
                toast.success("Chúc mừng bạn đã đăng ký thành công");
                dispatch(Register(""));
                setTimeout(() => {
                    navigate(MENU_URL.LOGIN);
                }, 1000);
                window.scroll({ top: 0, behavior: "smooth" });
            } else if (register.error_code === "PBS-0400") {
                toast.warning("Thông tin nhập chưa đúng");
                window.scroll({ top: 0, behavior: "smooth" });
            }
        }
    }, [register]);
    const onSubmit = (data) => {
        // const formattedDate = format(selectedDate, "dd/MM/yyyy"); // Định dạng mẫu của bạn
        const birthday = new Date(selectedDate);
        const date_of_birth =
            birthday.getFullYear() +
            "-" +
            Number(birthday.getMonth() + 1) +
            "-" +
            birthday.getDate() +
            " 00:00:00";
        const registerData = {
            email: data.email,
            user_name: data.user_name,
            password: data.password,
            full_name: data.full_name,
            date_of_birth: date_of_birth,
        };
        console.log(registerData);
        dispatch(Register(registerData));
    };

    return (
        <Row align={"center "}>
            <Col className="authem_form pdbt20" span={12}>
                <h3>Đăng Ký</h3>
                <form onSubmit={handleSubmit(onSubmit)}>
                    <InputField
                        name="user_name"
                        control={control}
                        placeholder="Tên Đăng Nhập"
                        type="text"
                        error={errors.user_name}
                    />
                    <InputField
                        name="email"
                        control={control}
                        placeholder="Email"
                        type="text"
                        error={errors.email}
                    />
                    <InputField
                        name="password"
                        control={control}
                        placeholder="Mật khẩu"
                        type="password"
                        error={errors.password}
                    />
                    <InputField
                        name="repassword"
                        control={control}
                        placeholder="Xác nhận mật khẩu"
                        type="password"
                        error={errors.repassword}
                    />
                    <InputField
                        name="full_name"
                        control={control}
                        placeholder="Họ và tên"
                        type="text"
                        error={errors.full_name}
                    />
                    <div>
                        <label>Ngày sinh</label>
                        <DatePicker
                            onChange={(date) => setSelectedDate(date)}
                            value={selectedDate}
                        />
                    </div>
                    <button type="submit">Đăng ký</button>
                </form>
            </Col>
        </Row>
    );
};

export default RegistrationForm;
