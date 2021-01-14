import React from "react";
import {MdViewComfy, MdLooks5, MdSchool} from "react-icons/md";
import TeacherMenuNavLink from "./TeacherMenuNavLink";

export default function TeacherMenuNav() {
    return (
        <div className="usermenu__nav">
            <TeacherMenuNavLink
                to="/teacher/plan-zajec/"
                name="Plan zajęć"
                icon={<MdViewComfy/>}
            />
            <TeacherMenuNavLink
                to="/teacher/oceny-czastkowe/"
                name="Panel Ocen Cząstkowych"
                icon={<MdLooks5/>}
            />
            <TeacherMenuNavLink
                to="/teacher/oceny/"
                name="Panel Ocen Końcowych"
                icon={<MdSchool/>}
            />
        </div>
    );
}
