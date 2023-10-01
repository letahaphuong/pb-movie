import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import { authApi } from "../../../api/index";
import Cookies from "js-cookie";



const initialState = {
    isLoading: false,
    isLogin: false,
    authemData: {},
    register: {},
    errors: {},
};

export const Login = createAsyncThunk(
    "authemSlice/Login",
    async (logindata) => {
        const data = await authApi.login(logindata);
        return data;
    }
);

export const Register = createAsyncThunk(
    "authemSlice/Register",
    async (logindata) => {
        if (logindata === "") {
            return {};
        } else {
            try {
                const response = await authApi.register(logindata);
                return response;
            } catch (error) {
                console.error(error);
                return error.data;
            }
        }
    }
);

const AuthemApi = createSlice({
    name: "authem",
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(Login.pending, (state) => {
                state.isLoading = true;
            })
            .addCase(Login.rejected, (state) => {
                state.isLoading = false;
                state.isLogin = false;
            })
            .addCase(Login.fulfilled, (state, action) => {
                state.isLoading = false;
                state.authemData = action.payload;
                if (state.authemData.message) {
                    state.isLogin = false;
                } else {
                    Cookies.set(
                        "access_token",
                        state.authemData.authorization.access_token,
                        {
                            expires: 1,
                        }
                    );
                    Cookies.set(
                        "refresh_token",
                        state.authemData.authorization.refresh_token,
                        {
                            expires: 1,
                        }
                    );
                    state.isLogin = true;
                }
            })
            .addCase(Register.pending, (state) => {
                state.isLoading = true;
            })

            .addCase(Register.rejected, (state, action) => {
                state.isLoading = false;
                state.register = {}; // Đặt lại dữ liệu đăng ký
                state.register = action.payload; // Lưu lỗi vào trạng thái nếu có lỗi xảy ra
                console.log(state.register);
            })

            .addCase(Register.fulfilled, (state, action) => {
                state.isLoading = false;
                state.register = action.payload; // Lưu dữ liệu đăng ký từ action.payload
                // Kiểm tra dữ liệu đăng ký ở đây và thực hiện xử lý tùy ý
                console.log(state.register);
            });
    },
});

export default AuthemApi.reducer;
