import axios from "axios";

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
    register: async (data) => {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", local + "auth/register", true);

        try {
            const formData = new FormData();
            formData.append("user_name", data.user_name);
            formData.append("email", data.email);
            formData.append("password", data.password);
            formData.append("date_of_birth", data.date_of_birth);
            formData.append("full_name", data.full_name);

            xhr.send(formData);

            return new Promise((resolve, reject) => {
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200 || xhr.status === 400) {
                            const response = JSON.parse(xhr.responseText);
                            resolve(response);
                        } else {
                            const errorResponse = JSON.parse(xhr.responseText);
                            reject(errorResponse);
                        }
                    }
                };
            });
        } catch (error) {
            console.error(error);
            return Promise.reject(error);
        }
    },
};
