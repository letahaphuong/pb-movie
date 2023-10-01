import React from "react";

const MovieCard = (prop) => {
  return (
    <div className={prop?.datatype === "grid" ? "gridCard" : "listCard"}>
      <div>
        <img src={prop.img} alt="" />
      </div>
      <div>
        <h3>{prop.title}</h3>
        <p>{prop.desc}</p>
      </div>
    </div>
  );
};

export default MovieCard;
