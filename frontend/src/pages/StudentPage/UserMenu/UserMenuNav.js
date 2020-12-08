import React from "react";
import { MdViewComfy, MdLooks5, MdSchool } from "react-icons/md";
import UserMenuNavLink from "./UserMenuNavLink";

export default function UserMenuNav() {
  return (
    <div className="usermenu__nav">
      <UserMenuNavLink
        to="/student/plan-zajec/"
        name="Plan zajęć"
        icon={<MdViewComfy />}
      />
      <UserMenuNavLink
        to="/student/oceny-czastkowe/"
        name="Oceny cząstkowe"
        icon={<MdLooks5 />}
      />
      <UserMenuNavLink to="/student/oceny/" name="Oceny" icon={<MdSchool />} />
    </div>
  );
}
