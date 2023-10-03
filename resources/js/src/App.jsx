import { BrowserRouter, Route, Routes } from "react-router-dom";
import "./App.css";
import MainLayout from "./component/MainLayout/MainLayout";
import "./assets/style/main.scss";
import LoginForm from "./Userpage/Login";
import RegistrationForm from "./Userpage/Register";
import HomePage from "./Userpage/HomePage";
import Product from "./Userpage/Product";
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { MENU_URL } from "./constain/Link";
import { TOKEN } from "./constain/token";
import AdminHome from "./adminPage/Home_admin";
function App() {
    if (TOKEN.ROLE === "ADMIN") {
        return (
            <div className="App">
                <BrowserRouter>
                    <Routes>
                        <Route element={<MainLayout />}>
                            <Route path="/" element={<AdminHome />}></Route>
                            <Route
                                path={MENU_URL.LOGIN}
                                element={<LoginForm />}
                            />
                        </Route>
                    </Routes>

                    <ToastContainer
                        position="top-right"
                        autoClose={2000}
                        hideProgressBar
                    />
                </BrowserRouter>
            </div>
        );
    } else {
        return (
            <div className="App">
                <BrowserRouter>
                    <Routes>
                        <Route element={<MainLayout />}>
                            <Route
                                exact
                                path="/"
                                element={<HomePage />}
                            ></Route>
                            <Route
                                path={MENU_URL.LOGIN}
                                element={<LoginForm />}
                            />
                            <Route
                                path={MENU_URL.REGISTER}
                                element={<RegistrationForm />}
                            />
                            <Route
                                path={MENU_URL.THELOAI}
                                element={<Product />}
                            />
                        </Route>
                    </Routes>
                    <ToastContainer
                        position="top-right"
                        autoClose={2000}
                        hideProgressBar
                    />
                </BrowserRouter>
            </div>
        );
    }
}

export default App;
