import React from "react";
import {NavLink} from "react-router-dom";

export default function TeacherMenuNavLink({to, icon, name}) {
    return (
        <NavLink to={to} className="usermenu__nav-link" activeClassName="current">
            {icon}
            <p>{name}</p>
        </NavLink>
    );
}
