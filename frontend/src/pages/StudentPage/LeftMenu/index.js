import React from "react";
import "./menu.scss";
import logoSmall from "../../../images/logo-male.png";
import Menu from "./Menu";
import { Link } from "react-router-dom";

export default function index() {
  return (
    <nav className="mainmenu">
      <Link to="/student" className="mainmenu__logo">
        <img src={logoSmall} alt="ZUT Logo" />
      </Link>
      <Menu />
    </nav>
  );
}
