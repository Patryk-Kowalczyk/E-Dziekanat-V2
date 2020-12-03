import React from "react";
import "./menu.scss";
import logoSmall from "../../../images/logo-male.png";
import Menu from "./Menu";

export default function index() {
  return (
    <nav className="mainmenu">
      <img src={logoSmall} alt="ZUT Logo" className="mainmenu__logo" />
      <Menu />
    </nav>
  );
}
