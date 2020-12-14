import React from "react";
import "./usermenu.scss";
import UserInfo from "./UserInfo";
import LogoutButton from "./LogoutButton";
import UserMenuNav from "./UserMenuNav";
import { MdMenu, MdClear } from "react-icons/md";
import { motion } from "framer-motion";

function UserMenu({ open, setopen }) {
  return (
    <motion.div
      className="usermenu"
      initial={{
        opacity: 0,
        x: 400,
      }}
      animate={{
        opacity: 1,
        x: 0,
      }}
      transition={{
        duration: 0.25,
      }}
    >
      {!open ? (
        <MdMenu
          onClick={() => {
            setopen(!open);
          }}
          className="usermenu__menubutton"
        />
      ) : (
        <MdClear
          onClick={() => {
            setopen(!open);
          }}
          className="usermenu__menubutton"
        />
      )}

      <UserInfo />
      <UserMenuNav />
      <LogoutButton />
    </motion.div>
  );
}

export default function index(props) {
  return <UserMenu {...props} />;
}
