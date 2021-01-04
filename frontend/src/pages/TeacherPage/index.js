import React, {Suspense, useState, lazy} from "react";
import "./teacherpage.scss";
import LeftMenu from "./LeftMenu";

import TeacherMenu from './TeacherMenu';
import {useDispatch} from "react-redux";
import {login} from "../../actions/auth";


const LoggedUser = {
    firstname: "Jan",
    lastname: "Kowalski",
    index: "jk12345",
    avatar:
        "https://www.tm-town.com/assets/default_male600x600-79218392a28f78af249216e097aaf683.png",
};

function App() {
    const dispatch = useDispatch();
    dispatch(login(LoggedUser));
    const [isMenuOpen, setIsMenuOpen] = useState(false);

    return (
        <div className="user-page">
            <LeftMenu open={isMenuOpen} setopen={setIsMenuOpen}/>
            <div className="content">

            </div>
            <TeacherMenu open={isMenuOpen} setopen={setIsMenuOpen}/>

        </div>
    );
}

export default function index() {
    return <App/>;
}
