import React from "react";
import "./skeleton.scss";
import PropTypes from "prop-types";

export default function index(props) {
  const { count = 1, type = "line" } = props;
  if (type === "round") {
    return <div className="skeleton round"></div>;
  }
  return (
    <div className="skeleton-container">
      {[...Array(count)].map((x, i) => {
        return <div key={i} className="skeleton"></div>;
      })}
    </div>
  );
}

index.propTypes = {
  count: PropTypes.number,
};
