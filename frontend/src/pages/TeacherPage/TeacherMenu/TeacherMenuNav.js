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
                name="Oceny cząstkowe"
                icon={<MdLooks5/>}
            />
            <TeacherMenuNavLink to="/teacher/oceny/" name="Oceny" icon={<MdSchool/>}/>
        </div>
    );
}
