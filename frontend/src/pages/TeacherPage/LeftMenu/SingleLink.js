import React,{useState} from "react";
import { NavLink } from "react-router-dom";
import PropTypes from "prop-types";

function SingleLink({ to, name, icon,href }) {
    const hrefFunction = () => {
        if(href){
            window.open( 'https://e-edukacja.zut.edu.pl/');
            return null;
        }
    }
    return (
        <NavLink to={to} activeClassName={href ? "" : "current"} className="menu__item" onClick={hrefFunction}>
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
