import { Carousel } from "antd";
import React from "react";

const HomepageSlice = () => {
    const slides = [
        "https://media.slidesgo.com/storage/26293594/movie-awards-ceremony1666019888.jpg",
        "https://media.slidesgo.com/storage/26293594/movie-awards-ceremony1666019888.jpg",
        "https://media.slidesgo.com/storage/26293594/movie-awards-ceremony1666019888.jpg",
        "https://media.slidesgo.com/storage/26293594/movie-awards-ceremony1666019888.jpg",
        "https://media.slidesgo.com/storage/26293594/movie-awards-ceremony1666019888.jpg",
        "https://media.slidesgo.com/storage/26293594/movie-awards-ceremony1666019888.jpg",
    ];
    return (
        <Carousel>
            {slides.map((item) => {
                return <img src={item} alt="" />;
            })}
        </Carousel>
    );
};

export default HomepageSlice;
