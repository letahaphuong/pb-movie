import { BrowserRouter, Route, Routes } from "react-router-dom";
import "./App.css";
import MainLayout from "./component/MainLayout/MainLayout";
import "./assets/style/main.scss";
import LoginForm from "./page/Login";
import RegistrationForm from "./page/Register";
import HomePage from "./page/HomePage";
import Product from "./page/Product";
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
function App() {
    return (
        <div className="App">
            <BrowserRouter>
                <Routes>
                    <Route element={<MainLayout />}>
                        <Route exact path="/" element={<HomePage />}></Route>
                        <Route path="/login" element={<LoginForm />} />
                        <Route
                            path="/register"
                            element={<RegistrationForm />}
                        />
                        <Route path="/product/:id" element={<Product />} />
                    </Route>
                </Routes>
                <ToastContainer
                    position="top-right"
                    autoClose={5000}
                    hideProgressBar
                />
            </BrowserRouter>
        </div>
    );
}

export default App;
