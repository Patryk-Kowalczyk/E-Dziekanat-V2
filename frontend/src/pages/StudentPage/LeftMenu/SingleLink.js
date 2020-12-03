import React from "react";
import { NavLink } from "react-router-dom";
import PropTypes from "prop-types";

function SingleLink({ to, name, icon }) {
  return (
    <NavLink to={to} activeClassName="current" className="menu__item">
      {icon}
      {name}
    </NavLink>
  );
}

SingleLink.propTypes = {
  to: PropTypes.string.isRequired,
  name: PropTypes.string.isRequired,
  icon: PropTypes.node,
};

export default SingleLink;
