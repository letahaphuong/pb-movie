import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import { authApi } from "../../../api/index";
import Cookies from "js-cookie";

const initialState = {
    isLoading: false,
    isLogin: false,
    authemData: {},
    register: {},
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
        try {
            const response = await authApi.register(logindata);
            return response;
        } catch (error) {
            throw error;
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
            .addCase(Register.rejected, (state) => {
                state.isLoading = false;
                state.isLogin = false;
            })
            .addCase(Register.fulfilled, (state, action) => {
                state.isLoading = false;
                const responseData = action.payload;
                if (responseData.message) {
                    // Xử lý khi đăng ký thất bại
                    state.register = {
                        success: false,
                        message: responseData.message,
                    };
                } else {
                    // Xử lý khi đăng ký thành công
                    state.register = {
                        success: true,
                        message: "Đăng ký thành công",
                    };
                }
            });
    },
});

export default AuthemApi.reducer;
