import React from "react";
import {MdViewComfy, MdLooks5, MdSchool} from "react-icons/md";
import TeacherMenuNavLink from "./TeacherMenuNavLink";

export default function TeacherMenuNav() {
    return (
        <div className="usermenu__nav">
            <TeacherMenuNavLink
                to="/educator/plan-zajec/"
                name="Plan zajęć"
                icon={<MdViewComfy/>}
            />
            <TeacherMenuNavLink
                to="/educator/oceny-czastkowe/"
                name="Panel Ocen Cząstkowych"
                icon={<MdLooks5/>}
            />
            <TeacherMenuNavLink
                to="/educator/oceny/"
                name="Panel Ocen Końcowych"
                icon={<MdSchool/>}
            />
        </div>
    );
}
