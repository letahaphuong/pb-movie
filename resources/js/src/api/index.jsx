import axios from "axios";
import {  toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
const local = "http://127.0.0.1:8000/api/v1/";
export const authApi = {
    login: async (data) => {
        const login = {
            method: "post",
            url: local + "auth/login",
            headers: {
                "Content-Type": "application/json",
            },
            data: data,
        };
        try {
            console.log(data);
            const response = await axios(login);
            return response.data;
        } catch (error) {
            console.log(error.response.data);
            return error.response.data;
        }
    },
    register: async (datas) => {
        try {
            const formData = new FormData();
            formData.append("user_name", datas.user_name);
            formData.append("email", datas.email);
            formData.append("password", datas.password);
            formData.append("date_of_birth", datas.date_of_birth);
            formData.append("full_name", datas.full_name);

            const response = await fetch(local + "auth/register", {
                method: "POST",
                body: formData,
            });

            if (response.ok) {
                const data = await response.json();
                return data;
            } else {
                // Xử lý lỗi không thành công
                if (response.status === 400) {
                    const errorResponse = await response.json();
                    console.log(errorResponse.errors);
                    return errorResponse.errors;
                } else if (response.status === 500) {
                    // Lấy thông điệp lỗi 500 từ phản hồi
                    const errorMessage = await response.text();
                    console.error(errorMessage);
                    toast.error("Email Hoặc Username bị trùng");
                    return errorMessage;
                } else {
                    console.error(response.statusText);
                    throw new Error("Lỗi không xác định");
                }
            }
        } catch (error) {
            console.error(error);
            throw error;
        }
    },
    // getInfoUser: async(username) => {

    // }
};
