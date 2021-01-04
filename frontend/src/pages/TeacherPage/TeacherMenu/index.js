import React from "react";
import "./teachermenu.scss";
import TeacherInfo from "./TeacherInfo";
import LogoutButton from "./LogoutButton";
import TeacherMenuNav from "./TeacherMenuNav";
import {MdMenu, MdClear} from "react-icons/md";
import {motion} from "framer-motion";

function TeacherMenu({open, setopen}) {
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

            <TeacherInfo/>
            <TeacherMenuNav/>
            <LogoutButton/>
        </motion.div>
    );
}

export default function index(props) {
    return <TeacherMenu {...props} />;
}
