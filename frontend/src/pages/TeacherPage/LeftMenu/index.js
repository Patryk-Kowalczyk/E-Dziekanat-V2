import React from "react";
import "./menu.scss";
import logoSmall from "../../../images/logo-male.png";
import Menu from "./Menu";
import { Link } from "react-router-dom";

export default function index({ open, setopen }) {
    return (
        <>
            <nav className={`mainmenu ${open && "active"}`}>
                <Link to="/student" className="mainmenu__logo">
                    <img src={logoSmall} alt="ZUT Logo" />
                </Link>
                <Menu />
            </nav>
            <div className="bglayer" onClick={() => setopen(!open)}></div>
        </>
    );
}
